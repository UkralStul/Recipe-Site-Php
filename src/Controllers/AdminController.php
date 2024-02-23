<?php

namespace App\Controllers;

use App\Services\RecipeService;

class AdminController extends \App\Kernel\Controller\Controller
{
    public function index()
    {
        $recipes = new RecipeService($this->db());

        $this->view('admin', [
            'recipes' => $recipes->all(),
        ]);
    }
}