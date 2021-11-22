<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PremiumSiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/**
 * site routes
 * */
Route::get('/', [SiteController::class, 'show_index_page'])->name('site.home');
Route::get('/industrialising-africa', [SiteController::class, 'show_articles_page'])->name('site.articles.show');
//tingg payment urls
Route::post('/industrialising-africa/pending', [SiteController::class, 'pending_from_tingg'])->name('site.tingg.pending');
Route::post('/industrialising-africa/failure', [SiteController::class, 'failure_from_tingg'])->name('site.tingg.failure');
Route::post('/industrialising-africa/post', [SiteController::class, 'post_from_tingg'])->name('site.tingg.post');
Route::get('/industrialising-africa/success', [SiteController::class, 'show_success_page'])->name('site.success.show');

Route::get('/industrialising-africa/archives', [SiteController::class, 'show_archives_page'])->name('site.archives.show');
Route::get('/industrialising-africa/about', [SiteController::class, 'show_about_page'])->name('site.about.show');
Route::get('/industrialising-africa/faqs', [SiteController::class, 'show_faqs_page'])->name('site.faqs.show');
Route::get('/industrialising-africa/search', [SiteController::class, 'search_articles'])->name('site.articles.search');
Route::get('/industrialising-africa/show/{slug}', [SiteController::class, 'show_full_article'])->name('site.article.full.show');
Route::get('/industrialising-africa/category/{slug}', [SiteController::class, 'get_all_articles_per_category'])->name('site.category.all.articles.show');
Route::post('/industrialising-africa/subscribe', [SiteController::class, 'news_letter'])->name('site.newsletter');

/**
 * subscription page
 */
Route::get('/subscribe/plan/{email}', [PaymentController::class, 'show_subscription_plan'])->name('show.subscription.plan');
Route::post('/subscribe/save/{email}', [PaymentController::class, 'save_subscription_plan'])->name('save.subscription.plan');
Route::get('/subscribe/{email}', [PaymentController::class, 'show_payment_page'])->name('show.subscribe');
Route::post('/subscribe/encryption', [PaymentController::class, 'checkoutEncryption']);

/**
 * users authentication
 * */
Route::get('user/login', [AuthController::class, 'show_login'])->name('show.login');
Route::post('login', [AuthController::class, 'login'])->name('user.login');
Route::get('user/register', [AuthController::class, 'show_register'])->name('show.register');
Route::post('register', [AuthController::class, 'register'])->name('user.register');
Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('user/forgot_pass', [AuthController::class, 'show_forgot_pass_form'])->name('user.show.forgot_pass_form');
Route::post('forgot_pass', [AuthController::class, 'submit_forgot_pass_form'])->name('user.forgot_submit');
Route::get('user/reset_pass/{token}', [AuthController::class, 'show_reset_pass_form'])->name('user.show.reset_form');
Route::post('reset_pass', [AuthController::class, 'reset_pass'])->name('user.reset_pass');

/**
 * authenticated user page - portal
 */
Route::get('portal',[PremiumSiteController::class,'portal'])->name('portal');
Route::get('portal/search',[PremiumSiteController::class,'search_articles'])->name('portal.search');
Route::get('portal/magazine',[PremiumSiteController::class,'show_magazine'])->name('portal.magazine.show');
Route::get('portal/read/{slug}',[PremiumSiteController::class,'read_magazine'])->name('portal.magazine.read');
Route::get('portal/article/{slug}',[PremiumSiteController::class,'show_full_premium_article'])->name('portal.full.article.show');
Route::get('portal/category/{slug}',[PremiumSiteController::class,'get_all_premium_articles_per_category'])->name('portal.category.article.show');

/**
 * filter articles based on category
 * */
Route::get('category/article/{category_id}', [SiteController::class, 'get_category_articles'])->name('get.category.articles');

/**
 * admin authentication
 * */
