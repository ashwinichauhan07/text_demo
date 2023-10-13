<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\institute\InstController;
use App\Http\Controllers\AdminstudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\IsessionController;
use App\Http\Controllers\ItimingController;
use App\Http\Controllers\CoursefeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GrnumberController;
use App\Http\Controllers\InstructorpaymentController;
use App\Http\Controllers\StudentfeeController;
use App\Http\Controllers\StudentinstallmentsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\instructor\AdmininstructorController;
use App\Models\Gender;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\AuthorityController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\CustemNotificationController;
use App\Http\Controllers\HandicapController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\McqtypeController;
use App\Http\Controllers\TypingtestController;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\StudenttypingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NoticereportController;
use App\Http\Controllers\StudentreportController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ExamBatchesController;
use App\Http\Controllers\HallticketController;
use App\Http\Controllers\McqtestController;
use App\Http\Controllers\StudentuserController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TypingWordPracticesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomekeyController;
use App\Http\Controllers\UpperkeyController;
use App\Http\Controllers\LowerkeyController;
use App\Http\Controllers\CapitalwordController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\KeboardPracticeController;
use App\Http\Controllers\PractiseTypeController;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\TypingPractiseController;
use App\Http\Controllers\StudentGrowthController;
use App\Http\Controllers\PractisemcqtestController;
use App\Http\Controllers\MCQPractiseExamController;
use App\Http\Controllers\AttendanceRecordController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentBatchAllocationController;
use App\Http\Controllers\ExamNameController;
use App\Http\Controllers\TypingExamController;
use App\Http\Controllers\DemoauthController;
use App\Http\Controllers\TypingTestReportController;
use App\Http\Controllers\UploadController;






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


// Route::get('/',[HomeController::class,'home'])->name('home');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/term', [HomeController::class, 'term'])->name('term');

Route::get('/about', [HomeController::class, 'about'])->name('about');


Route::get('/index', [StudenttypingController::class, 'index'])->name('studenttyping.index');

//Route::get('/exe',[StudenttypingController::class,'exe'])->name('studenttyping.exe');

Route::get('/exe1', [StudenttypingController::class, 'exe1'])->name('studenttyping.exe1');

Route::get('/exe2', [StudenttypingController::class, 'exe2'])->name('studenttyping.exe2');

Route::get('/', [AuthController::class, 'login'])->name('auth.login');

