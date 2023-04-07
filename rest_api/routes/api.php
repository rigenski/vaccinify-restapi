<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\SpotVaccineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/auth/profile', [AuthController::class, 'profile'])->name('profile');

    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultation');
    Route::post('/consultations/store', [ConsultationController::class, 'store'])->name('consultation.store');
    Route::post('/consultations/{id}/update', [ConsultationController::class, 'update'])->name('consultation.update');

    Route::get('/vaccinations', [VaccinationController::class, 'index'])->name('vaccination');
    Route::post('/vaccinations/store', [VaccinationController::class, 'store'])->name('vaccination.store');
    Route::post('/vaccinations/{id}/update', [VaccinationController::class, 'update'])->name('vaccination.update');

    Route::get('/spots', [SpotController::class, 'index'])->name('spot');
    Route::get('/spots/{id}', [SpotController::class, 'show'])->name('spot.show');

    Route::get('/schedules/{spot_id}', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/spot-vaccine/{spot_id}', [SpotVaccineController::class, 'index'])->name('spot-vaccine');
});
