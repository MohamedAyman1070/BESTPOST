<?php

use App\Events\TestEvent;
use App\Http\Controllers\GoogleAuthController;
use App\Models\Draft;
use App\Livewire\Profile\Follower;
use App\Livewire\Profile\Following;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



Route::get('/login', function () {
    return view('Auth.login');
})->name('login');

Route::get('/register', function () {
    return view('Auth.register');
});

// Route::get('/' , function(){
//     return view('base.index');
// });

Route::middleware('auth')->group(function () {
    Route::post('/signout', function (Request $r) {
        Auth::logout();
        return redirect('/');
    });
    Route::get('/post-create', function () {
        return view('post.create');
    });


    Route::get('/profile/update', function () {
        return view('Profile-page.edit');
    });
    Route::get('/profile/posts', function () {
        return view('Profile-page.posts', ['posts' => Post::where('user_id', Auth::user()->id)->latest()->get()]);
    });

    Route::get('/profile/posts-oldest', function () {
        return view('Profile-page.posts', ['posts' => Post::where('user_id', Auth::user()->id)->get()]);
    });

    Route::get('/profile/posts-popular', function () {
        return view('Profile-page.draft', ['posts' => Post::withCount('reacts')->orderBY('reacts_count', 'desc')->where('user_id', Auth::user()->id)->get()]);
    });

    // Route::get('/profile/draft', function () {
    //     return view('Profile-page.draft', ['posts' => Draft::where('user_id', Auth::user()->id)->latest()->get()]);
    // });

    // Route::get('/profile/draft-oldest', function () {
    //     return view('Profile-page.posts', ['posts' => Draft::where('user_id', Auth::user()->id)->get()]);
    // });

    // Route::get('/profile/draft-popular', function () {
    //     return view('Profile-page.posts', ['posts' => Draft::withCount('reacts')->orderBY('reacts_count', 'desc')->where('user_id', Auth::user()->id)->get()]);
    // });


    Route::get('/post/edit/{id}', function ($id) {
        $post = Post::find($id);
        if ($post) :
            Gate::authorize('update-delete-post', $post['user_id']);
            return view('post.edit', ['post' => $post]);
        endif;
        return throw new NotFoundHttpException();
    });

    Route::get('/profile/followers', Follower::class);
    Route::get('/profile/following', Following::class);
});


Route::view('/', 'Base.index', ['posts' => \App\Models\Post::latest()->get()]);


Route::get('/profile/{userTag}', function ($userTag) {
    return view('Profile-page.profile', ['userTag' => $userTag]);
});



Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);



// Route::view('profile/posts' , 'profile-page.posts' );
