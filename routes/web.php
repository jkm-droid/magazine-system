<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
Route::get('auth_admin/login', [AdminLoginController::class, 'admin_show_login'])->name('admin.show.login');
Route::post('auth_admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::get('auth_admin/register', [AdminLoginController::class, 'admin_show_register'])->name('admin.show.register');
Route::post('auth_admin/register', [AdminLoginController::class, 'admin_register'])->name('admin.register');
Route::get('auth_admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

//dashboard
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

/**
 * everyone (admin / author) can view all the articles, categories
 */
Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

/**
 * only the person with either the admin or author role can access these routes
 * */
Route::group(['middleware'=>['role:author,admin']], function (){
    //articles
    Route::get('articles/create', [ArticlesController::class, 'create_article'])->name('article.create');
    Route::post('articles/save', [ArticlesController::class, 'save_article'])->name('article.save');
    Route::get('articles/edit/{article_id}', [ArticlesController::class, 'edit_article'])->name('article.edit');
    Route::put('articles/update/{article_id}', [ArticlesController::class, 'update_article'])->name('article.update');
    Route::get('articles/show/{article_id}', [ArticlesController::class, 'show_article'])->name('article.show');
    Route::put('articles/delete/{article_id}', [ArticlesController::class, 'delete_article'])->name('article.delete');

    //categories
    Route::get('categories/create', [CategoryController::class, 'create_category'])->name('category.create');
    Route::post('categories/save', [CategoryController::class, 'save_category'])->name('category.save');
    Route::get('categories/edit/{category_id}', [CategoryController::class, 'edit_category'])->name('category.edit');
    Route::post('categories/update/{category_id}', [CategoryController::class, 'update_category'])->name('category.update');
    Route::get('categories/show/{category_id}', [CategoryController::class, 'show_category'])->name('category.show');
    Route::put('categories/delete/{category_id}', [CategoryController::class, 'delete_category'])->name('category.delete');
});


/**
 * individual articles for an admin or author
 */
Route::get('articles/{author_id}', [ArticlesController::class, 'my_articles'])->name('my_articles.index');

/**
 * These routes are strictly accessible by the person with admin role only
 */
Route::group(['middleware'=>'role:admin'], function (){
    //only the admin can publish or un-publish an article
    Route::put('articles/publish/{article_id}', [ArticlesController::class, 'publish_draft_article'])->name('article.publish');

    //roles
    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('roles/create', [RoleController::class, 'create_role'])->name('role.create');
    Route::post('roles/save', [RoleController::class, 'save_role'])->name('role.save');
    Route::get('roles/edit/{slug}', [RoleController::class, 'edit_role'])->name('role.edit');
    Route::post('roles/update/{role_id}', [RoleController::class, 'update_role'])->name('role.update');
    Route::get('roles/show/{slug}', [RoleController::class, 'show_role'])->name('role.show');
    Route::post('roles/delete/{slug}', [RoleController::class, 'delete_role'])->name('role.delete');

    //permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('permissions/create', [PermissionController::class, 'create_permission'])->name('permission.create');
    Route::post('permissions/save', [PermissionController::class, 'save_permission'])->name('permission.save');
    Route::get('permissions/edit/{slug}', [PermissionController::class, 'edit_permission'])->name('permission.edit');
    Route::post('permissions/update/{slug}', [PermissionController::class, 'update_permission'])->name('permission.update');
    Route::get('permissions/show/{slug}', [PermissionController::class, 'show_permission'])->name('permission.show');
    Route::post('permissions/delete/{slug}', [PermissionController::class, 'delete_permission'])->name('permission.delete');

    //authors/admins
    Route::get('admins',[AdminController::class,'index'])->name('admin.index');
    Route::get('admins/create',[AdminController::class,'create_admin'])->name('admin.create');
    Route::post('admins/send',[AdminController::class,'send_admin_invite_link'])->name('admin.send.link');
    Route::get('admins/edit/{admin_id}',[AdminController::class,'edit_admin'])->name('admin.edit');
    Route::post('admins/update/{admin_id}',[AdminController::class,'update_admin'])->name('admin.update');
    Route::get('admins/show/{admin_id}',[AdminController::class,'show_admin'])->name('admin.show');
    Route::post('admins/delete/{admin_id}',[AdminController::class,'delete_admin'])->name('admin.delete');
});
