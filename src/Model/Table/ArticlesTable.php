<?php

declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Datasource\EntityInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Articles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'article_id',
            "conditions" => ['Comments.parent_id IS' => null]
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'articles_tags',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('category_id')
            ->allowEmptyString('category_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('excerpt')
            ->maxLength('excerpt', 255)
            ->requirePresence('excerpt', 'create')
            ->notEmptyString('excerpt');

        $validator
            ->allowEmptyFile('image_file')
            ->uploadedFile('image_file', [
                'types' => ['image/png', 'image/jpg', 'image/jpeg'],
                'minSize' => 1024, // Min 1 KB
                'maxSize' => 1024 * 1024 // Max 1 MB
            ])
            ->add('image_file', 'minSize', [
                'rule' => ['imageSize', [
                    // Min 10x10 pixels
                    'width' => [Validation::COMPARE_GREATER_OR_EQUAL, 10],
                    'height' => [Validation::COMPARE_GREATER_OR_EQUAL, 10],
                ]]
            ])
            ->add('image_file', 'maxSize', [
                'rule' => ['imageSize', [
                    // Min 4000x4000 pixels
                    'width' => [Validation::COMPARE_LESS_OR_EQUAL, 4000],
                    'height' => [Validation::COMPARE_LESS_OR_EQUAL, 4000],
                ]]
            ])
            ->add('image_file', 'filename', [
                'rule' => function (UploadedFileInterface $file) {
                    // filename must not be a path
                    $filename = $file->getClientFilename();
                    if (strcmp(basename($filename), $filename) === 0) {
                        return true;
                    }
                    return false;
                }
            ])
            ->add('image_file', 'extension', [
                'rule' => ['extension', ['png', 'jpg', 'jpeg']]
            ]);

        $validator
            ->scalar('caption')
            ->maxLength('caption', 255)
            ->allowEmptyString('caption');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('category_id', 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $image_file = $options["image_file"];

        if ($image_file and $image_file->getError() === 0 and !$entity->getErrors()) {
            // $file_name = Security::hash($image_file->getClientFilename(), 'sha1'); // add name hashing later
            $file_name = $image_file->getClientFilename();
            $image_path = WWW_ROOT . "img/articles" . DS . $file_name;

            if (!$entity->isNew() and $entity->image) {
                $stored_file = WWW_ROOT . "img/articles" . DS . $entity->image;
                if (file_exists($stored_file)) {
                    unlink($stored_file);
                }
            }

            $image_file->moveTo($image_path);
            $entity->image = $file_name;
        }
    }

    public function beforeDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->image) {
            $stored_file = WWW_ROOT . "img/articles" . DS . $entity->image;
            if (file_exists($stored_file)) {
                unlink($stored_file);
            }
        }
    }

    public function findTagged(Query $query, array $options)
    {
        $columns = [
            'Articles.id', 'Articles.user_id', 'Articles.title',
            'Articles.content', 'Articles.image', 'Articles.created',
            'Articles.caption', 'Articles.excerpt'
        ];

        $query = $query
            ->select($columns)
            ->distinct($columns);

        // If there are no tags provided, find articles that have no tags
        if (empty($options['tags'])) {
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Articles.id']);
    }
}
