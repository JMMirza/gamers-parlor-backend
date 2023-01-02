<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\GamerTagController;
use App\Http\Controllers\MatchSchedulerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentPrizeController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\WagerPostController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LadderPostController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionPriceController;
use App\Http\Controllers\TournamentLevelController;
use App\Http\Controllers\TournamentLevelMatchResultController;

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

Route::get('/', [UserController::class, 'landingPage']);
Route::get('/home/terms-polices', [UserController::class, 'showTermsPolices'])->name('terms');
Route::get('/home/privacy-polices', [UserController::class, 'showPrivacyPolices'])->name('privacy');
Route::post('/upload-video', [UserController::class, 'uploadVideo'])->name('upload-video');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'root'])->name('root');



Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resources(['users' => UserController::class]);
    Route::resources(['statuses' => StatusController::class]);
    Route::resources(['gamer-tags' => GamerTagController::class]);
    Route::resources(['prizes' => TournamentPrizeController::class]);
    Route::resources(['tournaments' => TournamentController::class]);
    Route::resources(['tournament-levels' => TournamentLevelController::class]);
    Route::resources(['coins' => CoinController::class]);
    Route::resources(['subscriptions' => SubscriptionPriceController::class]);
    Route::resources(['tournament-level-match-result' => TournamentLevelMatchResultController::class]);
    Route::get('show-modal/{match_id}', [TournamentLevelController::class, 'show_modal'])->name('show-modal');
    Route::resources(['teams' => TeamController::class]);
    Route::resources(['match-scheduler' => MatchSchedulerController::class]);
    Route::resources(['teams-members' => TeamMemberController::class]);
    Route::resources(['tournament-enrollments' => EnrollmentController::class]);
    Route::resources(['wager-post' => WagerPostController::class]);
    Route::resources(['ladder-post' => LadderPostController::class]);
    Route::resources(['platforms' => PlatformController::class]);
    Route::resources(['games' => GameController::class]);
    Route::post('teams-members-create', [TeamMemberController::class, 'teams_members_create'])->name('teams-members-create');
    Route::post('update-level-status', [TournamentLevelController::class, 'update_level_status'])->name('update-level-status');
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['permissions' => PermissionController::class]);
    Route::resources(['staffs' => UserController::class]);
    Route::get('/staff-profile/{id}', [UserController::class, 'edit'])->name('staff-profile');
    Route::get('/roles-permission-assignment-list', [UserController::class, 'userRolesPermissionList'])->name('roles-permission-assignment-list');
    Route::get('edit-with-role-permissions/{id}', [UserController::class, 'editUserRolesPermissions'])->name('edit-with-role-permissions');
    Route::post('assign-role-permissions/{id}', [UserController::class, 'updateUserRolesPermissions'])->name('assign-role-permissions');
    Route::get('/transactions', [UserController::class, 'transactions'])->name('transactions');
    Route::get('/accept-transaction/{id}', [UserController::class, 'accept_transaction'])->name('accept-transaction');
    Route::get('/reject-transaction/{id}', [UserController::class, 'reject_transaction'])->name('reject-transaction');
    Route::get('ladder-details/{id}', [LadderPostController::class, 'ladderDetail'])->name('ladder-details');
    Route::post('ladder-post-approve-result', [LadderPostController::class, 'ladderResultApprove'])->name('ladder-post-approve-result');
    Route::get('/subscription-transactions', [UserController::class, 'subscription_transactions'])->name('subscription-transactions');
    Route::get('/accept-sub-transaction/{id}', [UserController::class, 'accept_sub_transaction'])->name('accept-sub-transaction');
    Route::get('/reject-sub-transaction/{id}', [UserController::class, 'reject_sub_transaction'])->name('reject-sub-transaction');
});
