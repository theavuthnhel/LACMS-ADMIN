<?php

use Illuminate\Support\Facades\Route;
use Modules\Bio\Http\Controllers\BioController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bios', BioController::class)->names('bio');
});
