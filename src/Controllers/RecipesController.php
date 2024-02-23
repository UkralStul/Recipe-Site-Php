<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\RecipeService;

class RecipesController extends Controller
{
    private RecipeService $service;

    public function add(): void
    {
        $this->view('AddRecipe');
    }
    public function store()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required']
        ]);
        if (! $validation){
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set('name.errors', $this->request()->errors());
            }
            $this->redirect('/admin/recipes/add');
            dd($this->request()->errors());
        }
        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
        );
        $this->redirect('/admin');
    }
    public function show():void
    {
        $this->view('recipe', [
            'recipe' => $this->service()->find($this->request()->input('id'))
        ]);
    }
    public function service(): RecipeService
    {
        if (! isset($this->service)){
            $this->service = new RecipeService($this->db());
        }

        return $this->service;
    }
    public function edit(): void
    {
        $service = new RecipeService($this->db());

        $recipe = $this->service()->find($this->request()->input('id'));

        $this->view('UpdateRecipe',[
            'recipe' => $recipe,
            'recipes' => $service->all()
        ]);
    }

    public function update()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required']
        ]);
        if (! $validation){
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set('name.errors', $this->request()->errors());
            }
            $this->redirect("/admin/recipe/update?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image')
        );

        $this->redirect('/admin');
    }

    public function destroy()
    {
        $this->db()->delete('recipes', [
            'id' => $this->request()->input('id'),
        ]);

        $this->redirect('/admin');
    }

    public function destroyFavoriteRecipe()
    {
        $this->db()->delete('favorite_recipes', [
            'recipe_id' => $this->request()->input('id'),
            'user_id' => $this->auth()->user()->id(),
        ]);

        $this->redirect('/profile');
    }

    public function addFavoriteRecipe(): void
    {
        $this->db()->insert('favorite_recipes', [
            'recipe_id' => $this->request()->input('id'),
            'user_id' => $this->auth()->id(),
        ]);
        $this->redirect("/recipe?id={$this->request()->input('id')}");
    }
}