<?php

declare(strict_types=1);

namespace App\Controller;


class CommentsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['add', 'reply']);
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();
        $comment = $this->Comments->newEmptyEntity();

        if ($this->request->is('post')) {
            $parent_id = $this->request->getData()["parent_id"];
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());

            if ($this->Comments->save($comment, ["parent_id" => $parent_id])) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(["controller" => "Articles", "action" => "view", "id" => $this->request->getData("article_id")]);
            }

            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            return $this->redirect($this->referer());
        }
    }

    public function reply()
    {
        $this->Authorization->skipAuthorization();
        $comment_id = $this->request->getParam("comment_id");
        $article_id = $this->request->getParam("article_id");

        $comment = $this->Comments->get($comment_id);
        $comment_entity = $this->Comments->newEmptyEntity();
        $this->set(compact('comment', 'comment_entity', 'article_id'));
    }
}
