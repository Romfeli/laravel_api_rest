<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
Route::get('/participants',[ParticipantController::class,'index']);

Route::get('/participants/{id}',[ParticipantController::class,'show']);


Route::post('/participants',[ParticipantController::class,'store']);

Route::put('/participants/{id}',[ParticipantController::class,'update']);

Route::put('/participants/{id}',[ParticipantController::class,'updatePartials']);



Route::delete('/participants/{id}',[ParticipantController::class,'destroy']);