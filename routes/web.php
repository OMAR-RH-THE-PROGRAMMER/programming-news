<?php

use App\Http\Controllers\NewsController;

Route::get('/', [NewsController::class, 'index']);
