<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\RecipeService;

class ProfileController extends Controller
{
    public function index()
    {
        $service = new RecipeService($this->db());

        $this->view('profile', [
            'recipes' => $service->favoriteRecipes($this->auth()->user()->id())
        ]);
    }
}