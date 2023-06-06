<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\CategoriaBlogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;


// Frontend Routes
Route::get('/', [TiendaController::class, 'index'])->name('tienda.index');
Route::get('/productos', [TiendaController::class, 'productos'])->name('frontend.productos');
Route::get('/productos/{producto}', [ProductoController::class, 'frontendShow'])->name('productos.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout');
Route::get('/blog', [BlogController::class, 'frontendIndex'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'frontendShow'])->name('blog.show');
Route::get('/recetas', [BlogController::class, 'recetas'])->name('blog.recetas');
Route::get('/novedades', [BlogController::class, 'novedades'])->name('blog.novedades');
Route::get('/noticias', [BlogController::class, 'noticias'])->name('blog.noticias');
Route::get('/search', [BlogController::class, 'search'])->name('blog.search');



Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{itemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/nosotros', [AboutController::class, 'index'])->name('about.index');
Route::post('/admin/imagenes', [ImageProductController::class, 'store'])->name('admin.imagenes.store');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('admin/blog/{post}/deleteImage', [BlogController::class, 'deleteImage'])->name('admin.blog.deleteImage');
Route::delete('/admin/productos/{producto}/deleteImage/{image}', [ImageProductController::class, 'destroy'])->name('admin.productos.deleteImage');

Route::post('/checkout/process-paypal-payment', [PaymentController::class, 'processPaypalPayment'])->name('checkout.processPaypalPayment');

Route::get('/direccion', [AddressController::class, 'create'])->name('direccion.create');
Route::post('/direccion', [AddressController::class, 'store'])->name('direccion.store');

Route::get('/direccion', function () {     return view('frontend.direccion'); })->middleware(['auth', 'verified'])->name('direccion');
Route::get('/direccion', [AddressController::class, 'create'])->name('frontend.direccion');


Route::get('/checkout-transferencia/{order}', [CheckoutController::class, 'viewTransferencia'])->name('frontend.checkout-transferencia');
Route::post('/checkout/process-payment', [CheckoutController::class, 'processPayment'])->name('frontend.checkout.processPayment');
Route::get('/checkout-transferencia/{order}', [CheckoutController::class, 'showTransferencia'])->name('frontend.checkout.transferencia');

//esto manda a lavista para cambiar la password
Route::get('password/reset', [LoginController::class, 'showLinkRequestForm'])->name('password.request');

//esto manda un a la funcion que genera un token temporar a un correo
Route::post('password/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');

//a esto te lleva el limk del correo
Route::get('password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');


Route::post('password/reset', [LoginController::class, 'reset'])->name('password.reset.update');







Route::post('/upload-receipt', [CheckoutController::class, 'uploadReceipt'])->name('frontend.upload-receipt');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [UserController::class, 'profile'])->name('profile');
    Route::get('/perfil/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/perfil/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('password.change');
    Route::put('/change-password', [UserController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

//Route::get('/checkout-index', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout-process', [CheckoutController::class, 'checkout'])->name('checkout.index');

Route::post('/order/{order}/transfer-proof', [OrderController::class, 'storeTransferProof'])->name('transfer.proof');


Route::get('/confirmation', function () {
    return view('frontend.confirmacion');
})->name('confirmation.view');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);




// Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Routes
    Route::resource('/admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // productos Routes
    Route::resource('/admin/productos', ProductoController::class)->names([
        'index' => 'admin.productos.index',
        'create' => 'admin.productos.create',
        'store' => 'admin.productos.store',
        'show' => 'admin.productos.show',
        'edit' => 'admin.productos.edit',
        'update' => 'admin.productos.update',
        'destroy' => 'admin.productos.destroy',
    ]);

    // Blog Routes
    Route::resource('/admin/blog', BlogController::class)->names([
        'index' => 'admin.blog.index',
        'create' => 'admin.blog.create',
        'store' => 'admin.blog.store',
        'show' => 'admin.blog.show',
        'edit' => 'admin.blog.edit',
        'update' => 'admin.blog.update',
        'destroy' => 'admin.blog.destroy',
    ]);

    // CategoriaBlog Routes
    Route::resource('/admin/categorias-blog', CategoriaBlogController::class)->names([
        'index' => 'admin.categorias-blog.index',
        'create' => 'admin.categorias-blog.create',
        'store' => 'admin.categorias-blog.store',
        'show' => 'admin.categorias-blog.show',
        'edit' => 'admin.categorias-blog.edit',
        'update' => 'admin.categorias-blog.update',
        'destroy' => 'admin.categorias-blog.destroy',
    ]);

    // Ordenes Routes
    Route::resource('/admin/ordenes', OrderController::class)->names([
        'index' => 'admin.ordenes.index',
    ]);

    Route::post('/admin/order/{order}/updateOrderStatus', [OrderController::class, 'updateOrderStatus'])->name('admin.order.updateOrderStatus');
    Route::delete('/admin/order/{id}', [OrderController::class, 'deleteOrder'])->name('admin.order.destroy');
    Route::get('/admin/order/{order}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::put('/admin/order/{order}/changeStatus', [OrderController::class, 'changeStatus'])->name('admin.order.changeStatus');

});


// Ruta para cerrar la sesión
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
