<?php

declare(strict_types=1);

namespace App\Controller;


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
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'Categories', 'Tags'],
            // 'contain' => ['Users', 'Categories', 'Tags', 'Comments'],
        ]);

        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $categories = $this->Articles->Categories->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'users', 'categories', 'tags'));
    }

    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags'],
        ]);
        $this->Authorization->authorize($article);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $categories = $this->Articles->Categories->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'users', 'categories', 'tags'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article);

        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
