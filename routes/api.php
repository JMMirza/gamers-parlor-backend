<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CreditController;
use App\Http\Controllers\Api\TournamentController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WagerController;
use App\Http\Controllers\Api\WagerPostRequestController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/get-credits', [CreditController::class, 'getCredits']);
    Route::get('get-tournament-level-wise-matches', [TournamentController::class, 'levelWiseMatches']);
    Route::get('upload-tournament-matche-result', [TournamentController::class, 'uploadResult']);
    Route::get('list-tournaments', [TournamentController::class, 'tournamentsList']);
    Route::get('user-credits', [UserController::class, 'credits']);
    Route::get('list-vip-tournaments', [TournamentController::class, 'tournamentsVipList']);
    Route::get('list-wagers', [WagerController::class, 'wagersList']);
    Route::get('list-tournament-teams', [TeamController::class, 'listTournamentTeam']);
    Route::get('get-profile', [UserController::class, 'getUserProfile']);
    Route::post('update-profile', [UserController::class, 'updateProfile']);
    Route::get('list-teams', [TeamController::class, 'teamsList']);
    Route::get('search-user', [UserController::class, 'searchUser']);
    Route::get('get-all-user', [UserController::class, 'getAllUser']);
    Route::post('create-team', [TeamController::class, 'createTeam']);
    Route::post('create-wager-post-request', [WagerPostRequestController::class, 'createRequest']);
    Route::get('list-player-teams', [TeamController::class, 'playerTeams']);
    Route::get('get-wager-data', [WagerController::class, 'getWagerData']);
    Route::post('create-wager-post', [WagerController::class, 'createWager']);
    Route::get('list-wager-matches', [WagerController::class, 'listMatches']);
    Route::post('get-team-data', [TeamController::class, 'getTeamData']);
    Route::post('create-team-member', [TeamController::class, 'createTeamMember']);
    Route::get('list-player-tournaments', [TournamentController::class, 'playerTournamentsList']);
    Route::post('create-tournament', [TournamentController::class, 'createTournament']);
    Route::post('create-transaction', [TransactionController::class, 'createTransaction']);
    Route::post('create-credit', [CreditController::class, 'createCredit']);
    Route::get('list-wager-request', [WagerPostRequestController::class, 'getWagerPostRequest']);
    Route::get('accept-wager-request', [WagerPostRequestController::class, 'acceptRequest']);
    Route::get('reject-wager-request', [WagerPostRequestController::class, 'rejectRequest']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
