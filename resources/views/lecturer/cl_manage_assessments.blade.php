@extends('layouts.lecturer')

@section('title', 'Assessment Management - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Custom Tailwind Configuration to match original CSS variables
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3498db',
                    'secondary': '#2c3e50',
                    'accent': '#e74c3c',
                    'light': '#ecf0f1',
                    'success': '#2ecc71',
                    'warning': '#f39c12',
                    'dark': '#34495e',
                    'gray-bg': '#f5f7fa',
                    'nav-bg-start': '#2c3e50',
                    'nav-bg-end': '#34495e',
                    
                    // Custom Assessment Colors
                    'quiz': '#3498db',
                    'practical': '#1abc9c',
                    'assignment': '#f39c12',
                    'presentation': '#e67e22',
                    'casestudy': '#9b59b6',
                    'midexam': '#e74c3c',
                    'finalexam': '#c0392b',
                    
                    // PLO Colors
                    'plo1': '#3498db',
                    'plo2': '#2ecc71',
                    'plo3': '#f39c12',
                    'plo4': '#9b59b6',
                    'plo5': '#e74c3c',
                    'plo6': '#1abc9c',
                    'plo7': '#34495e',
                    'plo8': '#95a5a6',
                },
                spacing: {
                    '128': '32rem',
                }
            }
        }
    }
</script>

<div class="header">
    <h1 class="text-3xl font-bold text-gray-800">Assessment Management</h1>
    <div class="user-info">
        <div>
            <h3 class="text-sm font-semibold m-0">Dr. Admin User</h3>
            <p class="text-xs text-gray-500 m-0">System Administrator</p>
        </div>
        <img src="https://i.pravatar.cc/150?img=8" alt="User Avatar" class="w-12 h-12 rounded-full object-cover ring-4 ring-teal-500 ring-offset-2">
    </div>
</div>

<div class="breadcrumb flex items-center gap-2 mb-8 bg-white p-4 rounded-xl shadow-md text-gray-500 text-sm">
    <a href="#" class="text-primary hover:underline"><i class="fas fa-home"></i> Dashboard</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Assessment Management</span>
</div>

<div class="course-selection bg-white rounded-2xl p-6 shadow-lg mb-8">
    <div class="form-group">
        <label for="courseSelect" class="block mb-2 text-secondary font-medium">Select Course</label>
        <select id="courseSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            <option value="">-- Select a Course --</option>
            <option value="CS101" selected>CS101 - Introduction to Programming</option>
            <option value="CS201">CS201 - Data Structures</option>
            <option value="CS301">CS301 - Algorithms</option>
            <option value="EE101">EE101 - Circuit Analysis</option>
        </select>
    </div>
</div>

