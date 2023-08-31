<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;


class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Users', 'Categories'],
            'order' => ['created' => 'desc'],
            'limit' => 10
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function view()
    {
        $this->Authorization->skipAuthorization();
        $id = $this->request->getParam("id");
        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'Categories', 'Tags', 'Comments'],
        ]);
        $comment_entity = $this->fetchTable('Comments')->newEmptyEntity();
        $comments_table = $this->getTableLocator()->get('Comments');

        $this->set(compact('article', 'comment_entity', 'comments_table'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $image_file = $this->request->getData()["image_file"];

            $article = $this->Articles->patchEntity($article, $data);
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article, ["image_file" => $image_file])) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect([
                    'controller' => 'Users',
                    'action' => 'view',
                ]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }

        $categories = $this->Articles->Categories->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'categories', 'tags'));
    }

    public function edit()
    {
        $id = $this->request->getParam("id");
        $article = $this->Articles->get($id, [
            'contain' => ['Tags'],
        ]);
        $this->Authorization->authorize($article);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $image_file = $this->request->getData()["image_file"];

            $article = $this->Articles->patchEntity($article, $data);

            if ($this->Articles->save($article, ["image_file" => $image_file])) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect([
                    'controller' => 'Users',
                    'action' => 'view',
                ]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }

        $categories = $this->Articles->Categories->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'categories', 'tags'));
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getParam("id");
        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article);

        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            'controller' => 'Users',
            'action' => 'view',
        ]);
    }
}
