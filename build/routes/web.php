<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\GenerateDocController;
use App\Http\Controllers\GroupLocalityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\UserHandlerController;
use App\Http\Controllers\ProfessionalCategoryController;
use App\Http\Controllers\QualificationAreaController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\WorkVisaController;
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
    return redirect()->route('login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('account/password/edit', [UserHandlerController::class, 'editPassword'])->name('account.password.edit');
    Route::post('account/password/update', [UserHandlerController::class, 'updatePassword'])->name('account.password.update');

    Route::middleware(['passwordUpdated'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('users/{user}/password/reset', [UserHandlerController::class, 'resetUserPassword'])->name('users.password.reset');

        Route::middleware(['roleVerified:super,admin,observateur,general,directeur,secretaire'])->group(function () {
            Route::resource('users', UserHandlerController::class);
        });
        Route::get('account/info/edit', [UserHandlerController::class, 'editAccount'])->name('account.info.edit');
        Route::post('account/info/update', [UserHandlerController::class, 'updateAccount'])->name('account.info.update');
        Route::get('account/{user}/access/update', [UserHandlerController::class, 'updateAccountAccess'])->name('account.access.update');

        Route::resource('group-localities', GroupLocalityController::class);

        Route::resource('localities', LocalityController::class);

        Route::resource('activities', ActivityController::class);

        Route::resource('employers', EmployerController::class);
        Route::get('employers/{employer}/state/update', [EmployerController::class, 'updateEmployerState'])->name('employers.state.update');

        Route::middleware(['roleVerified:observateur,general,directeur,secretaire,agent'])->group(function () {
            Route::resource('demands', DemandController::class)->except('edit');
            Route::get('demands/states/rejected', [DemandController::class, 'demandeStatesRejected'])->name('demande.states.rejected');
            Route::get('demands/states/recours', [DemandController::class, 'demandeStatesRecours'])->name('demande.states.recours');
            Route::get('demands/{demand}/general', [DemandController::class, 'edit'])->name('demande.edit.general');
            Route::get('demands/{demand}/contract', [DemandController::class, 'editDemandContract'])->name('demande.edit.contract');
            Route::get('demands/{demand}/employee', [DemandController::class, 'editDemandEmployee'])->name('demande.edit.employee');
            Route::get('demands/{demand}/employer', [DemandController::class, 'editDemandEmployer'])->name('demande.edit.employer');
            Route::get('demands/{demand}/piece', [DemandController::class, 'editDemandPiece'])->name('demande.edit.piece');
            Route::get('demands/{demand}/summer', [DemandController::class, 'editDemandEnd'])->name('demande.edit.summer');

            Route::resource('work-visas', WorkVisaController::class);
            Route::get('work-visas/demands/{demand}', [WorkVisaController::class, 'createWithDemand'])->name('work-visa.with.demand');
            Route::post('work-visas/{workVisa}/confirm-relauch', [WorkVisaController::class, 'confirmRelauch'])->name('work-visa.confirm.relauch');

            Route::post('demands/{demand}/couriel/generate', [GenerateDocController::class, 'demandeCourielGenerate'])->name('demande.couriel.generate');
            Route::get('demands/en/traitement', [DemandController::class, 'demandsEnTraitement'])->name('demands.en.traitement');

        });

        Route::middleware(['roleVerified:observateur,directeur'])->group(function () {
            Route::get('demands/pour/avis', [DemandController::class, 'demandsPourAvis'])->name('demands.pour.avis');
        });
        Route::middleware(['roleVerified:observateur,general,directeur'])->group(function () {
            Route::get('demands/pour/decision', [DemandController::class, 'demandsPourDecision'])->name('demands.pour.decision');
        });

        Route::resource('professional-categories', ProfessionalCategoryController::class);

        Route::resource('qualification-areas', QualificationAreaController::class);

        Route::get('statistics/demands/branche/sexe', [StatisticController::class, 'demandeBrancheSexe'])->name('statistics.demands.branche.sexe');
        Route::post('statistics/demands/branche/sexe', [StatisticController::class, 'fetchDemandeBrancheSexe'])->name('statistics.fetch.demands.branche.sexe');
        Route::get('statistics/visa/branche/sexe', [StatisticController::class, 'visaBrancheSexe'])->name('statistics.visa.branche.sexe');
        Route::post('statistics/visa/branche/sexe', [StatisticController::class, 'fetchVisaBrancheSexe'])->name('statistics.fetch.visa.branche.sexe');
        Route::get('statistics/visa/branche/categorie/sexe', [StatisticController::class, 'visaBrancheCategorieSexe'])->name('statistics.visa.branche.categorie.sexe');
        Route::post('statistics/visa/branche/categorie/sexe', [StatisticController::class, 'fetchVisaBrancheCategorieSexe'])->name('statistics.fetch.visa.branche.categorie.sexe');
        Route::get('statistics/demands/domaine/sexe', [StatisticController::class, 'demandeDomaineSexe'])->name('statistics.demands.domaine.sexe');
        Route::post('statistics/demands/domaine/sexe', [StatisticController::class, 'fetchDemandeDomaineSexe'])->name('statistics.fetch.demands.domaine.sexe');
        Route::get('statistics/visa/suivi', [StatisticController::class, 'suiviVisa'])->name('statistics.visa.suivi');
        Route::post('statistics/visa/suivi', [StatisticController::class, 'fetchSuiviVisa'])->name('statistics.fetch.visa.suivi');

        Route::post('statistics/demands/branche/sexe/export', [ExcelExportController::class, 'exportDemandeBrancheSexe'])->name('statistics.demands.branche.sexe.export');
        Route::post('statistics/visa/branche/sexe/export', [ExcelExportController::class, 'exportVisaBrancheSexe'])->name('statistics.visa.branche.sexe.export');
        Route::post('statistics/visa/branche/categorie/export', [ExcelExportController::class, 'exportVisaBrancheCategorieSexe'])->name('statistics.visa.branche.categorie.sexe.export');
        Route::post('statistics/demands/domaine/sexe/export', [ExcelExportController::class, 'exportDemandeDomaineSexe'])->name('statistics.demands.domaine.sexe.export');
        Route::post('statistics/visa/suivi/export', [ExcelExportController::class, 'exportTableauSuiviVisa'])->name('statistics.visa.suivi.export');
        // exportVisaBrancheCategorieSexe
    });
});
require __DIR__.'/auth.php';
