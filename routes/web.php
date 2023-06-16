<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\productController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\etatController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StaterkitController::class, 'home'])->name('home');
Route::get('home', [StaterkitController::class, 'home'])->name('home');
Route::get('shop', [StaterkitController::class, 'shop'])->name('shop');
// Route Components
Route::get('layouts/collapsed-menu', [
    StaterkitController::class,
    'collapsed_menu',
])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name(
    'layout-full'
);
Route::get('layouts/without-menu', [
    StaterkitController::class,
    'without_menu',
])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name(
    'layout-empty'
);
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name(
    'layout-blank'
);

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::group(['prefix' => 'app'], function () {
    Route::get('ecommerce/shop', [
        StaterkitController::class,
        'ecommerce_shop',
        ])->name('app-ecommerce-shop');
        Route::get('ecommerce/details/{id}', [
            StaterkitController::class,
            'ecommerce_details',
    ])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [
        StaterkitController::class,
        'ecommerce_wishlist',
    ])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [
        StaterkitController::class,
        'ecommerce_checkout',
    ])->name('app-ecommerce-checkout');
});
Route::get('Aboutus', [
    StaterkitController::class,
    'Aboutus',
])->name('Aboutus');

Route::get('/app/ecommerce/shop/search', [
    StaterkitController::class,
    'search',
    ])->name('search');

Route::resource('/checkout', 
    CheckoutController::class,
   );

Route::resource('/Comment', 
    ContactController::class,
   );

Route::get('/Contact', [
    StaterkitController::class,
    'contact',
    ])->name('contact');
Route::get('/app/ecommerce/shop/whishlist', [
        StaterkitController::class,
        'whishlist',
        ])->name('whishlist');
Route::get('/app/ecommerce/shop/home', [
        StaterkitController::class,
        'filter_home',
        ])->name('filter_home');
Route::get('/app/ecommerce/wishlist-details', [
            StaterkitController::class,
            'wishlist_details',
            ])->name('wishlist_details');
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('postlogin', [AuthenticationController::class, 'postlogin'])->name(
                'postlogin'
            );
Route::get('register', [AuthenticationController::class, 'register'])->name(
    'register'
);
Route::post('postsignup', [
    AuthenticationController::class,
    'postsignup',
])->name('postsignup');
Route::get('signout', [AuthenticationController::class, 'signOut'])->name(
    'signout'
);
Route::resource('Users', UtilisateursController ::class,[ 'names' => [
    'index' => 'users',
    
    
]])->middleware('role_Admin');
Route::resource('Commande', CommandeController ::class,[ 'names' => [
    'index' => 'Commande',
    
    
]])->middleware('role_Admin');
Route::resource('Profile', ProfileController ::class)->middleware('auth');

Route::get('/Contacts', [CommandeController::class, 'contacts'])->name(
    'contacts'
)->middleware('role_Admin');;
Route::get('search_commande', [CommandeController::class, 'search_commande'])->name(
    'search_commande'
);
Route::get('/payment/{id}', [CommandeController::class, 'payment'])->name(
    'payment'
)->middleware('auth');
Route::get('confirm_commande/{id}', [CommandeController::class, 'confirm_commande'])->name(
    'confirm_commande'
)->middleware('role_Admin');
Route::get('invoice/{id}', [CommandeController::class, 'invoice'])->name(
    'invoice'
)->middleware('role_Admin');
Route::get('download_invoice/{id}', [CommandeController::class, 'download_invoice'])->name(
    'download_invoice'
);
Route::get('reject_commande/{id}', [CommandeController::class, 'reject_commande'])->name(
    'reject_commande'
)->middleware('role_Admin');
Route::get('search_user', [UtilisateursController::class, 'search_user'])->name(
    'search_user'
)->middleware('role_Admin');
// Route::get('/Users/delete/{id}', 'UtilisateursController@destroy')
//      ->name('Users.destroy');
//Cart
Route::get('/profile', [UtilisateursController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile-security', [UtilisateursController::class, 'profile_security'])->name('profile_security')->middleware('auth');
Route::put('/password', [UtilisateursController::class, 'password'])->name('password')->middleware('auth');

Route::get('add-to-cart/{id}', [StaterkitController::class, 'addToCart'])->name('add_to_cart');
Route::put('update-cart', [StaterkitController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [StaterkitController::class, 'remove'])->name('remove_from_cart');
//
Route::resource('Categorie', CategorieController ::class,[ 'names' => [
    'index' => 'Categorie',
    
    
]])->middleware('role_Admin');
Route::resource('Dashboard',DashboardController ::class,[ 'names' => [
    'index' => 'Dashboard',
    
    
]])->middleware('role_Admin');
Route::resource('product', productController::class,[ 'names' => [
    'index' => 'product',
    
    
]])->middleware('role_Admin');
Route::get('filter_categorie', [productController::class, 'filter_categorie'])->name(
    'filter_categorie'
);
Route::resource('brand', brandController::class,[ 'names' => [
    'index' => 'brand',
    
    
]])->middleware('role_Admin');
Route::resource('etat', etatController::class,[ 'names' => [
    'index' => 'etat',
    
    
]])->middleware('role_Admin');

Route::get('/send',[MailController::class,'sendMail'])->name('sendMail')->middleware('role_Admin');

Route::fallback(function () {
    return view('content/error');
});
Route::get('lang/{locale}', [StaterkitController::class, 'swap']);