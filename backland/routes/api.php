<?php

use App\Http\Controllers\MailUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("mailuser/subscribe", [MailUserController::class, 'subscribe']);