Route::post('/store', [AuthController::class, 'store'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('login.logout');


// Route::get('/',[AuthController::class,'loginpage'])->name('login');

// Route::post("/login",[AuthController::class,'login']);

Route::get("sendOtp", [AuthController::class, 'sendOtp'])->name('sendOtp');

Route::post('/otpvarify', [AuthController::class, 'otpvarify'])->name('login.otpvarify');


// Demo Exam login route

Route::get('/examlogin', [DemoauthController::class, 'login'])->name('demoexam.auth.login');

Route::post('/examlogin/store', [DemoauthController::class, 'store'])->name('demoexam.auth.store');




// Route::get("verifyOtp",[AuthController::class,'verifyOtp'])->name('verifyOtp');

// Route::get("verify",[AuthController::class,'verify'])->name('verify');

Route::middleware(['auth:sanctum', 'verified', 'UserTypeCheck'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');


// Super Admin Routes
Route::group(['middleware' => ['auth:sanctum', 'verified', 'AdminCheck'], 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');


    Route::get('admin/calender', 'App\Http\Controllers\CalenderController@viewCalendar')->name('admin/calender');


    Route::get('custemNotification/index', [CustemNotificationController::class, 'index'])->name('custemNotification.index');

    Route::post('custemNotification/store', [CustemNotificationController::class, 'store'])->name('custemNotification.store');

    Route::delete('custemNotification/destroy/{custemNotification}', [CustemNotificationController::class, 'destroy'])->name('custemNotification.destroy');

    Route::get('/student', [StudentController::class, 'index'])->name('admin.student.index');

    Route::resource('institute', InstituteController::class);

    Route::resource('handicap', HandicapController::class);

    Route::resource('revenue', RevenueController::class);

    Route::resource('course', CourseController::class);

    Route::resource('adminstudent', AdminstudentController::class);

    // Route::POST('adminstudent', [AdminstudentController::class, 'show_student'])->name('adminstudent.show_student');


    // Course route
    Route::resource('subject', SubjectController::class);

    Route::resource('document', DocumentController::class);

    // license route

    Route::get('/license', [LicenseController::class, 'index'])->name('license.index');

    Route::get('/license/create', [LicenseController::class, 'create'])->name('license.create');
    Route::post('/store', [LicenseController::class, 'store'])->name('license.store');

    Route::get('/license/{license}/edit', [LicenseController::class, 'edit'])->name('license.edit');

    Route::put('/license/{license}', [LicenseController::class, 'update'])->name('license.update');

//    Practise Type Name
    Route::resource('practisetypename', \App\Http\Controllers\PractisTypeNameController::class);


});

// Admin Routes

Route::group(['middleware' => ['auth:sanctum', 'verified',], 'prefix' => 'instituteadmin'], function () {

    Route::get('/dashboard', [InstController::class, 'index'])->name('instituteadmin.dashboard');

    Route::get('/profile', [InstController::class, 'profile'])->name('instituteadmin.profile');

    Route::get('students/{id}/lock', [InstController::class, 'lock'])->name('students.lock');
    Route::get('students/{id}/unlock', [InstController::class, 'unlock'])->name('students.unlock');

//    Route::get('extendtime/{id}', [InstController::class, 'extendtime'])->name('instituteadmin.extendtime');

    Route::get('instituteadmin/calender', 'App\Http\Controllers\CalenderController@viewCalendar')->name('instituteadmin/calender');

    Route::get('instituteadmin.session', function () {
        return view('instituteadmin.session');
    });


    Route::post('subfilter', [CoursefeeController::class, 'subfilter'])->name('subfilter');

    Route::post('coursefilter', [StudentController::class, 'coursefilter'])->name('coursefilter');

    Route::post('subjectfilter', [StudentController::class, 'subjectfilter'])->name('subjectfilter');

    Route::post('feesfilter', [StudentController::class, 'feesfilter'])->name('feesfilter');

    //route for notification

    Route::get('notice/', [InstituteController::class, 'notice'])->name('instituteadmin.notice');

    Route::get('checknotice/', [InstController::class, 'checknotice'])->name('instituteadmin.checknotice');

    // student details
    Route::post('student/details/', [StudentController::class, 'details'])->name("student.details");

    Route::post('student/searchname/', [StudentController::class, 'searchname'])->name("student.searchname");



    // student details
    Route::post('instructor/details/', [InstructorController::class, 'details'])->name("instructor.details");

    // Route::resource('students', StudentController::class);

    // Route::resource('students', StudentController::class);

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

    Route::put('/students/store', [StudentController::class, 'store'])->name('students.store');

    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');


    Route::PATCH('/students/{student}', [StudentController::class, 'update'])->name('students.update');

    Route::DELETE('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('grnumber', [StudentController::class, 'grnumber'])->name('students.grnumber');

    Route::get('repeat_index', [StudentController::class, 'repeat_index'])
        ->name('students.repeat_index');

    Route::get('students/{student_repeat}/repeat', [StudentController::class,
        'repeat'])->name('students.repeat');

    Route::PATCH('/students/repeat/{student_repeat}', [StudentController::class, 'repeat_update'])->name('students.repeat_update');

    Route::get('students/{student_reappear}/reappear', [StudentController::class, 'reappear'])->name('students.reappear');

    Route::PATCH('/students/reappear/{student_reappear}', [StudentController::class, 'reappear_update'])->name('students.reappear_update');


    // Route::get('/examBatches/create', [ExamBatchesController::class, 'create'])->name('examBatches.create');

    Route::resource('instructors', InstructorController::class);

    // Route::resource('exam', ExamController::class);

//    Create Practise Exam

    Route::get('/practise_exam', [\App\Http\Controllers\PractiseExamController::class, 'index'])->name('practise_exam.index');
//
    Route::get('/practise_exam/create', [\App\Http\Controllers\PractiseExamController::class, 'create'])->name('practise_exam.create');
//
    Route::post('/practise_exam/select_paper', [\App\Http\Controllers\PractiseExamController::class, 'select_paper'])->name('practise_exam.select_paper');

//        Route::get('/practise_exam/select_paper}',[\App\Http\Controllers\PractiseExamController::class,'show'])->name('exam.show');

    Route::post('/practise_exam/studentselect', [\App\Http\Controllers\PractiseExamController::class, 'studentselect'])->name('practise_exam.studentselect');
//
    Route::post('/practise_exam/createxam', [\App\Http\Controllers\PractiseExamController::class, 'createxam'])->name('practise_exam.createxam');
//
    Route::get('/practise_exam/show/{practiseExam}', [\App\Http\Controllers\PractiseExamController::class, 'show'])->name('practise_exam.show');

    Route::delete('/practise_exam/{practiseExam}', [\App\Http\Controllers\PractiseExamController::class, 'destroy'])->name('practise_exam.destroy');

    Route::resource('isessions', IsessionController::class);

    Route::post('/isessions/{isession}/active', [IsessionController::class, 'active'])->name('isessions.active');

    Route::resource('itimings', ItimingController::class);

    Route::resource('coursefees', CoursefeeController::class);

    Route::resource('grnumbers', GrnumberController::class);

    Route::resource('halltickets', HallticketController::class);

    Route::resource('studentinstallments', StudentinstallmentsController::class);

    Route::get('installment/show/{id}', [StudentinstallmentsController::class, 'show'])->name('installment.show');



    // for receipt

    Route::get('installment/receipt/{studentinstallment}', [StudentinstallmentsController::class, 'receipt'])->name('installment.receipt');

    Route::get('installment', [StudentinstallmentsController::class, 'session'])->name('studentinstallments.session');

    Route::get('revenue', [StudentinstallmentsController::class, 'revenue'])->name('studentinstallments.revenue');

    Route::get('deletedstudentinfo', [StudentinstallmentsController::class,
     'index'])->name('studentinfo.index');



    Route::resource('instructorpayments', InstructorpaymentController::class);

    Route::get('instructor/report/', [InstructorController::class, 'report'])->name("instructors.report");

    Route::get('payment_report', [InstructorpaymentController::class, 'payment_report'])->name('instructorpayments.payment_report');

    Route::resource('studentfees', StudentfeeController::class);

    Route::get('studentinfo', [StudentInfoController::class, 'index'])
    ->name('studentinfo.index');

  Route::DELETE('/studentinfo/destroy/{id}', [StudentInfoController::class,
   'destroy'])->name('studentinfo.destroy');

    Route::get('/studentinfo/restore/{id}', [StudentInfoController::class, 'restore'])->name('studentinfo.restore');



    Route::get('studentinfo/installmentreceipt/{id}', [StudentInfoController::class,
     'show'])->name('studentinfo.showinstallmentrecipt');

    Route::get('studentinfo/receipt/{id}', [StudentInfoController::class,
        'printreceipt'])->name('studentinfo.printreceipt');


    Route::get('attendance/index', [AttendanceController::class, 'index'])->name('attendance.index');


    Route::resource('noticereport', NoticereportController::class);

    // Route::resource('studentreport', StudentreportController::class);

    Route::get('studentreport', [StudentreportController::class, 'index'])
        ->name('studentreport.index');

    Route::get('hallticket', [HallticketController::class, 'index'])->name('hallticket.index');

    Route::get('/hallticket/create', [HallticketController::class, 'create'])->name('hallticket.create');

    Route::put('/store/hallticket', [HallticketController::class, 'store'])->name('hallticket.store');

    Route::get('/hallticket/{hallticket}/edit', [HallticketController::class, 'edit'])->name('hallticket.edit');

    Route::PATCH('/hallticket/{hallticket}', [HallticketController::class, 'update'])->name('hallticket.update');
    Route::DELETE('/hallticket/{hallticket}', [HallticketController::class, 'destroy'])->name('hallticket.destroy');

    Route::get('/hallticket_time_table/pdf', [HallticketController::class, 'hallticket_time_table'])->name('pdf.hallticket_time_table');

    Route::get('/hallticket_print/{hallticket}', [HallticketController::class, 'hallticket_print'])->name('pdf.hallticket');

    Route::post('batchfilter', [HallticketController::class, 'batchfilter'])->name('batchfilter');

    Route::post('student/search/', [StudentController::class, 'search'])->name("student.search");

    Route::get('typing_word_practices', [TypingWordPracticesController::class, 'index'])->name('typing_word_practices.index');

    Route::get('typing_word_practices/create', [TypingWordPracticesController::class, 'create'])->name('typing_word_practices.create');

    Route::post('/store', [TypingWordPracticesController::class, 'store'])->name('typing_word_practices.store');

    Route::get('/typing_word_practices/show/{typing_word_practices}', [TypingWordPracticesController::class, 'show'])->name('typing_word_practices.show');

    Route::get('/typing_word_practices/{typing_word_practices}/edit', [TypingWordPracticesController::class, 'edit'])->name('typing_word_practices.edit');

    Route::PATCH('/typing_word_practices/{typing_word_practices}', [TypingWordPracticesController::class, 'update'])->name('typing_word_practices.update');

    Route::DELETE('/typing_word_practices/{typing_word_practices}', [TypingWordPracticesController::class, 'destroy'])->name('typing_word_practices.destroy');

    Route::DELETE('/typing_word_practices/deleteAll', [TypingWordPracticesController::class, 'deleteAll'])->name('deleteAll');

// question controller


    // MCQ Typing controller

    Route::resource('mcqtype', McqtypeController::class);

    // Section controller

    Route::resource('section', SectionController::class);

    // Typing test controller

    Route::resource('typingtest', TypingtestController::class);

    Route::post('practisetype_data', [TypingtestController::class, 'practisetype_data'])->name('practisetype_data');


    // For notification

    Route::resource('authority', AuthorityController::class);

    // For MCQ Test
    Route::resource('mcqtest', McqtestController::class);

//     MCQ Question for Practise
    // Route:: get('/practicemcq/upload', function(){
    //     return view('upload');
    // }); 
    // Route::view('practicemcq/upload','upload');
    // Route::post('practicemcq/upload',[\App\Http\Controllers\UploadController::class, 'store']);
    // Route::get('/practicemcq/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('practicemcq.upload');
    // Route::post('upload',[UploadController::class,'index']);
    Route::get('/practicemcq', [\App\Http\Controllers\PractisemcqController::class, 'index'])->name('practicemcq.index');
    // Route::get('/practicemcq', [\App\Http\Controllers\PractisemcqController::class, 'index1'])->name('practicemcq.index1');

    Route::get('/practicemcq/create', [\App\Http\Controllers\PractisemcqController::class, 'create'])->name('practicemcq.create');
//
    Route::post('practicemcq/store', [\App\Http\Controllers\PractisemcqController::class, 'store'])->name('practicemcq.store');
//
    Route::get('/practicemcq/{practisemcq}/show', [\App\Http\Controllers\PractisemcqController::class, 'show'])->name('practicemcq.show');
//
    Route::get('/practicemcq/{practisemcq}/edit', [\App\Http\Controllers\PractisemcqController::class, 'edit'])->name('practicemcq.edit');

    Route::PATCH('/practicemcq/{practisemcq}', [\App\Http\Controllers\PractisemcqController::class, 'update'])->name('practicemcq.update');
//
    Route::DELETE('/practicemcq/{practisemcq}', [\App\Http\Controllers\PractisemcqController::class, 'destroy'])->name('practicemcq.destroy');
    // for Language

    Route::get('language', [LanguageController::class, 'index'])->name('language.index');

    Route::get('language/create', [LanguageController::class, 'create'])->name('language.create');

    Route::put('/store/language', [LanguageController::class, 'store'])->name('language.store');

    Route::DELETE('/language/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');

    // for craeation of home key

    Route::get('homekey', [HomekeyController::class, 'index'])->name('homekey.index');

    Route::get('homekey/create', [HomekeyController::class, 'create'])->name('homekey.create');

    Route::put('/store/homekey', [HomekeyController::class, 'store'])->name('homekey.store');

    Route::DELETE('/homekey/{homekey}', [HomekeyController::class, 'destroy'])->name('homekey.destroy');

    Route::get('homekey/{homekey}', [HomekeyController::class, 'typingpractise'])->name('homekey.typingpractise');

    Route::post('homekey_result', [HomekeyController::class, 'homekey_result'])->name('homekey_result');

    // For Upper Key

    Route::get('upperkey', [UpperkeyController::class, 'index'])->name('upperkey.index');

    Route::get('upperkey/create', [UpperkeyController::class, 'create'])->name('upperkey.create');

    Route::put('/store/upperkey', [UpperkeyController::class, 'store'])->name('upperkey.store');

    Route::DELETE('/upperkey/{upperkey}', [UpperkeyController::class, 'destroy'])->name('upperkey.destroy');

    Route::get('upperkey/{upperkey}', [UpperkeyController::class, 'typingpractise'])->name('upperkey.typingpractise');

    Route::post('upperkey_result', [UpperkeyController::class, 'upperkey_result'])->name('upperkey_result');

    // For Lower Key

    Route::get('lowerkey', [LowerkeyController::class, 'index'])->name('lowerkey.index');

    Route::get('lowerkey/create', [LowerkeyController::class, 'create'])->name('lowerkey.create');

    Route::put('/store/lowerkey', [LowerkeyController::class, 'store'])->name('lowerkey.store');

    Route::DELETE('/lowerkey/{lowerkey}', [LowerkeyController::class, 'destroy'])->name('lowerkey.destroy');

    Route::get('lowerkey/{lowerkey}', [LowerkeyController::class, 'typingpractise'])->name('lowerkey.typingpractise');

    Route::post('lowerkey_result', [LowerkeyController::class, 'lowerkey_result'])->name('lowerkey_result');

    // For Capital Word

    Route::get('capitalword', [CapitalwordController::class, 'index'])->name('capitalword.index');

    Route::get('capitalword/create', [CapitalwordController::class, 'create'])->name('capitalword.create');

    Route::post('/store', [CapitalwordController::class, 'store'])->name('capitalword.store');

    Route::DELETE('/capitalword/{capitalword}', [CapitalwordController::class, 'destroy'])->name('capitalword.destroy');

    Route::get('capitalword/{capitalword}', [CapitalwordController::class, 'typingpractise'])->name('capitalword.typingpractise');

    Route::post('capitalword_result', [CapitalwordController::class, 'capitalword_result'])->name('capitalword_result');

    // Keybord Practises

    Route::get('keboardPractice', [KeboardPracticeController::class, 'index'])->name('keboardPractice.index');

    Route::get('keboardPractice/create', [KeboardPracticeController::class, 'create'])->name('keboardPractice.create');

    Route::put('/store/keboardPractice', [KeboardPracticeController::class, 'store'])->name('keboardPractice.store');

    Route::DELETE('/keboardPractice/{keboardPractice}', [KeboardPracticeController::class, 'destroy'])->name('keboardPractice.destroy');


    // Student Growth

    Route::get('studentgrowth', [StudentGrowthController::class, 'index'])
        ->name('studentgrowth.index');

    Route::get('studentgrowth/viewresult/{id}', [StudentGrowthController::class,
        'viewresult'])->name('studentgrowth.viewresult');

    Route::Post('studentgrowth/viewenglishresult',
        [StudentGrowthController::class, 'viewenglishresult'])
        ->name('studentgrowth.viewenglishresult');

    Route::post('studentgrowth/accuracyresult', [StudentGrowthController::class,
    'accuracyresult'])->name('studentgrowth.accuracyresult');

    Route::Post('studentgrowth/test', [StudentGrowthController::class, 'test'])
        ->name('studentgrowth.test');

        Route::Post('studentgrowth/mcq_practiseresult', [StudentGrowthController::class, 'mcq_practiseresult'])
        ->name('studentgrowth.mcq_practiseresult');

        Route::Post('studentgrowth/mcq_testresult', [StudentGrowthController::class, 'mcq_testresult'])
        ->name('studentgrowth.mcq_testresult');

        Route::Post('studentgrowth/testresult', [StudentGrowthController::class, 'testresult'])
        ->name('studentgrowth.testresult');


        Route::post('studentgrowth/showtestresult/', [StudentGrowthController::class, 'showtestresult'])
        ->name('studentgrowth.showtestresult');



    // filter for practise type

    Route::post('practise_type', [KeboardPracticeController::class, 'practise_type'])->name('practise_type');


    Route::post('practisetype', [TypingPractiseController::class, 'practisetype'])->name('practisetype');


    // exe upload data

    Route::get('typingPractise', [TypingPractiseController::class, 'index'])->name('typingPractise.index');

    Route::get('typingPractise/create', [TypingPractiseController::class, 'create'])->name('typingPractise.create');

    Route::put('/store/typingPractise', [TypingPractiseController::class, 'store'])->name('typingPractise.store');

    Route::DELETE('/typingPractise/{typingPractise}', [TypingPractiseController::class, 'destroy'])->name('typingPractise.destroy');

    // Typing pratise comparator

    Route::get('keboardPractice/{keboardPractice}', [KeboardPracticeController::class, 'typingpractise'])->name('keboardPractice.typingpractise');

    // save keboardPractice result in database

    Route::post('keboard_practice', [KeboardPracticeController::class, 'keboard_practice'])->name('keboard_practice');

    Route::post('student_keboardpractice', [KeboardPracticeController::class, 'student_keboardpractice'])->name('student_keboardpractice');


    //  Practise Type

    Route::get('practiseType', [PractiseTypeController::class, 'index'])->name('practiseType.index');

    Route::get('practiseType/create', [PractiseTypeController::class, 'create'])->name('practiseType.create');

    Route::put('/store/practiseType', [PractiseTypeController::class, 'store'])->name('practiseType.store');

    Route::DELETE('/practiseType/{practiseType}', [PractiseTypeController::class, 'destroy'])->name('practiseType.destroy');

    // Student Type

    Route::get('studentType', [StudentTypeController::class, 'index'])->name('studentType.index');

    Route::get('studentType/create', [StudentTypeController::class, 'create'])->name('studentType.create');

    Route::put('studentType/store', [StudentTypeController::class, 'store'])->name('studentType.store');

    Route::DELETE('/studentType/{studentType}', [StudentTypeController::class, 'destroy'])->name('studentType.destroy');


    Route::get('instituteNotification/index', [CustemNotificationController::class, 'index'])->name('instituteNotification.index');

    Route::post('instituteNotification/store', [CustemNotificationController::class, 'store'])->name('instituteNotification.store');

    Route::delete('instituteNotification/destroy/{instituteNotification}', [CustemNotificationController::class, 'destroy'])->name('instituteNotification.destroy');


    // Typing Test Report


    Route::get('typingtestreport/index', [TypingTestReportController::class,'index'])->name('typingtestreport.index');

    // MCQ Test Report

    Route::get('mcqtestreport/indexofmcq', [TypingTestReportController::class,
     'indexofmcq'])->name('typingtestreport.indexofmcq');





//      MCQ Quection bank For Practise

    Route::get('/mcq_bank/decide', [\App\Http\Controllers\McqBankController::class, 'decide'])->name('mcq_bank.decide');


    Route::get('/mcq_bank/automatic_create', [\App\Http\Controllers\McqBankController::class, 'automatic_create'])->name('mcq_bank.automatic_create');
//
    Route::get('manual_create/mcq_bank', [\App\Http\Controllers\McqBankController::class, 'manual_create'])->name('mcq_bank.manual_create');
//
    Route::post('/mcq_bank/automatic_create_show', [\App\Http\Controllers\McqBankController::class, 'automatic_create_show'])->name('mcq_bank.automatic_create_show');
//
    Route::post('/mcq_bank/get_question_details', [\App\Http\Controllers\McqBankController::class, 'get_question_details'])->name('mcq_bank.get_question_details');
//
    Route::get('/mcq_bank/{mcq_bank}', [\App\Http\Controllers\McqBankController::class, 'show'])->name('mcq_bank.show');
//
    Route::post('/mcq_bank/automatic_store', [\App\Http\Controllers\McqBankController::class, 'automatic_store'])->name('mcq_bank.automatic_store');
//
    Route::post('questionmanaual/mcq_bank', [\App\Http\Controllers\McqBankController::class, 'questionmanaual'])->name('mcq_bank.questionmanaual');
//
    Route::post('manauallyQuestionShow/mcq_bank', [\App\Http\Controllers\McqBankController::class, 'manauallyQuestionShow'])->name('mcq_bank.manauallyQuestionShow');

    Route::delete('mcq_bank/destroy/{mcq_bank}', [\App\Http\Controllers\McqBankController::class, 'destroy'])->name('mcq_bank.destroy');


// mcq question for practise test




    Route::get('/practisemcqtest/index', [\App\Http\Controllers\PractisemcqtestController::class, 'index'])
        ->name('practise_mcqtestpaper.index');


    Route::get('/practisemcqtest/automatic', [\App\Http\Controllers\PractisemcqtestController::class, 'automatic'])
        ->name('practise_mcqtestpaper.automatic');


    Route::post('/practisemcqtest/automaticshow', [\App\Http\Controllers\PractisemcqtestController::class, 'automatic_create_show'])
        ->name('practise_mcqtestpaper.automatic_create_show');

    Route::post('/practisemcqtest/automaticstore', [\App\Http\Controllers\PractisemcqtestController::class, 'automaticstore'])
        ->name('practise_mcqtestpaper.automaticstore');


    Route::get('/practisemcqtest/manually', [\App\Http\Controllers\PractisemcqtestController::class, 'manually'])
        ->name('practise_mcqtestpaper.manually');


    Route::post('/practisemcqtest/questionmanaual', [\App\Http\Controllers\PractisemcqtestController::class, 'questionmanaual'])
        ->name('practise_mcqtestpaper.manually_question');


    Route::post('/practisemcqtest/manuallyshow', [\App\Http\Controllers\PractisemcqtestController::class, 'manually_create_show'])
        ->name('practise_mcqtestpaper.manually_create_show');

    Route::get('/practisemcqtest/{practiseMCQTest}', [PractisemcqtestController::class, 'show'])->name('practise_mcqtestpaper.show');


    // Route::get('practisemcqtest/{PractiseMCQTest}', [\App\Http\Controllers\PractisemcqtestController::class, 'show'])
    // ->name('practise_mcqtestpaper.show');


    // MCQ PRACTISE CREATE EXAM

    Route::get('/practisetest/index_exam', [\App\Http\Controllers\MCQPractiseExamController::class, 'index_exam'])
        ->name('practiseexam.index_exam');


    Route::get('/practisetest/create_exam', [\App\Http\Controllers\MCQPractiseExamController::class, 'create_exam'])
        ->name('practiseexam.create_exam');


    Route::post('/practisetest/select_paper', [\App\Http\Controllers\MCQPractiseExamController::class, 'select_paper'])
        ->name('practiseexam.select_paper');

    Route::post('/practisetest/select_student', [App\Http\Controllers\MCQPractiseExamController::class, 'select_student'])
        ->name('practiseexam.select_student');

    Route::post('/practisetest/store_exam', [\App\Http\Controllers\MCQPractiseExamController::class, 'store_exam'])->name('practiseexam.store_exam');

    Route::get('/practisetest/show/{mCQPractiseExam}', [\App\Http\Controllers\MCQPractiseExamController::class, 'show'])->name('practiseexam.show');


    Route::delete('/practisetest/destroy/{mCQPractiseExam}', [\App\Http\Controllers\MCQPractiseExamController::class, 'destroy'])
        ->name('practiseexam.destroy');


    Route::get('/practisetest/show_info/{id}',
        [\App\Http\Controllers\MCQPractiseExamController::class, 'show_info'])
        ->name('practiseexam.show_info');


//       Route for license payment or payment get way

    Route::get('licensepayment', [\App\Http\Controllers\LicensePaymentController::class, 'index'])->name('licensepayment.index');
//
    Route::get('licensepayment/create', [\App\Http\Controllers\LicensePaymentController::class, 'create'])->name('licensepayment.create');

    Route::put('/licensepayment/payment', [\App\Http\Controllers\LicensePaymentController::class, 'payment'])->name('licensepayment.payment');

//
    Route::put('/store/licensepayment', [\App\Http\Controllers\LicensePaymentController::class, 'store'])->name('licensepayment.store');
//
//        Route::DELETE('/practiseType/{practiseType}', [PractiseTypeController::class, 'destroy'])->name('practiseType.destroy');

    Route::get('timetable', [InstController::class, 'timetable'])->name('instituteadmin.timetable');

    // Route::get('/studentbatchallocation/create', [StudentBatchAllocationController::class, 'create'])->name('studentbatchallocation.create');


});


// Demo Exam


Route::group(['middleware' => ['auth:sanctum', 'verified', 'DemoExam'], 'prefix' => 'demoexam'], function () {

    Route::get('/dashboard', [ExamController::class, 'dashboard'])->name('demoexam.dashboard');

    Route::resource('exam_name', ExamNameController::class);

    Route::get('examBatches', [ExamBatchesController::class, 'index'])->name('examBatches.index');

    Route::get('/examBatches/create', [ExamBatchesController::class, 'create'])->name('examBatches.create');

    Route::put('/store', [ExamBatchesController::class, 'store'])->name('examBatches.store');

    Route::get('/examBatches/{examBatches}/edit', [ExamBatchesController::class, 'edit'])->name('examBatches.edit');

    Route::PATCH('/examBatches/{examBatches}', [ExamBatchesController::class, 'update'])->name('examBatches.update');

    Route::DELETE('/examBatches/{examBatches}', [ExamBatchesController::class, 'destroy'])->name('examBatches.destroy');

    Route::get('/studentbatchallocation', [StudentBatchAllocationController::class, 'index'])->name('studentbatchallocation.index');

    Route::get('/studentbatchallocation/create', [StudentBatchAllocationController::class, 'create'])->name('studentbatchallocation.create');

    Route::get('/studentbatchallocation/create', [StudentBatchAllocationController::class, 'create'])->name('studentbatchallocation.create');

    Route::post('/studentbatchallocation/select_student', [StudentBatchAllocationController::class, 'select_student'])->name('studentbatchallocation.select_student');

    Route::post('/studentbatchallocation/store', [StudentBatchAllocationController::class, 'store'])->name('studentbatchallocation.store');

    Route::delete('/studentbatchallocation/destroy/{studentBatchAllocation}',
     [StudentBatchAllocationController::class, 'destroy'])->name('studentbatchallocation.destroy');

    Route::post('examwise_batchname', [StudentBatchAllocationController::class, 'examwise_batchname'])->name('examwise_batchname');

    Route::post('batchwisesubject', [StudentBatchAllocationController::class, 'batchwisesubject'])->name('batchwisesubject');

    Route::resource('question', QuestionController::class);

    Route::get('/question_bank/decide', [QuestionBankController::class, 'decide'])->name('question_bank.decide');

    Route::delete('question_bank/destroy/{questionBank}', [QuestionBankController::class, 'destroy'])->name('question_bank.destroy');

    Route::get('/question_bank/automatic_create', [QuestionBankController::class, 'automatic_create'])->name('question_bank.automatic_create');

    Route::get('manual_create/question_bank', [QuestionBankController::class, 'manual_create'])->name('question_bank.manual_create');

    Route::post('/question_bank/automatic_create_show', [QuestionBankController::class, 'automatic_create_show'])->name('question_bank.automatic_create_show');

    Route::post('/question_bank/get_question_details', [QuestionBankController::class, 'get_question_details'])->name('question_bank.get_question_details');

    Route::get('/question_bank/{question_bank}', [QuestionBankController::class, 'show'])->name('question_bank.show');

    Route::post('/question_bank/automatic_store', [QuestionBankController::class, 'automatic_store'])->name('question_bank.automatic_store');

    Route::post('questionmanaual/question_bank', [QuestionBankController::class, 'questionmanaual'])->name('question_bank.questionmanaual');

    Route::post('manauallyQuestionShow/question_bank', [QuestionBankController::class, 'manauallyQuestionShow'])->name('question_bank.manauallyQuestionShow');

    Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');

    Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create');

    Route::post('/exam/select_paper', [ExamController::class, 'select_paper'])->name('exam.select_paper');

    Route::post('/exam/studentselect', [ExamController::class, 'studentselect'])->name('exam.studentselect');

    Route::post('/exam/createxam', [ExamController::class, 'createxam'])->name('exam.createxam');

    Route::get('/exam/show/{exam}', [ExamController::class, 'show'])->name('exam.show');

    Route::delete('/exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');

    Route::get('/typing_exam', [TypingExamController::class, 'index'])->name('typing_exam.index');

    Route::get('/typing_exam/create', [TypingExamController::class, 'create'])->name('typing_exam.create');

    Route::post('/typing_exam/store', [TypingExamController::class, 'store'])->name('typing_exam.store');

    Route::delete('/typing_exam/destroy/{typingExam}', [TypingExamController::class,
        'destroy'])->name('typing_exam.destroy');

});


// Instructor login

Route::group(['middleware' => ['auth:sanctum', 'verified',], 'prefix' => 'instructortadmin'], function () {

    Route::get('/dashboard', [AdmininstructorController::class, 'index'])->name('instructortadmin.dashboard');

    Route::get('/payment', [AdmininstructorController::class, 'payment'])->name('instructortadmin.payment');

    Route::get('/profile', [AdmininstructorController::class, 'profile'])->name('instructortadmin.profile');

    Route::get('instructortadmin/calender', 'App\Http\Controllers\CalenderController@viewCalendar')->name('instructortadmin/calender');

    // for notification check

    Route::get('checknotice/', [AdmininstructorController::class, 'checknotice'])->name('instructortadmin.checknotice');

    Route::get('/form/pdf/{student}', [StudentController::class, 'createPDF'])->name('pdf.form');

    Route::resource('halltickets', HallticketController::class);

    Route::resource('noticereport', NoticereportController::class);

    Route::get('instituteNotification/index', [CustemNotificationController::class, 'index'])->name('instituteNotification.index');

    Route::post('instituteNotification/store', [CustemNotificationController::class, 'store'])->name('instituteNotification.store');

    Route::delete('instituteNotification/destroy/{instituteNotification}', [CustemNotificationController::class, 'destroy'])->name('instituteNotification.destroy');
});

Route::group(['middleware' => ['auth:sanctum', 'verified','StudentNotice'], 'prefix' => 'student'], function () {

    Route::get('/dashboard', [StudentuserController::class, 'index'])->name('studentuser.index12');

    Route::get('checknotice/', [StudentuserController::class, 'checknotice'])->name('studentuser.checknotice');

    Route::get('paidfees/', [StudentuserController::class, 'paidfees'])->name('studentuser.paidfees');

    Route::post('attendance/', [StudentuserController::class, 'attendance'])->name('attendance');

    Route::post('student_session/', [StudentuserController::class, 'student_session'])->name('student_session');

    Route::get('selectpractise/', [StudentuserController::class, 'selectpractise'])->name('studentuser.selectpractise');

    Route::get('typing', [StudentuserController::class, 'typing'])->name('studentuser.typing');

    Route::get('typing_data/', [StudentuserController::class, 'typing_data'])->name('typing_data');

    // Route::get('homekey/', [StudentuserController::class, 'homekey'])->name('studentuser.typing');

    Route::post('/exe', [StudenttypingController::class, 'exe'])->name('studenttyping.exe');

    Route::get('studentattendance/', [StudentuserController::class, 'showattendanse'])->name('studentuser.showattendanse');

    Route::get('/mcqdashboard', [\App\Http\Controllers\StudentMcqTestController::class, 'mcqdashboard'])->name('student_mcqtest.dashboard');

    Route::post('/index', [\App\Http\Controllers\StudentMcqTestController::class, 'index'])->name('student_mcqtest.index');

    Route::get('/preview', [\App\Http\Controllers\StudentMcqTestController::class, 'resultgeneratepreview'])->name('student_mcqtest.resultgeneratepreview');

    Route::get('/end_exam', [\App\Http\Controllers\StudentMcqTestController::class, 'end_exam_notify'])->name('student_mcqtest.end_exam_notify');

    Route::get('/studenttheory', [\App\Http\Controllers\StudentTheoryController::class, 'studenttheory'])->name('studenttheory.index');

    Route::get('/studenttheory/test/{id}', [\App\Http\Controllers\StudentTheoryController::class, 'test'])->name('studenttheory.test');

    Route::post('/starttest', [\App\Http\Controllers\StudentTheoryController::class, 'starttest'])->name('studenttheory.starttest');

    Route::post('/mcqresult', [\App\Http\Controllers\StudentTheoryController::class, 'mcqresult'])->name('studenttheory.mcqresult');
    Route::get('url', ['middleware' => 'MiddlewareName', 'as' => 'route.name', 'uses' => 'StudentTheoryController@methodName']);

    // Route::post('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\StudentTheoryController@switchLang']);
    Route::post('student/lang/{lang}', [StudentTheoryController::class, 'switchLanguage'])->name('lang.switch');



//    route for display theory test

    Route::get('/studenttheorytest', [\App\Http\Controllers\Student_theorytest::class, 'studenttheorytest'])->name('student_theorytest.index');

    Route::get('/studenttheorytest/test/{id}', [\App\Http\Controllers\Student_theorytest::class, 'test'])->name('student_theorytest.test');
//
    Route::post('/starttheorytest', [\App\Http\Controllers\Student_theorytest::class, 'starttheorytest'])->name('student_theorytest.starttheorytest');
//
    Route::get('/starttheorytest/preview', [\App\Http\Controllers\Student_theorytest::class, 'resultgeneratepreview'])->name('student_theorytest.resultgeneratepreview');

    Route::get('/starttheorytest/end_exam', [\App\Http\Controllers\Student_theorytest::class, 'end_exam_notify'])->name('student_theorytest.end_exam_notify');


});
