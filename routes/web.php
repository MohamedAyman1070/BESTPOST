<?php

use App\Events\TestEvent;
use App\Http\Controllers\GoogleAuthController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/login', function () {
    return view('Auth.login');
});

Route::get('/register', function () {
    return view('Auth.register');
});

// Route::get('/' , function(){
//     return view('base.index');
// });

Route::view('/', 'Base.index', ['posts' => \App\Models\Post::latest()->get()]);

Route::post('/signout', function (Request $r) {
    Auth::logout();
    return redirect('/');
});

Route::get('/post-create', function () {
    return view('post.create');
});

Route::get('/profile', function () {
    return view('Profile-page.profile');
});

Route::get('/profile/update', function () {
    return view('Profile-page.edit');
});

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);



// Route::view('profile/posts' , 'profile-page.posts' );

Route::get('/profile/posts', function () {
    return view('Profile-page.posts', ['posts' => Post::where('user_id', Auth::user()->id)->latest()->get()]);
});

Route::get('/profile/posts-oldest', function () {
    return view('Profile-page.posts', ['posts' => Post::where('user_id', Auth::user()->id)->get()]);
});

Route::get('/profile/posts-popular', function () {
    return view('Profile-page.posts', ['posts' => Post::where('user_id', Auth::user()->id)->get()]);
});

Route::get('/post/edit/{id}', function ($id) {
    $post = Post::find($id);
    if ($post) :
        Gate::authorize('update-delete-post', $post['user_id']);
        return view('post.edit', ['post' => $post]);
    endif;
    return throw new NotFoundHttpException();
});
