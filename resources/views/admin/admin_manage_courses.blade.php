@extends('layouts.admin')

@section('title', 'Course Management - EduManage')

@section('content')
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer base {
            :root {
                --primary: #3498db;
                --secondary: #2c3e50;
                --success: #2ecc71;
                --warning: #f39c12;
                --danger: #e74c3c;
                --bg-main: #f4f7f6;
                --bg-sidebar: #1e293b;
                
                --dept-color: #3b82f6;
                --dept-light: #dbeafe;
                --course-color: #f59e0b;
                --course-light: #fef3c7;
                --assign-color: #10b981;
                --assign-light: #d1fae5;
            }
        }

        @layer components {

            .tabs-container {
                @apply bg-white p-6 rounded-2xl shadow-xl;
            }

            .tabs-header {
                @apply flex border-b-2 border-gray-200 mb-6;
            }

            .tab {
                @apply flex items-center px-6 py-3 cursor-pointer text-gray-500 font-medium transition-all duration-300 relative;
            }
            
            .tab i {
                @apply mr-2 text-lg;
            }
            
            .tab::after {
                content: '';
                @apply absolute bottom-0 left-0 w-full h-1 transform scale-x-0 transition-transform duration-300 rounded-t-full;
            }
            
            .tab:hover {
                @apply text-gray-700;
            }
            
            .tab.department-tab {
                @apply hover:text-blue-600;
            }
            
            .tab.department-tab::after {
                @apply bg-gradient-to-r from-blue-500 to-blue-600;
            }
            
            .tab.department-tab.active {
                @apply text-blue-600;
            }
            
            .tab.department-tab.active::after {
                @apply scale-x-100;
            }
            
            .tab.course-tab {
                @apply hover:text-amber-600;
            }
            
            .tab.course-tab::after {
                @apply bg-gradient-to-r from-amber-500 to-amber-600;
            }
            
            .tab.course-tab.active {
                @apply text-amber-600;
            }
            
            .tab.course-tab.active::after {
                @apply scale-x-100;
            }
            
            .tab.assignment-tab {
                @apply hover:text-emerald-600;
            }
            
            .tab.assignment-tab::after {
                @apply bg-gradient-to-r from-emerald-500 to-emerald-600;
            }
            
            .tab.assignment-tab.active {
                @apply text-emerald-600;
            }
            
            .tab.assignment-tab.active::after {
                @apply scale-x-100;
            }

            .tab-content {
                @apply hidden;
            }

            .tab-content.active {
                @apply block;
            }

            .tab-header {
                @apply flex justify-between items-center mb-6 p-5 rounded-xl;
            }
            
            #departments-tab .tab-header {
                background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                @apply border-l-4 border-blue-600 shadow-md;
            }
            
            #departments-tab .tab-title h2 {
                @apply text-blue-900;
            }
            
            #departments-tab .tab-title i {
                @apply text-blue-600;
            }
            
            #courses-tab .tab-header {
                background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                @apply border-l-4 border-amber-600 shadow-md;
            }
            
            #courses-tab .tab-title h2 {
                @apply text-amber-900;
            }
            
            #courses-tab .tab-title i {
                @apply text-amber-600;
            }
            
            #assignment-tab .tab-header {
                background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
                @apply border-l-4 border-emerald-600 shadow-md;
            }
            
            #assignment-tab .tab-title h2 {
                @apply text-emerald-900;
            }
            
            #assignment-tab .tab-title i {
                @apply text-emerald-600;
            }

            .tab-title {
                @apply flex items-center space-x-3;
            }

            .form-container {
                @apply grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8;
            }

            .form-card {
                @apply bg-white p-6 rounded-2xl border-2 border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300;
                background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            }
            .form-card h3 {
                @apply text-base font-semibold mb-4 text-gray-800 flex items-center;
            }
            
            .form-card h3 i {
                @apply mr-2;
            }

            .form-group {
                @apply mb-4;
            }

            .form-group label {
                @apply block text-sm font-medium text-gray-600 mb-1;
            }

            .form-control {
                @apply block w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200;
            }

            .form-row {
                @apply flex space-x-4;
            }
            .form-row .form-group {
                @apply flex-1;
            }
            .form-row .form-group:first-child {
                @apply flex-grow;
            }

            .btn {
                @apply px-5 py-2.5 rounded-xl font-medium transition-all duration-200 cursor-pointer text-center shadow-md hover:shadow-xl;
            }

            .btn-primary {
                @apply bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-0.5;
            }

            .btn-success {
                @apply bg-gradient-to-r from-emerald-600 to-emerald-700 text-white hover:from-emerald-700 hover:to-emerald-800 transform hover:-translate-y-0.5;
            }

            .btn-outline {
                @apply bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400;
            }

            .btn-danger {
                @apply bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 transform hover:-translate-y-0.5;
            }

            .btn-sm {
                @apply px-3 py-1.5 text-sm;
            }

            .action-buttons {
                @apply flex space-x-3;
            }
            
            .badge {
                @apply px-3 py-1 rounded-full text-xs font-semibold shadow-sm;
            }

            .department-stats, .course-details {
                @apply flex justify-between items-center p-4 rounded-xl border-2 border-blue-100 mt-4 shadow-md;
                background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
            }
            
            .department-card .department-stats {
                background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            }

            .stat {
                @apply text-center flex-1;
            }

            .stat-value {
                @apply text-2xl font-bold;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .stat-label {
                @apply text-xs text-gray-600 font-medium mt-1;
            }
            
            .departments-grid, .courses-grid {
                @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6;
            }

            .department-card, .course-card {
                @apply bg-white p-5 rounded-2xl shadow-lg border-2 border-blue-100 hover:shadow-2xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1;
            }
            
            .course-card {
                @apply border-amber-100 hover:border-amber-300;
            }

            .department-header, .course-header {
                @apply flex justify-between items-start mb-3;
            }

            .department-info h3, .course-info h3 {
                @apply text-lg font-bold mb-1;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .course-info h3 {
                background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .department-info p, .course-info .course-code {
                @apply text-sm text-gray-500 m-0;
            }

            .course-details {
                @apply flex flex-col space-y-2;
                background: linear-gradient(135deg, #fef3c7 0%, #fef9e7 100%);
                @apply border-amber-100;
            }
            .detail-item {
                @apply flex justify-between text-sm;
            }
            .detail-label {
                @apply text-gray-600 font-medium;
            }
            .detail-value {
                @apply text-gray-800 font-semibold;
            }
            
            .assignment-section {
                @apply grid grid-cols-1 lg:grid-cols-2 gap-6;
            }

            .assignment-card {
                @apply bg-white p-5 rounded-2xl shadow-lg border-2 border-emerald-100 hover:shadow-2xl hover:border-emerald-300 transition-all duration-300 transform hover:-translate-y-1;
            }
            
            .assignment-header {
                @apply flex justify-between items-start;
            }
            
            .assignment-header h4 {
                @apply text-base font-semibold text-gray-800;
            }
            
            .lecturer-assignment-list {
                @apply list-none p-0 space-y-2;
            }
            
            .lecturer-assignment-list li {
                @apply flex justify-between items-center text-sm p-3 bg-white rounded-xl border-2 border-gray-100 shadow-sm;
            }
            
            .remove-lecturer-btn {
                @apply bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 px-3 py-1 rounded-lg text-xs shadow-md;
            }

            footer {
                @apply text-center py-4 mt-8 text-sm text-white;
            }
        }

        @layer components {
            .modal {
                @apply fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden;
                backdrop-filter: blur(4px);
            }

            .modal-content {
                @apply bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 p-6 transform transition-all duration-300;
            }

            .modal-header {
                @apply flex justify-between items-center border-b-2 border-gray-200 pb-4 mb-4;
            }

            .modal-header h3 {
                @apply text-xl font-semibold text-gray-800 flex items-center;
            }
            
            .modal-header h3 i {
                @apply mr-2;
            }

            .modal-header .close {
                @apply text-gray-400 hover:text-gray-600 text-2xl font-light leading-none cursor-pointer transition-colors duration-200;
            }

            .modal-footer {
                @apply flex justify-end space-x-3 pt-4 border-t-2 border-gray-200 mt-4;
            }
            
            .read-only-detail {
                @apply mb-4 p-4 rounded-xl border-l-4 border-blue-400 shadow-sm;
                background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            }
            
            .read-only-detail label {
                @apply block text-xs font-medium text-gray-500 mb-1;
            }
            
            .read-only-detail p {
                @apply text-base font-semibold text-gray-700 m-0;
            }
        }
    </style>
    <!-- Font Awesome CDN for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <div class="main-content">
        <div class="header">
            <h1>Course Management</h1>
            <div class="user-info">
                <div>
                    <h3>Dr. Admin User</h3>
                    <p>System Administrator</p>
                </div>
                <img src="https://i.pravatar.cc/150?img=8" alt="User Avatar">
            </div>
        </div>

        <div class="tabs-container">
            <div class="tabs-header">
                <div class="tab department-tab active" data-tab="departments">
                    <i class="fas fa-building"></i>
                    <span>Departments</span>
                </div>
                <div class="tab course-tab" data-tab="courses">
                    <i class="fas fa-book"></i>
                    <span>Courses</span>
                </div>
                <div class="tab assignment-tab" data-tab="assignment">
                    <i class="fas fa-user-tie"></i>
                    <span>Assign Lecturer</span>
                </div>
            </div>

            <div class="tab-content active" id="departments-tab">
                <div class="tab-header">
                    <div class="tab-title">
                        <i class="fas fa-building" style="color: var(--primary);"></i>
                        <h2>Department Management</h2>
                    </div>
                    <button class="btn btn-primary" id="addDepartmentBtn">
                        <i class="fas fa-plus"></i> Add New Department
                    </button>
                </div>

                <div class="form-container">
                    <div class="form-card" style="grid-column: span 2;">
                        <h3><i class="fas fa-chart-bar"></i> Overall Department Metrics</h3>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Total Depts</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">84</div>
                                <div class="stat-label">Total Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">45</div>
                                <div class="stat-label">Total Lecturers</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h3 style="margin-bottom: 20px; color: var(--secondary);">All Departments</h3>
                <div class="departments-grid">
                    <div class="department-card" data-dept-id="CS" data-dept-name="Computer Science" data-dept-code="CS" data-dept-hod="Dr. Alan Turing" data-dept-desc="Department focusing on computing technologies and software development.">
                        <div class="department-header">
                            <div class="department-info">
                                <h3>Computer Science</h3>
                                <p>CS Department</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Department focusing on computing technologies and software development.</p>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">15</div>
                                <div class="stat-label">Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">8</div>
                                <div class="stat-label">Lecturers</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">320</div>
                                <div class="stat-label">Students</div>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-btn" data-dept-id="CS">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-btn" data-dept-id="CS">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="department-card" data-dept-id="EE" data-dept-name="Electrical Engineering" data-dept-code="EE" data-dept-hod="Dr. Nikola Tesla" data-dept-desc="Department specializing in electrical systems and electronics.">
                        <div class="department-header">
                            <div class="department-info">
                                <h3>Electrical Engineering</h3>
                                <p>EE Department</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Department specializing in electrical systems and electronics.</p>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">6</div>
                                <div class="stat-label">Lecturers</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">280</div>
                                <div class="stat-label">Students</div>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-btn" data-dept-id="EE">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-btn" data-dept-id="EE">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="department-card" data-dept-id="ME" data-dept-name="Mechanical Engineering" data-dept-code="ME" data-dept-hod="Dr. Rudolf Diesel" data-dept-desc="Department focused on mechanical systems and design.">
                        <div class="department-header">
                            <div class="department-info">
                                <h3>Mechanical Engineering</h3>
                                <p>ME Department</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Department focused on mechanical systems and design.</p>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">10</div>
                                <div class="stat-label">Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">5</div>
                                <div class="stat-label">Lecturers</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">250</div>
                                <div class="stat-label">Students</div>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-btn" data-dept-id="ME">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-btn" data-dept-id="ME">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="department-card" data-dept-id="CE" data-dept-name="Civil Engineering" data-dept-code="CE" data-dept-hod="Dr. John Smeaton" data-dept-desc="Department dedicated to infrastructure and construction.">
                        <div class="department-header">
                            <div class="department-info">
                                <h3>Civil Engineering</h3>
                                <p>CE Department</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Department dedicated to infrastructure and construction.</p>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">8</div>
                                <div class="stat-label">Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">4</div>
                                <div class="stat-label">Lecturers</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">200</div>
                                <div class="stat-label">Students</div>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-btn" data-dept-id="CE">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-btn" data-dept-id="CE">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="courses-tab">
                <div class="tab-header">
                    <div class="tab-title">
                        <i class="fas fa-book" style="color: var(--warning);"></i>
                        <h2>Course Management</h2>
                    </div>
                    <button class="btn btn-primary" id="addCourseBtn">
                        <i class="fas fa-plus"></i> Add New Course
                    </button>
                </div>

                <div class="form-container">
                    <div class="form-card">
                        <h3><i class="fas fa-filter"></i> Filter Courses</h3>
                        <div class="form-group">
                            <label for="departmentFilter">Department</label>
                            <select id="departmentFilter" class="form-control">
                                <option value="">All Departments</option>
                                <option value="cs">Computer Science</option>
                                <option value="ee">Electrical Engineering</option>
                                <option value="me">Mechanical Engineering</option>
                                <option value="ce">Civil Engineering</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-card">
                        <h3><i class="fas fa-chart-bar"></i> Course Statistics</h3>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">84</div>
                                <div class="stat-label">Total Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">15</div>
                                <div class="stat-label">This Semester</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">4</div>
                                <div class="stat-label">New Courses</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="margin-bottom: 20px; color: var(--secondary);">All Courses</h3>
                <div class="courses-grid">
                    <div class="course-card" data-course-id="CS101" data-course-name="Introduction to Programming" data-course-code="CS101" data-course-dept="Computer Science" data-course-credits="3" data-course-level="100" data-course-sem="Fall 2023" data-course-desc="Fundamental concepts of programming and algorithm development." data-course-term="Sem1 25/26" data-course-leader="Dr. Sarah Johnson (L001)">
                        <div class="course-header">
                            <div class="course-info">
                                <h3>Introduction to Programming</h3>
                                <span class="course-code">CS101</span>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Fundamental concepts of programming and algorithm development.</p>
                        <div class="course-details">
                            <div class="detail-item">
                                <span class="detail-label">Department:</span>
                                <span class="detail-value">Computer Science</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Credit Hours:</span>
                                <span class="detail-value">3</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Course Leader:</span>
                                <span class="detail-value">Dr. Sarah Johnson (L001)</span>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-course-btn" data-course-id="CS101">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-course-btn" data-course-id="CS101">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="course-card" data-course-id="CS201" data-course-name="Data Structures" data-course-code="CS201" data-course-dept="Computer Science" data-course-credits="3" data-course-level="200" data-course-sem="Fall 2023" data-course-desc="Study of data organization, storage, and retrieval techniques." data-course-term="Sem2 25/26" data-course-leader="Dr. Michael Brown (L002)">
                        <div class="course-header">
                            <div class="course-info">
                                <h3>Data Structures</h3>
                                <span class="course-code">CS201</span>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                        </div>
                        <p style="color: #7f8c8d; margin-bottom: 15px;">Study of data organization, storage, and retrieval techniques.</p>
                        <div class="course-details">
                            <div class="detail-item">
                                <span class="detail-label">Department:</span>
                                <span class="detail-value">Computer Science</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Credit Hours:</span>
                                <span class="detail-value">3</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Course Leader:</span>
                                <span class="detail-value">Dr. Michael Brown (L002)</span>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-outline btn-sm edit-course-btn" data-course-id="CS201">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-course-btn" data-course-id="CS201">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="assignment-tab">
                <div class="tab-header">
                    <div class="tab-title">
                        <i class="fas fa-user-tie" style="color: var(--success);"></i>
                        <h2>Lecturer Assignment</h2>
                    </div>
                </div>

                <div class="form-container">
                    <div class="form-card">
                        <h3><i class="fas fa-filter"></i> Filter Assignments</h3>
                        <div class="form-group">
                            <label for="assignmentFilter">Assignment Status</label>
                            <select id="assignmentFilter" class="form-control">
                                <option value="all">All Courses</option>
                                <option value="assigned">Assigned Courses</option>
                                <option value="unassigned">Unassigned Courses</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-card">
                        <h3><i class="fas fa-chart-bar"></i> Assignment Statistics</h3>
                        <div class="department-stats">
                            <div class="stat">
                                <div class="stat-value">84</div>
                                <div class="stat-label">Total Courses</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">72</div>
                                <div class="stat-label">Assigned</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Unassigned</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="margin-bottom: 20px; color: var(--secondary);">Course Assignments</h3>
                <div class="assignment-section">
                    <div class="assignment-card" data-course-id="CS101" data-course-name="Introduction to Programming" data-status="assigned" data-course-term="Sem1 25/26" data-course-dept="Computer Science" data-course-credits="3" data-course-leader="Dr. Sarah Johnson (L001)" data-assigned-lecturers="Dr. Sarah Johnson (L001), Dr. Michael Brown (L002)">
                        <div class="assignment-header">
                            <div>
                                <h4><i class="fas fa-book"></i> CS101 - Introduction to Programming</h4>
                                <p style="color: #7f8c8d; font-size: 0.9rem; margin-top: 5px;">Computer Science • 3 Credits • Sem1 25/26</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 5px 12px; border-radius: 4px; font-size: 0.8rem;">Assigned</span>
                        </div>
                        <div style="margin-top: 15px; padding: 15px; background-color: #f0f3f6; border-radius: 5px; border-left: 3px solid var(--success);">
                            <div style="margin-bottom: 10px;">
                                <label style="font-size: 0.8rem; color: #7f8c8d; display: block; margin-bottom: 5px;">Course Leader:</label>
                                <p style="font-weight: 600; color: var(--secondary); margin: 0;">Dr. Sarah Johnson (L001)</p>
                            </div>
                            <div>
                                <label style="font-size: 0.8rem; color: #7f8c8d; display: block; margin-bottom: 5px;">Assigned Lecturers (2):</label>
                                <p style="font-weight: 600; color: var(--secondary); margin: 0;">Dr. Sarah Johnson (L001), Dr. Michael Brown (L002)</p>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-primary btn-sm add-lecturer-btn" data-course-id="CS101">
                                <i class="fas fa-plus"></i> Add
                            </button>
                            <button class="btn btn-outline btn-sm edit-assignment-btn" data-course-id="CS101">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-assignment-btn" data-course-id="CS101">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="assignment-card" data-course-id="CS201" data-course-name="Data Structures" data-status="assigned" data-course-term="Sem2 25/26" data-course-dept="Computer Science" data-course-credits="3" data-course-leader="Dr. Michael Brown (L002)" data-assigned-lecturers="Dr. Michael Brown (L002)">
                        <div class="assignment-header">
                            <div>
                                <h4><i class="fas fa-book"></i> CS201 - Data Structures</h4>
                                <p style="color: #7f8c8d; font-size: 0.9rem; margin-top: 5px;">Computer Science • 3 Credits • Sem2 25/26</p>
                            </div>
                            <span class="badge" style="background-color: var(--success); color: white; padding: 5px 12px; border-radius: 4px; font-size: 0.8rem;">Assigned</span>
                        </div>
                        <div style="margin-top: 15px; padding: 15px; background-color: #f0f3f6; border-radius: 5px; border-left: 3px solid var(--success);">
                            <div style="margin-bottom: 10px;">
                                <label style="font-size: 0.8rem; color: #7f8c8d; display: block; margin-bottom: 5px;">Course Leader:</label>
                                <p style="font-weight: 600; color: var(--secondary); margin: 0;">Dr. Michael Brown (L002)</p>
                            </div>
                            <div>
                                <label style="font-size: 0.8rem; color: #7f8c8d; display: block; margin-bottom: 5px;">Assigned Lecturers (1):</label>
                                <p style="font-weight: 600; color: var(--secondary); margin: 0;">Dr. Michael Brown (L002)</p>
                            </div>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-primary btn-sm add-lecturer-btn" data-course-id="CS201">
                                <i class="fas fa-plus"></i> Add
                            </button>
                            <button class="btn btn-outline btn-sm edit-assignment-btn" data-course-id="CS201">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-assignment-btn" data-course-id="CS201">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>

                    <div class="assignment-card" data-course-id="EE101" data-course-name="Circuit Analysis" data-status="unassigned" data-course-term="Sem1 25/26" data-course-dept="Electrical Engineering" data-course-credits="4" data-course-leader="Not Yet Set" data-assigned-lecturers="">
                        <div class="assignment-header">
                            <div>
                                <h4><i class="fas fa-book"></i> EE101 - Circuit Analysis</h4>
                                <p style="color: #7f8c8d; font-size: 0.9rem; margin-top: 5px;">Electrical Engineering • 4 Credits • Sem1 25/26</p>
                            </div>
                            <span class="badge" style="background-color: var(--warning); color: white; padding: 5px 12px; border-radius: 4px; font-size: 0.8rem;">Unassigned</span>
                        </div>
                        <div style="margin-top: 15px; padding: 15px; background-color: #fff3cd; border-radius: 5px; border-left: 3px solid var(--warning);">
                            <p style="color: #856404; margin: 0; font-style: italic;">
                                <i class="fas fa-exclamation-triangle"></i> No lecturers assigned to this course yet
                            </p>
                        </div>
                        <div class="action-buttons" style="margin-top: 15px; justify-content: flex-start;">
                            <button class="btn btn-primary btn-sm add-lecturer-btn" data-course-id="EE101">
                                <i class="fas fa-plus"></i> Add
                            </button>
                            <button class="btn btn-outline btn-sm edit-assignment-btn" data-course-id="EE101" disabled style="opacity: 0.5; cursor: not-allowed;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline btn-sm view-assignment-btn" data-course-id="EE101">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>EduManage Course Management System &copy; 2023. All rights reserved.</p>
        </footer>
    </div>

    <div class="modal" id="addDepartmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Department</h3>
                <span class="close">&times;</span>
            </div>
            <form id="departmentForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="deptName">Department Name</label>
                        <input type="text" id="deptName" class="form-control" placeholder="Enter department name">
                    </div>
                    <div class="form-group">
                        <label for="deptCode">Department Code</label>
                        <input type="text" id="deptCode" class="form-control" placeholder="Enter department code">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deptHod">Head of Department (HOD)</label>
                    <input type="text" id="deptHod" class="form-control" placeholder="Enter HOD name">
                </div>
                <div class="form-group">
                    <label for="deptDescription">Description</label>
                    <textarea id="deptDescription" class="form-control" rows="3" placeholder="Enter department description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Department</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal" id="editDepartmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="editModalTitle">Edit Department: [Dept Name]</h3>
                <span class="close">&times;</span>
            </div>
            <form id="editDepartmentForm">
                <input type="hidden" id="editDeptId">
                <div class="form-row">
                    <div class="form-group">
                        <label for="editDeptName">Department Name</label>
                        <input type="text" id="editDeptName" class="form-control" placeholder="Enter department name">
                    </div>
                    <div class="form-group">
                        <label for="editDeptCode">Department Code</label>
                        <input type="text" id="editDeptCode" class="form-control" placeholder="Enter department code" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editDeptHod">Head of Department (HOD)</label>
                    <input type="text" id="editDeptHod" class="form-control" placeholder="Enter HOD name">
                </div>
                <div class="form-group">
                    <label for="editDeptDescription">Description</label>
                    <textarea id="editDeptDescription" class="form-control" rows="3" placeholder="Enter department description"></textarea>
                </div>
                <div class="form-group">
                    <label for="editDeptStatus">Status</label>
                    <select id="editDeptStatus" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal" id="viewDepartmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="viewModalTitle">Department Details: [Dept Name]</h3>
                <span class="close">&times;</span>
            </div>
            <div id="viewDepartmentDetails">
                <div class="read-only-detail">
                    <label>Department Name</label>
                    <p id="viewDeptName"></p>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Department Code</label>
                            <p id="viewDeptCode"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>HOD</label>
                            <p id="viewDeptHod"></p>
                        </div>
                    </div>
                </div>
                <div class="read-only-detail">
                    <label>Description</label>
                    <p id="viewDeptDescription"></p>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Courses Offered</label>
                            <p id="viewDeptCourses">15</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Lecturers</label>
                            <p id="viewDeptLecturers">8</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Status</label>
                            <p id="viewDeptStatus">Active</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline close-modal">Close</button>
            </div>
        </div>
    </div>

    <div class="modal" id="addCourseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Course</h3>
                <span class="close">&times;</span>
            </div>
            <form id="courseForm">
                <div class="form-row">
                    <div class="form-group" style="flex: 100%;">
                        <label for="courseDept">Department <span style="color: red;">*</span></label>
                        <select id="courseDept" class="form-control" required>
                            <option value="">-- Select Department --</option>
                            <option value="cs">Computer Science</option>
                            <option value="ee">Electrical Engineering</option>
                            <option value="me">Mechanical Engineering</option>
                            <option value="ce">Civil Engineering</option>
                            <option value="math">Mathematics</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="courseName">Course Name <span style="color: red;">*</span></label>
                        <input type="text" id="courseName" class="form-control" placeholder="e.g., Introduction to Programming" required>
                    </div>
                    <div class="form-group">
                        <label for="courseCode">Course Code <span style="color: red;">*</span></label>
                        <input type="text" id="courseCode" class="form-control" placeholder="e.g., CS101" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="courseCredits">Credit Hours <span style="color: red;">*</span></label>
                        <input type="number" id="courseCredits" class="form-control" placeholder="e.g., 3" min="1" max="6" required>
                    </div>
                    <div class="form-group">
                        <label for="courseCurrentTerm">Current Term <span style="color: red;">*</span></label>
                        <select id="courseCurrentTerm" class="form-control" required>
                            <option value="">Select Term</option>
                            <option value="sem1_2526">Sem1 25/26</option>
                            <option value="sem2_2526">Sem2 25/26</option>
                            <option value="sem3_2526">Sem3 25/26</option>
                            <option value="sem1_2425">Sem1 24/25</option>
                            <option value="sem2_2425">Sem2 24/25</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="courseLeader">Course Leader <span style="color: red;">*</span></label>
                    <select id="courseLeader" class="form-control" required>
                        <option value="">-- Select Course Leader (Lecturer) --</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="courseDescription">Course Description</label>
                    <textarea id="courseDescription" class="form-control" rows="3" placeholder="Enter a brief description of the course content."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Course</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="editCourseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="editCourseModalTitle">Edit Course: [Course Name]</h3>
                <span class="close">&times;</span>
            </div>
            <form id="editCourseForm">
                <input type="hidden" id="editCourseId">
                <div class="form-row">
                    <div class="form-group">
                        <label for="editCourseName">Course Name</label>
                        <input type="text" id="editCourseName" class="form-control" placeholder="e.g., Introduction to Programming">
                    </div>
                    <div class="form-group">
                        <label for="editCourseCode">Course Code</label>
                        <input type="text" id="editCourseCode" class="form-control" placeholder="e.g., CS101" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="editCourseCredits">Credit Hours</label>
                        <input type="number" id="editCourseCredits" class="form-control" placeholder="e.g., 3" min="1" max="6">
                    </div>
                    <div class="form-group">
                        <label for="editCourseCurrentTerm">Current Term</label>
                        <select id="editCourseCurrentTerm" class="form-control">
                            <option value="sem1_2526">Sem1 25/26</option>
                            <option value="sem2_2526">Sem2 25/26</option>
                            <option value="sem3_2526">Sem3 25/26</option>
                            <option value="sem1_2425">Sem1 24/25</option>
                            <option value="sem2_2425">Sem2 24/25</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editCourseLeader">Course Leader</label>
                    <select id="editCourseLeader" class="form-control">
                            </select>
                </div>
                <div class="form-group">
                    <label for="editCourseDept">Department</label>
                    <select id="editCourseDept" class="form-control">
                        <option value="cs">Computer Science</option>
                        <option value="ee">Electrical Engineering</option>
                        <option value="me">Mechanical Engineering</option>
                        <option value="ce">Civil Engineering</option>
                        <option value="math">Mathematics</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editCourseDescription">Course Description</label>
                    <textarea id="editCourseDescription" class="form-control" rows="3" placeholder="Enter a brief description of the course content."></textarea>
                </div>
                <div class="form-group">
                    <label for="editCourseStatus">Status</label>
                    <select id="editCourseStatus" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-course-btn" id="deleteCourseBtn">
                           <i class="fas fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal" id="viewCourseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="viewCourseModalTitle">Course Details: [Course Name]</h3>
                <span class="close">&times;</span>
            </div>
            <div id="viewCourseDetails">
                <div class="read-only-detail">
                    <label>Course Name</label>
                    <p id="viewCourseName"></p>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Course Code</label>
                            <p id="viewCourseCode"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Department</label>
                            <p id="viewCourseDept"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Credit Hours</label>
                            <p id="viewCourseCredits"></p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Current Term</label>
                            <p id="viewCourseCurrentTerm"></p>
                        </div>
                    </div>
                    <div class="form-group">
                            </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Status</label>
                            <p id="viewCourseStatus"></p>
                        </div>
                    </div>
                </div>
                <div class="read-only-detail">
                    <label>Course Leader</label>
                    <p id="viewCourseLeader"></p>
                </div>
                <div class="read-only-detail">
                    <label>Description</label>
                    <p id="viewCourseDescription"></p>
                </div>
                <div class="read-only-detail">
                    <label>Assigned Lecturer</label>
                    <p id="viewCourseLecturer">Dr. Sarah Johnson (L001)</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline close-modal">Close</button>
            </div>
        </div>
    </div>
    
    <div class="modal" id="addAssignmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle"></i> Assign New Lecturer to <span id="addAssignmentCourseTitle">[Course Code - Name]</span></h3>
                <span class="close">&times;</span>
            </div>
            <form id="addAssignmentForm">
                <input type="hidden" id="addAssignmentCourseId">
                <div class="form-group">
                    <label for="newLecturerSelect">Select Lecturer to Add</label>
                    <select id="newLecturerSelect" class="form-control" required>
                        <option value="">-- Select Lecturer --</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Lecturer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="editAssignmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Assignment for <span id="editAssignmentCourseTitle">[Course Code - Name]</span></h3>
                <span class="close">&times;</span>
            </div>
            <form id="editAssignmentForm">
                <input type="hidden" id="editAssignmentCourseId">
                <div class="form-group">
                    <label>Current Assigned Lecturers:</label>
                    <div id="currentAssignedLecturers" style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f8f9fa;">
                        </div>
                </div>
                <div class="form-group">
                    <label for="editCourseLeaderAssignment">Update Course Leader</label>
                    <select id="editCourseLeaderAssignment" class="form-control">
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Assignment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="viewAssignmentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-eye"></i> Assignment Details: <span id="viewAssignmentCourseTitle">[Course Code - Name]</span></h3>
                <span class="close">&times;</span>
            </div>
            <div id="viewAssignmentDetails">
                <div class="read-only-detail">
                    <label>Course Name</label>
                    <p id="viewAssCourseName"></p>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Course Code</label>
                            <p id="viewAssCourseCode"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="read-only-detail">
                            <label>Credit Hours</label>
                            <p id="viewAssCourseCredits"></p>
                        </div>
                    </div>
                </div>
                <div class="read-only-detail" style="border-left-color: var(--success);">
                    <label>Course Leader</label>
                    <p id="viewAssCourseLeader"></p>
                </div>
                <div class="read-only-detail" style="border-left-color: var(--success);">
                    <label>Assigned Lecturers</label>
                    <ul id="viewAssAssignedLecturers" class="lecturer-assignment-list">
                        </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline close-modal">Close</button>
            </div>
        </div>
    </div>


    <script>
        // --- Simulated Lecturer Data ---
        const lecturers = [
            { id: "L001", name: "Dr. Sarah Johnson", dept: "cs" },
            { id: "L002", name: "Dr. Michael Brown", dept: "cs" },
            { id: "L003", name: "Dr. Emily Davis", dept: "cs" },
            { id: "L004", name: "Dr. Robert Wilson", dept: "ee" },
            { id: "L005", name: "Dr. Lisa Anderson", dept: "ee" },
            { id: "L006", name: "Dr. James Lee", dept: "ee" },
            { id: "L007", name: "Prof. Jane Doe", dept: "me" },
            { id: "L008", name: "Dr. Kelvin Smith", dept: "ce" },
        ];
        
        // --- Department Data (Simulated for modal functionality) ---
        const deptData = {
            "CS": {
                name: "Computer Science",
                code: "CS",
                hod: "Dr. Alan Turing",
                description: "Department focusing on computing technologies and software development.",
                courses: 15,
                lecturers: 8,
                students: 320,
                status: "Active"
            },
            "EE": {
                name: "Electrical Engineering",
                code: "EE",
                hod: "Dr. Nikola Tesla",
                description: "Department specializing in electrical systems and electronics.",
                courses: 12,
                lecturers: 6,
                students: 280,
                status: "Active"
            },
            "ME": {
                name: "Mechanical Engineering",
                code: "ME",
                hod: "Dr. Rudolf Diesel",
                description: "Department focused on mechanical systems and design.",
                courses: 10,
                lecturers: 5,
                students: 250,
                status: "Active"
            },
            "CE": {
                name: "Civil Engineering",
                code: "CE",
                hod: "Dr. John Smeaton",
                description: "Department dedicated to infrastructure and construction.",
                courses: 8,
                lecturers: 4,
                students: 200,
                status: "Active"
            }
        };

        // --- Course Data (Simulated for modal functionality) ---
        const courseData = {
            "CS101": {
                name: "Introduction to Programming",
                code: "CS101",
                dept: "Computer Science",
                credits: "3",
                level: "100 Level", 
                currentTerm: "Sem1 25/26",
                semester: "Fall 2023",
                description: "Fundamental concepts of programming and algorithm development.",
                status: "Active",
                courseLeader: "Dr. Sarah Johnson (L001)", 
                assignedLecturers: "Dr. Sarah Johnson (L001), Dr. Michael Brown (L002)"
            },
            "CS201": {
                name: "Data Structures",
                code: "CS201",
                dept: "Computer Science",
                credits: "3",
                level: "200 Level", 
                currentTerm: "Sem2 25/26",
                semester: "Fall 2023",
                description: "Study of data organization, storage, and retrieval techniques.",
                status: "Active",
                courseLeader: "Dr. Michael Brown (L002)", 
                assignedLecturers: "Dr. Michael Brown (L002)"
            },
             "EE101": {
                name: "Circuit Analysis",
                code: "EE101",
                dept: "Electrical Engineering",
                credits: "4",
                level: "100 Level", 
                currentTerm: "Sem1 25/26",
                semester: "Fall 2023",
                description: "Analysis of fundamental electrical circuits and theorems.",
                status: "Active",
                courseLeader: "Not Yet Set", 
                assignedLecturers: ""
            }
        };

        // Utility to map select value back to display text
        function mapTermValueToText(value) {
            const map = {
                "sem1_2526": "Sem1 25/26",
                "sem2_2526": "Sem2 25/26",
                "sem3_2526": "Sem3 25/26",
                "sem1_2425": "Sem1 24/25",
                "sem2_2425": "Sem2 24/25"
            };
            return map[value] || value;
        }


        // --- Global Selectors ---
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        const addDepartmentBtn = document.getElementById('addDepartmentBtn');
        const addCourseBtn = document.getElementById('addCourseBtn');
        
        // Modals
        const addDepartmentModal = document.getElementById('addDepartmentModal');
        const addCourseModal = document.getElementById('addCourseModal');
        const editDepartmentModal = document.getElementById('editDepartmentModal');
        const viewDepartmentModal = document.getElementById('viewDepartmentModal');
        const editCourseModal = document.getElementById('editCourseModal');
        const viewCourseModal = document.getElementById('viewCourseModal');
        
        // NEW Assignment Modals
        const addAssignmentModal = document.getElementById('addAssignmentModal');
        const editAssignmentModal = document.getElementById('editAssignmentModal');
        const viewAssignmentModal = document.getElementById('viewAssignmentModal');

        const closeModalBtns = document.querySelectorAll('.close, .close-modal');
        const departmentForm = document.getElementById('departmentForm');
        const editDepartmentForm = document.getElementById('editDepartmentForm');
        const courseForm = document.getElementById('courseForm');
        const editCourseForm = document.getElementById('editCourseForm');
        // NEW Assignment Forms
        const addAssignmentForm = document.getElementById('addAssignmentForm');
        const editAssignmentForm = document.getElementById('editAssignmentForm');

        // Action Buttons
        const deptEditButtons = document.querySelectorAll('.department-card .edit-btn');
        const deptViewButtons = document.querySelectorAll('.department-card .view-btn');
        const courseEditButtons = document.querySelectorAll('.course-card .edit-course-btn');
        const courseViewButtons = document.querySelectorAll('.course-card .view-course-btn');

        // NEW Assignment Buttons
        const addLecturerBtns = document.querySelectorAll('.assignment-card .add-lecturer-btn');
        const editAssignmentBtns = document.querySelectorAll('.assignment-card .edit-assignment-btn');
        const viewAssignmentBtns = document.querySelectorAll('.assignment-card .view-assignment-btn');

        // New Select Fields
        const courseLeaderSelect = document.getElementById('courseLeader');
        const editCourseLeaderSelect = document.getElementById('editCourseLeader');
        // New Assignment Select Fields
        const newLecturerSelect = document.getElementById('newLecturerSelect');
        const editCourseLeaderAssignment = document.getElementById('editCourseLeaderAssignment');

        // Assignment Filter
        const assignmentFilter = document.getElementById('assignmentFilter');


        // --- Utility Functions ---

        // Function to populate the Course Leader dropdowns
        function populateCourseLeaderDropdowns() {
            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.textContent = "-- Select Course Leader (Lecturer) --";

            const defaultEditOption = document.createElement('option');
            defaultEditOption.value = "";
            defaultEditOption.textContent = "-- Select Course Leader (Lecturer) --";

            // Clear existing options (if any)
            courseLeaderSelect.innerHTML = '';
            editCourseLeaderSelect.innerHTML = '';
            newLecturerSelect.innerHTML = ''; // Also populate for Add Assignment modal

            courseLeaderSelect.appendChild(defaultOption.cloneNode(true));
            editCourseLeaderSelect.appendChild(defaultEditOption.cloneNode(true));
            newLecturerSelect.appendChild(defaultOption.cloneNode(true));

            lecturers.forEach(lecturer => {
                const value = lecturer.name + ' (' + lecturer.id + ')';
                
                // For Add Course Modal
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value;
                courseLeaderSelect.appendChild(option);

                // For Edit Course Modal
                const editOption = document.createElement('option');
                editOption.value = value;
                editOption.textContent = value;
                editCourseLeaderSelect.appendChild(editOption);
                
                // For Add Assignment Modal
                const addAssignmentOption = document.createElement('option');
                addAssignmentOption.value = value;
                addAssignmentOption.textContent = value;
                newLecturerSelect.appendChild(addAssignmentOption);
            });
        }

        // Filter assignment cards logic
        function filterAssignmentCards() {
            const selectedStatus = assignmentFilter.value;
            const assignmentCards = document.querySelectorAll('.assignment-card');

            assignmentCards.forEach(card => {
                const status = card.getAttribute('data-status');
                if (selectedStatus === 'all' || status === selectedStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }


        // Initialize dropdowns on load
        window.addEventListener('load', () => {
             populateCourseLeaderDropdowns();
             filterAssignmentCards(); // Initial filter on load
        });

        // Add filter listener
        assignmentFilter.addEventListener('change', filterAssignmentCards);


        // --- Tab Functionality ---
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to current tab and content
                tab.classList.add('active');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // --- Modal Control Functions ---
        function openModal(modal) {
            modal.style.display = 'flex';
        }

        function closeModal(modal) {
            modal.style.display = 'none';
        }

        // Close modals listeners
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                closeModal(addDepartmentModal);
                closeModal(addCourseModal);
                closeModal(editDepartmentModal);
                closeModal(viewDepartmentModal);
                closeModal(editCourseModal);
                closeModal(viewCourseModal);
                closeModal(addAssignmentModal); // NEW
                closeModal(editAssignmentModal); // NEW
                closeModal(viewAssignmentModal); // NEW
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === addDepartmentModal) closeModal(addDepartmentModal);
            if (e.target === addCourseModal) closeModal(addCourseModal);
            if (e.target === editDepartmentModal) closeModal(editDepartmentModal);
            if (e.target === viewDepartmentModal) closeModal(viewDepartmentModal);
            if (e.target === editCourseModal) closeModal(editCourseModal);
            if (e.target === viewCourseModal) closeModal(viewCourseModal);
            if (e.target === addAssignmentModal) closeModal(addAssignmentModal); // NEW
            if (e.target === editAssignmentModal) closeModal(editAssignmentModal); // NEW
            if (e.target === viewAssignmentModal) closeModal(viewAssignmentModal); // NEW
        });

        // Open modals listeners
        addDepartmentBtn.addEventListener('click', () => openModal(addDepartmentModal));
        addCourseBtn.addEventListener('click', () => openModal(addCourseModal));

        // --- Department Card Action (Edit/View) ---
        deptEditButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const deptId = e.currentTarget.getAttribute('data-dept-id');
                const data = deptData[deptId];
                if (data) {
                    document.getElementById('editModalTitle').textContent = `Edit Department: ${data.name}`;
                    document.getElementById('editDeptId').value = deptId;
                    document.getElementById('editDeptName').value = data.name;
                    document.getElementById('editDeptCode').value = data.code;
                    document.getElementById('editDeptHod').value = data.hod;
                    document.getElementById('editDeptDescription').value = data.description;
                    document.getElementById('editDeptStatus').value = data.status.toLowerCase();
                    openModal(editDepartmentModal);
                }
            });
        });
        
        deptViewButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const deptId = e.currentTarget.getAttribute('data-dept-id');
                const data = deptData[deptId];
                if (data) {
                    document.getElementById('viewModalTitle').textContent = `Department Details: ${data.name}`;
                    document.getElementById('viewDeptName').textContent = data.name;
                    document.getElementById('viewDeptCode').textContent = data.code;
                    document.getElementById('viewDeptHod').textContent = data.hod;
                    document.getElementById('viewDeptDescription').textContent = data.description;
                    document.getElementById('viewDeptCourses').textContent = data.courses;
                    document.getElementById('viewDeptLecturers').textContent = data.lecturers;
                    document.getElementById('viewDeptStatus').textContent = data.status;
                    openModal(viewDepartmentModal);
                }
            });
        });


        // --- Course Card Action (Edit) - MODIFIED ---
        courseEditButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const courseId = e.currentTarget.getAttribute('data-course-id');
                const data = courseData[courseId];
                
                // Fallback to card attributes if not in courseData 
                const card = e.currentTarget.closest('.course-card');
                const courseName = data ? data.name : card.getAttribute('data-course-name');
                const courseCode = data ? data.code : card.getAttribute('data-course-code');
                const courseDept = data ? data.dept : card.getAttribute('data-course-dept');
                const courseCredits = data ? data.credits : card.getAttribute('data-course-credits');
                const courseCurrentTerm = data ? data.currentTerm : card.getAttribute('data-course-term');
                const courseLeader = data ? data.courseLeader : card.getAttribute('data-course-leader');
                const courseDesc = data ? data.description : card.getAttribute('data-course-desc');
                const courseStatus = data ? data.status.toLowerCase() : 'active'; 
                
                // Find term value from display text
                const termMap = {
                    "Sem1 25/26": "sem1_2526",
                    "Sem2 25/26": "sem2_2526",
                    "Sem3 25/26": "sem3_2526",
                    "Sem1 24/25": "sem1_2425",
                    "Sem2 24/25": "sem2_2425"
                };
                const termValue = termMap[courseCurrentTerm] || 'sem1_2526';
                
                // Find department value from display text
                const deptMap = {
                    "Computer Science": "cs",
                    "Electrical Engineering": "ee",
                    "Mechanical Engineering": "me",
                    "Civil Engineering": "ce",
                    "Mathematics": "math"
                };
                const deptValue = deptMap[courseDept] || 'cs';


                document.getElementById('editCourseModalTitle').textContent = `Edit Course: ${courseName}`;
                document.getElementById('editCourseId').value = courseId;
                document.getElementById('editCourseName').value = courseName;
                document.getElementById('editCourseCode').value = courseCode;
                document.getElementById('editCourseCredits').value = courseCredits;
                document.getElementById('editCourseCurrentTerm').value = termValue; // Set the term value
                document.getElementById('editCourseLeader').value = courseLeader; // Set the Course Leader
                document.getElementById('editCourseDept').value = deptValue;
                document.getElementById('editCourseDescription').value = courseDesc;
                document.getElementById('editCourseStatus').value = courseStatus;

                openModal(editCourseModal);
            });
        });


        // --- Course Card Action (View) - MODIFIED ---
        courseViewButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const courseId = e.currentTarget.getAttribute('data-course-id');
                const data = courseData[courseId];

                // Fallback to card attributes if not in courseData 
                const card = e.currentTarget.closest('.course-card');
                const courseName = data ? data.name : card.getAttribute('data-course-name');
                const courseCode = data ? data.code : card.getAttribute('data-course-code');
                const courseDept = data ? data.dept : card.getAttribute('data-course-dept');
                const courseCredits = data ? data.credits : card.getAttribute('data-course-credits');
                const courseCurrentTerm = data ? data.currentTerm : card.getAttribute('data-course-term'); // Using new term data
                const courseSem = data ? data.semester : card.getAttribute('data-course-sem');
                const courseDesc = data ? data.description : card.getAttribute('data-course-desc');
                const courseStatus = data ? data.status : 'Active';
                const courseLecturer = data ? data.assignedLecturers.split(', ')[0] : 'Dr. Not Assigned Yet'; // Showing first lecturer as primary
                const courseLeader = data ? data.courseLeader : card.getAttribute('data-course-leader');
                
                document.getElementById('viewCourseModalTitle').textContent = `Course Details: ${courseName}`;
                document.getElementById('viewCourseName').textContent = courseName;
                document.getElementById('viewCourseCode').textContent = courseCode;
                document.getElementById('viewCourseDept').textContent = courseDept;
                document.getElementById('viewCourseCredits').textContent = courseCredits;
                document.getElementById('viewCourseCurrentTerm').textContent = courseCurrentTerm; // Displaying new term
                document.getElementById('viewCourseDescription').textContent = courseDesc;
                document.getElementById('viewCourseStatus').textContent = courseStatus;
                document.getElementById('viewCourseLecturer').textContent = courseLecturer;
                document.getElementById('viewCourseLeader').textContent = courseLeader; // Displaying Course Leader
                
                openModal(viewCourseModal);
            });
        });


        // --- NEW: Lecturer Assignment Modals Logic ---

        // Add Lecturer Button Listener
        addLecturerBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                const courseId = e.currentTarget.getAttribute('data-course-id');
                const data = courseData[courseId];
                const title = `${data.code} - ${data.name}`;

                // Set Modal Title
                document.getElementById('addAssignmentCourseTitle').textContent = title;
                document.getElementById('addAssignmentCourseId').value = courseId;
                
                // Filter dropdown to only show lecturers NOT currently assigned
                const assignedLecturersList = data.assignedLecturers.split(', ').filter(l => l.trim() !== "");
                newLecturerSelect.innerHTML = '<option value="">-- Select Lecturer --</option>';

                lecturers.forEach(lecturer => {
                    const value = lecturer.name + ' (' + lecturer.id + ')';
                    if (!assignedLecturersList.includes(value)) {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = value;
                        newLecturerSelect.appendChild(option);
                    }
                });

                openModal(addAssignmentModal);
            });
        });

        // Edit Assignment Button Listener
        editAssignmentBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                const courseId = e.currentTarget.getAttribute('data-course-id');
                const data = courseData[courseId];
                const title = `${data.code} - ${data.name}`;
                
                if (data.assignedLecturers.trim() === "") {
                     alert(`Cannot edit assignment for ${title}. No lecturers are currently assigned.`);
                     return;
                }

                // Set Modal Title
                document.getElementById('editAssignmentCourseTitle').textContent = title;
                document.getElementById('editAssignmentCourseId').value = courseId;
                
                const assignedListContainer = document.getElementById('currentAssignedLecturers');
                assignedListContainer.innerHTML = '';
                
                const assignedLecturersList = data.assignedLecturers.split(', ').filter(l => l.trim() !== "");

                // Populate Current Assigned Lecturers list (for removal/management)
                const list = document.createElement('ul');
                list.className = 'lecturer-assignment-list';

                // Also populate the Course Leader dropdown for editing
                editCourseLeaderAssignment.innerHTML = '';
                
                assignedLecturersList.forEach(lecturer => {
                    // List item for assigned lecturers (with simulated removal button)
                    const listItem = document.createElement('li');
                    listItem.className = 'lecturer-assignment-item';
                    listItem.innerHTML = `
                        <span>${lecturer}</span>
                        <button type="button" class="btn btn-danger btn-sm remove-lecturer-btn" data-lecturer="${lecturer}">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    `;
                    list.appendChild(listItem);

                    // Option for Course Leader dropdown
                    const leaderOption = document.createElement('option');
                    leaderOption.value = lecturer;
                    leaderOption.textContent = lecturer;
                    if (lecturer === data.courseLeader) {
                        leaderOption.selected = true;
                    }
                    editCourseLeaderAssignment.appendChild(leaderOption);
                });

                assignedListContainer.appendChild(list);

                // Add simulated remove lecturer listener
                document.querySelectorAll('.remove-lecturer-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const lecturerName = this.getAttribute('data-lecturer');
                        if (confirm(`Are you sure you want to remove ${lecturerName} from this course?`)) {
                            alert(`${lecturerName} removed! (Simulated)`);
                            this.closest('li').remove();
                            // In a real app, you'd send an AJAX request here
                        }
                    });
                });

                openModal(editAssignmentModal);
            });
        });


        // View Assignment Button Listener
        viewAssignmentBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                const courseId = e.currentTarget.getAttribute('data-course-id');
                const data = courseData[courseId];
                const title = `${data.code} - ${data.name}`;

                // Set Modal Title
                document.getElementById('viewAssignmentCourseTitle').textContent = title;
                
                // Populate Details
                document.getElementById('viewAssCourseName').textContent = data.name;
                document.getElementById('viewAssCourseCode').textContent = data.code;
                document.getElementById('viewAssCourseCredits').textContent = data.credits;
                document.getElementById('viewAssCourseLeader').textContent = data.courseLeader;

                const assignedList = document.getElementById('viewAssAssignedLecturers');
                assignedList.innerHTML = '';

                const assignedLecturersList = data.assignedLecturers.split(', ').filter(l => l.trim() !== "");

                if (assignedLecturersList.length > 0) {
                    assignedLecturersList.forEach(lecturer => {
                        const listItem = document.createElement('li');
                        listItem.textContent = lecturer;
                        assignedList.appendChild(listItem);
                    });
                } else {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<i class="fas fa-exclamation-circle" style="color: var(--warning);"></i> <strong>No Lecturers Assigned</strong>`;
                    assignedList.appendChild(listItem);
                }

                openModal(viewAssignmentModal);
            });
        });


        // --- Form Submissions (Simulated) ---
        departmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('New Department added successfully! (Simulated)');
            closeModal(addDepartmentModal);
            departmentForm.reset();
        });
        
        editDepartmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const deptId = document.getElementById('editDeptId').value;
            alert(`Changes saved for Department ${deptId}! (Simulated Update)`);
            closeModal(editDepartmentModal);
        });

        // ADD COURSE FORM SUBMISSION - UPDATED to include Course Leader
        courseForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const dept = document.getElementById('courseDept').value;
            const name = document.getElementById('courseName').value;
            const code = document.getElementById('courseCode').value;
            const term = mapTermValueToText(document.getElementById('courseCurrentTerm').value); // Get display text
            const leader = document.getElementById('courseLeader').value;
            
            if (!dept || !name || !code || !term || !leader) {
                alert('Please fill out all required fields marked with *');
                return;
            }

            alert(`Course "${code} - ${name}" led by ${leader} for ${term} added successfully! (Simulated)`);
            closeModal(addCourseModal);
            courseForm.reset();
        });

        // Edit Course Form Submission
        editCourseForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const courseId = document.getElementById('editCourseId').value;
            alert(`Changes saved for Course ${courseId}! (Simulated Update)`);
            closeModal(editCourseModal);
        });

        // Delete Course Button (inside Edit Modal)
        document.getElementById('deleteCourseBtn').addEventListener('click', () => {
             const courseId = document.getElementById('editCourseId').value;
             if (confirm(`Are you sure you want to delete course ${courseId}? This action cannot be undone.`)) {
                 alert(`Course ${courseId} deleted! (Simulated Action)`);
                 closeModal(editCourseModal);
             }
        });

        // NEW: Add Assignment Form Submission
        addAssignmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const courseId = document.getElementById('addAssignmentCourseId').value;
            const newLecturer = document.getElementById('newLecturerSelect').value;
            if (newLecturer) {
                alert(`Lecturer ${newLecturer} assigned to ${courseId}! (Simulated Update)`);
                closeModal(addAssignmentModal);
            } else {
                 alert('Please select a lecturer to add.');
            }
        });

        // NEW: Edit Assignment Form Submission
        editAssignmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const courseId = document.getElementById('editAssignmentCourseId').value;
            const newLeader = document.getElementById('editCourseLeaderAssignment').value;
            alert(`Assignment for ${courseId} saved. New Course Leader is ${newLeader}. (Simulated Update)`);
            closeModal(editAssignmentModal);
        });

    </script>
@endsection