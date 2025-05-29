<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Models\Question;
use App\Models\QuizVisitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Edit Profile Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Guest Profile Route
Route::get('/', [QuestionController::class, 'index'])->name('index');
Route::post('/question/submit', [QuestionController::class, 'store'])->name('question.submit');
Route::get('/ranking', [QuestionController::class, 'ranking'])->name('ranking');
Route::post('/submit-npm', function (Request $request) {
    $npm = $request->npm;
    $today = now()->toDateString();

    QuizVisitor::create([
        'npm' => $npm,
        'visit_date' => $today,
    ]);

    $visitorCount = QuizVisitor::where('visit_date', $today)->count();

    session([
        'npm' => $npm,
        'visitor_number' => $visitorCount,
        'visited_today' => true
    ]);

    return response()->json([
        'message' => 'Berhasil',
        'visitor_number' => $visitorCount
    ]);
});
Route::get('/quiz-questions', [QuestionController::class, 'getQuestionsByCategory']);
Route::get('/kritik-saran/form', [FeedbackController::class, 'form'])->name('feedback.form');
Route::post('/kritik-saran', [FeedbackController::class, 'store'])->name('feedback.store');

// Admin Route
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.show');
    Route::get('/galeri/form', [GaleriController::class, 'form'])->name('galeri.form');
    Route::get('/galeri/form/{galeri}', [GaleriController::class, 'form'])->name('galeri.edit');
    Route::post('/galeri/save', [GaleriController::class, 'save'])->name('galeri.store');
    Route::post('/galeri/save/{galeri}', [GaleriController::class, 'save'])->name('galeri.update');
    Route::post('/galeri/delete', [GaleriController::class, 'destroyMultiple'])->name('galeri.delete');
    // Iklan
    Route::get('/iklan', [IklanController::class, 'index'])->name('iklan.show');
    Route::get('/iklan/form', [IklanController::class, 'form'])->name('iklan.form');
    Route::get('/iklan/form/{iklan}', [IklanController::class, 'form'])->name('iklan.edit');
    Route::post('/iklan/save', [IklanController::class, 'save'])->name('iklan.store');
    Route::post('/iklan/save/{iklan}', [IklanController::class, 'save'])->name('iklan.update');
    Route::post('/iklan/delete', [IklanController::class, 'destroyMultiple'])->name('iklan.delete');
    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.show');
    Route::get('/berita/form', [BeritaController::class, 'beritaForm'])->name('berita.form');
    Route::get('/berita/form/{slug}', [BeritaController::class, 'beritaForm'])->name('berita.edit');
    Route::post('/berita/save', [BeritaController::class, 'save'])->name('berita.store');
    Route::post('/berita/save/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::post('/berita/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
    // Berita Kategori
    Route::post('/kategori-berita/save', [KategoriBeritaController::class, 'save'])->name('kategori-berita.save');
    Route::post('/kategori-berita/delete/{id}', [KategoriBeritaController::class, 'delete'])->name('kategori-berita.delete');
    // Feedback
    Route::get('/kritik-saran', [FeedbackController::class, 'index'])->name('feedback.show');
    Route::get('/kritik-saran/{id}', [FeedbackController::class, 'showDetail'])->name('feedback.detail');
    // Game
    Route::get('/questions', [AdminController::class, 'question'])->name('index');
    Route::post('/questions', [AdminController::class, 'createQuestion'])->name('createQuestion');
    Route::get('/questions/{question}/edit', [AdminController::class, 'editQuestion'])->name('editQuestion');
    Route::put('/questions/{question}', [AdminController::class, 'updateQuestion'])->name('updateQuestion');
    Route::delete('/questions/{question}', [AdminController::class, 'destroyQuestion'])->name('destroyQuestion');
    Route::get('/visitors', [AdminController::class, 'visitorsToday'])->name('visitors');
    Route::get('/visitors/filter', [AdminController::class, 'visitorfilter'])->name('visitors.filter');

});


// Api route
Route::get('/questions/{category}', function ($category) {
    $questions = Question::where('jenis_soal', $category)->get();
    return response()->json($questions);
});


require __DIR__.'/auth.php';
