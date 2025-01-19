<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Comment In Production
use App\Models\User_admin;
use App\Models\Level;
Route::get('/create_admin_test', function () {
    // Create a new admin entry
    $admin = new User_admin();
    $admin->name = 'Admin';
    $admin->email = 'root@admin.com';
    $admin->email_verified = 'yes';
    $admin->email_token = '1234';
    $admin->password = Hash::make('1234');
    $admin->save();

    $levels = new Level();
    $levels->level = 'Begin';
    $levels->prr_min = 0;
    $levels->prr_max = 100;
    $levels->save();
    return response()->json(['message' => 'Admin created successfully', 'admin' => $admin]);
});

// LOGIN
Route::get('/game/sign-in', [GameController::class, 'sign_in']);
Route::post('/game/sign-in', [GameController::class, 'sign_in_check']);
// SELECT ACCOUNT
Route::view('/game/select-account', 'game/sign/main');
// SIGNUP
Route::get('/game/sign-up', [GameController::class, 'sign_up']);
Route::post('/game/sign-up', [GameController::class, 'sign_up_save']);


Route::get('/', function () {
    return redirect('/game/select-account');
});

Route::middleware(['checkUserLogin'])->group(function () {
    Route::get('/game/welcome', [GameController::class, 'welcome']);
    Route::get('/game/main', [GameController::class, 'main']);
    Route::get('/game/profile', [GameController::class, 'profile']);
    Route::get('/game/game-history', [GameController::class, 'history']);

    Route::get('/game/friends', [GameController::class, 'friends']);
    Route::post('/game/friends', [GameController::class, 'friends_q']);
    Route::get('/game/friends/add/{id}', [GameController::class, 'friends_add']);
    Route::get('/game/friends/remove/{id}', [GameController::class, 'friends_remove']);

    Route::get('/game/world', [GameController::class, 'world']);
    Route::post('/game/world', [GameController::class, 'world_q']);

    Route::get('/game/store', [GameController::class, 'store']);

    Route::get('/game/payment', [GameController::class, 'payment']);
    Route::post('/game/payment', [GameController::class, 'payment_change']);
    Route::post('/game/pay', [GameController::class, 'pay']);
    Route::get('/game/payment-history', [GameController::class, 'payment_history']);

    Route::get('/game/conversion', [GameController::class, 'conversion']);
    Route::post('/game/conversion', [GameController::class, 'conversion_change']);

    Route::get('/game/withdraw', [GameController::class, 'withdraw']);
    Route::post('/game/withdraw', [GameController::class, 'withdraw_r']);
    Route::get('/game/withdraw-history', [GameController::class, 'withdraw_history']);

    Route::get('/game/chat/{id}', [GameController::class, 'chat']);
    Route::post('/game/chat/{id}', [GameController::class, 'chat_s']);

    Route::view('game/select-table', 'game/main/select-table');
    Route::post('/game/nl-holdem', [GameController::class, 'nl_holdem']);
    Route::post('/game/nl-holdem-rebet', [GameController::class, 'nl_holdem_rebet']);
    Route::get('/game/played', [GameController::class, 'played']);
    Route::post('/game/played', [GameController::class, 'played']);
    Route::post('/game/played-s', [GameController::class, 'played_s']);

    Route::view('game/setting', 'game/main/setting');
    Route::get('/game/logout', [GameController::class, 'logout']);

    Route::view('game', 'game');
    Route::view('collection', 'collection');
    Route::get('/game/player-rank', [GameController::class, 'player_rank']);

});

Route::get('/login_admin', function () {
    return view('admin/login');
});
Route::post('/login_admin', [AdminController::class, 'login']);

Route::middleware(['checkAdminLogin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/users/delete/{id}', [AdminController::class, 'users_d']);
    Route::get('/admin/users/email-verify/{id}', [AdminController::class, 'users_e']);
    Route::get('/admin/users/view/{id}', [AdminController::class, 'users_v']);
    Route::get('/admin/profiles', [AdminController::class, 'profiles']);

    Route::get('/admin/levels', [AdminController::class, 'levels']);
    Route::get('/admin/levels/delete/{id}', [AdminController::class, 'levels_d']);
    Route::get('/admin/levels/view/{id}', [AdminController::class, 'levels_v']);
    Route::get('/admin/levels/edit/{id}', [AdminController::class, 'levels_e']);
    Route::post('/admin/levels/edit/{id}', [AdminController::class, 'levels_es']);
    Route::get('/admin/levels/add/', [AdminController::class, 'levels_a']);
    Route::post('/admin/levels/add/', [AdminController::class, 'levels_as']);

    Route::get('/admin/payments', [AdminController::class, 'payments']);
    Route::get('/admin/payments/delete/{id}', [AdminController::class, 'payments_d']);
    Route::get('/admin/payments/approve/{id}', [AdminController::class, 'payments_a']);
    Route::get('/admin/payments/view/{id}', [AdminController::class, 'payments_v']);

    Route::get('/admin/player_rake', [AdminController::class, 'player_rake']);
    Route::get('/admin/player_rake/delete/{id}', [AdminController::class, 'player_rake_d']);

    Route::get('/admin/payment_withdraw', [AdminController::class, 'payment_withdraw']);
    Route::get('/admin/payment_withdraw/delete/{id}', [AdminController::class, 'payment_withdraw_d']);
    Route::get('/admin/payment_withdraw/approve/{id}', [AdminController::class, 'payment_withdraw_a']);
    Route::get('/admin/payment_withdraw/disapprove/{id}', [AdminController::class, 'payment_withdraw_da']);

    Route::get('/admin/payment_methods', [AdminController::class, 'payment_methods']);
    Route::get('/admin/payment_methods/delete/{id}', [AdminController::class, 'payment_methods_d']);
    Route::get('/admin/payment_methods/approve/{id}', [AdminController::class, 'payment_methods_a']);
    Route::get('/admin/payment_methods/view/{id}', [AdminController::class, 'payment_methods_v']);
    Route::get('/admin/payment_methods/view/c/{id}', [AdminController::class, 'payment_methods_vc']);
    Route::get('/admin/payment_methods/add', [AdminController::class, 'payment_methods_add']);
    Route::post('/admin/payment_methods/add', [AdminController::class, 'payment_methods_adds']);
    Route::get('/admin/payment_methods/edit/{id}', [AdminController::class, 'payment_methods_e']);
    Route::post('/admin/payment_methods/edit/{id}', [AdminController::class, 'payment_methods_es']);

    Route::get('/admin/account', [AdminController::class, 'account']);
    Route::post('/admin/account/save_webdet', [AdminController::class, 'save_webdet']);

    Route::get('/logout', [AdminController::class, 'logout']);
});


