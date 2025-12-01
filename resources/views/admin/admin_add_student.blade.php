@extends('layouts.admin')

@section('title', 'Student Enrollment - EduManage')

@section('content')
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer base {
            :root {
                --primary: #14b8a6;
                --primary-light: #5eead4;
                --primary-dark: #0f766e;
                --secondary: #2c3e50;
                --success: #10b981;
                --warning: #f59e0b;
                --danger: #ef4444;
                --bg-main: #f0fdfa;
                --bg-sidebar: #0f766e;
                
                --info: #14b8a6;
                --purple: #9b59b6;
            }
        }

        @layer components {
            .header {
                @apply flex justify-between items-center bg-white p-6 rounded-2xl shadow-xl mb-8 border-2 border-teal-100 relative overflow-hidden;
                background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 100%);
            }

            .header::before {
                content: '';
                @apply absolute top-0 left-0 w-2 h-full;
                background: linear-gradient(180deg, #14b8a6 0%, #0d9488 100%);
            }

            .header h1 {
                @apply text-3xl font-bold mb-2 flex items-center text-gray-800;
            }

            .header h1 i {
                @apply text-4xl mr-3;
                background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .user-info {
                @apply flex items-center space-x-4;
            }

            .user-info img {
                @apply w-14 h-14 rounded-full object-cover shadow-lg;
                border: 3px solid #14b8a6;
                box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
            }

            .user-info h3 {
                @apply text-base font-bold mb-0;
                color: #14b8a6;
            }

            .user-info p {
                @apply text-sm text-gray-500 m-0;
            }

            .breadcrumb {
                @apply flex items-center gap-2 mb-6 bg-white p-4 rounded-xl shadow-md text-gray-500 text-sm;
            }

            .breadcrumb a {
                @apply text-teal-600 hover:underline;
            }

            .courses-grid {
                @apply grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4;
            }

            .course-card {
                @apply bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 border-l-4 border-teal-500 cursor-pointer hover:shadow-2xl hover:border-teal-600 transform hover:-translate-y-1;
            }

            .course-header {
                @apply flex justify-between items-start mb-4;
            }

            .course-info h3 {
                @apply text-lg font-bold mb-2 text-gray-800;
            }

            .course-info span {
                @apply px-3 py-1 rounded-lg text-xs font-semibold;
                background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
                color: #0f766e;
            }

            .badge {
                @apply px-3 py-1 rounded-full text-xs font-semibold shadow-sm;
            }

            .course-details {
                @apply mt-4;
            }

            .detail-item {
                @apply flex justify-between mb-2 pb-2 border-b border-gray-100 text-sm;
            }

            .detail-item span:first-child {
                @apply text-gray-500;
            }

            .detail-item span:last-child {
                @apply text-gray-800 font-medium;
            }

            .section-count {
                @apply flex items-center gap-2 mt-4 font-semibold text-sm;
                color: #14b8a6;
            }

            .section-management, .student-enrollment {
                @apply bg-white rounded-2xl p-6 shadow-xl mb-8 border-2 border-teal-100;
            }

            .section-header, .enrollment-header {
                @apply flex justify-between items-center mb-6 pb-4 border-b-2 border-gray-200;
            }

            .section-title, .enrollment-title {
                @apply flex items-center gap-3 text-gray-800;
            }

            .section-title i, .enrollment-title i {
                @apply text-3xl;
                color: #14b8a6;
            }

            .section-title h2, .enrollment-title h2 {
                @apply text-2xl font-bold;
            }

            .btn {
                @apply px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 cursor-pointer text-center shadow-md hover:shadow-xl;
            }

            .btn-primary {
                @apply text-white transform hover:-translate-y-0.5;
                background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            }

            .btn-outline {
                @apply bg-white border-2 text-teal-600 hover:bg-teal-50;
                border-color: #14b8a6;
            }

            .btn-success {
                @apply bg-gradient-to-r from-emerald-600 to-emerald-700 text-white hover:from-emerald-700 hover:to-emerald-800 transform hover:-translate-y-0.5;
            }

            .form-container {
                @apply grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8;
            }

            .form-card {
                @apply bg-white p-6 rounded-2xl border-2 border-teal-100 shadow-lg hover:shadow-xl transition-all duration-300;
                background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            }

            .form-card h3 {
                @apply text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2;
            }

            .form-card h3 i {
                color: #14b8a6;
            }

            .form-group {
                @apply mb-4;
            }

            .form-group label {
                @apply block mb-2 font-medium text-gray-700;
            }

            .form-control {
                @apply w-full p-3 border-2 border-gray-200 rounded-xl text-base transition-all duration-300 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200;
            }

            .sections-grid {
                @apply grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4;
            }

            .section-card {
                @apply bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 border-l-4 border-amber-500 hover:shadow-2xl transform hover:-translate-y-1;
            }

            .section-card-header {
                @apply flex justify-between items-start mb-4;
            }

            .section-info h3 {
                @apply text-lg font-bold mb-2 text-gray-800;
            }

            .student-count {
                @apply flex items-center gap-2 mt-2 font-semibold text-sm;
                color: #14b8a6;
            }

            .section-actions {
                @apply flex gap-3 mt-4;
            }

            .btn-sm {
                @apply px-3 py-2 text-sm;
            }

            .upload-area {
                @apply border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center mb-6 transition-all duration-300 bg-gray-50;
            }

            .upload-area:hover {
                @apply border-teal-500;
                background: linear-gradient(135deg, #f0fdfa 0%, #e6f9fb 100%);
            }

            .upload-icon {
                @apply text-6xl text-gray-400 mb-4;
            }

            .upload-text h3 {
                @apply text-xl font-bold mb-2 text-gray-800;
            }

            .upload-text p {
                @apply text-gray-500 mb-4;
            }

            .table-container {
                @apply overflow-x-auto mb-6 max-h-96 overflow-y-auto rounded-xl shadow-md border-2 border-gray-200;
            }

            .data-table {
                @apply w-full border-collapse;
            }

            .data-table thead tr {
                @apply sticky top-0 z-10;
                background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            }

            .data-table th {
                @apply p-4 text-left font-bold text-sm border-b-2 border-teal-200;
                color: #0f766e;
            }

            .data-table tbody tr {
                @apply hover:bg-teal-50 transition-colors duration-200;
            }

            .data-table td {
                @apply p-4 border-b border-gray-100 text-sm text-gray-700;
            }

            .action-buttons {
                @apply flex justify-end gap-4 mt-8;
            }

            footer {
                @apply text-center py-6 mt-8 text-sm text-gray-500;
            }
        }
    </style>

    <!-- Font Awesome CDN for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <div id="courses-list">
        <div class="header">
            <div>
                <h1>
                    <i class="fas fa-user-graduate"></i>
                    Student Enrollment Management
                </h1>
                <p class="text-gray-600">Manage student enrollment across courses and sections</p>
            </div>
            <div class="user-info">
                <img src="https://i.pravatar.cc/150?img=8" alt="User Avatar">
                <div>
                    <h3>Dr. Admin User</h3>
                    <p>System Administrator</p>
                </div>
            </div>
        </div>

        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>Student Enrollment</span>
        </div>

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Select a Course to Manage Sections</h2>
        
        <div class="courses-grid">
            <div class="course-card" data-course="CS101">
                <div class="course-header">
                    <div class="course-info">
                        <h3>Introduction to Programming</h3>
                        <span>CS101</span>
                    </div>
                    <span class="badge" style="background-color: #d1fae5; color: #065f46;">Active</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Fundamental concepts of programming and algorithm development.</p>
                <div class="course-details">
                    <div class="detail-item">
                        <span>Department:</span>
                        <span>Computer Science</span>
                    </div>
                    <div class="detail-item">
                        <span>Credit Hours:</span>
                        <span>3</span>
                    </div>
                    <div class="detail-item">
                        <span>Semester:</span>
                        <span>Fall 2023</span>
                    </div>
                </div>
                <div class="section-count">
                    <i class="fas fa-users"></i>
                    <span>3 Sections</span>
                </div>
            </div>

            <div class="course-card" data-course="CS201">
                <div class="course-header">
                    <div class="course-info">
                        <h3>Data Structures</h3>
                        <span>CS201</span>
                    </div>
                    <span class="badge" style="background-color: #d1fae5; color: #065f46;">Active</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Study of data organization, storage, and retrieval techniques.</p>
                <div class="course-details">
                    <div class="detail-item">
                        <span>Department:</span>
                        <span>Computer Science</span>
                    </div>
                    <div class="detail-item">
                        <span>Credit Hours:</span>
                        <span>3</span>
                    </div>
                    <div class="detail-item">
                        <span>Semester:</span>
                        <span>Fall 2023</span>
                    </div>
                </div>
                <div class="section-count">
                    <i class="fas fa-users"></i>
                    <span>2 Sections</span>
                </div>
            </div>

            <div class="course-card" data-course="CS301">
                <div class="course-header">
                    <div class="course-info">
                        <h3>Algorithms</h3>
                        <span>CS301</span>
                    </div>
                    <span class="badge" style="background-color: #d1fae5; color: #065f46;">Active</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Design and analysis of efficient algorithms for problem solving.</p>
                <div class="course-details">
                    <div class="detail-item">
                        <span>Department:</span>
                        <span>Computer Science</span>
                    </div>
                    <div class="detail-item">
                        <span>Credit Hours:</span>
                        <span>3</span>
                    </div>
                    <div class="detail-item">
                        <span>Semester:</span>
                        <span>Fall 2023</span>
                    </div>
                </div>
                <div class="section-count">
                    <i class="fas fa-users"></i>
                    <span>1 Section</span>
                </div>
            </div>

            <div class="course-card" data-course="EE101">
                <div class="course-header">
                    <div class="course-info">
                        <h3>Circuit Analysis</h3>
                        <span>EE101</span>
                    </div>
                    <span class="badge" style="background-color: #d1fae5; color: #065f46;">Active</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Fundamental principles of electrical circuits and analysis.</p>
                <div class="course-details">
                    <div class="detail-item">
                        <span>Department:</span>
                        <span>Electrical Engineering</span>
                    </div>
                    <div class="detail-item">
                        <span>Credit Hours:</span>
                        <span>4</span>
                    </div>
                    <div class="detail-item">
                        <span>Semester:</span>
                        <span>Fall 2023</span>
                    </div>
                </div>
                <div class="section-count">
                    <i class="fas fa-users"></i>
                    <span>0 Sections</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section-management hidden" id="section-management">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-users"></i>
                <h2>Section Management for <span id="course-name"></span></h2>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline" id="back-to-courses">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Courses
                </button>
                <button class="btn btn-primary" id="add-section-btn">
                    <i class="fas fa-plus mr-2"></i> Add New Section
                </button>
            </div>
        </div>

        <div class="form-container" id="add-section-form" style="display: none;">
            <div class="form-card">
                <h3><i class="fas fa-plus-circle"></i> Create New Section</h3>
                <form id="sectionForm">
                    <div class="form-group">
                        <label for="sectionCode">Section Code</label>
                        <input type="text" id="sectionCode" class="form-control" placeholder="e.g., A, B, C" required>
                    </div>
                    <div class="form-group">
                        <label for="sectionCapacity">Capacity</label>
                        <input type="number" id="sectionCapacity" class="form-control" value="40" min="1" max="100" required>
                        <small class="text-gray-500 mt-1 block">Maximum 40 students per section</small>
                    </div>
                    <div class="form-group">
                        <label for="sectionSchedule">Schedule</label>
                        <input type="text" id="sectionSchedule" class="form-control" placeholder="e.g., Mon-Wed-Fri 10:00 AM">
                    </div>
                    <div class="form-group">
                        <label for="sectionLocation">Location</label>
                        <input type="text" id="sectionLocation" class="form-control" placeholder="Classroom or Lab">
                    </div>
                    <button type="submit" class="btn btn-success w-full">
                        <i class="fas fa-save mr-2"></i> Create Section
                    </button>
                </form>
            </div>

            <div class="form-card">
                <h3><i class="fas fa-info-circle"></i> Section Information</h3>
                <p class="text-gray-600 text-sm mb-4">Each section can accommodate up to 40 students. You can create multiple sections for large courses.</p>
                
                <div class="p-4 rounded-xl mt-5" style="background: linear-gradient(135deg, #e0f7f9 0%, #b3ecf3 100%);">
                    <h4 class="font-bold mb-2" style="color: #0f766e;">Excel Upload Requirements</h4>
                    <p class="text-gray-600 text-sm mb-2">Your Excel file should contain the following columns:</p>
                    <ul class="text-gray-600 text-sm mt-2 pl-5 list-disc space-y-1">
                        <li>Student ID</li>
                        <li>Full Name</li>
                        <li>Email</li>
                        <li>Program</li>
                        <li>Year</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sections-grid" id="sections-grid"></div>

        <div class="action-buttons">
            <button class="btn btn-outline">
                <i class="fas fa-file-export mr-2"></i> Export Sections
            </button>
            <button class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Save All Changes
            </button>
        </div>
    </div>

    <div class="student-enrollment hidden" id="student-enrollment">
        <div class="enrollment-header">
            <div class="enrollment-title">
                <i class="fas fa-user-graduate"></i>
                <h2>Student Enrollment - <span id="section-name"></span></h2>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline" id="back-to-sections">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Sections
                </button>
                <button class="btn btn-primary" id="download-template">
                    <i class="fas fa-download mr-2"></i> Download Template
                </button>
            </div>
        </div>

        <div class="upload-area" id="upload-area">
            <div class="upload-icon">
                <i class="fas fa-file-excel"></i>
            </div>
            <div class="upload-text">
                <h3>Upload Student Excel File</h3>
                <p>Drag & drop your Excel file here or click to browse</p>
                <p class="text-sm text-gray-500">Supported format: .xlsx, .xls (Max 40 students per section)</p>
            </div>
            <input type="file" id="file-input" class="hidden" accept=".xlsx, .xls">
            <button class="btn btn-primary mt-4" id="browse-btn">
                <i class="fas fa-folder-open mr-2"></i> Browse Files
            </button>
        </div>

        <div class="student-list mt-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
                <i class="fas fa-list" style="color: #14b8a6;"></i> Enrolled Students
            </h3>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="student-table-body"></tbody>
                </table>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-outline">
                <i class="fas fa-sync-alt mr-2"></i> Reset
            </button>
            <button class="btn btn-success" id="confirm-enrollment">
                <i class="fas fa-check-circle mr-2"></i> Confirm Enrollment
            </button>
        </div>
    </div>


    <script>
        // Sample data
        const coursesData = {
            'CS101': {
                name: 'Introduction to Programming',
                sections: [
                    { code: 'A', capacity: 40, enrolled: 38, schedule: 'Mon-Wed-Fri 10:00 AM', location: 'Room 101' },
                    { code: 'B', capacity: 40, enrolled: 35, schedule: 'Tue-Thu 2:00 PM', location: 'Room 102' },
                    { code: 'C', capacity: 40, enrolled: 0, schedule: 'Mon-Wed 4:00 PM', location: 'Room 103' }
                ]
            },
            'CS201': {
                name: 'Data Structures',
                sections: [
                    { code: 'A', capacity: 40, enrolled: 40, schedule: 'Mon-Wed-Fri 9:00 AM', location: 'Lab 201' },
                    { code: 'B', capacity: 40, enrolled: 32, schedule: 'Tue-Thu 11:00 AM', location: 'Lab 202' }
                ]
            },
            'CS301': {
                name: 'Algorithms',
                sections: [
                    { code: 'A', capacity: 40, enrolled: 28, schedule: 'Mon-Wed 3:00 PM', location: 'Room 301' }
                ]
            },
            'EE101': {
                name: 'Circuit Analysis',
                sections: []
            }
        };

        // Sample student data
        const sampleStudents = [
            { id: 'S001', name: 'Alice Johnson', email: 'alice.johnson@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S002', name: 'Michael Brown', email: 'michael.brown@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S003', name: 'Sarah Williams', email: 'sarah.williams@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S004', name: 'David Miller', email: 'david.miller@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S005', name: 'Emily Davis', email: 'emily.davis@student.edu', program: 'Computer Science', year: '2' }
        ];

        // Current state
        let currentCourse = '';
        let currentSection = '';
        let currentStudents = [];

        // DOM Elements
        const coursesList = document.getElementById('courses-list');
        const sectionManagement = document.getElementById('section-management');
        const studentEnrollment = document.getElementById('student-enrollment');
        const backToCoursesBtn = document.getElementById('back-to-courses');
        const backToSectionsBtn = document.getElementById('back-to-sections');
        const addSectionBtn = document.getElementById('add-section-btn');
        const addSectionForm = document.getElementById('add-section-form');
        const sectionsGrid = document.getElementById('sections-grid');
        const courseNameSpan = document.getElementById('course-name');
        const sectionNameSpan = document.getElementById('section-name');
        const sectionForm = document.getElementById('sectionForm');
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('file-input');
        const browseBtn = document.getElementById('browse-btn');
        const studentTableBody = document.getElementById('student-table-body');
        const confirmEnrollmentBtn = document.getElementById('confirm-enrollment');
        const downloadTemplateBtn = document.getElementById('download-template');

        // Helper function to show/hide elements based on state
        function setView(showElement, hideElement1, hideElement2) {
            hideElement1.classList.add('hidden');
            hideElement2.classList.add('hidden');
            showElement.classList.remove('hidden');
        }

        // Load sections for a course
        function loadSectionsForCourse(courseCode) {
            currentCourse = courseCode;
            const course = coursesData[courseCode];
            courseNameSpan.textContent = `${courseCode} - ${course.name}`;
            
            // Update breadcrumb
            document.querySelector('.breadcrumb span').innerHTML = `Section Management for ${courseCode}`;
            
            // Show section management (using hidden utility class equivalent to original display:none/block)
            setView(sectionManagement, coursesList, studentEnrollment);
            
            // Hide add section form when switching courses
            addSectionForm.style.display = 'none';

            // Render sections
            renderSections();
        }

        // Render sections grid
        function renderSections() {
            sectionsGrid.innerHTML = '';
            const sections = coursesData[currentCourse].sections;
            
            if (sections.length === 0) {
                sectionsGrid.innerHTML = `
                    <div class="col-span-full text-center p-10 text-gray-500">
                        <i class="fas fa-users text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-secondary">No Sections Created Yet</h3>
                        <p>Click "Add New Section" to create your first section for this course.</p>
                    </div>
                `;
                return;
            }
            
            sections.forEach(section => {
                const sectionCard = document.createElement('div');
                sectionCard.className = 'section-card bg-white rounded-xl p-5 shadow-md transition-all duration-300 ease-in-out border-l-4 border-warning hover:translate-y-[-3px] hover:shadow-lg';
                sectionCard.dataset.section = section.code;
                
                const enrollmentPercent = (section.enrolled / section.capacity) * 100;
                let statusColor, bgColor;
                if (enrollmentPercent >= 90) {
                    statusColor = 'text-accent'; 
                    bgColor = 'bg-[#fdedec]';
                } else if (enrollmentPercent >= 70) {
                    statusColor = 'text-warning';
                    bgColor = 'bg-[#fef5e6]';
                } else {
                    statusColor = 'text-success';
                    bgColor = 'bg-[#e8f6f3]';
                }
                
                sectionCard.innerHTML = `
                    <div class="section-card-header flex justify-between items-start mb-4">
                        <div class="section-info">
                            <h3 class="text-secondary font-semibold mb-1">Section ${section.code}</h3>
                            <div class="student-count flex items-center gap-1 mt-2 text-primary font-semibold text-sm">
                                <i class="fas fa-user-graduate"></i>
                                <span>${section.enrolled}/${section.capacity} students</span>
                            </div>
                        </div>
                        <div class="badge ${bgColor} ${statusColor} px-2 py-1 rounded-full text-xs font-semibold">
                            ${Math.round(enrollmentPercent)}% Full
                        </div>
                    </div>
                    <div class="course-details">
                        <div class="detail-item flex justify-between mb-2 pb-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-500">Schedule:</span>
                            <span class="text-secondary font-medium">${section.schedule}</span>
                        </div>
                        <div class="detail-item flex justify-between mb-2 pb-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-500">Location:</span>
                            <span class="text-secondary font-medium">${section.location}</span>
                        </div>
                    </div>
                    <div class="section-actions flex gap-3 mt-4">
                        <button class="btn btn-primary bg-primary text-white px-3 py-1 text-sm rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#2980b9] enroll-students-btn">
                            <i class="fas fa-user-plus mr-1"></i> Enroll Students
                        </button>
                        <button class="btn btn-outline border border-primary text-primary px-3 py-1 text-sm rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-[#e8f4fc] view-students-btn">
                            <i class="fas fa-eye mr-1"></i> View
                        </button>
                    </div>
                `;
                
                sectionsGrid.appendChild(sectionCard);
            });
            
            // Add event listeners to section buttons
            document.querySelectorAll('.enroll-students-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const sectionCode = this.closest('.section-card').dataset.section;
                    enrollStudentsInSection(sectionCode);
                });
            });
            
            document.querySelectorAll('.view-students-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const sectionCode = this.closest('.section-card').dataset.section;
                    viewStudentsInSection(sectionCode);
                });
            });
        }

        // Enroll students in a section
        function enrollStudentsInSection(sectionCode) {
            currentSection = sectionCode;
            sectionNameSpan.textContent = `Section ${sectionCode} - ${currentCourse}`;
            
            // Update breadcrumb
            document.querySelector('.breadcrumb span').innerHTML = `Student Enrollment - ${currentCourse} Section ${sectionCode}`;
            
            // Show student enrollment
            setView(studentEnrollment, sectionManagement, coursesList);

            // Load sample students for demonstration
            // This is meant to simulate loading a fresh or partial list for enrollment upload
            currentStudents = [...sampleStudents.slice(0, 5)]; 
            
            renderStudentTable();
        }

        // View students in a section
        function viewStudentsInSection(sectionCode) {
            currentSection = sectionCode;
            sectionNameSpan.textContent = `Section ${sectionCode} - ${currentCourse}`;
            
            // Update breadcrumb
            document.querySelector('.breadcrumb span').innerHTML = `Student Enrollment - ${currentCourse} Section ${sectionCode}`;
            
            // Show student enrollment
            setView(studentEnrollment, sectionManagement, coursesList);
            
            // Get enrolled students count for this section
            const section = coursesData[currentCourse].sections.find(s => s.code === sectionCode);
            currentStudents = Array.from({length: section.enrolled}, (_, i) => ({
                id: `S${1000 + i}`,
                name: `Student ${i + 1}`,
                email: `student${i + 1}@student.edu`,
                program: 'Computer Science',
                year: '2'
            }));
            
            renderStudentTable();
        }

        // Render student table
        function renderStudentTable() {
            studentTableBody.innerHTML = '';
            
            if (currentStudents.length === 0) {
                studentTableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 p-10">
                            <i class="fas fa-user-graduate text-3xl mb-3 block"></i>
                            No students enrolled yet. Upload an Excel file to enroll students.
                        </td>
                    </tr>
                `;
                return;
            }
            
            currentStudents.forEach(student => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="p-3 border-b border-gray-100 text-sm">${student.id}</td>
                    <td class="p-3 border-b border-gray-100 text-sm">${student.name}</td>
                    <td class="p-3 border-b border-gray-100 text-sm">${student.email}</td>
                    <td class="p-3 border-b border-gray-100 text-sm">${student.program}</td>
                    <td class="p-3 border-b border-gray-100 text-sm">Year ${student.year}</td>
                    <td class="p-3 border-b border-gray-100 text-sm"><span class="badge bg-[#e8f6f3] text-success px-2 py-1 rounded-full text-xs font-semibold">Enrolled</span></td>
                `;
                studentTableBody.appendChild(row);
            });
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Course card click events
            document.querySelectorAll('.course-card').forEach(card => {
                card.addEventListener('click', function() {
                    const courseCode = this.dataset.course;
                    loadSectionsForCourse(courseCode);
                });
            });
            
            // Back to courses button
            backToCoursesBtn.addEventListener('click', function() {
                setView(coursesList, sectionManagement, studentEnrollment);
                document.querySelector('.breadcrumb span').textContent = 'Student Enrollment';
            });
            
            // Back to sections button
            backToSectionsBtn.addEventListener('click', function() {
                setView(sectionManagement, studentEnrollment, coursesList);
                document.querySelector('.breadcrumb span').innerHTML = `Section Management for ${currentCourse}`;
                renderSections(); // Re-render to show updated counts
            });
            
            // Add section button
            addSectionBtn.addEventListener('click', function() {
                // Tailwind utility for toggle display
                addSectionForm.style.display = addSectionForm.style.display === 'none' ? 'grid' : 'none';
            });
            
            // Section form submission
            sectionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const sectionCode = document.getElementById('sectionCode').value;
                const capacity = document.getElementById('sectionCapacity').value;
                const schedule = document.getElementById('sectionSchedule').value;
                const location = document.getElementById('sectionLocation').value;
                
                // Add new section to data
                coursesData[currentCourse].sections.push({
                    code: sectionCode,
                    capacity: parseInt(capacity),
                    enrolled: 0,
                    schedule: schedule,
                    location: location
                });
                
                // Re-render sections
                renderSections();
                
                // Reset form and hide it
                sectionForm.reset();
                addSectionForm.style.display = 'none';
                
                alert(`Section ${sectionCode} created successfully!`);
            });
            
            // File upload handling
            browseBtn.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    handleFileUpload(file);
                }
            });
            
            // Drag and Drop listeners
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('border-success', 'bg-[#e8f6f3]');
                this.querySelector('.upload-icon i').classList.add('text-success');
                this.classList.remove('border-gray-300', 'bg-gray-50');
                this.querySelector('.upload-icon i').classList.remove('text-gray-500');
            });
            
            uploadArea.addEventListener('dragleave', function() {
                this.classList.remove('border-success', 'bg-[#e8f6f3]');
                this.querySelector('.upload-icon i').classList.remove('text-success');
                this.classList.add('border-gray-300', 'bg-gray-50');
                this.querySelector('.upload-icon i').classList.add('text-gray-500');
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-success', 'bg-[#e8f6f3]');
                this.querySelector('.upload-icon i').classList.remove('text-success');
                this.classList.add('border-gray-300', 'bg-gray-50');
                this.querySelector('.upload-icon i').classList.add('text-gray-500');
                
                if (e.dataTransfer.files.length > 0) {
                    const file = e.dataTransfer.files[0];
                    handleFileUpload(file);
                }
            });
            
            // Confirm enrollment
            confirmEnrollmentBtn.addEventListener('click', function() {
                if (currentStudents.length === 0) {
                    alert('No students to enroll. Please upload an Excel file first.');
                    return;
                }
                
                // Update enrolled count in the section
                const section = coursesData[currentCourse].sections.find(s => s.code === currentSection);
                if (section) {
                    section.enrolled = currentStudents.length;
                }
                
                alert(`Successfully enrolled ${currentStudents.length} students in Section ${currentSection}!`);
                
                // Go back to sections
                setView(sectionManagement, studentEnrollment, coursesList);
                document.querySelector('.breadcrumb span').innerHTML = `Section Management for ${currentCourse}`;
                
                // Re-render sections to update counts
                renderSections();
            });
            
            // Download template
            downloadTemplateBtn.addEventListener('click', function() {
                alert('Excel template downloaded! The template includes columns for Student ID, Full Name, Email, Program, and Year.');
                // In a real application, this would trigger a file download
            });
        });

        // Handle file upload
        function handleFileUpload(file) {
            if (!file.name.match(/\.(xlsx|xls)$/)) {
                alert('Please upload a valid Excel file (.xlsx or .xls)');
                return;
            }
            
            // Simulate file processing
            const uploadIcon = uploadArea.querySelector('.upload-icon i');
            const uploadText = uploadArea.querySelector('.upload-text h3');
            
            uploadArea.classList.add('border-success', 'bg-[#e8f6f3]');
            uploadArea.classList.remove('border-gray-300', 'bg-gray-50');
            uploadIcon.className = 'fas fa-spinner fa-spin text-success';
            uploadText.textContent = 'Processing File...';
            
            setTimeout(() => {
                // Simulate successful processing
                uploadArea.classList.remove('border-success', 'bg-[#e8f6f3]');
                uploadArea.classList.add('border-gray-300', 'bg-gray-50');
                uploadIcon.className = 'fas fa-file-excel text-success';
                uploadText.textContent = 'File Uploaded Successfully!';
                
                // Add more sample students to simulate import
                const newStudents = Array.from({length: 35}, (_, i) => ({
                    id: `S${1006 + i}`,
                    name: `New Student ${i + 1}`,
                    email: `new.student${i + 1}@student.edu`,
                    program: 'Computer Science',
                    year: '2'
                }));
                
                currentStudents = [...sampleStudents.slice(0, 5), ...newStudents];
                renderStudentTable();
                
                alert(`Successfully imported ${newStudents.length} students from Excel file!`);
                
                // Reset upload area after a delay
                setTimeout(() => {
                    uploadIcon.className = 'fas fa-file-excel text-gray-500';
                    uploadText.textContent = 'Upload Student Excel File';
                }, 2000);
            }, 2000);
        }
    </script>
@endsection