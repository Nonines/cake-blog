<?php

declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\FactoryLocator;

/**
 * Comments Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\BelongsTo $ParentComments
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $ChildComments
 *
 * @method \App\Model\Entity\Comment newEmptyEntity()
 * @method \App\Model\Entity\Comment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Comment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Comment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsTable extends Table
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

        $this->setTable('comments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ParentComment', [
            'className' => 'Comments',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildComments', [
            'className' => 'Comments',
            'foreignKey' => 'parent_id',
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
            ->integer('article_id')
            ->notEmptyString('article_id');

        $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

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
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('parent_id', 'ParentComment'), ['errorField' => 'parent_id']);

        return $rules;
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        // make sure child comment shares same article_id as parent comment
        $parent_id = $options["parent_id"];
        if ($parent_id) {
            $comments = FactoryLocator::get('Table')->get('Comments');
            $parent_comment = $comments->get($parent_id);
            $article_id = $parent_comment->article_id;
            $entity->article_id = $article_id;
        }
    }
}
