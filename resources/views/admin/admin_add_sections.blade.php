@extends('layouts.admin')

@section('title', 'Student Enrollment - EduManage')

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
                
                --section-color: #9b59b6; /* Purple for Sections */
                --section-light: #f3e8ff;
            }

            body {
                @apply font-sans text-gray-700 min-h-screen;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            h1, h2, h3, h4, h5, h6 {
                @apply text-gray-800 font-bold;
            }
        }

        @layer components {
            /* Global Layout Components */
            .main-content {
                @apply p-8 flex-1;
            }

            .header {
                @apply flex justify-between items-center bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-100;
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            }

            .user-info {
                @apply flex items-center space-x-3;
            }
            /* Styling for the user profile icon */
            .user-profile-icon {
                @apply w-12 h-12 flex items-center justify-center rounded-full text-2xl bg-blue-100 text-blue-500 ring-4 ring-blue-500 ring-offset-2;
            }
            .user-info h3 {
                @apply text-sm font-semibold m-0;
            }
            .user-info p {
                @apply text-xs text-gray-500 m-0;
            }
            
            /* Filtering and Card Styles */
            .form-card {
                @apply bg-white p-6 rounded-2xl border-2 border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300;
                background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            }
            .form-card h3 {
                @apply text-base font-semibold mb-4 text-gray-800 flex items-center;
            }
            .form-group {
                @apply mb-4;
            }
            .form-group label {
                @apply block text-sm font-medium text-gray-600 mb-1;
            }
            .form-control {
                @apply block w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition-all duration-200;
            }
            .form-row {
                @apply flex space-x-4;
            }
            .form-row .form-group {
                @apply flex-1;
            }

            /* Buttons */
            .btn {
                @apply px-5 py-2.5 rounded-xl font-medium transition-all duration-200 cursor-pointer text-center shadow-md hover:shadow-xl;
            }
            .btn-primary {
                @apply bg-gradient-to-r from-purple-600 to-purple-700 text-white hover:from-purple-700 hover:to-purple-800 transform hover:-translate-y-0.5;
            }
            .btn-outline {
                @apply bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400;
            }
            .btn-sm {
                @apply px-3 py-1.5 text-sm;
            }
            .action-buttons {
                @apply flex space-x-3;
            }
            
            /* Tab/Content Styles */
            .tabs-container {
                @apply bg-white p-6 rounded-2xl shadow-xl;
            }
            .tabs-header {
                @apply flex border-b-2 border-gray-200 mb-6;
            }
            .tab {
                @apply flex items-center px-6 py-3 cursor-pointer text-gray-500 font-medium transition-all duration-300 relative;
            }
            .tab.active {
                @apply text-purple-600;
            }
            .tab.active::after {
                content: '';
                @apply absolute bottom-0 left-0 w-full h-1 transform scale-x-100 transition-transform duration-300 rounded-t-full bg-gradient-to-r from-purple-500 to-purple-600;
            }
            .tab-content {
                @apply hidden;
            }
            .tab-content.active {
                @apply block;
            }
            .tab-header {
                @apply flex justify-between items-center mb-6 p-5 rounded-xl;
                background: linear-gradient(135deg, var(--section-light) 0%, #e9d5ff 100%);
                @apply border-l-4 border-purple-600 shadow-md;
            }
            .tab-title {
                @apply flex items-center space-x-3;
            }
            .tab-header h2 {
                @apply text-purple-900;
            }
            .tab-header i {
                @apply text-purple-600;
            }

            /* Course Card (Simplified View) */
            .courses-grid {
                @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6;
            }
            .course-card {
                @apply bg-white p-5 rounded-2xl shadow-lg border-2 border-purple-100 hover:shadow-2xl hover:border-purple-300 transition-all duration-300 transform hover:-translate-y-1;
                border-left: 4px solid var(--section-color);
            }
            .course-info h3 {
                @apply text-lg font-bold mb-1;
                background: linear-gradient(135deg, #7e22ce 0%, #9b59b6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .course-details {
                @apply text-sm space-y-1 mt-3;
            }
            
            /* Section Management Modal/List */
            .section-list-item {
                @apply flex justify-between items-center p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-white transition-all duration-150;
            }
            .section-details h4 {
                @apply text-base font-semibold text-gray-800 m-0;
            }
            .section-details p {
                @apply text-xs text-gray-500 m-0;
            }

            .badge-purple {
                @apply bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm;
            }
            .badge-success {
                @apply bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm;
            }
            
            /* User Assignment List (Specific Styling) */
            .user-item {
                @apply flex flex-col md:flex-row md:justify-between items-start md:items-center p-4 rounded-xl border border-gray-200 bg-white shadow-md hover:shadow-lg transition-all duration-200;
            }

            .user-item-header {
                @apply flex justify-between items-center w-full md:w-auto mb-3 md:mb-0;
            }

            .user-item .user-info-small .user-icon {
                @apply w-10 h-10 flex items-center justify-center rounded-full text-xl bg-purple-100 text-purple-500 ring-2 ring-purple-300;
            }
            
            /* Modal Styles */
            .modal {
                @apply fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden;
                backdrop-filter: blur(4px);
            }
            .modal-content {
                @apply bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 p-6 transform transition-all duration-300;
            }
            .modal-header {
                @apply flex justify-between items-center border-b-2 border-gray-200 pb-4 mb-4;
            }
            .modal-header h3 {
                @apply text-xl font-semibold text-gray-800 flex items-center;
            }
            .modal-header .close {
                @apply text-gray-400 hover:text-gray-600 text-2xl font-light leading-none cursor-pointer transition-colors duration-200;
            }
            .modal-footer {
                @apply flex justify-end space-x-3 pt-4 border-t-2 border-gray-200 mt-4;
            }
            
            footer {
                @apply text-center py-4 mt-8 text-sm text-white;
            }
        }
    </style>
    <div class="main-content">
        <div class="header">
            <h1>Section Management</h1>
            <div class="user-info">
                <div>
                    <h3>Dr. Admin User</h3>
                    <p>System Administrator</p>
                </div>
                <i class="fas fa-user-circle user-profile-icon"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-100">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <a href="#" class="text-blue-500 hover:text-blue-700"><i class="fas fa-home"></i> Dashboard</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span>Section Management</span>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <button class="btn btn-primary" id="addSectionBtn">
                        <i class="fas fa-plus"></i> Add New Section
                    </button>
                </div>
            </div>
        </div>
        
        <div class="form-card mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="m-0"><i class="fas fa-filter text-purple-600"></i> Filter Sections</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="form-group mb-0">
                    <label for="departmentFilter">Department</label>
                    <select id="departmentFilter" class="form-control">
                        <option value="">All Depts</option>
                        <option value="cs">Computer Science</option>
                        <option value="ee">Electrical Engineering</option>
                        <option value="me">Mechanical Engineering</option>
                        <option value="ce">Civil Engineering</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label for="courseFilter">Course</label>
                    <select id="courseFilter" class="form-control">
                        <option value="">All Courses</option>
                        <option value="cs101">CS101 - Intro Programming</option>
                        <option value="cs201">CS201 - Data Structures</option>
                        <option value="ee101">EE101 - Circuit Analysis</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label for="semesterFilter">Semester</label>
                    <select id="semesterFilter" class="form-control">
                        <option value="">All Semesters</option>
                        <option value="fall2023">Fall 2023</option>
                        <option value="spring2023">Spring 2023</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label for="statusFilter">Status</label>
                    <select id="statusFilter" class="form-control">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="tabs-container">
            <div class="tabs-header">
                <div class="tab active" data-tab="courses">
                    <i class="fas fa-book"></i>
                    <span>Courses & Sections</span>
                </div>
                <div class="tab" data-tab="users">
                    <i class="fas fa-users"></i>
                    <span>User Assignments</span>
                </div>
            </div>

            <div class="tab-content active" id="courses-tab">
                <div class="tab-header">
                    <div class="tab-title">
                        <i class="fas fa-sitemap"></i>
                        <h2>Active Course Sections Overview</h2>
                    </div>
                </div>

                <div class="courses-grid">
                    <div class="course-card" data-course-id="CS101" data-course-name="Introduction to Programming" data-sections="3">
                        <div class="course-header">
                            <div class="course-info">
                                <h3>CS101 - Intro to Programming</h3>
                                <span class="course-code">Computer Science</span>
                            </div>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Fundamental concepts of programming and algorithm development.</p>
                        <div class="course-details">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Credit Hours:</span>
                                <span class="font-semibold">3</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Total Sections:</span>
                                <span class="font-semibold text-purple-700">3</span>
                            </div>
                        </div>
                        <div class="action-buttons mt-4 justify-center">
                            <button class="btn btn-primary btn-sm manage-sections-btn" data-course-id="CS101">
                                <i class="fas fa-tasks"></i> Manage Sections
                            </button>
                        </div>
                    </div>

                    <div class="course-card" data-course-id="CS201" data-course-name="Data Structures" data-sections="2">
                        <div class="course-header">
                            <div class="course-info">
                                <h3>CS201 - Data Structures</h3>
                                <span class="course-code">Computer Science</span>
                            </div>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Study of data organization, storage, and retrieval techniques.</p>
                        <div class="course-details">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Credit Hours:</span>
                                <span class="font-semibold">3</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Total Sections:</span>
                                <span class="font-semibold text-purple-700">2</span>
                            </div>
                        </div>
                        <div class="action-buttons mt-4 justify-center">
                            <button class="btn btn-primary btn-sm manage-sections-btn" data-course-id="CS201">
                                <i class="fas fa-tasks"></i> Manage Sections
                            </button>
                        </div>
                    </div>

                    <div class="course-card" data-course-id="EE101" data-course-name="Circuit Analysis" data-sections="1">
                        <div class="course-header">
                            <div class="course-info">
                                <h3>EE101 - Circuit Analysis</h3>
                                <span class="course-code">Electrical Engineering</span>
                            </div>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Fundamental principles of electrical circuits and analysis.</p>
                        <div class="course-details">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Credit Hours:</span>
                                <span class="font-semibold">4</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Total Sections:</span>
                                <span class="font-semibold text-purple-700">1</span>
                            </div>
                        </div>
                        <div class="action-buttons mt-4 justify-center">
                            <button class="btn btn-primary btn-sm manage-sections-btn" data-course-id="EE101">
                                <i class="fas fa-tasks"></i> Manage Sections
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="users-tab">
                <div class="tab-header">
                    <div class="tab-title">
                        <i class="fas fa-user-tie"></i>
                        <h2>Lecturer Section Assignments</h2>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="user-item">
                        <div class="user-item-header">
                            <div class="user-info-small">
                                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                                <div class="user-details">
                                    <h4>Dr. Sarah Johnson (L001)</h4>
                                    <p>Course Leader & Lecturer</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="badge badge-purple">3 Sections</span>
                            <button class="btn btn-primary btn-sm manage-user-btn" data-user-id="L001">Manage</button>
                        </div>
                    </div>
                    
                    <div class="user-item">
                        <div class="user-item-header">
                            <div class="user-info-small">
                                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                                <div class="user-details">
                                    <h4>Dr. Michael Brown (L002)</h4>
                                    <p>Course Leader & Lecturer</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="badge badge-purple">2 Sections</span>
                            <button class="btn btn-primary btn-sm manage-user-btn" data-user-id="L002">Manage</button>
                        </div>
                    </div>
                    
                    <div class="user-item">
                        <div class="user-item-header">
                            <div class="user-info-small">
                                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                                <div class="user-details">
                                    <h4>Dr. Emily Davis (L003)</h4>
                                    <p>Lecturer</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="badge badge-purple">1 Section</span>
                            <button class="btn btn-primary btn-sm manage-user-btn" data-user-id="L003">Manage</button>
                        </div>
                    </div>
                    
                    <div class="user-item">
                        <div class="user-item-header">
                            <div class="user-info-small">
                                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                                <div class="user-details">
                                    <h4>Dr. Robert Wilson (L004)</h4>
                                    <p>Course Leader</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="badge badge-purple">1 Section</span>
                            <button class="btn btn-primary btn-sm manage-user-btn" data-user-id="L004">Manage</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addSectionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="addEditModalTitle"><i class="fas fa-plus-circle text-purple-600"></i> Add New Section</h3>
                <span class="close" data-modal="addSectionModal">&times;</span>
            </div>
            <form id="sectionForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="sectionCourse">Course</label>
                        <select id="sectionCourse" class="form-control" required>
                            <option value="">Select Course</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionCode">Section Code</label>
                        <input type="text" id="sectionCode" class="form-control" placeholder="e.g., A, B, C" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="courseLeader">Course Leader</label>
                        <select id="courseLeader" class="form-control" required>
                            <option value="">Select Course Leader</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lecturer">Lecturer</label>
                        <select id="lecturer" class="form-control">
                            <option value="">Select Lecturer</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="sectionCapacity">Capacity</label>
                        <input type="number" id="sectionCapacity" class="form-control" placeholder="Maximum students" min="1" max="100">
                    </div>
                    <div class="form-group">
                        <label for="sectionSchedule">Schedule</label>
                        <input type="text" id="sectionSchedule" class="form-control" placeholder="e.g., Mon-Wed-Fri 10:00 AM">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="sectionLocation">Location</label>
                    <input type="text" id="sectionLocation" class="form-control" placeholder="Classroom or Lab">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal" data-modal="addSectionModal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="addEditSubmitBtn">Add Section</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal" id="manageSectionsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="manageModalTitle"><i class="fas fa-tasks text-purple-600"></i> Manage Sections for [Course Name]</h3>
                <span class="close" data-modal="manageSectionsModal">&times;</span>
            </div>
            <div class="mb-4 flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                <p class="text-sm text-gray-700 font-semibold">Course Leader: <span id="courseLeaderDisplay">Dr. Sarah Johnson (L001)</span></p>
                <button class="btn btn-primary btn-sm add-new-section-small-btn">
                    <i class="fas fa-plus"></i> Add Section
                </button>
            </div>
            
            <h4 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2"><i class="fas fa-stream text-purple-500"></i> Current Sections</h4>
            <div id="currentSectionsList" class="space-y-3 max-h-80 overflow-y-auto">
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline close-modal" data-modal="manageSectionsModal">Close</button>
            </div>
        </div>
    </div>
    
    <div class="modal" id="manageUserModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="manageUserModalTitle"><i class="fas fa-user-tie text-purple-600"></i> Assignments for [Lecturer Name]</h3>
                <span class="close" data-modal="manageUserModal">&times;</span>
            </div>
            <div id="userAssignmentDetails">
                <h4 class="text-lg font-bold text-gray-700 mb-3 border-b pb-2"><i class="fas fa-chalkboard-teacher text-purple-500"></i> Assigned Sections (3)</h4>
                <div id="userSectionsList" class="space-y-3 max-h-80 overflow-y-auto">
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline close-modal" data-modal="manageUserModal">Close</button>
            </div>
        </div>
    </div>


    <script>
        // Simulated Data (Extended for sections and user assignments)
        const courses = [
            { id: "CS101", name: "Introduction to Programming", dept: "Computer Science", credits: 3, description: "Fundamental concepts of programming and algorithm development.", leader: "Dr. Sarah Johnson (L001)" },
            { id: "CS201", name: "Data Structures", dept: "Computer Science", credits: 3, description: "Study of data organization, storage, and retrieval techniques.", leader: "Dr. Michael Brown (L002)" },
            { id: "EE101", name: "Circuit Analysis", dept: "Electrical Engineering", credits: 4, description: "Fundamental principles of electrical circuits and analysis.", leader: "Dr. Robert Wilson (L004)" }
        ];

        const lecturers = [
            { id: "L001", name: "Dr. Sarah Johnson", role: "Course Leader & Lecturer" },
            { id: "L002", name: "Dr. Michael Brown", role: "Course Leader & Lecturer" },
            { id: "L003", name: "Dr. Emily Davis", role: "Lecturer" },
            { id: "L004", name: "Dr. Robert Wilson", role: "Course Leader" },
            { id: "L005", name: "Dr. Lisa Anderson", role: "Lecturer" },
            { id: "L006", name: "Dr. James Wilson", role: "Lecturer" },
            { id: "L007", name: "Not Assigned", role: "N/A" }
        ];
        
        const sectionsData = {
            "CS101": [
                { id: "CS101-A", code: "A", leaderId: "L001", lecturerId: "L002", schedule: "Mon/Wed 10:00 AM", capacity: 40 },
                { id: "CS101-B", code: "B", leaderId: "L001", lecturerId: "L003", schedule: "Tue/Thu 1:00 PM", capacity: 35 },
                { id: "CS101-C", code: "C", leaderId: "L001", lecturerId: "L007", schedule: "Fri 9:00 AM", capacity: 30 }
            ],
            "CS201": [
                { id: "CS201-A", code: "A", leaderId: "L002", lecturerId: "L001", schedule: "Mon/Wed 1:00 PM", capacity: 45 },
                { id: "CS201-B", code: "B", leaderId: "L002", lecturerId: "L006", schedule: "Tue/Thu 11:00 AM", capacity: 45 }
            ],
            "EE101": [
                { id: "EE101-A", code: "A", leaderId: "L004", lecturerId: "L005", schedule: "Mon/Wed/Fri 2:00 PM", capacity: 50 }
            ]
        };

        // --- Utility Functions ---
        function getLecturerName(id) {
            const lecturer = lecturers.find(l => l.id === id);
            return lecturer ? `${lecturer.name} (${lecturer.id})` : 'Not Assigned';
        }
        
        // Populate Course and Lecturer dropdowns in the Add/Edit Section Modal
        function populateDropdowns() {
            const courseSelect = document.getElementById('sectionCourse');
            const leaderSelect = document.getElementById('courseLeader');
            const lecturerSelect = document.getElementById('lecturer');

            // Clear previous options
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            leaderSelect.innerHTML = '<option value="">Select Course Leader</option>';
            lecturerSelect.innerHTML = '<option value="">Select Lecturer</option>';

            // Populate Course options
            courses.forEach(course => {
                const option = document.createElement('option');
                option.value = course.id;
                option.textContent = `${course.id} - ${course.name}`;
                courseSelect.appendChild(option);
            });

            // Populate Lecturer/Leader options
            lecturers.forEach(lecturer => {
                const value = `${lecturer.name} (${lecturer.id})`;
                const option = document.createElement('option');
                option.value = lecturer.id;
                option.textContent = value;
                
                // Add to Leader and Lecturer dropdowns
                leaderSelect.appendChild(option.cloneNode(true));
                if (lecturer.id !== "L007") { // Don't allow "Not Assigned" as a lecturer
                    lecturerSelect.appendChild(option);
                }
            });
        }
        
        // --- Modal Control Functions ---
        function openModal(modal) {
            modal.style.display = 'flex';
        }

        function closeModal(modal) {
            modal.style.display = 'none';
        }

        function setupModalCloseListeners() {
            document.querySelectorAll('.close, .close-modal').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const modalId = e.currentTarget.getAttribute('data-modal');
                    // Check for closest modal if data-modal isn't directly on the button
                    const modalElement = document.getElementById(modalId) || e.currentTarget.closest('.modal');
                    if (modalElement) {
                        closeModal(modalElement);
                    }
                });
            });

            window.addEventListener('click', (e) => {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (e.target === modal) {
                        closeModal(modal);
                    }
                });
            });
        }
        
        // --- Manage Sections Modal Logic ---
        function handleManageSections(courseId, courseName, courseLeader) {
            const modal = document.getElementById('manageSectionsModal');
            document.getElementById('manageModalTitle').textContent = `Manage Sections for ${courseId} - ${courseName}`;
            document.getElementById('courseLeaderDisplay').textContent = courseLeader;

            const sectionsListContainer = document.getElementById('currentSectionsList');
            sectionsListContainer.innerHTML = '';
            const sections = sectionsData[courseId] || [];

            if (sections.length > 0) {
                sections.forEach(section => {
                    const leaderName = getLecturerName(section.leaderId);
                    const lecturerName = getLecturerName(section.lecturerId);
                    
                    const listItem = document.createElement('div');
                    listItem.className = 'section-list-item';
                    listItem.innerHTML = `
                        <div class="section-details">
                            <h4>Section ${section.code}</h4>
                            <p>Leader: ${leaderName} | Lecturer: ${lecturerName}</p>
                            <p class="text-xs text-purple-500 mt-1"><i class="fas fa-clock mr-1"></i> ${section.schedule} | <i class="fas fa-users mr-1"></i> Capacity: ${section.capacity}</p>
                        </div>
                        <div class="section-actions">
                            <button class="btn btn-outline btn-sm edit-section-in-manage" data-section-id="${section.id}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-section-btn" data-section-id="${section.id}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    `;
                    sectionsListContainer.appendChild(listItem);
                });
            } else {
                 sectionsListContainer.innerHTML = '<p class="text-center text-gray-500 py-4 italic"><i class="fas fa-info-circle mr-2"></i> No sections currently created for this course.</p>';
            }

            // Re-attach listeners for buttons inside the managed list
            sectionsListContainer.querySelectorAll('.edit-section-in-manage').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const sectionId = e.currentTarget.getAttribute('data-section-id');
                    alert(`Simulated: Opening edit form for Section ID: ${sectionId}`);
                    // In a real app, you would populate addSectionModal as an edit form and open it
                });
            });
            sectionsListContainer.querySelectorAll('.delete-section-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const sectionId = e.currentTarget.getAttribute('data-section-id');
                    if (confirm(`Are you sure you want to delete Section ID: ${sectionId}?`)) {
                        alert(`Simulated: Section ${sectionId} deleted.`);
                        e.target.closest('.section-list-item').remove();
                    }
                });
            });
            
            // Add listener to the small "Add Section" button inside the management modal
            document.querySelector('.add-new-section-small-btn').onclick = () => {
                closeModal(modal);
                // Set Add/Edit modal title and button text for adding
                document.getElementById('addEditModalTitle').innerHTML = '<i class="fas fa-plus-circle text-purple-600"></i> Add New Section';
                document.getElementById('addEditSubmitBtn').textContent = 'Add Section';
                document.getElementById('sectionCourse').value = courseId; // Pre-select the course
                document.getElementById('sectionForm').reset(); // Clear form inputs
                openModal(document.getElementById('addSectionModal'));
            };

            openModal(modal);
        }
        
        // --- Manage User Assignments Modal Logic ---
        function handleManageUserAssignments(userId) {
            const modal = document.getElementById('manageUserModal');
            const user = lecturers.find(l => l.id === userId);
            
            document.getElementById('manageUserModalTitle').textContent = `Assignments for ${user.name} (${user.id})`;

            const userSectionsList = document.getElementById('userSectionsList');
            userSectionsList.innerHTML = '';
            
            let assignedSections = [];
            let totalSections = 0;
            
            for (const courseId in sectionsData) {
                sectionsData[courseId].forEach(section => {
                    if (section.leaderId === userId || section.lecturerId === userId) {
                        const isLeader = section.leaderId === userId;
                        assignedSections.push({
                            ...section,
                            courseId: courseId,
                            isLeader: isLeader,
                            courseName: courses.find(c => c.id === courseId).name
                        });
                        totalSections++;
                    }
                });
            }
            
            document.querySelector('#userAssignmentDetails h4').textContent = `Assigned Sections (${totalSections})`;

            if (assignedSections.length > 0) {
                assignedSections.forEach(section => {
                    const role = section.isLeader ? 'Course Leader' : 'Lecturer';
                    
                    const listItem = document.createElement('div');
                    listItem.className = 'section-list-item border-l-4 border-purple-400';
                    listItem.innerHTML = `
                        <div class="section-details">
                            <h4 class="text-purple-700">${section.courseId}-${section.code} - ${section.courseName}</h4>
                            <p class="text-xs mt-1">Role: <span class="font-semibold text-purple-600">${role}</span></p>
                            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i> ${section.schedule}</p>
                        </div>
                        <div class="section-actions">
                            <button class="btn btn-outline btn-sm" onclick="alert('Simulated: Unassigning ${user.name} from ${section.courseId}-${section.code}')">
                                <i class="fas fa-user-minus"></i> Unassign
                            </button>
                        </div>
                    `;
                    userSectionsList.appendChild(listItem);
                });
            } else {
                 userSectionsList.innerHTML = '<p class="text-center text-gray-500 py-4 italic"><i class="fas fa-info-circle mr-2"></i> This user is not currently assigned to any sections.</p>';
            }

            openModal(modal);
        }

        // --- Main Initialization ---
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Setup global functionality
            setupModalCloseListeners();
            populateDropdowns();

            // 2. Setup button listeners for Course Management tab
            document.querySelectorAll('.manage-sections-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const courseId = e.currentTarget.getAttribute('data-course-id');
                    const card = e.currentTarget.closest('.course-card');
                    // Use a fallback for courseName if not directly stored in the card for brevity
                    const courseData = courses.find(c => c.id === courseId);
                    const courseName = courseData ? courseData.name : card.getAttribute('data-course-name');
                    const courseLeader = courseData ? courseData.leader : "Not Found";
                    handleManageSections(courseId, courseName, courseLeader);
                });
            });

            // 3. Setup button listeners for User Assignments tab
            document.querySelectorAll('.manage-user-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const userId = e.currentTarget.getAttribute('data-user-id');
                    handleManageUserAssignments(userId);
                });
            });

            // 4. Tab functionality
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabId = tab.getAttribute('data-tab');
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    tab.classList.add('active');
                    document.getElementById(`${tabId}-tab`).classList.add('active');
                });
            });
            
            // 5. Add New Section button (initial modal trigger)
            const addSectionBtn = document.getElementById('addSectionBtn');
            const addSectionModal = document.getElementById('addSectionModal');
            addSectionBtn.addEventListener('click', () => {
                document.getElementById('sectionForm').reset();
                document.getElementById('addEditModalTitle').innerHTML = '<i class="fas fa-plus-circle text-purple-600"></i> Add New Section';
                document.getElementById('addEditSubmitBtn').textContent = 'Add Section';
                openModal(addSectionModal);
            });
            
            // 6. Form Submission (Simulated)
            const sectionForm = document.getElementById('sectionForm');
            sectionForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const courseId = document.getElementById('sectionCourse').value;
                const sectionCode = document.getElementById('sectionCode').value;
                alert(`Section ${courseId}-${sectionCode} saved successfully! (Simulated)`);
                closeModal(addSectionModal);
            });
        });
    </script>
@endsection