<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
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

Route::get('/l-dashboard', function () {
    return view('lecturer/l_dashboard');
});

Route::get('/guest-dashboard', function () {
    return view('guest/guest_dashboard');
});