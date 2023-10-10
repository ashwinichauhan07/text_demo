<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/logout',[\App\Http\Controllers\api\ApiController::class,'logout'])->name('logout');

    Route::post('/student_details',[\App\Http\Controllers\api\ApiController::class,'student_details'])->name('student_details');

    Route::post('/student_insitute',[\App\Http\Controllers\api\ApiController::class,'student_insitute'])->name('student_insitute');

    Route::post('/student_subject',[\App\Http\Controllers\api\ApiController::class,'student_subject'])->name('student_subject');

    Route::post('/student_practisetype',[\App\Http\Controllers\api\ApiController::class,'student_practisetype'])->name('student_practisetype');

    Route::post('/student_typingdata',[\App\Http\Controllers\api\ApiController::class,'student_typingdata'])->name('student_typingdata');

    Route::post('/exeinvoke',[\App\Http\Controllers\api\ApiController::class,'exeinvoke'])->name('exeinvoke');

    Route::post('/student_batch',[\App\Http\Controllers\api\ApiController::class,'student_batch'])->name('student_batch');

    Route::post('/downloadfile',[\App\Http\Controllers\api\ApiController::class,'downloadfile'])->name('downloadfile');

    Route::post('/typing_result',[\App\Http\Controllers\api\ApiController::class,'typing_result'])->name('typing_result');

    Route::post('/passagetest',[\App\Http\Controllers\api\TypingtestapiController::class,'passagetest'])->name('passagetest');

    Route::post('/lettertest',[\App\Http\Controllers\api\TypingtestapiController::class,'lettertest'])->name('lettertest');

    Route::post('/statementtest',[\App\Http\Controllers\api\TypingtestapiController::class,'statementtest'])->name('statementtest');

    Route::post('/emailtest',[\App\Http\Controllers\api\TypingtestapiController::class,'emailtest'])->name('emailtest');

    Route::post('/typingtest_result',[\App\Http\Controllers\api\TypingtestapiController::class,'typingtest_result'])->name('typingtest_result');

    Route::post('/startexam',[\App\Http\Controllers\api\TypingexamController::class,'startexam'])->name('startexam');

    Route::post('/getpdf',[\App\Http\Controllers\api\TypingexamController::class,
        'getpdf'])->name('getpdf');

     Route::post('/keyboardpractisetype',[\App\Http\Controllers\api\KeyboardPractiseController::class, 'keyboardpractisetype'])->name('keyboardpractisetype');

     Route::post('/keyboardData',[\App\Http\Controllers\api\KeyboardPractiseController::class, 'keyboardData'])->name('keyboardData');

     Route::post('/keyboardpractiseresult',[\App\Http\Controllers\api\KeyboardPractiseController::class, 'keyboardpractiseresult'])->name('keyboardpractiseresult');


});


Route::post('/insert_absentdata',[\App\Http\Controllers\api\AttendanceDataController::class, 'insert_absentdata'])
    ->name('insert_absentdata');


    Route::get('/insert_absentattendance',[\App\Http\Controllers\api\AttendanceDataController::class, 'insert_absentattendance'])
    ->name('insert_absentattendance');



//Route::get('/demo',[\App\Http\Controllers\api\ApiController::class,'demo'])->name('demo');

Route::post('/studentlogin',[\App\Http\Controllers\api\ApiController::class,'studentlogin'])->name('studentlogin');

Route::post('/examlogin',[\App\Http\Controllers\api\TypingexamController::class,'examlogin'])->name('examlogin');

Route::get('pdf', [\App\Http\Controllers\api\TypingexamController::class, 'pdf'])->name('pdf');;

//Route::post('/exeinvoke',[\App\Http\Controllers\api\ApiController::class,'exeinvoke'])->name('exeinvoke');

//get practise type

Route::post('/practiseTypeData',[\App\Http\Controllers\api\ApiController::class,'practiseTypeData'])->name('practiseTypeData');

Route::post('/test',[\App\Http\Controllers\api\ApiController::class,'test'])->name('test');

Route::post('/apitest',[\App\Http\Controllers\api\ApiController::class,'apitest'])->name('apitest');







