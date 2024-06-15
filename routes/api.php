<?php

use App\Http\Controllers\AdminMenuItemController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventHasCuratorController;
use App\Http\Controllers\EventHasSponsorController;
use App\Http\Controllers\EventHasUserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\LectureHasSpeakerController;
use App\Http\Controllers\LectureHasUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleHasStageController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Member;

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

Route::get('/check-auth', [UserController::class, 'checkAuth']);
Route::get('/user', [UserController::class, 'user']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/checkin', [ScheduleController::class, 'checkin']);
Route::post('/checkout', [ScheduleController::class, 'checkout']);

Route::get('/get-menu', [MenuController::class, 'getMenu']);
Route::get('/get-current-event', [EventController::class, 'getCurrentEvent']);
Route::get('/get-article/{name}', [ArticleController::class, 'getArticleByMenuItemName']);
Route::get('/get-curators', [ContactsController::class, 'getCurators']);
Route::get('/get-sponsors', [SponsorController::class, 'getSponsors']);
Route::get('/get-speakers', [SpeakerController::class, 'getCurrentEventSpeakers']);
Route::get('/get-testimonials', [TestimonialController::class, 'getCurrentEventTestimonials']);
Route::get('/get-galleries', [GalleryController::class, 'getMenuGalleries']);
Route::get('/get-images/{id}', [GalleryController::class, 'getImagesByGalleryId']);
Route::get('/get-schedule', [ScheduleController::class, 'getCurrentEventSchedule']);

Route::group(['middleware' => 'member'], function () {
    Route::get('/get-subscribe', [EventHasUserController::class, 'getSubscribe']);
    Route::put('/update-subscribe', [EventHasUserController::class, 'updateSubscribe']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/get-admin-menu', [AdminMenuItemController::class, 'getMenu']);
    Route::get('/admin/get-events', [EventController::class, 'getEventsAdmin']);
    Route::get('/admin/get-events-all', [EventController::class, 'getEventsAllAdmin']);
    Route::get('/admin/get-event/{id}', [EventController::class, 'getEventAdmin']);
    Route::post('/admin/create-event', [EventController::class, 'createEvent']);
    Route::put('/admin/update-event', [EventController::class, 'updateEvent']);
    Route::delete('/admin/delete-event/{id}', [EventController::class, 'deleteEvent']);

    Route::get('/admin/get-sponsors', [SponsorController::class, 'getSponsorsAdmin']);
    Route::get('/admin/get-sponsors-all', [SponsorController::class, 'getSponsorsAllAdmin']);
    Route::get('/admin/get-sponsor/{id}', [SponsorController::class, 'getSponsorAdmin']);
    Route::post('/admin/create-sponsor', [SponsorController::class, 'createSponsor']);
    Route::put('/admin/update-sponsor', [SponsorController::class, 'updateSponsor']);
    Route::delete('/admin/delete-sponsor/{id}', [SponsorController::class, 'deleteSponsor']);

    Route::get('/admin/get-events-sponsors', [EventHasSponsorController::class, 'getEventsHasSponsorsAdmin']);
    Route::get('/admin/get-event-sponsor/{id}', [EventHasSponsorController::class, 'getEventHasSponsorAdmin']);
    Route::post('/admin/create-event-sponsor', [EventHasSponsorController::class, 'createEventHasSponsor']);
    Route::put('/admin/update-event-sponsor', [EventHasSponsorController::class, 'updateEventHasSponsor']);
    Route::delete('/admin/delete-event-sponsor/{id}', [EventHasSponsorController::class, 'deleteEventHasSponsor']);

    Route::get('/admin/get-contacts', [ContactsController::class, 'getContactsAdmin']);
    Route::get('/admin/get-contacts-all', [ContactsController::class, 'getContactsAllAdmin']);
    Route::get('/admin/get-contact/{id}', [ContactsController::class, 'getContactAdmin']);
    Route::post('/admin/create-contact', [ContactsController::class, 'createContact']);
    Route::put('/admin/update-contact', [ContactsController::class, 'updateContact']);
    Route::delete('/admin/delete-contact/{id}', [ContactsController::class, 'deleteContact']);

    Route::get('/admin/get-events-curators', [EventHasCuratorController::class, 'getEventsHasCuratorsAdmin']);
    Route::get('/admin/get-event-curator/{id}', [EventHasCuratorController::class, 'getEventHasCuratorAdmin']);
    Route::post('/admin/create-event-curator', [EventHasCuratorController::class, 'createEventHasCurator']);
    Route::put('/admin/update-event-curator', [EventHasCuratorController::class, 'updateEventHasCurator']);
    Route::delete('/admin/delete-event-curator/{id}', [EventHasCuratorController::class, 'deleteEventHasCurator']);

    Route::get('/admin/get-events-users', [EventHasUserController::class, 'getEventsHasUsersAdmin']);
    Route::get('/admin/get-events-users/{id}', [EventHasUserController::class, 'getEventsHasUsersByUserAdmin']);
    Route::get('/admin/get-event-user/{id}', [EventHasUserController::class, 'getEventHasUserAdmin']);
    Route::post('/admin/create-event-user', [EventHasUserController::class, 'createEventHasUser']);
    Route::put('/admin/update-event-user', [EventHasUserController::class, 'updateEventHasUser']);
    Route::delete('/admin/delete-event-user/{id}', [EventHasUserController::class, 'deleteEventHasUser']);

    Route::get('/admin/get-menu', [MenuController::class, 'getMenuAdmin']);
    Route::get('/admin/get-menu-all', [MenuController::class, 'getMenuAdminAll']);
    Route::get('/admin/get-menu-item/{id}', [MenuController::class, 'getMenuItemAdmin']);
    Route::post('/admin/create-menu-item', [MenuController::class, 'createMenuItem']);
    Route::put('/admin/update-menu-item', [MenuController::class, 'updateMenuItem']);
    Route::delete('/admin/delete-menu-item/{id}', [MenuController::class, 'deleteMenuItem']);

    Route::get('/admin/get-articles', [ArticleController::class, 'getArticlesAdmin']);
    Route::get('/admin/get-article/{id}', [ArticleController::class, 'getArticleAdmin']);
    Route::post('/admin/create-article', [ArticleController::class, 'createArticle']);
    Route::put('/admin/update-article', [ArticleController::class, 'updateArticle']);
    Route::delete('/admin/delete-article/{id}', [ArticleController::class, 'deleteArticle']);

    Route::get('/admin/get-speakers', [SpeakerController::class, 'getSpeakersAdmin']);
    Route::get('/admin/get-speakers-all', [SpeakerController::class, 'getSpeakersAllAdmin']);
    Route::get('/admin/get-speaker/{id}', [SpeakerController::class, 'getSpeakerAdmin']);
    Route::post('/admin/create-speaker', [SpeakerController::class, 'createSpeaker']);
    Route::put('/admin/update-speaker', [SpeakerController::class, 'updateSpeaker']);
    Route::delete('/admin/delete-speaker/{id}', [SpeakerController::class, 'deleteSpeaker']);

    Route::get('/admin/get-testimonials', [TestimonialController::class, 'getTestimonialsAdmin']);
    Route::get('/admin/get-testimonial/{id}', [TestimonialController::class, 'getTestimonialAdmin']);
    Route::post('/admin/create-testimonial', [TestimonialController::class, 'createTestimonial']);
    Route::put('/admin/update-testimonial', [TestimonialController::class, 'updateTestimonial']);
    Route::delete('/admin/delete-testimonial/{id}', [TestimonialController::class, 'deleteTestimonial']);

    Route::get('/admin/get-galleries', [GalleryController::class, 'getGalleriesAdmin']);
    Route::get('/admin/get-galleries-all', [GalleryController::class, 'getGalleriesAllAdmin']);
    Route::get('/admin/get-gallery/{id}', [GalleryController::class, 'getGalleryAdmin']);
    Route::post('/admin/create-gallery', [GalleryController::class, 'createGallery']);
    Route::put('/admin/update-gallery', [GalleryController::class, 'updateGallery']);
    Route::delete('/admin/delete-gallery/{id}', [GalleryController::class, 'deleteGallery']);

    Route::get('/admin/get-images', [ImageController::class, 'getImagesAdmin']);
    Route::get('/admin/get-image/{id}', [ImageController::class, 'getImageAdmin']);
    Route::post('/admin/create-image', [ImageController::class, 'createImage']);
    Route::put('/admin/update-image', [ImageController::class, 'updateImage']);
    Route::delete('/admin/delete-image/{id}', [ImageController::class, 'deleteImage']);

    Route::get('/admin/get-schedules', [ScheduleController::class, 'getSchedulesAdmin']);
    Route::get('/admin/get-schedules-all', [ScheduleController::class, 'getSchedulesAllAdmin']);
    Route::get('/admin/get-schedule/{id}', [ScheduleController::class, 'getScheduleAdmin']);
    Route::post('/admin/create-schedule', [ScheduleController::class, 'createSchedule']);
    Route::put('/admin/update-schedule', [ScheduleController::class, 'updateSchedule']);
    Route::delete('/admin/delete-schedule/{id}', [ScheduleController::class, 'deleteSchedule']);

    Route::get('/admin/get-schedules-stages', [ScheduleHasStageController::class, 'getSchedulesHasStagesAdmin']);
    Route::get('/admin/get-schedule-stage/{id}', [ScheduleHasStageController::class, 'getScheduleHasStageAdmin']);
    Route::post('/admin/create-schedule-stage', [ScheduleHasStageController::class, 'createScheduleHasStage']);
    Route::put('/admin/update-schedule-stage', [ScheduleHasStageController::class, 'updateScheduleHasStage']);
    Route::delete('/admin/delete-schedule-stage/{id}', [ScheduleHasStageController::class, 'deleteScheduleHasStage']);

    Route::get('/admin/get-users', [UserController::class, 'getUsersAdmin']);
    Route::get('/admin/get-users-all', [UserController::class, 'getUsersAllAdmin']);
    Route::get('/admin/get-users-all-concat', [UserController::class, 'getUsersAllConcatAdmin']);
    Route::get('/admin/get-user/{id}', [UserController::class, 'getUserAdmin']);
    Route::post('/admin/create-user', [UserController::class, 'createUser']);
    Route::put('/admin/update-user', [UserController::class, 'updateUser']);
    Route::delete('/admin/delete-user/{id}', [UserController::class, 'deleteUser']);

    Route::get('/admin/get-lectures', [LectureController::class, 'getLecturesAdmin']);
    Route::get('/admin/get-lectures-all', [LectureController::class, 'getLecturesAllAdmin']);
    Route::get('/admin/get-lecture/{id}', [LectureController::class, 'getLectureAdmin']);
    Route::post('/admin/create-lecture', [LectureController::class, 'createLecture']);
    Route::put('/admin/update-lecture', [LectureController::class, 'updateLecture']);
    Route::delete('/admin/delete-lecture/{id}', [LectureController::class, 'deleteLecture']);

    Route::get('/admin/get-lectures-users', [LectureHasUserController::class, 'getLecturesHasUsersAdmin']);
    Route::get('/admin/get-lecture-user/{id}', [LectureHasUserController::class, 'getLectureHasUserAdmin']);
    Route::post('/admin/create-lecture-user', [LectureHasUserController::class, 'createLectureHasUser']);
    Route::put('/admin/update-lecture-user', [LectureHasUserController::class, 'updateLectureHasUser']);
    Route::delete('/admin/delete-lecture-user/{id}', [LectureHasUserController::class, 'deleteLectureHasUser']);

    Route::get('/admin/get-lectures-speakers', [LectureHasSpeakerController::class, 'getLecturesHasSpeakersAdmin']);
    Route::get('/admin/get-lecture-speaker/{id}', [LectureHasSpeakerController::class, 'getLectureHasSpeakerAdmin']);
    Route::post('/admin/create-lecture-speaker', [LectureHasSpeakerController::class, 'createLectureHasSpeaker']);
    Route::put('/admin/update-lecture-speaker', [LectureHasSpeakerController::class, 'updateLectureHasSpeaker']);
    Route::delete('/admin/delete-lecture-speaker/{id}', [LectureHasSpeakerController::class, 'deleteLectureHasSpeaker']);


    Route::get('/admin/get-stages', [StageController::class, 'getStagesAdmin']);
    Route::get('/admin/get-stages-all', [StageController::class, 'getStagesAllAdmin']);
    Route::get('/admin/get-stage/{id}', [StageController::class, 'getStageAdmin']);
    Route::post('/admin/create-stage', [StageController::class, 'createStage']);
    Route::put('/admin/update-stage', [StageController::class, 'updateStage']);
    Route::delete('/admin/delete-stage/{id}', [StageController::class, 'deleteStage']);

    Route::get('/admin/get-slots', [SlotController::class, 'getSlotsAdmin']);
    Route::get('/admin/get-slot/{id}', [SlotController::class, 'getSlotAdmin']);
    Route::post('/admin/create-slot', [SlotController::class, 'createSlot']);
    Route::put('/admin/update-slot', [SlotController::class, 'updateSlot']);
    Route::delete('/admin/delete-slot/{id}', [SlotController::class, 'deleteSlot']);
});
