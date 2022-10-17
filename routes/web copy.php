<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VpController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DispatchController;

use App\Http\Controllers\DVRController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HaulerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SafetyController;
use App\Http\Controllers\SecurityGuardController;
use App\Http\Controllers\SecurityGuardObservationController;
use App\Http\Controllers\ServiceCompanyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\UaeViolationController;
use App\Http\Controllers\UnfixedPermitController;
use App\Http\Controllers\UnfixedServiceController;
use App\Http\Controllers\ViolationTypeController;
use App\Http\Controllers\VlanController;
use App\Models\Permit;
use App\Models\UnfixedPermit;
use Illuminate\Support\Facades\Auth;

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
    return redirect(route('dashboard'));
});

Auth::routes();
/* Ahmed Abdel-Wahab Dashboard */
Route::get('/testDashboard', [HomeController::class, 'testDashboard'])->name('test.dashboard');
Route::any('/replytestDashboard', [HomeController::class, 'replytestDashboard'])->name('reply.dashboard');
/* Ahmed Abdel-Wahab Dashboard */

Route::any('/logout', [UserController::class, 'logout'])->name('logout');
Route::any('/findvpareas', [ViolationController::class, "selectArea"])->name('findvpareas');
Route::post('/Dashbord/date', [HomeController::class, "dashboardByDate"])->name('dashboardByDate');
Route::any('/findlocations', [CountryController::class, "selectLocation"])->name('findlocations');
Route::group(['middleware' => ['auth']], function () {
    /* Start Own Permits Responce */
    Route::post('own/permits/approve/{id}',[PermitController::class, 'ownVehicleApprove'])->name('own.approve');
    Route::post('own/permits/reject/{id}',[PermitController::class, 'ownVehicleReject'])->name('own.reject');
    Route::post('own/permits/approve/{id}',[UnfixedPermitController::class, 'ownUnfixedApprove'])->name('own.unfixed.approve');
    Route::post('own/permits/reject/{id}',[UnfixedPermitController::class, 'ownUnfixedReject'])->name('own.unfixed.reject');
    /* End Own Permits Responce */

    /* Start Group Approval Permits Responce */
    Route::post('group/permits/approve/{id}', [PermitController::class, 'groupVehicleApprove'])->name('group.approve');
    Route::post('group/permits/reject/{id}', [PermitController::class, 'groupVehicleReject'])->name('group.reject');
    Route::post('group/permits/approve/{id}', [UnfixedPermitController::class, 'groupUnfixedApprove'])->name('group.unfixed.approve');
    Route::post('group/permits/reject/{id}', [UnfixedPermitController::class, 'groupUnfixedReject'])->name('group.unfixed.reject');
    /* End Group Approval Permits Responce */

    /* Start Safety Approval Permits Responce */
    Route::post('safety/vehicle/permits/approve/{id}', [PermitController::class, 'safetyVehicleApprove'])->name('safety.vehicle.approve');
    Route::post('safety/vehicle/permits/reject/{id}', [PermitController::class, 'safetyVehicleReject'])->name('safety.vehicle.reject');
    Route::post('safety/unfixed/permits/approve/{id}', [UnfixedPermitController::class, 'safetyUnfixedApprove'])->name('safety.unfixed.approve');
    Route::post('safety/unfixed/permits/reject/{id}', [UnfixedPermitController::class, 'safetyUnfixedReject'])->name('safety.unfixed.reject');
    /* End Safety Approval Permits Responce */

    /* Start Security Approval Permits Responce */
    Route::post('security/vehicle/permits/approve/{id}', [PermitController::class, 'securityVehicleApprove'])->name('security.vehicle.approve');
    Route::post('security/vehicle/permits/reject/{id}', [PermitController::class, 'securityVehicleReject'])->name('security.vehicle.reject');
    Route::post('security/unfixed/permits/approve/{id}', [UnfixedPermitController::class, 'securityUnfixedApprove'])->name('security.unfixed.approve');
    Route::post('security/unfixed/permits/reject/{id}', [UnfixedPermitController::class, 'securityUnfixedReject'])->name('security.unfixed.reject');
    /* End Safety Approval Permits Responce */
});
