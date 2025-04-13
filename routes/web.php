<?php

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Route;
use App\Models\Image;

Route::get('/', function () {
    // $images = Image::all();
    // foreach ($images as $i) {
    //     echo "Creado por: ".$i->user->name. $i->user->surname;
    //     echo '<br>';
    //     echo "Imagen: $i->image_path";
    //     echo '<br>';
    //     echo "Descripcion: $i->description <br>";
    //     echo "Comentarios: <br>";
    //     foreach ($i->comments as $c) {
    //         echo $c->content."<br>";
    //         echo "Creado en: ".$c->created_at->diffForHumans()."<br>";
    //
    //     }
    //     echo "Likes: ".$i->likes->count();
    //     echo '<hr>';
    // }
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
    Route::post('/updateUser', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/UserAvatar/{fileName}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.getImage');
    Route::get("/defaultAvatar", [App\Http\Controllers\UserController::class, 'getDefaultAvatar'])->name('user.getDefaultAvatar');
    Route::get("/ImgForm", [App\Http\Controllers\ImageController::class, 'imgForm'])->name('img.form');
    Route::post("/UpImage", [App\Http\Controllers\ImageController::class, 'upload'])->name('img.upload');
    Route::get("/ShowImgUser", [App\Http\Controllers\ImageController::class, 'show_id'])->name('img.show_id');
    Route::get("/ShowImgAll", [App\Http\Controllers\ImageController::class, 'show_all'])->name('img.show_all');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
