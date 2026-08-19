<?php

use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\InquiryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\WorkExperienceController;
use Illuminate\Support\Facades\Route;

Route::get('/site', [SiteController::class, 'show'])->name('api.site');

Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('api.projects.show');

Route::get('/technologies', [TechnologyController::class, 'index'])->name('api.technologies.index');

Route::get('/work-experiences', [WorkExperienceController::class, 'index'])->name('api.work-experiences.index');

Route::get('/educations', [EducationController::class, 'index'])->name('api.educations.index');

Route::get('/cvs', [CvController::class, 'index'])->name('api.cvs.index');
Route::get('/cvs/{cv}/download', [CvController::class, 'download'])->name('api.cvs.download');

Route::post('/inquiries', [InquiryController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('api.inquiries.store');
