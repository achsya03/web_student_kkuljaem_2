<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\ClassController;
use App\Http\Controllers\V1\QnaController;
use App\Http\Controllers\V1\ForumController;
use App\Http\Controllers\V1\DashboardController;
use App\Http\Controllers\V1\ProfilController;
use App\Http\Controllers\V1\PembayaranController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'cors'], function () {
    // Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Search


     // Auth
     Route::get('/login', [AuthController::class, 'login'])->name('login.index');
     Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
     Route::get('/register', [AuthController::class, 'register'])->name('register.index');
     Route::get('/register-2', [AuthController::class, 'register_2'])->name('register.register-2'); 
     Route::get('/register-3', [AuthController::class, 'register_3'])->name('register.register-3'); // berhasil verifikasi
     Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
     Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot.index');
     Route::post('/forgotProcess', [AuthController::class, 'forgotProcess'])->name('forgot.forgotProcess');
     Route::get('/change-success', [AuthController::class, 'change_success'])->name('change-success.index'); // Kata Sandi berhasil Diubah
     Route::get('/change-password', [AuthController::class, 'change_password'])->name('change-password.index'); // Imput New Password
     Route::post('/change-password-process', [AuthController::class, 'change_password_process'])->name('change-password.process');
 

});


Route::group(['middleware' => 'authtoken', 'cors'], function () {
    // Kelas
    Route::group(['prefix' => 'class'], function () {
        Route::get('/', [ClassController::class, 'index'])->name('class.index');
        Route::get('/history', [ClassController::class, 'history'])->name('class.history');
        Route::get('/detail/{id}', [ClassController::class, 'detail'])->name('class.detail');
        Route::get('/kategori/{id}', [ClassController::class, 'kategori'])->name('class.kategori');
        Route::get('/mentor/{id}', [ClassController::class, 'mentor'])->name('class.mentor');
        Route::get('/video/{id}', [ClassController::class, 'video'])->name('class.video');
        Route::get('/quiz-intro/{judul}/{id}', function ($judul, $id) {
            $judul = urldecode($judul);
            return view('quiz.index', compact('judul','id'));
        })->name('class.quiz-intro');
        Route::get('/latihan-intro/{id}', function ($id) {
            return view('latihan.index', compact('id'));
        })->name('class.latihan-intro');
        Route::get('/latihan/{id}', [ClassController::class, 'latihan'])->name('class.latihan');
        Route::post('/qna-video', [ClassController::class, 'qnaPostByVideo'])->name('class.qnaVideo.process');
        Route::post('/qna-like', [ClassController::class, 'qnaLikeByVideo'])->name('qnaLike.process');
        Route::get('/quiz/{id}', [ClassController::class, 'quiz'])->name('class.quiz');
        Route::get('/shadowing/{id}', [ClassController::class, 'shadowing'])->name('class.shadowing');
    });
    // Route::get('/search', [DashboardController::class, 'search'])->name('dashboard.search');
    Route::post('/search', [DashboardController::class, 'search'])->name('dashboard.search');

    Route::group(['prefix' => 'qna'], function () {
        Route::get('/', [QnaController::class, 'index'])->name('qna.index');
        Route::get('/theme/{$id]', [QnaController::class, 'theme'])->name('qna.theme');
            Route::get('/detail/{id}', [QnaController::class, 'detail'])->name('qna.detail');
            Route::post('/create_post', [QnaController::class, 'create_post'])->name('qna.create_post');
            Route::post('/create_comment', [QnaController::class, 'create_comment'])->name('qna.create_comment');
            Route::get('/delete/{id}', [QnaController::class, 'delete'])->name('qna.delete');
            Route::post('/delete_comment', [QnaController::class, 'delete_comment'])->name('qna.delete_comment');
            Route::get('/like_post/{id}', [QnaController::class, 'like_post'])->name('qna.like_post');
            Route::get('/unlike_post/{id}', [QnaController::class, 'unlike_post'])->name('qna.unlike_post');
            Route::get('/like_comment/{id}', [QnaController::class, 'like_comment'])->name('qna.like_comment');
            Route::get('/unlike_comment/{id}', [QnaController::class, 'unlike_comment'])->name('qna.unlike_comment');
    });
    
    Route::group(['prefix' => 'forum'], function () {
        Route::get('/', [ForumController::class, 'index'])->name('forum.index');
        Route::get('/get_comments', [ForumController::class, 'get_comments'])->name('forum._comments');
        Route::get('/topik/{id}', [ForumController::class, 'topik'])->name('forum.topik');
        Route::get('/detail/{id}', [ForumController::class, 'detail'])->name('forum.detail');
        Route::post('/create_post', [ForumController::class, 'create_post'])->name('forum.create_post');
        Route::post('/create_comment', [ForumController::class, 'create_comment'])->name('forum.create_comment');
        Route::get('/delete/{id}', [ForumController::class, 'delete'])->name('forum.delete');
        Route::post('/delete_comment', [ForumController::class, 'delete_comment'])->name('forum.delete_comment');
        Route::get('/like_post/{id}', [ForumController::class, 'like_post'])->name('forum.like_post');
        Route::get('/unlike_post/{id}', [ForumController::class, 'unlike_post'])->name('forum.unlike_post');

    });
   
    Route::group(['prefix' => 'profil'], function () {
        Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/update_profil', [ProfilController::class, 'update'])->name('profil.update_profil');
        Route::post('/change_password', [ProfilController::class, 'change_password'])->name('profil.change_password');
        
    });
    Route::group(['prefix' => 'pembayaran'], function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/langganan', [PembayaranController::class, 'langganan'])->name('pembayaran.langganan');
        Route::post('/pesan-packet', [PembayaranController::class, 'pesan_packet'])->name('pembayaran.pesan-packet');
        Route::get('/sukses', [PembayaranController::class, 'sukses'])->name('pembayaran.sukses');
        
    });


    
});

// Route::resource('forums', ForumController::class)->only(['index']);

