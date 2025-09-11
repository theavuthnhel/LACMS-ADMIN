<?php

use Illuminate\Support\Facades\Route;
use Modules\Bio\Http\Controllers\BioController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('bios', BioController::class)->names('bio');
});