<div class="assessment-types flex flex-col gap-6 mb-8">
    
    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-quiz hover:translate-y-[-2px] hover:shadow-xl quiz">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-pencil-alt text-2xl text-quiz"></i>
                <h3 class="text-secondary font-bold text-xl">Quiz</h3>
            </div>
            <span class="assessment-status bg-green-100 text-success px-3 py-1 rounded-full text-xs font-semibold">Active</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            Short assessments conducted multiple times throughout the course. You can add multiple quiz items with different marks and weightage.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Multiple Items</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">Unlimited</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Total Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">15%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Items Added</span>
                <span class="detail-value font-semibold text-secondary text-sm">3</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Quiz Items</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" data-type="quiz">
                    <i class="fas fa-plus mr-1"></i> Add Quiz
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b border-gray-100 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Quiz 1</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO1</span>
                                <span class="text-xs">→</span>
                                <span>PLO1</span>
                            </span>
                            <span class="clo-plo-badge bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO1</span>
                                <span class="text-xs">→</span>
                                <span>PLO2</span>
                            </span>
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO1</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">5%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="quiz">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b border-gray-100 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Quiz 2</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO1</span>
                                <span class="text-xs">→</span>
                                <span>PLO1</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">5%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="quiz">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b-0 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Quiz 3</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO2</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">5%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="quiz">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-practical hover:translate-y-[-2px] hover:shadow-xl practical">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-flask text-2xl text-practical"></i>
                <h3 class="text-secondary font-bold text-xl">Practical Test</h3>
            </div>
            <span class="assessment-status bg-green-100 text-success px-3 py-1 rounded-full text-xs font-semibold">Active</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            Hands-on practical assessments to test application of knowledge. You can add multiple practical test items.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Multiple Items</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">Unlimited</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Total Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">20%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Items Added</span>
                <span class="detail-value font-semibold text-secondary text-sm">2</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Practical Items</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" data-type="practical">
                    <i class="fas fa-plus mr-1"></i> Add Practical
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b border-gray-100 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Lab Test 1</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO5</span>
                            </span>
                            <span class="clo-plo-badge bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO3</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">10%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="practical">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b-0 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Lab Test 2</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO3</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">10%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="practical">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-assignment hover:translate-y-[-2px] hover:shadow-xl assignment">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-tasks text-2xl text-assignment"></i>
                <h3 class="text-secondary font-bold text-xl">Assignment</h3>
            </div>
            <span class="assessment-status bg-green-100 text-success px-3 py-1 rounded-full text-xs font-semibold">Active</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            Practical tasks that students complete individually or in groups. You can add multiple assignment items throughout the course.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Multiple Items</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">Unlimited</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Total Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">15%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Items Added</span>
                <span class="detail-value font-semibold text-secondary text-sm">1</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Assignment Items</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" data-type="assignment">
                    <i class="fas fa-plus mr-1"></i> Add Assignment
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b-0 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Assignment 1</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO2</span>
                            </span>
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                            <span class="clo-plo-badge bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO4</span>
                                <span class="text-xs">→</span>
                                <span>PLO4</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">15%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm edit-item" data-type="assignment">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger bg-accent text-white px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#c0392b] btn-sm delete-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-casestudy hover:translate-y-[-2px] hover:shadow-xl casestudy">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-briefcase text-2xl text-casestudy"></i>
                <h3 class="text-secondary font-bold text-xl">Case Study</h3>
            </div>
            <span class="assessment-status bg-red-100 text-accent px-3 py-1 rounded-full text-xs font-semibold">Not Added</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            In-depth analysis of real-world scenarios. You can add multiple case study items.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Multiple Items</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">Unlimited</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">10%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Items Added</span>
                <span class="detail-value font-semibold text-secondary text-sm">0</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Case Study Items</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" id="addCaseStudyBtn" data-type="casestudy">
                    <i class="fas fa-plus mr-1"></i> Add Case Study
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-center p-5 text-gray-500 text-sm">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span>No case studies added yet</span>
                </div>
            </div>
        </div>
    </div>

    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-midexam hover:translate-y-[-2px] hover:shadow-xl mid-exam">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-file-alt text-2xl text-midexam"></i>
                <h3 class="text-secondary font-bold text-xl">Mid-Semester Exam</h3>
            </div>
            <span class="assessment-status bg-green-100 text-success px-3 py-1 rounded-full text-xs font-semibold">Active</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            Mid-semester examination conducted halfway through the course. Only one mid-exam can be added per course.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Single Item</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">1</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">20%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Status</span>
                <span class="detail-value font-semibold text-secondary text-sm">Added</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Mid-Exam</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] edit-item-single" id="editMidExamBtn" data-type="midexam">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-between gap-2 p-2 border-b-0 sm:flex-col sm:items-start lg:flex-row">
                    <div class="item-name flex-1 font-medium text-sm flex justify-start items-center w-full lg:w-auto">
                        <span>Mid-Semester Examination</span>
                        <div class="item-clo-plos flex flex-wrap gap-1 ml-4 max-w-xs">
                            <span class="clo-plo-badge bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO1</span>
                                <span class="text-xs">→</span>
                                <span>PLO1</span>
                            </span>
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO2</span>
                            </span>
                            <span class="clo-plo-badge bg-green-100 text-green-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO2</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                            <span class="clo-plo-badge bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full text-[0.65rem] font-medium flex items-center gap-1">
                                <span>CLO3</span>
                                <span class="text-xs">→</span>
                                <span>PLO3</span>
                            </span>
                        </div>
                    </div>
                    <div class="item-marks w-12 text-center font-semibold text-secondary text-sm">20%</div>
                    <div class="item-actions flex gap-1 sm:w-full sm:justify-end lg:w-auto">
                        <button class="btn btn-outline border border-primary text-primary px-2 py-1 text-xs rounded-lg transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] btn-sm view-item">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-finalexam hover:translate-y-[-2px] hover:shadow-xl final-exam">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-file-contract text-2xl text-finalexam"></i>
                <h3 class="text-secondary font-bold text-xl">End of Semester Exam</h3>
            </div>
            <span class="assessment-status bg-red-100 text-accent px-3 py-1 rounded-full text-xs font-semibold">Not Added</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            End-of-semester comprehensive examination. Only one final exam can be added per course.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Single Item</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">1</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">40%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Status</span>
                <span class="detail-value font-semibold text-secondary text-sm">Not Added</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Final Exam</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" id="addFinalExamBtn" data-type="finalexam">
                    <i class="fas fa-plus mr-1"></i> Add Final Exam
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-center p-5 text-gray-500 text-sm">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span>No final exam added yet</span>
                </div>
            </div>
        </div>
    </div>

    <div class="assessment-card bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 ease-in-out border-l-4 border-presentation hover:translate-y-[-2px] hover:shadow-xl presentation">
        <div class="assessment-header flex justify-between items-center mb-4">
            <div class="assessment-title flex items-center gap-3">
                <i class="fas fa-chalkboard-teacher text-2xl text-presentation"></i>
                <h3 class="text-secondary font-bold text-xl">Presentation</h3>
            </div>
            <span class="assessment-status bg-red-100 text-accent px-3 py-1 rounded-full text-xs font-semibold">Not Added</span>
        </div>
        <p class="assessment-description text-gray-500 text-sm mb-5 leading-relaxed">
            Student presentations to demonstrate understanding of course topics. You can add multiple presentation items.
        </p>
        <div class="assessment-details grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 mb-5 border-y border-gray-100 py-3">
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Type</span>
                <span class="detail-value font-semibold text-secondary text-sm">Multiple Items</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Max Count</span>
                <span class="detail-value font-semibold text-secondary text-sm">Unlimited</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Weightage</span>
                <span class="detail-value font-semibold text-secondary text-sm">10%</span>
            </div>
            <div class="detail flex flex-col">
                <span class="detail-label text-xs text-gray-500 mb-1">Items Added</span>
                <span class="detail-value font-semibold text-secondary text-sm">0</span>
            </div>
        </div>

        <div class="assessment-items mt-5">
            <div class="items-header flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h4 class="text-secondary font-semibold">Presentation Items</h4>
                <button class="btn btn-primary bg-primary text-white px-3 py-1 text-xs rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px] add-item-btn" id="addPresentationBtn" data-type="presentation">
                    <i class="fas fa-plus mr-1"></i> Add Presentation
                </button>
            </div>
            <div class="items-list max-h-40 overflow-y-auto border border-gray-100 rounded-lg p-2">
                <div class="item-row flex items-center justify-center p-5 text-gray-500 text-sm">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span>No presentations added yet</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="action-buttons flex justify-end gap-4 mt-7">
    <button class="btn btn-outline border border-primary text-primary px-5 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] hover:translate-y-[-2px]">
        <i class="fas fa-sync-alt mr-2"></i> Reset Changes
    </button>
    <button class="btn btn-success bg-success text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#27ae60] hover:translate-y-[-2px]">
        <i class="fas fa-save mr-2"></i> Save All Assessments
    </button>
