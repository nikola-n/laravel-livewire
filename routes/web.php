<?php

use App\Mail\ContactFormMailable;
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
    ['users' => App\Models\User::paginate(10)]);
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
