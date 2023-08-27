<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $article_id
 * @property int|null $parent_id
 * @property string $name
 * @property string $content
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\ParentComment $parent_comment
 * @property \App\Model\Entity\ChildComment[] $child_comments
 */
class Comment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'article_id' => true,
        'parent_id' => true,
        'name' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        // 'article' => true,
        // 'parent_comment' => true,
        // 'child_comments' => true,
    ];
}
