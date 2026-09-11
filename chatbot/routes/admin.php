<?php
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EducationalBackGroundController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\ElectionResultController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventRegistrationController;
use App\Http\Controllers\Admin\ExecutiveMemberController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MemberApplicationController;
use App\Http\Controllers\Admin\MemberProfileController;
use App\Http\Controllers\Admin\NewsAndAnnouncementsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\SubscriptionFeatureController;
use App\Http\Controllers\Admin\SubscriptionPlan;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoteController;
use App\Http\Controllers\Admin\WorkExperienceController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});