Route::get('auth-admin/login', [AdminLoginController::class, 'admin_show_login'])->name('admin.show.login');
Route::post('auth-admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::get('auth-admin/register', [AdminLoginController::class, 'admin_show_register'])->name('admin.show.register');
Route::post('auth-admin/register/save', [AdminLoginController::class, 'admin_register'])->name('admin.register');
Route::get('auth-admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

/**
 * dashboard
 * */
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

/**
 * only the person with either the admin or author or both roles can access these routes
 * */
Route::group(['middleware'=>['role:author|admin']], function (){
    Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('magazines', [MagazineController::class, 'index'])->name('magazines.index');

    //articles
    Route::get('articles/create', [ArticlesController::class, 'create_article'])->name('article.create');
    Route::post('articles/save', [ArticlesController::class, 'save_article'])->name('article.save');
    Route::get('articles/edit/{article_id}', [ArticlesController::class, 'edit_article'])->name('article.edit');
    Route::put('articles/update/{article_id}', [ArticlesController::class, 'update_article'])->name('article.update');
    Route::get('articles/show/{article_id}', [ArticlesController::class, 'show_article'])->name('article.show');
    Route::put('articles/delete/{article_id}', [ArticlesController::class, 'delete_article'])->name('article.delete');
    /**
     * individual articles for an admin or author
     */
    Route::get('articles/{author_id}', [ArticlesController::class, 'my_articles'])->name('my_articles.index');

    //categories
    Route::get('categories/create', [CategoryController::class, 'create_category'])->name('category.create');
    Route::post('categories/save', [CategoryController::class, 'save_category'])->name('category.save');
    Route::get('categories/edit/{category_id}', [CategoryController::class, 'edit_category'])->name('category.edit');
    Route::post('categories/update/{category_id}', [CategoryController::class, 'update_category'])->name('category.update');
    Route::get('categories/show/{category_id}', [CategoryController::class, 'show_category'])->name('category.show');
    Route::put('categories/delete/{category_id}', [CategoryController::class, 'delete_category'])->name('category.delete');

    //magazines
    Route::get('magazines/create', [MagazineController::class, 'create_magazine'])->name('magazine.create');
    Route::post('magazines/save', [MagazineController::class, 'save_magazine'])->name('magazine.save');
    Route::post('magazines/upload', [MagazineController::class, 'upload_magazine_digital_copy'])->name('magazine.upload.copy');
    Route::get('magazines/edit/{magazine_id}', [MagazineController::class, 'edit_magazine'])->name('magazine.edit');
    Route::post('magazines/update/{magazine_id}', [MagazineController::class, 'update_magazine'])->name('magazine.update');
    Route::get('magazines/show/{magazine_id}', [MagazineController::class, 'show_magazine'])->name('magazine.show');

    //magazine articles
    Route::post('magazines/article/{magazine_id}', [MagazineController::class, 'add_magazine_article'])->name('magazine.article.add');
    Route::get('magazines/article/edit/{magazine_article_id}', [MagazineController::class, 'edit_magazine_article'])->name('magazine.article.edit');
    Route::post('magazines/article/update/{magazine_article_id}', [MagazineController::class, 'update_magazine_article'])->name('magazine.article.update');
    Route::post('magazines/article/delete/{magazine_article_id}', [MagazineController::class, 'delete_magazine_article'])->name('magazine.article.delete');
});


/**
 * These routes are strictly accessible by the person with admin role only
 */
Route::group(['middleware'=>'role:admin'], function (){
    //only the admin can publish or un-publish an article
    Route::put('articles/publish/{article_id}', [ArticlesController::class, 'publish_draft_article'])->name('article.publish');
    //only the admin can publish or un-publish a magazine
    Route::put('magazines/publish/{magazine_id}', [MagazineController::class, 'publish_draft_magazine'])->name('magazine.publish');
    Route::put('magazines/delete/{magazine_id}', [MagazineController::class, 'delete_magazine'])->name('magazine.delete');

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
    Route::post('admins/make/{admin_id}',[AdminController::class,'make_super_admin'])->name('admin.make.super');
    Route::get('admins/show/{admin_id}',[AdminController::class,'show_admin'])->name('admin.show');
    Route::post('admins/delete/{admin_id}',[AdminController::class,'delete_admin'])->name('admin.delete');

    //notifications
    Route::get('notifications', [NotificationsController::class,'show_all_notifications'])->name('notifications.all.show');
    Route::post('notifications/mark_as_read/{notification_id}', [NotificationsController::class,'mark_as_read'])->name('notification.mark.as.read');
    Route::post('notifications/publish/ajax/{article_id}', [NotificationsController::class, 'publish_article'])->name('article.ajax.publish');
});
