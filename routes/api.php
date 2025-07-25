<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\RiasecTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;


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

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [JWTAuthController::class, 'getUser']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::get('riasec-get-question/{level_param?}/{question_order_in_level_param?}', [RiasecTestController::class, 'getQuestionByLevelAndOrderJson']);
    Route::post('riasec-submit-answer', [RiasecTestController::class, 'submitAnswer']);
    Route::get('riasec-get-user-result', [RiasecTestController::class, 'getUserResultJson'])->name('api.riasec.get_user_result');
    Route::post('chatbot/ask', [ChatBotController::class, 'ask']); 
    Route::get('chatbot/history', [ChatBotController::class, 'history']);
});
