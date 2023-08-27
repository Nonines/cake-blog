<?php

declare(strict_types=1);

namespace App\Controller;


class CommentsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['add']);
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();
        $comment = $this->Comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(["controller" => "Articles", "action" => "view", $this->request->getData("article_id")]);
            }

            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            return $this->redirect($this->referer());
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $comment = $this->Comments->get($id);
    //     if ($this->Comments->delete($comment)) {
    //         $this->Flash->success(__('The comment has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
