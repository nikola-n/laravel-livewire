<?php

use App\Mail\ContactFormMailable;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('examples',
        [
            'users' => App\Models\User::paginate(10),
            'posts' => Post::all(),
        ]);
});

Route::get('/screencasts', function () {
    return view('screencasts');
});
//Route::post('/contact', function (Request $request){
//    $contact = $request->validate([
//        'name' => 'required',
//        'email' => 'required|email',
//        'phone' => 'required',
//        'message' => 'required',
//    ]);

//Mail::to('nikola@nikola.com')->send(new ContactFormMailable($contact));

//return back()->with('success_message', 'We received your message successfully and will get back to you shortly!');
//});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/post/{post}', function (Post $post) {
    return view('post.show', [
        'post' => $post,
    ]);
})->name('post.show');

Route::post('/post/{post}/comment', function (Request $request, Post $post) {
    $request->validate([
        'comment' => 'required|min:4',
    ]);

    \App\Models\Comment::create([
        'post_id'  => $post->id,
        //should be user_id User has Many Comments , Comments belongsTo User
        'username' => 'Guest',
        'content'  => $request->comment,
    ]);

    return back()->with('success_message', 'Comment was posted!');
})->name('comment.store');

Route::get('/post/{post}/edit', function (Post $post) {
    return view('post.edit', [
        'post' => $post,
    ]);
})->name('post.edit');

Route::patch('/post/{post}', function (Request $request, Post $post) {
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'photo' => 'nullable|sometimes|image|max:5000',
    ]);

    $post->update([
        'title' => $request->title,
        'content' => \request('content'),
        'photo' => $request->photo ? $request->file('photo')->store('photos', 'public') : $post->photo,
    ]);

    return back()->with('success_message', 'Post was updated successfully!');
})->name('post.update');
