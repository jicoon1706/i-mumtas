<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/manage-courses', function () {
    return view('admin/admin_manage_courses');
});

Route::get('/admin-dashboard', function () {
    return view('admin/admin_dashboard');
});

Route::get('/add-student', function () {
    return view('admin/admin_add_student');
});

Route::get('/add-plo', function () {
    return view('admin/admin_add_plo');
});

Route::get('/profile', function () {
    return view('admin/admin_profile');
});

Route::get('/add-sections', function () {
    return view('admin/admin_add_sections');
});

Route::get('/new-term', function () {
    return view('admin/admin_add_new_term');
});

Route::get('/new-term-details', function () {
    return view('admin/admin_new_term_details');
});

Route::get('/l-dashboard', function () {
    return view('lecturer/l_dashboard');
});

Route::get('/manage-assessments', function () {
    return view('lecturer/cl_manage_assessments');
});

Route::get('/add-student-marks', function () {
    return view('lecturer/l_add_marks');
});

Route::get('/add-clo', function () {
    return view('lecturer/cl_add_clo');
});

Route::get('/view-students', function () {
    return view('lecturer/l_view_students');
});

Route::get('/guest-dashboard', function () {
    return view('guest/guest_dashboard');
});

