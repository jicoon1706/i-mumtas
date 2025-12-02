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
                <button class="btn btn-primary" id="import-excel-btn">
                    <i class="fas fa-file-import mr-2"></i> Import Excel
                </button>
            </div>
        </div>

        <div class="student-selection-container">
            <!-- Available Students -->
            <div class="selection-card">
                <div class="selection-header">
                    <div class="selection-title">
                        <i class="fas fa-user-friends"></i>
                        <h3>Available Students</h3>
                    </div>
                    <div class="selected-count">
                        <span id="selected-count">0</span> selected
                    </div>
                </div>
                <div class="table-container" style="max-height: 400px;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="w-12"></th>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Program</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tbody id="available-students-table">
                            <!-- Students will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Showing <span id="available-count">0</span> available students
                    </div>
                    <button class="btn btn-outline btn-sm" id="select-all-btn">
                        <i class="fas fa-check-double mr-1"></i> Select All
                    </button>
                </div>
            </div>

            <!-- Selected Students -->
            <div class="selection-card">
                <div class="selection-header">
                    <div class="selection-title">
                        <i class="fas fa-check-circle"></i>
                        <h3>Selected Students</h3>
                    </div>
                    <div class="selected-count">
                        Capacity: <span id="section-capacity">40</span>
                    </div>
                </div>
                <div class="table-container" style="max-height: 400px;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th class="w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="selected-students-table">
                            <!-- Selected students will appear here -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    <span id="selected-total">0</span> students selected
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-outline" id="reset-selection">
                <i class="fas fa-sync-alt mr-2"></i> Reset Selection
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
                    { code: 'A', capacity: 40, enrolled: 38, schedule: 'Mon-Wed-Fri 10:00 AM', location: 'Room 101', students: [] },
                    { code: 'B', capacity: 40, enrolled: 35, schedule: 'Tue-Thu 2:00 PM', location: 'Room 102', students: [] },
                    { code: 'C', capacity: 40, enrolled: 0, schedule: 'Mon-Wed 4:00 PM', location: 'Room 103', students: [] }
                ]
            },
            'CS201': {
                name: 'Data Structures',
                sections: [
                    { code: 'A', capacity: 40, enrolled: 40, schedule: 'Mon-Wed-Fri 9:00 AM', location: 'Lab 201', students: [] },
                    { code: 'B', capacity: 40, enrolled: 32, schedule: 'Tue-Thu 11:00 AM', location: 'Lab 202', students: [] }
                ]
            },
            'CS301': {
                name: 'Algorithms',
                sections: [
                    { code: 'A', capacity: 40, enrolled: 28, schedule: 'Mon-Wed 3:00 PM', location: 'Room 301', students: [] }
                ]
            },
            'EE101': {
                name: 'Circuit Analysis',
                sections: []
            }
        };

        // Sample unenrolled students data (this would come from your database)
        const unenrolledStudents = [
            { id: 'S1001', name: 'John Smith', email: 'john.smith@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S1002', name: 'Emma Watson', email: 'emma.watson@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S1003', name: 'Michael Brown', email: 'michael.brown@student.edu', program: 'Computer Science', year: '3' },
            { id: 'S1004', name: 'Sarah Johnson', email: 'sarah.johnson@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S1005', name: 'David Wilson', email: 'david.wilson@student.edu', program: 'Computer Science', year: '3' },
            { id: 'S1006', name: 'Lisa Anderson', email: 'lisa.anderson@student.edu', program: 'Computer Science', year: '1' },
            { id: 'S1007', name: 'Robert Taylor', email: 'robert.taylor@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S1008', name: 'Jennifer Lee', email: 'jennifer.lee@student.edu', program: 'Computer Science', year: '3' },
            { id: 'S1009', name: 'Thomas Clark', email: 'thomas.clark@student.edu', program: 'Computer Science', year: '2' },
            { id: 'S1010', name: 'Maria Garcia', email: 'maria.garcia@student.edu', program: 'Computer Science', year: '1' }
        ];

        // Current state
        let currentCourse = '';
        let currentSection = '';
        let selectedStudents = new Set();
        let availableStudents = [...unenrolledStudents];

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
        const availableStudentsTable = document.getElementById('available-students-table');
        const selectedStudentsTable = document.getElementById('selected-students-table');
        const selectedCountSpan = document.getElementById('selected-count');
        const availableCountSpan = document.getElementById('available-count');
        const selectedTotalSpan = document.getElementById('selected-total');
        const sectionCapacitySpan = document.getElementById('section-capacity');
        const selectAllBtn = document.getElementById('select-all-btn');
        const resetSelectionBtn = document.getElementById('reset-selection');
        const confirmEnrollmentBtn = document.getElementById('confirm-enrollment');
        const importExcelBtn = document.getElementById('import-excel-btn');

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
            
            // Show section management
            setView(sectionManagement, coursesList, studentEnrollment);
            
            // Hide add section form when switching courses
            addSectionForm.style.display = 'none';

            // Render sections
            renderSections();
        }

        // Render sections grid with expandable student lists
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
                sectionCard.className = 'section-card';
                sectionCard.dataset.section = section.code;
                
                const enrollmentPercent = (section.enrolled / section.capacity) * 100;
                let statusColor, bgColor;
                if (enrollmentPercent >= 90) {
                    statusColor = 'text-red-500'; 
                    bgColor = 'bg-red-50';
                } else if (enrollmentPercent >= 70) {
                    statusColor = 'text-yellow-500';
                    bgColor = 'bg-yellow-50';
                } else {
                    statusColor = 'text-green-500';
                    bgColor = 'bg-green-50';
                }
                
                // Generate enrolled students list HTML
                let enrolledStudentsHTML = '';
                if (section.enrolled > 0) {
                    enrolledStudentsHTML = `
                        <div class="toggle-expand" onclick="toggleStudentList(this)">
                            <i class="fas fa-chevron-down"></i>
                            <span>Show ${section.enrolled} enrolled students</span>
                        </div>
                        <div class="expanded-student-list hidden">
                            ${section.students.map((student, index) => `
                                <div class="expanded-student-item">
                                    <div class="expanded-avatar">${student.name.charAt(0)}</div>
                                    <div>
                                        <div class="font-medium">${student.name}</div>
                                        <div class="text-xs text-gray-500">${student.id} • ${student.program}</div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `;
                }
                
                sectionCard.innerHTML = `
                    <div class="section-card-header">
                        <div class="section-info">
                            <h3>Section ${section.code}</h3>
                            <div class="student-count">
                                <i class="fas fa-user-graduate"></i>
                                <span>${section.enrolled}/${section.capacity} students</span>
                            </div>
                        </div>
                        <div class="badge ${bgColor} ${statusColor}">
                            ${Math.round(enrollmentPercent)}% Full
                        </div>
                    </div>
                    <div class="course-details">
                        <div class="detail-item">
                            <span>Schedule:</span>
                            <span>${section.schedule}</span>
                        </div>
                        <div class="detail-item">
                            <span>Location:</span>
                            <span>${section.location}</span>
                        </div>
                    </div>
                    ${enrolledStudentsHTML}
                    <div class="section-actions">
                        <button class="btn btn-primary btn-sm enroll-students-btn">
                            <i class="fas fa-user-plus mr-1"></i> Enroll Students
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

        // Toggle student list visibility
        window.toggleStudentList = function(element) {
            const studentList = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            if (studentList.classList.contains('hidden')) {
                studentList.classList.remove('hidden');
                icon.className = 'fas fa-chevron-up';
                element.querySelector('span').textContent = 'Hide enrolled students';
            } else {
                studentList.classList.add('hidden');
                icon.className = 'fas fa-chevron-down';
                element.querySelector('span').textContent = 'Show enrolled students';
            }
        };

        // Enroll students in a section
        function enrollStudentsInSection(sectionCode) {
            currentSection = sectionCode;
            sectionNameSpan.textContent = `Section ${sectionCode} - ${currentCourse}`;
            
            // Update breadcrumb
            document.querySelector('.breadcrumb span').innerHTML = `Student Enrollment - ${currentCourse} Section ${sectionCode}`;
            
            // Get section details
            const section = coursesData[currentCourse].sections.find(s => s.code === sectionCode);
            sectionCapacitySpan.textContent = section.capacity;
            
            // Filter out already enrolled students
            const enrolledStudentIds = new Set(section.students.map(s => s.id));
            availableStudents = unenrolledStudents.filter(student => !enrolledStudentIds.has(student.id));
            
            // Reset selection
            selectedStudents.clear();
            
            // Show student enrollment
            setView(studentEnrollment, sectionManagement, coursesList);
            
            // Render student tables
            renderAvailableStudents();
            renderSelectedStudents();
        }

        // View students in a section
        function viewStudentsInSection(sectionCode) {
            currentSection = sectionCode;
            sectionNameSpan.textContent = `Section ${sectionCode} - ${currentCourse}`;
            
            // Update breadcrumb
            document.querySelector('.breadcrumb span').innerHTML = `Student Enrollment - ${currentCourse} Section ${sectionCode}`;
            
            // Get section details
            const section = coursesData[currentCourse].sections.find(s => s.code === sectionCode);
            sectionCapacitySpan.textContent = section.capacity;
            
            // Show enrolled students in available table (view mode)
            availableStudents = [...section.students];
            
            // Show student enrollment
            setView(studentEnrollment, sectionManagement, coursesList);
            
            // Render in view mode (no selection)
            renderAvailableStudents(true);
            renderSelectedStudents();
            
            // Disable selection buttons in view mode
            selectAllBtn.disabled = true;
            selectAllBtn.classList.add('opacity-50', 'cursor-not-allowed');
            confirmEnrollmentBtn.disabled = true;
            confirmEnrollmentBtn.classList.add('opacity-50', 'cursor-not-allowed');
            importExcelBtn.textContent = 'View Mode';
        }

        // Render available students table
        function renderAvailableStudents(viewMode = false) {
            availableStudentsTable.innerHTML = '';
            availableCountSpan.textContent = availableStudents.length;
            
            if (availableStudents.length === 0) {
                availableStudentsTable.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center p-8 text-gray-500">
                            <i class="fas fa-user-slash text-3xl mb-3 block"></i>
                            ${viewMode ? 'No students enrolled in this section.' : 'No available students found.'}
                        </td>
                    </tr>
                `;
                return;
            }
            
            availableStudents.forEach((student, index) => {
                const isSelected = selectedStudents.has(student.id);
                const row = document.createElement('tr');
                row.className = isSelected ? 'bg-teal-50' : '';
                row.innerHTML = `
                    <td class="p-4">
                        ${!viewMode ? `
                            <input type="checkbox" class="student-checkbox" 
                                   data-student-id="${student.id}"
                                   ${isSelected ? 'checked' : ''}>
                        ` : ''}
                    </td>
                    <td class="p-4 font-medium">${student.id}</td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-sm">
                                ${student.name.charAt(0)}
                            </div>
                            <div>
                                <div class="font-medium">${student.name}</div>
                                <div class="text-xs text-gray-500">${student.email}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">${student.program}</td>
                    <td class="p-4">Year ${student.year}</td>
                `;
                
                if (!viewMode) {
                    const checkbox = row.querySelector('.student-checkbox');
                    checkbox.addEventListener('change', function() {
                        toggleStudentSelection(student.id, this.checked);
                    });
                    
                    row.addEventListener('click', function(e) {
                        if (!e.target.matches('input')) {
                            checkbox.checked = !checkbox.checked;
                            toggleStudentSelection(student.id, checkbox.checked);
                        }
                    });
                }
                
                availableStudentsTable.appendChild(row);
            });
        }

        // Render selected students table
        function renderSelectedStudents() {
            selectedStudentsTable.innerHTML = '';
            selectedCountSpan.textContent = selectedStudents.size;
            selectedTotalSpan.textContent = selectedStudents.size;
            
            if (selectedStudents.size === 0) {
                selectedStudentsTable.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center p-8 text-gray-500">
                            <i class="fas fa-user-plus text-3xl mb-3 block"></i>
                            No students selected. Select students from the available list.
                        </td>
                    </tr>
                `;
                return;
            }
            
            selectedStudents.forEach(studentId => {
                const student = availableStudents.find(s => s.id === studentId) || 
                               unenrolledStudents.find(s => s.id === studentId);
                if (!student) return;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="p-4 font-medium">${student.id}</td>
                    <td class="p-4">${student.name}</td>
                    <td class="p-4">${student.program}</td>
                    <td class="p-4">Year ${student.year}</td>
                    <td class="p-4">
                        <button class="text-red-500 hover:text-red-700" onclick="removeStudent('${student.id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                `;
                selectedStudentsTable.appendChild(row);
            });
        }

        // Toggle student selection
        function toggleStudentSelection(studentId, selected) {
            const section = coursesData[currentCourse].sections.find(s => s.code === currentSection);
            const capacity = section.capacity;
            
            if (selected) {
                if (selectedStudents.size >= capacity) {
                    alert(`Section capacity is ${capacity} students. Cannot select more.`);
                    // Uncheck the checkbox
                    const checkbox = document.querySelector(`input[data-student-id="${studentId}"]`);
                    if (checkbox) checkbox.checked = false;
                    return;
                }
                selectedStudents.add(studentId);
            } else {
                selectedStudents.delete(studentId);
            }
            
            renderAvailableStudents();
            renderSelectedStudents();
        }

        // Remove student from selection
        window.removeStudent = function(studentId) {
            selectedStudents.delete(studentId);
            const checkbox = document.querySelector(`input[data-student-id="${studentId}"]`);
            if (checkbox) checkbox.checked = false;
            renderAvailableStudents();
            renderSelectedStudents();
        };

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
                renderSections();
            });
            
            // Add section button
            addSectionBtn.addEventListener('click', function() {
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
                    location: location,
                    students: []
                });
                
                // Re-render sections
                renderSections();
                
                // Reset form and hide it
                sectionForm.reset();
                addSectionForm.style.display = 'none';
                
                alert(`Section ${sectionCode} created successfully!`);
            });
            
            // Select all button
            selectAllBtn.addEventListener('click', function() {
                const section = coursesData[currentCourse].sections.find(s => s.code === currentSection);
                const capacity = section.capacity;
                
                if (availableStudents.length === 0) return;
                
                if (availableStudents.length > capacity - selectedStudents.size) {
                    alert(`Only ${capacity - selectedStudents.size} more students can be selected (capacity limit).`);
                    return;
                }
                
                availableStudents.forEach(student => {
                    if (!selectedStudents.has(student.id)) {
                        selectedStudents.add(student.id);
                    }
                });
                
                renderAvailableStudents();
                renderSelectedStudents();
            });
            
            // Reset selection button
            resetSelectionBtn.addEventListener('click', function() {
                selectedStudents.clear();
                renderAvailableStudents();
                renderSelectedStudents();
            });
            
            // Confirm enrollment
            confirmEnrollmentBtn.addEventListener('click', function() {
                if (selectedStudents.size === 0) {
                    alert('Please select at least one student to enroll.');
                    return;
                }
                
                const section = coursesData[currentCourse].sections.find(s => s.code === currentSection);
                if (!section) return;
                
                // Add selected students to section
                selectedStudents.forEach(studentId => {
                    const student = unenrolledStudents.find(s => s.id === studentId);
                    if (student && !section.students.some(s => s.id === studentId)) {
                        section.students.push(student);
                    }
                });
                
                // Update enrolled count
                section.enrolled = section.students.length;
                
                // Remove enrolled students from available list
                availableStudents = availableStudents.filter(student => !selectedStudents.has(student.id));
                
                // Show success message
                alert(`Successfully enrolled ${selectedStudents.size} students in Section ${currentSection}!`);
                
                // Go back to sections
                setView(sectionManagement, studentEnrollment, coursesList);
                document.querySelector('.breadcrumb span').innerHTML = `Section Management for ${currentCourse}`;
                
                // Re-render sections to update counts and show new students
                renderSections();
                
                // Reset selection
                selectedStudents.clear();
            });
            
            // Import Excel button
            importExcelBtn.addEventListener('click', function() {
                // This would open a file dialog in a real implementation
                alert('Excel import feature would open a file dialog here. For now, use the student selection interface.');
                
                // Simulate importing more students
                const newStudents = Array.from({length: 5}, (_, i) => ({
                    id: `S${1011 + i}`,
                    name: `Imported Student ${i + 1}`,
                    email: `imported.student${i + 1}@student.edu`,
                    program: 'Computer Science',
                    year: '2'
                }));
                
                // Add to available students
                availableStudents.push(...newStudents);
                renderAvailableStudents();
                
                alert('5 new students imported successfully!');
            });
        });
    </script>
@endsection