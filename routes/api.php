<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-menu', [MenuController::class, 'getMenu']);
Route::get('/get-current-event', [EventController::class, 'getCurrentEvent']);
Route::get('/get-article/{name}', [ArticleController::class, 'getArticleByMenuItemName']);
Route::get('/get-curators', [ContactsController::class, 'getCurators']);
Route::get('/get-sponsors', [SponsorController::class, 'getSponsors']);
Route::get('/get-speakers', [SpeakerController::class, 'getCurrentEventSpeakers']);
Route::get('/get-testimonials', [TestimonialController::class, 'getCurrentEventTestimonials']);
Route::get('/get-galleries', [GalleryController::class, 'getMenuGalleries']);
Route::get('/get-images/{id}', [GalleryController::class, 'getImagesByGalleryId']);
