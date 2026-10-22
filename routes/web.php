<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EnquiryController;
Route::get('/',[SiteController::class,'home'])->name('home');
Route::get('/tours',[SiteController::class,'tours'])->name('tours');
Route::get('/tours/{trip:slug}',[SiteController::class,'tour'])->name('tour.show');
Route::get('/categories/{category:slug}',[SiteController::class,'category'])->name('category.show');
Route::get('/destinations',[SiteController::class,'destinations'])->name('destinations');
Route::get('/destinations/{destination:slug}',[SiteController::class,'destination'])->name('destination.show');
Route::get('/blog',[SiteController::class,'blog'])->name('blog');
Route::get('/blog/{post:slug}',[SiteController::class,'post'])->name('blog.show');
Route::view('/about','pages.about')->name('about');
Route::get('/contact',[SiteController::class,'contact'])->name('contact');
Route::view('/privacy','pages.privacy')->name('privacy');
Route::view('/terms','pages.terms')->name('terms');
Route::post('/enquiry',[EnquiryController::class,'store'])->middleware('throttle:5,1')->name('enquiry.store');
Route::get('/sitemap.xml',[SiteController::class,'sitemap'])->name('sitemap');
