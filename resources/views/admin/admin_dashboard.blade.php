@extends('layouts.admin')

@section('title', 'Dashboard - EduManage')

@section('content')
<div class="header">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    <div class="user-info">
        <div>
            <h3 class="text-sm font-semibold m-0">Dr. Admin User</h3>
            <p class="text-xs text-gray-500 m-0">System Administrator</p>
        </div>
        <img src="https://i.pravatar.cc/150?img=8" alt="User Avatar" class="w-12 h-12 rounded-full object-cover ring-4 ring-teal-500 ring-offset-2">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-teal-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Students</p>
                <h3 class="text-2xl font-bold text-gray-800">2,847</h3>
            </div>
            <i class="fas fa-users text-teal-500 text-2xl"></i>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Courses</p>
                <h3 class="text-2xl font-bold text-gray-800">84</h3>
            </div>
            <i class="fas fa-book text-blue-500 text-2xl"></i>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Faculty Members</p>
                <h3 class="text-2xl font-bold text-gray-800">45</h3>
            </div>
            <i class="fas fa-chalkboard-teacher text-green-500 text-2xl"></i>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Departments</p>
                <h3 class="text-2xl font-bold text-gray-800">12</h3>
            </div>
            <i class="fas fa-building text-purple-500 text-2xl"></i>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Activity</h2>
    <div class="space-y-4">
        <div class="flex items-center p-3 bg-teal-50 rounded-lg">
            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-4">
                <i class="fas fa-plus text-teal-600"></i>
            </div>
            <div>
                <p class="font-medium">New course added</p>
                <p class="text-sm text-gray-500">"Advanced Machine Learning" was added to Computer Science</p>
            </div>
            <span class="ml-auto text-sm text-gray-500">2 hours ago</span>
        </div>
        
        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                <i class="fas fa-user-tie text-blue-600"></i>
            </div>
            <div>
                <p class="font-medium">Lecturer assigned</p>
                <p class="text-sm text-gray-500">Dr. Sarah Johnson assigned to Data Structures course</p>
            </div>
            <span class="ml-auto text-sm text-gray-500">5 hours ago</span>
        </div>
    </div>
</div>
@endsection