<?php

use App\Http\Controllers\Api\TaskController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::prefix('')
    ->middleware(['auth:sanctum'])
    ->group(function (Router $router) {
        $router->apiResource('tasks', TaskController::class)->except('show');
        $router->patch('tasks/{task}/status', [TaskController::class, 'updateStatus']);
    });

Route::get('/token/{user}', function ($id) {
    $user = User::find($id);

    if (! $user) {
        return response()->noContent(); // W ramach zabezpieczenia, żeby nie dało się podejrzeć czy user o danym id istnieje :)
    }

    $token = $user->createToken('manual-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

