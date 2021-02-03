<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login/login');
});

/* Route Home*/
Route::resource('/dashboard', 'DashboardController');

/* Route Notice*/
Route::resource('/notice', 'NoticeController');
Route::any('/table/notice', 'NoticeController@dataTable')->name('table.notice');

/* Route Program Study*/
Route::resource('/program_study', 'ProgramStudyController');
Route::any('/table/program_study', 'ProgramStudyController@dataTable')->name('table.program_study');

/* Route Authen*/
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login','AuthController@proses_auth')->name('login.auth');
Route::get('/logout','AuthController@logout')->name('logout');

/* Route Program Study*/
Route::resource('/grade_student', 'GradeStudentController');
Route::any('/table/grade_student', 'GradeStudentController@dataTable')->name('table.grade_student');


/* Route Group*/
Route::resource('/group','GroupController');
Route::get('/table/group', 'GroupController@dataTable')->name('table.group');

/* Route Department*/
Route::resource('/department','DepartmentController');
Route::any('/table/department', 'DepartmentController@dataTable')->name('table.department');

/* Route Institution*/
Route::resource('/institution','InstitutionController');
Route::any('/table/institution', 'InstitutionController@dataTable')->name('table.institution');

/* Route Student*/
Route::resource('/student','StudentController');
Route::any('/table/student', 'StudentController@dataTable')->name('table.student');

/* Route Lecturer*/
Route::resource('/lecturer','LecturerController');
Route::any('/table/lecturer', 'LecturerController@dataTable')->name('table.lecturer');

/* Route GroupStudent*/
Route::resource('/groupstudent','GroupStudentController');
Route::any('/table/groupstudent', 'GroupStudentController@dataTable')->name('table.groupstudent');

/* Route GroupLecturer*/
Route::resource('/grouplecturer','GroupLecturerController');
Route::any('/table/grouplecturer', 'GroupLecturerController@dataTable')->name('table.grouplecturer');

/* Route DetailGroup*/
Route::get('/group/{id}/detail','DetailGroupController@index')->name('group.detail');
Route::post('/detailgroup/{id}', 'DetailGroupController@updatestudent')->name('detailgroup.updatestudent');
Route::post('/detailgroup2/{id}', 'DetailGroupController@updatelecturer')->name('detailgroup.updatelecturer');
Route::any('/table/dglecturer/{id}/detail', 'DetailGroupController@dataTableLecturer')->name('table.dglecturer');
Route::any('/table/dgstudent/{id}/detail', 'DetailGroupController@dataTableStudent')->name('table.dgstudent');

/* Route Manage Account*/
Route::resource('/manage_account','ManageAccountController');

/* Route Manage Group*/
Route::resource('/manage_group','ManageGroupController');


/* Route Profil*/
Route::resource('/profile', 'ProfileController');
Route::put('/updateProfil/{id}', 'ProfileController@update')->name('updateProfil');
Route::post('/updatePw/{id}', 'ProfileController@update_pw')->name('updatePw');

/* Route SubmissionProposal*/
Route::resource('/submission_proposal','SubmissionProposalController');
Route::post('/submission_proposal/{id}','SubmissionProposalController@update');
Route::any('/table/submission_proposal', 'SubmissionProposalController@dataTable')->name('table.submission_proposal');

/* Route Manage Proposal*/
Route::resource('/manage_proposal','ManageProposalController');
Route::any('/table/manage_proposal', 'ManageProposalController@dataTable')->name('table.manage_proposal');
Route::any('/table/riwayatpp', 'ManageProposalController@dataTable2')->name('table.riwayatpp');

/* Route Guidance*/
Route::resource('/guidance','GuidanceController');
Route::post('/guidance/{id}','GuidanceController@update');
Route::any('/table/guidance', 'GuidanceController@dataTable')->name('table.guidance');
Route::any('table/guidance2', 'GuidanceController@dataTable2')->name('table.guidance2');

/* Route Manage Proposal*/
Route::resource('/manage_guidance','ManageGuidanceController');
Route::post('/manage_guidance/{id}','ManageGuidanceController@update');
Route::get('/terima/{id}','ManageGuidanceController@edit2')->name('terima.edit2');
Route::any('/table/manage_guidance', 'ManageGuidanceController@dataTable')->name('table.manage_guidance');
Route::any('/table/riwayatbb', 'ManageGuidanceController@dataTable2')->name('table.riwayatbb');

/* Route DetailGuidance*/
Route::resource('/guidance_detail','DetailGuidanceController');

/* Route prasidang*/
Route::resource('/prasidang','PrasidangController');
Route::post('/prasidang/{id}','PrasidangController@update');
Route::any('/table/prasidang', 'PrasidangController@dataTable')->name('table.prasidang');


Route::resource('/manage_prasidang','ManagePrasidangController');
Route::any('/table/manage_prasidang', 'ManagePrasidangController@dataTable')->name('table.manage_prasidang');
Route::get('/grade/export_excel', 'GradeStudentController@export_excel')->name('grade');
Route::get('/grade/export_excel2', 'GradeStudentController@export_excel2')->name('grade2');
Route::get('/grade/export_excel3', 'GradeStudentController@export_excel3')->name('grade3');

Route::resource('/manage_grade','ManageGradeController');
Route::any('/table/manage_grade', 'ManageGradeController@dataTable')->name('table.manage_grade');

/* Route pascasidang*/
Route::resource('/pascasidang','PascasidangController');
Route::post('/pascasidang/{id}','PascasidangController@update');
Route::any('/table/pascasidang', 'PascasidangController@dataTable')->name('table.pascasidang');

Route::resource('/viewpasca','ViewpascaController');
Route::any('/table/pascati', 'ViewpascaController@dataTable')->name('table.pascati');
Route::any('/table/pascasi', 'ViewpascaController@dataTable2')->name('table.pascasi');
Route::any('/table/pascami', 'ViewpascaController@dataTable3')->name('table.pascami');

/* Route Manage Schedule*/
Route::resource('/manage_schedule', 'ManageScheduleController');

/* Route ScheduleStudent*/
Route::resource('/schedulestudent', 'ScheduleStudentController');
Route::any('/table/schedulestudent', 'ScheduleStudentController@dataTable')->name('table.schedulestudent');

/* Route ScheduleLecturer*/
Route::resource('/schedulelecturer', 'ScheduleLecturerController');
Route::any('/table/schedulelecturer', 'ScheduleLecturerController@dataTable')->name('table.schedulelecturer');

/* Route DetailSchedule*/
Route::get('/schedule/{id}/detail', 'DetailScheduleController@index')->name('schedule.detail');
Route::post('/detailschedule/{id}', 'DetailScheduleController@updatestudent')->name('detailschedule.updatestudent');
Route::post('/detailschedule2/{id}', 'DetailScheduleController@updatelecturer')->name('detailschedule.updatelecturer');
Route::any('/table/dslecturer/{id}/detail', 'DetailScheduleController@dataTableLecturer')->name('table.dslecturer');
Route::any('/table/dsstudent/{id}/detail', 'DetailScheduleController@dataTableStudent')->name('table.dsstudent');

/* Route schedule*/
Route::resource('/schedule', 'ScheduleController');
Route::get('/table/schedule', 'ScheduleController@dataTable')->name('table.mschedule');

/* Route view_schedule*/
Route::resource('/view_schedule', 'ViewScheduleController');
Route::any('/table/ViewSchedule', 'ViewScheduleController@dataTable')->name('table.schedule');

Route::get('/apidashboard', 'DashboardController@jumlahRow')->name('api.dashboard');
Route::get('/apijur', 'DashboardController@chartGrad')->name('front.grad');