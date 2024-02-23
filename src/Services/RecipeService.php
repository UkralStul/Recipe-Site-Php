<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;

class RecipeService
{
    public function __construct(
        private DatabaseInterface $db
    )
    {
    }

    public function store(string $name, string $description, UploadedFileInterface $image): false|int
    {
        $filePath = $image->move('recipes');

        return $this->db->insert('recipes', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
        ]);
    }

    public function all(): array
    {
        $recipes = $this->db->get('recipes');

        $recipes = array_map(function ($recipe){
            return new Recipe(
                id: $recipe['id'],
                name: $recipe['name'],
                preview: $recipe['preview'],
                createdAt: $recipe['created_at'],
                description: $recipe['description'],
            );
        }, $recipes);
        return $recipes;
    }

    public function find(int $id): ?Recipe
    {
        $recipe = $this->db->first('recipes',[
            'id' => $id
        ]);

        if (! $recipe){
            return null;
        }

        $comments = $this->db->get('comments',[
            'recipe_id' => $id,
        ]);



        $comments = array_map(function ($comment) {
            $user = $this->db->first('users', [
                'id' => $comment['user_id']
            ]);

            return new Comment(
                $comment['id'],
                $comment['user_id'],
                $comment['comment'],
                $comment['created_at'],
                new User(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['password'],
                    $user['is_admin'],
                )
            );
        }, $comments);

        return new Recipe(
            id: $recipe['id'],
            name: $recipe['name'],
            preview: $recipe['preview'],
            createdAt: $recipe['created_at'],
            description: $recipe['description'],
            comments: $comments,
        );
    }

    public function update(int $id, string $name, string $description, ?UploadedFileInterface $image): void
    {
        $data = [
            'name' => $name,
            'description' => $description,];
        if ($image && ! $image->hasError()){
            $data['preview'] = $image->move('recipes');
        }

        $this->db->update('recipes',$data , [
                'id' => $id,
            ]);
    }

    public function new(): array
    {
        $recipes = $this->db->get('recipes', [], ['id' => 'DESC'], 5);
        return array_map(function ($recipe) {
            return new Recipe(
                id: $recipe['id'],
                name: $recipe['name'],
                preview: $recipe['preview'],
                createdAt: $recipe['created_at'],
                description: $recipe['description'],
            );
        }, $recipes);
    }
    public function favoriteRecipes(int $userId): array
    {
        $favoriteRecipes = $this->db->get('favorite_recipes', [
            'user_id' => $userId,
        ]);
        $recipes = [];
        foreach ($favoriteRecipes as $recipe) {
            $recipe = $this->db->get('recipes', [
                'id' => $recipe['recipe_id'],
            ]);
            array_push($recipes, new Recipe(
                id: $recipe[0]['id'],
                name: $recipe[0]['name'],
                preview: $recipe[0]['preview'],
                createdAt: $recipe[0]['created_at'],
                description: $recipe[0]['description'],
            ));
        }
        return $recipes;
    }
}