</div>

<div class="modal hidden fixed top-0 left-0 w-full h-full bg-black/50 z-[1000] justify-center items-center" id="addAssessmentModal">
    <div class="modal-content bg-white p-6 rounded-xl w-[700px] max-w-[90%] shadow-lg max-h-[90vh] overflow-y-auto">
        <div class="modal-header flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
            <h3 id="modalTitle" class="text-secondary font-semibold text-xl">Add New Assessment</h3>
            <span class="close text-2xl text-gray-500 cursor-pointer hover:text-accent">&times;</span>
        </div>
        <form id="assessmentForm">
            <input type="hidden" id="assessmentItemId">
            
            <!-- CLO-PLO Mapping Tabs -->
            <div class="clo-plo-mapping mb-6">
                <div class="tabs flex border-b border-gray-200 mb-4">
                    <button type="button" class="tab-btn active px-4 py-2 font-medium text-primary border-b-2 border-primary" data-tab="clo-tab">Select CLOs</button>
                    <button type="button" class="tab-btn px-4 py-2 font-medium text-gray-500 hover:text-primary" data-tab="plo-tab">Map to PLOs</button>
                </div>
                
                <!-- CLO Selection Tab -->
                <div id="clo-tab" class="tab-content active">
                    <div class="form-group mb-4">
                        <label for="assessmentName" class="block mb-2 text-secondary font-medium">Assessment Name</label>
                        <input type="text" id="assessmentName" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Enter assessment name" required>
                    </div>
                    
                    <div class="form-row flex gap-4 mb-4 sm:flex-col lg:flex-row">
                        <div class="form-group flex-1">
                            <label for="assessmentMarks" class="block mb-2 text-secondary font-medium">Total Marks</label>
                            <input type="number" id="assessmentMarks" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Enter total marks" min="1" required>
                        </div>
                        <div class="form-group flex-1">
                            <label for="assessmentWeight" class="block mb-2 text-secondary font-medium">Weightage (%)</label>
                            <input type="number" id="assessmentWeight" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Enter weightage" min="1" max="100" required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="assessmentDescription" class="block mb-2 text-secondary font-medium">Description</label>
                        <textarea id="assessmentDescription" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" rows="3" placeholder="Enter assessment description"></textarea>
                    </div>
                    
                    <div class="form-row flex gap-4 mb-4 sm:flex-col lg:flex-row">
                        <div class="form-group flex-1">
                            <label for="assessmentDueDate" class="block mb-2 text-secondary font-medium">Due Date</label>
                            <input type="date" id="assessmentDueDate" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div class="form-group flex-1">
                            <label for="assessmentType" class="block mb-2 text-secondary font-medium">Assessment Type</label>
                            <select id="assessmentType" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" required>
                                <option value="quiz">Quiz</option>
                                <option value="practical">Practical Test</option>
                                <option value="assignment">Assignment</option>
                                <option value="casestudy">Case Study</option>
                                <option value="presentation">Presentation</option>
                                <option value="midexam">Mid-Semester Exam</option>
                                <option value="finalexam">End of Semester Exam</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="block mb-2 text-secondary font-medium">Select CLOs for this Assessment</label>
                        <div class="clo-selection">
                            <div class="clo-grid grid gap-3 mt-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5" id="clo-grid">
                                <!-- CLO items will be dynamically generated here -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="next-step-btn flex justify-end">
                        <button type="button" class="btn btn-primary bg-primary text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] hover:translate-y-[-2px]" id="nextToPloBtn">
                            Next: Map to PLOs <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- PLO Mapping Tab -->
                <div id="plo-tab" class="tab-content hidden">
                    <div class="form-group mb-6">
                        <label class="block mb-4 text-secondary font-medium text-lg">Map Selected CLOs to PLOs</label>
                        <p class="text-gray-500 text-sm mb-4">For each CLO, select which PLOs it maps to. You can map one CLO to multiple PLOs.</p>
                        
                        <!-- CLO-PLO Mapping Container -->
                        <div id="clo-plo-mapping-container" class="space-y-4">
                            <!-- Dynamic CLO-PLO mapping items will be generated here -->
                        </div>
                        
                        <!-- Selected CLO-PLO Pairs Preview -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <label class="block mb-3 text-secondary font-medium">Selected CLO-PLO Pairs:</label>
                            <div id="clo-plo-preview" class="bg-gray-50 p-3 rounded-lg min-h-[60px] border border-gray-200">
                                <p class="text-gray-500 text-sm text-center py-4">No CLO-PLO pairs selected yet</p>
                            </div>
                            <p class="text-gray-500 text-xs mt-2">These CLO-PLO pairs will be displayed as individual badges for the assessment.</p>
                        </div>
                    </div>
                    
                    <div class="navigation-buttons flex justify-between">
                        <button type="button" class="btn btn-outline border border-primary text-primary px-4 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] hover:translate-y-[-2px]" id="backToCloBtn">
                            <i class="fas fa-arrow-left mr-2"></i> Back to CLOs
                        </button>
                        <button type="submit" class="btn btn-success bg-success text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#27ae60] hover:translate-y-[-2px]" id="submitAssessment">
                            Add Assessment
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal hidden fixed top-0 left-0 w-full h-full bg-black/50 z-[1000] justify-center items-center" id="deleteConfirmationModal">
    <div class="modal-content bg-white p-6 rounded-xl w-[400px] max-w-[90%] shadow-lg">
        <div class="modal-header flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
            <h3 class="text-secondary font-semibold text-xl text-accent"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Deletion</h3>
            <span class="close-delete text-2xl text-gray-500 cursor-pointer hover:text-accent">&times;</span>
        </div>
        <p class="text-gray-700 mb-6">Are you sure you want to delete the assessment item: <strong id="deleteItemName"></strong>? This action cannot be undone.</p>
        <div class="modal-footer flex justify-end gap-3 pt-4 border-t border-gray-100">
            <button type="button" class="btn btn-outline border border-primary text-primary px-4 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] close-delete">Cancel</button>
            <button type="button" class="btn btn-danger bg-accent text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#c0392b]" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>
