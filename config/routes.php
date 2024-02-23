<?php

use App\Controllers\AdminController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ProfileController;
use App\Controllers\RecipesController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;

return [
    Route::get('/home',[HomeController::class, 'index']),
    Route::get('/register',[RegisterController::class, 'index']),
    Route::post('/register',[RegisterController::class, 'register']),
    Route::get('/login',[LoginController::class, 'index']),
    Route::post('/login',[LoginController::class, 'login']),
    Route::post('/logout',[LoginController::class, 'logout']),
    Route::get('/admin',[AdminController::class, 'index']),
    Route::get('/admin/recipes/add',[RecipesController::class, 'add']),
    Route::post('/admin/recipes/add',[RecipesController::class, 'store']),
    Route::post('/admin/recipes/destroy',[RecipesController::class, 'destroy']),
    Route::get('/admin/recipes/update',[RecipesController::class, 'edit']),
    Route::post('/admin/recipes/update',[RecipesController::class, 'update']),
    Route::get('/recipe',[RecipesController::class, 'show']),
    Route::post('/favoriteRecipes/add',[RecipesController::class, 'addFavoriteRecipe']),
    Route::post('/favoriteRecipes/destroy',[RecipesController::class, 'destroyFavoriteRecipe']),
    Route::post('/comments/add',[CommentController::class, 'store']),
    Route::get('/profile',[ProfileController::class, 'index']),


];