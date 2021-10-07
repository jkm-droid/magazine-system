<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

//site routes
Route::get('/', [SiteController::class, 'show_index_page'])->name('home');
Route::get('/article/search', [SiteController::class, 'search_articles'])->name('articles.search');
Route::get('/article/show/{slug}', [SiteController::class, 'show_full_article'])->name('article.full.show');
Route::get('/article/category/{slug}', [SiteController::class, 'get_all_articles_per_category'])->name('category.all.articles.show');

//filter articles based on category
Route::get('category/article/{category_id}', [SiteController::class, 'get_category_articles'])->name('get.category.articles');

//admin authentication
Route::get('admin/login', [AdminLoginController::class, 'admin_show_login'])->name('admin.show.login');
Route::post('admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

//dashboard
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

//admin articles
Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('articles/create', [ArticlesController::class, 'create_article'])->name('article.create');
Route::post('articles/save', [ArticlesController::class, 'save_article'])->name('article.save');
Route::get('articles/edit/{article_id}', [ArticlesController::class, 'edit_article'])->name('article.edit');
Route::put('articles/update/{article_id}', [ArticlesController::class, 'update_article'])->name('article.update');
Route::get('articles/show/{article_id}', [ArticlesController::class, 'show_article'])->name('article.show');
Route::put('articles/delete/{article_id}', [ArticlesController::class, 'delete_article'])->name('article.delete');
Route::put('articles/publish/{article_id}', [ArticlesController::class, 'publish_draft_article'])->name('article.publish');

//individual admin
Route::get('articles/{author_id}', [ArticlesController::class, 'my_articles'])->name('my_articles.index');

//admin categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create_category'])->name('category.create');
Route::post('categories/save', [CategoryController::class, 'save_category'])->name('category.save');
Route::get('categories/edit/{category_id}', [CategoryController::class, 'edit_category'])->name('category.edit');
Route::post('categories/update/{category_id}', [CategoryController::class, 'update_category'])->name('category.update');
Route::get('categories/show/{category_id}', [CategoryController::class, 'show_category'])->name('category.show');
Route::put('categories/delete/{category_id}', [CategoryController::class, 'delete_category'])->name('category.delete');


