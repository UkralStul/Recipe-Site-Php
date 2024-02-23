<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class CommentController extends Controller
{
    public function store()
    {
        $validation = $this->request()->validate([
            'comment' => ['required', 'min:3'],
        ]);

        if (! $validation){
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }
            $this->redirect("/recipe?id={$this->request()->input('id')}");
        }
        $this->db()->insert('comments', [
           'comment' => $this->request()->input('comment'),
           'recipe_id' => $this->request()->input('id'),
            'user_id' => $this->auth()  ->id(),
        ]);
        $this->redirect("/recipe?id={$this->request()->input('id')}");
    }
}