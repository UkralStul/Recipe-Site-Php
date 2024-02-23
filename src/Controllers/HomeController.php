<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;
use App\Services\RecipeService;

class HomeController extends Controller
{
    public function index(): void
    {
        $recipes = new RecipeService($this->db());

        $this->view('home', [
            'recipes' => $recipes->new(),
        ]);
    }
}