</div>

<script>
    // Sample CLO data
    const clos = [
        { id: 'clo1', code: 'CLO1', description: 'Explain fundamental programming concepts' },
        { id: 'clo2', code: 'CLO2', description: 'Design and implement algorithms' },
        { id: 'clo3', code: 'CLO3', description: 'Apply debugging techniques' },
        { id: 'clo4', code: 'CLO4', description: 'Demonstrate understanding of data structures' },
        { id: 'clo5', code: 'CLO5', description: 'Analyze algorithm complexity' }
    ];
    
    // Sample PLO data
    const plos = [
        { id: 'plo1', code: 'PLO1', description: 'Engineering Knowledge', color: 'blue' },
        { id: 'plo2', code: 'PLO2', description: 'Problem Analysis', color: 'green' },
        { id: 'plo3', code: 'PLO3', description: 'Design/Development of Solutions', color: 'yellow' },
        { id: 'plo4', code: 'PLO4', description: 'Investigation', color: 'purple' },
        { id: 'plo5', code: 'PLO5', description: 'Modern Tool Usage', color: 'red' },
        { id: 'plo6', code: 'PLO6', description: 'The Engineer and Society', color: 'teal' },
        { id: 'plo7', code: 'PLO7', description: 'Environment and Sustainability', color: 'gray' },
        { id: 'plo8', code: 'PLO8', description: 'Ethics', color: 'indigo' }
    ];
    
    // Sample CLO-PLO mapping (which CLOs map to which PLOs)
    const cloPloMapping = {
        'clo1': ['plo1', 'plo2'],
        'clo2': ['plo2', 'plo3', 'plo5'],
        'clo3': ['plo3', 'plo6'],
        'clo4': ['plo4', 'plo7'],
        'clo5': ['plo5', 'plo8']
    };
    
    // Data for simulating item details
    const itemDetails = {
        'Quiz 1': { 
            name: 'Quiz 1', 
            marks: 10, 
            weight: 5, 
            description: 'Short quiz covering basic syntax.', 
            type: 'quiz', 
            clos: ['clo1', 'clo2'],
            ploMapping: {
                'clo1': ['plo1', 'plo2'],
                'clo2': ['plo2']
            }
        },
        'Lab Test 1': { 
            name: 'Lab Test 1', 
            marks: 50, 
            weight: 10, 
            description: 'Practical implementation of arrays.', 
            type: 'practical', 
            clos: ['clo2', 'clo3'],
            ploMapping: {
                'clo2': ['plo3', 'plo5'],
                'clo3': ['plo3']
            }
        },
        'Assignment 1': { 
            name: 'Assignment 1', 
            marks: 100, 
            weight: 15, 
            description: 'Project: Build a simple calculator.', 
            type: 'assignment', 
            clos: ['clo2', 'clo4'],
            ploMapping: {
                'clo2': ['plo2', 'plo3'],
                'clo4': ['plo4']
            }
        },
        'Mid-Semester Examination': { 
            name: 'Mid-Semester Examination', 
            marks: 100, 
            weight: 20, 
            description: 'Comprehensive mid-semester examination covering all topics from weeks 1-6.', 
            type: 'midexam', 
            clos: ['clo1', 'clo2', 'clo3'],
            ploMapping: {
                'clo1': ['plo1'],
                'clo2': ['plo2', 'plo3'],
                'clo3': ['plo3']
            }
        }
    };

    // Modal DOM Elements
    const addAssessmentModal = document.getElementById('addAssessmentModal');
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const closeModalBtns = document.querySelectorAll('.close, .close-modal');
    const closeDeleteBtns = document.querySelectorAll('.close-delete');
    const assessmentForm = document.getElementById('assessmentForm');
    const modalTitle = document.getElementById('modalTitle');
    const cloGrid = document.getElementById('clo-grid');
    const cloPloMappingContainer = document.getElementById('clo-plo-mapping-container');
    const cloPloPreview = document.getElementById('clo-plo-preview');
    const deleteItemName = document.getElementById('deleteItemName');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const submitAssessmentBtn = document.getElementById('submitAssessment');
    const nextToPloBtn = document.getElementById('nextToPloBtn');
    const backToCloBtn = document.getElementById('backToCloBtn');
    
    // Tab switching functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    let selectedClos = [];
    let cloPloPairs = [];
    let itemToDelete = null;

    // Initialize CLO grid display in modal
    function initializeCloGrid() {
        cloGrid.innerHTML = '';
        clos.forEach(clo => {
            const cloItem = document.createElement('div');
            cloItem.className = 'clo-item flex items-center gap-2 p-2 border border-gray-300 rounded-lg cursor-pointer transition-all duration-300 ease-in-out hover:border-primary hover:bg-[#e8f4fc]';
            cloItem.dataset.cloId = clo.id;
            
            cloItem.innerHTML = `
                <div class="clo-checkbox w-[18px] h-[18px] rounded-md border-2 border-gray-300 flex items-center justify-center transition-all duration-300 ease-in-out"></div>
                <div class="clo-info flex-1">
                    <h4 class="text-secondary text-sm font-medium">${clo.code}</h4>
                    <p class="text-gray-500 text-xs">${clo.description}</p>
                </div>
            `;
            
            cloItem.addEventListener('click', function() {
                const cloId = this.dataset.cloId;
                const isSelected = this.classList.contains('selected');
                
                if (!isSelected) {
                    this.classList.add('selected');
                    selectedClos.push(cloId);
                } else {
                    this.classList.remove('selected');
                    selectedClos = selectedClos.filter(id => id !== cloId);
                }
                
                // Apply/Remove Tailwind classes for selected state
                const checkbox = this.querySelector('.clo-checkbox');
                if (this.classList.contains('selected')) {
                    this.classList.add('border-primary', 'bg-[#e8f4fc]');
                    checkbox.classList.add('bg-primary', 'border-primary');
                    checkbox.innerHTML = `<i class="fas fa-check text-white text-[12px]"></i>`;
                } else {
                    this.classList.remove('border-primary', 'bg-[#e8f4fc]');
                    checkbox.classList.remove('bg-primary', 'border-primary');
                    checkbox.innerHTML = '';
                }
            });
            
            cloGrid.appendChild(cloItem);
        });
    }
    
    // Initialize CLO-PLO mapping interface
    function initializeCloPloMapping() {
        cloPloMappingContainer.innerHTML = '';
        cloPloPairs = [];
        updateCloPloPreview();
        
        // Only show mapping for selected CLOs
        selectedClos.forEach(cloId => {
            const clo = clos.find(c => c.id === cloId);
            if (!clo) return;
            
            const mappingItem = document.createElement('div');
            mappingItem.className = 'clo-plo-mapping-item p-4 border border-gray-200 rounded-lg bg-gray-50';
            mappingItem.dataset.cloId = cloId;
            
            const availablePlos = cloPloMapping[cloId] || [];
            
            mappingItem.innerHTML = `
                <div class="clo-header mb-3">
                    <h4 class="text-secondary font-semibold text-sm flex items-center">
                        <span class="clo-badge bg-light text-secondary px-3 py-1 rounded-full text-xs font-medium mr-2">${clo.code}</span>
                        ${clo.description}
                    </h4>
                </div>
                <div class="plo-selection">
                    <p class="text-gray-500 text-xs mb-2">Select PLOs for this CLO:</p>
                    <div class="plo-grid grid grid-cols-2 md:grid-cols-4 gap-2" id="plo-grid-${cloId}">
                        ${plos.map(plo => `
                            <div class="plo-item flex items-center gap-2 p-2 border border-gray-300 rounded-lg cursor-pointer transition-all duration-300 ease-in-out hover:border-${plo.color}-500 hover:bg-${plo.color}-50" data-clo-id="${cloId}" data-plo-id="${plo.id}">
                                <div class="plo-checkbox w-[16px] h-[16px] rounded-sm border-2 border-gray-300 flex items-center justify-center transition-all duration-300 ease-in-out"></div>
                                <div class="plo-info">
                                    <h4 class="text-secondary text-xs font-medium">${plo.code}</h4>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
            
            cloPloMappingContainer.appendChild(mappingItem);
            
            // Initialize PLO selection for this CLO
            setTimeout(() => {
                const ploItems = mappingItem.querySelectorAll('.plo-item');
                ploItems.forEach(ploItem => {
                    const cloId = ploItem.dataset.cloId;
                    const ploId = ploItem.dataset.ploId;
                    const plo = plos.find(p => p.id === ploId);
                    
                    ploItem.addEventListener('click', function() {
                        const isSelected = this.classList.contains('selected');
                        
                        if (!isSelected) {
                            // Add CLO-PLO pair
                            cloPloPairs.push({
                                cloId: cloId,
                                ploId: ploId,
                                cloCode: clos.find(c => c.id === cloId).code,
                                ploCode: plo.code,
                                ploColor: plo.color
                            });
                            this.classList.add('selected');
                        } else {
                            // Remove CLO-PLO pair
                            cloPloPairs = cloPloPairs.filter(pair => 
                                !(pair.cloId === cloId && pair.ploId === ploId)
                            );
                            this.classList.remove('selected');
                        }
                        
                        // Apply/Remove Tailwind classes for selected state
                        const checkbox = this.querySelector('.plo-checkbox');
                        if (this.classList.contains('selected')) {
                            this.classList.add(`border-${plo.color}-500`, `bg-${plo.color}-100`);
                            checkbox.classList.add(`bg-${plo.color}-500`, `border-${plo.color}-500`);
                            checkbox.innerHTML = `<i class="fas fa-check text-white text-[10px]"></i>`;
                        } else {
                            this.classList.remove(`border-${plo.color}-500`, `bg-${plo.color}-100`);
                            checkbox.classList.remove(`bg-${plo.color}-500`, `border-${plo.color}-500`);
                            checkbox.innerHTML = '';
                        }
                        
                        // Update preview
                        updateCloPloPreview();
                    });
                });
            }, 100);
        });
        
        if (selectedClos.length === 0) {
            cloPloMappingContainer.innerHTML = `
                <div class="text-center p-8 text-gray-500">
                    <i class="fas fa-info-circle text-2xl mb-2"></i>
                    <p>Please select at least one CLO in the previous step.</p>
                </div>
            `;
        }
    }
    
    // Update CLO-PLO pairs preview
    function updateCloPloPreview() {
        cloPloPreview.innerHTML = '';
        
        if (cloPloPairs.length === 0) {
            cloPloPreview.innerHTML = '<p class="text-gray-500 text-sm text-center py-4">No CLO-PLO pairs selected yet</p>';
            return;
        }
        
        const pairsContainer = document.createElement('div');
        pairsContainer.className = 'flex flex-wrap gap-2';
        
        cloPloPairs.forEach(pair => {
            const pairBadge = document.createElement('span');
            pairBadge.className = `clo-plo-preview-badge bg-${pair.ploColor}-100 text-${pair.ploColor}-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1`;
            pairBadge.innerHTML = `
                <span>${pair.cloCode}</span>
                <span class="text-xs">→</span>
                <span>${pair.ploCode}</span>
            `;
            pairsContainer.appendChild(pairBadge);
        });
        
        cloPloPreview.appendChild(pairsContainer);
    }
    
    // Get selected PLOs for each CLO
    function getSelectedPloMapping() {
        const mapping = {};
        
        selectedClos.forEach(cloId => {
            const selectedPlosForClo = cloPloPairs
                .filter(pair => pair.cloId === cloId)
                .map(pair => pair.ploId);
            mapping[cloId] = selectedPlosForClo;
        });
        
        return mapping;
    }
    
    // Tab switching
    function switchTab(tabName) {
        // Update tab buttons
        tabBtns.forEach(btn => {
            if (btn.dataset.tab === tabName) {
                btn.classList.add('active', 'text-primary', 'border-primary');
                btn.classList.remove('text-gray-500');
            } else {
                btn.classList.remove('active', 'text-primary', 'border-primary');
                btn.classList.add('text-gray-500');
            }
        });
        
        // Update tab content
        tabContents.forEach(content => {
            if (content.id === tabName) {
                content.classList.remove('hidden');
                content.classList.add('active');
            } else {
                content.classList.add('hidden');
                content.classList.remove('active');
            }
        });
    }
    
    // Function to open the Edit/Add Modal
    function openAssessmentModal(title, isEdit = false, itemData = {}) {
        modalTitle.textContent = title;
        assessmentForm.reset();
        selectedClos = [];
        cloPloPairs = [];
        initializeCloGrid();
        
        // Reset tabs to CLO selection
        switchTab('clo-tab');
        
        // Set button text
        submitAssessmentBtn.textContent = isEdit ? 'Save Changes' : 'Add Assessment';
        
        if (isEdit && itemData) {
            document.getElementById('assessmentItemId').value = itemData.name;
            document.getElementById('assessmentName').value = itemData.name;
            document.getElementById('assessmentMarks').value = itemData.marks;
            document.getElementById('assessmentWeight').value = itemData.weight;
            document.getElementById('assessmentDescription').value = itemData.description;
            document.getElementById('assessmentType').value = itemData.type;
            
            // Select existing CLOs
            if (itemData.clos) {
                itemData.clos.forEach(cloId => {
                    const item = cloGrid.querySelector(`[data-clo-id="${cloId}"]`);
                    if (item) {
                        item.click(); // Programmatically click to select
                        selectedClos.push(cloId);
                    }
                });
                
                // If there's existing PLO mapping, initialize it
                if (itemData.ploMapping) {
                    // This will be applied when user switches to PLO tab
                }
            }
        } else {
            document.getElementById('assessmentItemId').value = '';
        }
        
        addAssessmentModal.style.display = 'flex';
    }

    // Global listeners for Add/Edit buttons
    document.querySelectorAll('.add-item-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            let title = `Add New ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            if (type.includes('exam')) {
                title = `Add ${type.split('exam')[0].toUpperCase().replace('MID', 'Mid-Semester').replace('FINAL', 'End of Semester')} Exam`;
            }
            openAssessmentModal(title, false);
            document.getElementById('assessmentType').value = type;
        });
    });

    document.querySelectorAll('.edit-item, .edit-item-single').forEach(btn => {
        btn.addEventListener('click', function() {
            // Get item name from the corresponding row
            const itemRow = this.closest('.item-row') || this.closest('.assessment-items').querySelector('.item-row');
            const itemName = itemRow.querySelector('.item-name span:first-child').textContent.trim();
            
            const itemData = itemDetails[itemName];
            
            openAssessmentModal(`Edit ${itemName}`, true, itemData);
        });
    });

    // Global listeners for Delete button
    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            itemToDelete = this.closest('.item-row');
            const itemName = itemToDelete.querySelector('.item-name span:first-child').textContent.trim();
            
            deleteItemName.textContent = itemName;
            deleteConfirmationModal.style.display = 'flex';
        });
    });

    // Next to PLO button
    nextToPloBtn.addEventListener('click', function() {
        if (selectedClos.length === 0) {
            alert('Please select at least one CLO before proceeding.');
            return;
        }
        initializeCloPloMapping();
        switchTab('plo-tab');
    });

    // Back to CLO button
    backToCloBtn.addEventListener('click', function() {
        switchTab('clo-tab');
    });

    // Confirmation for Delete Modal
    confirmDeleteBtn.addEventListener('click', function() {
        if (itemToDelete) {
            const itemName = itemToDelete.querySelector('.item-name span:first-child').textContent.trim();
            itemToDelete.remove();
            deleteConfirmationModal.style.display = 'none';
            alert(`"${itemName}" deleted successfully!`);
            itemToDelete = null;
        }
    });

    // Tab button click handlers
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            if (tabName === 'plo-tab' && selectedClos.length === 0) {
                alert('Please select at least one CLO before mapping to PLOs.');
                return;
            }
            switchTab(tabName);
            if (tabName === 'plo-tab') {
                initializeCloPloMapping();
            }
        });
    });

    // Close Modals
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            addAssessmentModal.style.display = 'none';
        });
    });

    closeDeleteBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            deleteConfirmationModal.style.display = 'none';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === addAssessmentModal) {
            addAssessmentModal.style.display = 'none';
        }
        if (e.target === deleteConfirmationModal) {
            deleteConfirmationModal.style.display = 'none';
        }
    });

    // Form submission (Add/Edit)
    assessmentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const itemName = document.getElementById('assessmentName').value;
        const isEdit = document.getElementById('assessmentItemId').value !== '';
        
        // Validate that at least one CLO-PLO pair is selected
        if (cloPloPairs.length === 0) {
            alert('Please select at least one CLO-PLO mapping.');
            return;
        }
        
        const action = isEdit ? 'updated' : 'added';
        
        // Create success message with CLO-PLO pairs summary
        let summaryMessage = `Assessment "${itemName}" ${action} successfully!\n\nCLO-PLO Pairs:\n`;
        cloPloPairs.forEach(pair => {
            summaryMessage += `• ${pair.cloCode} → ${pair.ploCode}\n`;
        });
        
        alert(summaryMessage);
        addAssessmentModal.style.display = 'none';
        
        // In a real application, you would submit the form data to the server here
        // including: itemName, marks, weight, description, type, selectedClos, and cloPloPairs
    });

    // Initialize CLO grid on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeCloGrid();
        
        // Initialize tab switching
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                switchTab(tabName);
            });
        });
    });
</script>
@endsection