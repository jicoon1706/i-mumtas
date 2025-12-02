@extends('layouts.lecturer')

@section('title', 'Dashboard - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer base {
            /* Define all CSS variables from the Section Management Page */
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
                
                --section-color: #9b59b6; /* Purple for Sections/CLOs */
                --section-light: #f3e8ff;
            }

            body {
                /* Matching gradient background from Section Management page */
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
                /* Remove sidebar margin as this page contains its own sidebar HTML */
                @apply p-8 flex-1; 
                margin-left: 0; /* Override JS-driven margin for the CLO page structure */
                min-height: 100vh;
                padding-top: 20px;
            }

            .header {
                /* Matching header style */
                @apply flex justify-between items-center bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-100;
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            }

            .user-info {
                @apply flex items-center space-x-3;
            }
            .user-profile-icon {
                /* Re-style for generic user info in this page */
                @apply w-12 h-12 flex items-center justify-center rounded-full text-2xl bg-blue-100 text-blue-500 ring-4 ring-blue-500 ring-offset-2;
            }
            .user-info h3 {
                @apply text-sm font-semibold m-0;
            }
            .user-info p {
                @apply text-xs text-gray-500 m-0;
            }

            /* Breadcrumb style */
            .breadcrumb {
                @apply bg-white p-6 rounded-2xl shadow-lg mb-8 border border-gray-100;
            }
            
            /* Filtering and Card Styles (Reusing form-card structure) */
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
                /* Adjusted for CLO page controls, ensuring purple focus ring */
                @apply block w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition-all duration-200;
            }

            /* Buttons */
            .btn {
                @apply px-5 py-2.5 rounded-xl font-medium transition-all duration-200 cursor-pointer text-center shadow-md hover:shadow-xl;
            }
            .btn-primary {
                /* Purple gradient primary button */
                @apply bg-gradient-to-r from-purple-600 to-purple-700 text-white hover:from-purple-700 hover:to-purple-800 transform hover:-translate-y-0.5;
            }
            .btn-outline {
                @apply bg-white border-2 border-purple-300 text-purple-700 hover:bg-purple-50 hover:border-purple-400;
            }
            .btn-success {
                @apply bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 transform hover:-translate-y-0.5;
            }
            .btn-danger {
                @apply bg-red-500 text-white hover:bg-red-600;
            }
            .btn-sm {
                @apply px-3 py-1.5 text-sm;
            }
            .action-buttons {
                @apply flex space-x-3;
            }

            /* Course Card (Replicating the Section Management style) */
            .courses-grid {
                @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6;
            }
            .course-card {
                /* Use Purple accent for CLO page */
                @apply bg-white p-5 rounded-2xl shadow-lg border-2 border-purple-100 hover:shadow-2xl hover:border-purple-300 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer;
                border-left: 4px solid var(--section-color);
            }
            .course-card h3 {
                @apply text-lg font-bold mb-1;
                /* Apply purple gradient text color */
                background: linear-gradient(135deg, #7e22ce 0%, #9b59b6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .course-code {
                /* Matching badge style */
                @apply bg-purple-100 text-purple-800 px-2 py-0.5 rounded text-xs font-medium;
            }
            .badge-success {
                @apply bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs font-semibold shadow-sm;
            }
            .course-details {
                 @apply text-sm space-y-1 mt-3;
            }
             .clo-count {
                /* Consistent color for CLO count */
                @apply text-purple-700 font-semibold;
            }
            
            /* CLO Management Header */
            .clo-header {
                @apply flex justify-between items-center mb-6 p-5 rounded-xl;
                background: linear-gradient(135deg, var(--section-light) 0%, #e9d5ff 100%);
                @apply border-l-4 border-purple-600 shadow-md;
            }
            .clo-title h2 {
                @apply text-purple-900;
            }
            .clo-title i {
                @apply text-purple-600;
            }

            /* CLO Item in Table (Badges, etc.) */
            .data-table th {
                @apply py-3 px-4 text-left bg-purple-50 text-purple-800 font-semibold text-sm;
            }
            .data-table td {
                @apply py-3 px-4 text-sm text-gray-700;
            }
            .data-table tr {
                @apply border-b border-gray-100 hover:bg-purple-50 transition-colors duration-200;
            }
            .plo-badge {
                /* New badge style matching the Section Management purple badge */
                @apply bg-purple-100 text-purple-800 px-2 py-0.5 rounded-xl text-xs font-medium shadow-sm;
            }
            
            /* PLO Selection Grid - Adjusted to use the new purple-based colors */
            .plo-item {
                @apply flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer transition-all duration-300 ease-in-out hover:border-purple-500 hover:bg-purple-50;
            }
            .plo-item .plo-info h4 {
                @apply text-gray-800;
            }
            .plo-item.selected {
                border-color: var(--section-color);
                background-color: var(--section-light); /* Light purple background */
            }
            .plo-item.selected .plo-checkbox {
                background-color: var(--section-color);
                border-color: var(--section-color);
            }
            .plo-item.selected .plo-checkbox:after {
                content: '✓';
                color: white;
                font-size: 12px;
            }
            /* End of Section Management Style Integration */
        }
        
        /* Custom Styles (Keep as is, they mostly rely on the theme changes above) */
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Responsive Sidebar Toggle (Simplified for display) */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px !important;
            }
            .sidebar .logo h2, .sidebar .nav-links span {
                display: none !important;
            }
            .main-content {
                margin-left: 80px !important;
            }
            .nav-links li {
                text-align: center;
                padding: 15px 10px !important;
            }
            .nav-links a {
                justify-content: center !important;
            }
        }
        
        /* CLO Management Toggle */
        .clo-management {
            display: none;
        }
        .clo-management.active {
            display: block;
        }
    </style>
<div class="header">
            <h1>CLO Management</h1>
            <div class="user-info">
                <div>
                    <h3>Dr. Sarah Johnson</h3>
                    <p>Course Leader</p>
                </div>
                <i class="fas fa-user-circle user-profile-icon"></i>
            </div>
        </div>

        <div class="breadcrumb">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <a href="#" class="text-purple-500 hover:text-purple-700"><i class="fas fa-home"></i> Dashboard</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span>CLO Management</span>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="addCloBtn">
                        <i class="fas fa-plus"></i> Add New CLO
                    </button>
                    <button class="btn btn-outline" onclick="window.location.reload()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
        </div>

        <div id="courses-list">
            <h2 class="text-secondary text-xl font-semibold mb-5">Select a Course to Manage CLOs</h2>
            
            <div class="courses-grid">
                <div class="course-card" data-course="CS101">
                    <div class="course-header flex justify-between items-start mb-4">
                        <div class="course-info">
                            <h3>CS101 - Introduction to Programming</h3>
                            <span class="course-code">Computer Science</span>
                        </div>
                        <span class="badge-success">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Fundamental concepts of programming and algorithm development.</p>
                    <div class="course-details">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Department:</span>
                            <span class="font-semibold">Computer Science</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Credit Hours:</span>
                            <span class="font-semibold">3</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Semester:</span>
                            <span class="font-semibold">Fall 2023</span>
                        </div>
                    </div>
                    <div class="clo-count flex items-center gap-1 mt-3">
                        <i class="fas fa-bullseye"></i>
                        <span data-clo-count="CS101">4 CLOs defined</span>
                    </div>
                </div>

                <div class="course-card" data-course="CS201">
                    <div class="course-header flex justify-between items-start mb-4">
                        <div class="course-info">
                            <h3>CS201 - Data Structures</h3>
                            <span class="course-code">Computer Science</span>
                        </div>
                        <span class="badge-success">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Study of data organization, storage, and retrieval techniques.</p>
                    <div class="course-details">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Department:</span>
                            <span class="font-semibold">Computer Science</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Credit Hours:</span>
                            <span class="font-semibold">3</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Semester:</span>
                            <span class="font-semibold">Fall 2023</span>
                        </div>
                    </div>
                    <div class="clo-count flex items-center gap-1 mt-3">
                        <i class="fas fa-bullseye"></i>
                        <span data-clo-count="CS201">3 CLOs defined</span>
                    </div>
                </div>

                <div class="course-card" data-course="CS301">
                    <div class="course-header flex justify-between items-start mb-4">
                        <div class="course-info">
                            <h3>CS301 - Algorithms</h3>
                            <span class="course-code">Computer Science</span>
                        </div>
                        <span class="badge-success">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Design and analysis of efficient algorithms for problem solving.</p>
                    <div class="course-details">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Department:</span>
                            <span class="font-semibold">Computer Science</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Credit Hours:</span>
                            <span class="font-semibold">3</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Semester:</span>
                            <span class="font-semibold">Fall 2023</span>
                        </div>
                    </div>
                    <div class="clo-count flex items-center gap-1 mt-3">
                        <i class="fas fa-bullseye"></i>
                        <span data-clo-count="CS301">5 CLOs defined</span>
                    </div>
                </div>

                <div class="course-card" data-course="EE101">
                    <div class="course-header flex justify-between items-start mb-4">
                        <div class="course-info">
                            <h3>EE101 - Circuit Analysis</h3>
                            <span class="course-code">Electrical Engineering</span>
                        </div>
                        <span class="badge-success">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Fundamental principles of electrical circuits and analysis.</p>
                    <div class="course-details">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Department:</span>
                            <span class="font-semibold">Electrical Engineering</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Credit Hours:</span>
                            <span class="font-semibold">4</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Semester:</span>
                            <span class="font-semibold">Fall 2023</span>
                        </div>
                    </div>
                    <div class="clo-count flex items-center gap-1 mt-3">
                        <i class="fas fa-bullseye"></i>
                        <span data-clo-count="EE101">2 CLOs defined</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clo-management" id="clo-management">
            <div class="clo-header">
                <div class="clo-title">
                    <i class="fas fa-bullseye"></i>
                    <h2 id="current-course-title">CLO Management for <span id="course-name"></span></h2>
                </div>
                <button class="btn btn-outline btn-sm" id="back-to-courses">
                    <i class="fas fa-arrow-left"></i> Back to Courses
                </button>
            </div>

            <div class="form-container grid grid-cols-1 gap-6 mb-8">
                <div class="form-card">
                    <h3 class="flex items-center space-x-2"><i class="fas fa-plus-circle text-purple-600"></i> Add New CLO</h3>
                    <form id="cloForm">
                        <div class="form-group">
                            <label for="cloCode">CLO Code</label>
                            <input type="text" id="cloCode" class="form-control" placeholder="e.g., CLO1, CLO2" required>
                        </div>
                        <div class="form-group">
                            <label for="cloDescription">CLO Description</label>
                            <textarea id="cloDescription" class="form-control min-h-[100px] resize-y" placeholder="Describe the learning outcome..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cloLevel">Cognitive Level</label>
                            <select id="cloLevel" class="form-control" required>
                                <option value="">Select Cognitive Level</option>
                                <option value="knowledge">Knowledge</option>
                                <option value="comprehension">Comprehension</option>
                                <option value="application">Application</option>
                                <option value="analysis">Analysis</option>
                                <option value="synthesis">Synthesis</option>
                                <option value="evaluation">Evaluation</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-full mt-4 flex justify-center items-center space-x-2">
                            <i class="fas fa-save"></i> Add CLO
                        </button>
                    </form>
                </div>
            </div>

            <div class="clo-list">
                <h3 class="text-gray-800 font-bold mb-4 flex items-center space-x-2 text-xl border-b pb-2"><i class="fas fa-list text-purple-600"></i> Existing CLOs for this Course</h3>
                <div class="table-container overflow-x-auto bg-white rounded-2xl shadow-xl border border-gray-100">
                    <table class="data-table w-full">
                        <thead>
                            <tr>
                                <th>CLO Code</th>
                                <th>Description</th>
                                <th>Cognitive Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clo-table-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="action-buttons flex justify-end gap-4 mt-8">
                <button class="btn btn-outline flex items-center space-x-2" onclick="resetFormToAddMode()">
                    <i class="fas fa-undo"></i> Reset Form
                </button>
                <button class="btn btn-primary flex items-center space-x-2">
                    <i class="fas fa-save"></i> Save All Changes
                </button>
            </div>
        </div>

    <script>
        const sampleClos = {
            'CS101': [
                { code: 'CLO1', description: 'Explain fundamental programming concepts and constructs', level: 'knowledge' },
                { code: 'CLO2', description: 'Design and implement simple algorithms to solve problems', level: 'application' },
                { code: 'CLO3', description: 'Apply debugging techniques to identify and fix code errors', level: 'application' },
                { code: 'CLO4', description: 'Demonstrate understanding of data types and control structures', level: 'comprehension' }
            ],
            'CS201': [
                { code: 'CLO1', description: 'Analyze time and space complexity of algorithms', level: 'analysis' },
                { code: 'CLO2', description: 'Implement various data structures and their operations', level: 'application' },
                { code: 'CLO3', description: 'Compare and contrast different data structure implementations', level: 'evaluation' }
            ],
            'CS301': [
                { code: 'CLO1', description: 'Design efficient algorithms for computational problems', level: 'synthesis' },
                { code: 'CLO2', description: 'Analyze algorithm correctness and complexity', level: 'analysis' },
                { code: 'CLO3', description: 'Apply algorithmic strategies to solve complex problems', level: 'application' },
                { code: 'CLO4', description: 'Evaluate algorithm performance in different scenarios', level: 'evaluation' },
                { code: 'CLO5', description: 'Explain fundamental algorithmic paradigms', level: 'knowledge' }
            ],
            'EE101': [
                { code: 'CLO1', description: 'Apply circuit laws and theorems to analyze electrical circuits', level: 'application' },
                { code: 'CLO2', description: 'Design simple electrical circuits for specific applications', level: 'synthesis' }
            ]
        };

        let currentCourse = '';
        let currentClos = [];

        const coursesList = document.getElementById('courses-list');
        const cloManagement = document.getElementById('clo-management');
        const backToCoursesBtn = document.getElementById('back-to-courses');
        const courseNameSpan = document.getElementById('course-name');
        const cloForm = document.getElementById('cloForm');
        const cloTableBody = document.getElementById('clo-table-body');
        const addCloBtnInitial = document.getElementById('addCloBtn');

        function loadClosForCourse(courseCode) {
            currentCourse = courseCode;
            currentClos = JSON.parse(JSON.stringify(sampleClos[courseCode] || []));
            const courseCard = document.querySelector(`.course-card[data-course="${courseCode}"]`);
            const courseTitle = courseCard ? courseCard.querySelector('h3').textContent.replace(`${courseCode} - `, '') : 'Unknown Course';

            courseNameSpan.textContent = `${courseCode} - ${courseTitle}`;
            
            document.querySelector('.breadcrumb span').innerHTML = `CLO Management for ${courseCode}`;
            
            coursesList.style.display = 'none';
            cloManagement.classList.add('active');
            
            renderCloTable();
            resetFormToAddMode();
        }

        function renderCloTable() {
            cloTableBody.innerHTML = '';
            
            if (currentClos.length === 0) {
                cloTableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="py-3 text-center text-gray-500 italic bg-white">
                            No CLOs defined for this course yet. Add your first CLO using the form above.
                        </td>
                    </tr>
                `;
                return;
            }
            
            currentClos.forEach(clo => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${clo.code}</td>
                    <td>${clo.description}</td>
                    <td><span class="font-semibold text-purple-600">${capitalizeFirstLetter(clo.level)}</span></td>
                    <td>
                        <button class="btn btn-outline btn-sm edit-clo-btn flex items-center space-x-1" data-clo-code="${clo.code}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-clo-btn flex items-center space-x-1 mt-1" data-clo-code="${clo.code}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
                
                cloTableBody.appendChild(row);
            });
            
            addCloActionListeners();
        }

        function addCloActionListeners() {
            document.querySelectorAll('.edit-clo-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cloCode = this.dataset.cloCode;
                    editClo(cloCode);
                });
            });
            
            document.querySelectorAll('.delete-clo-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cloCode = this.dataset.cloCode;
                    deleteClo(cloCode);
                });
            });
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function resetFormToAddMode() {
            cloForm.reset();
            document.querySelector('.form-card h3').innerHTML = '<i class="fas fa-plus-circle text-purple-600"></i> Add New CLO';
            document.querySelector('.btn-success').innerHTML = '<i class="fas fa-save"></i> Add CLO';
            cloForm.onsubmit = handleAddClo;
        }

        function addClo(cloData) {
            currentClos.push(cloData);
            renderCloTable();
            resetFormToAddMode();
            alert(`CLO ${cloData.code} added successfully! (Simulated)`);
        }

        function editClo(cloCode) {
            const clo = currentClos.find(c => c.code === cloCode);
            if (clo) {
                document.getElementById('cloCode').value = clo.code;
                document.getElementById('cloDescription').value = clo.description;
                document.getElementById('cloLevel').value = clo.level;
                
                document.querySelector('.form-card h3').innerHTML = '<i class="fas fa-edit text-purple-600"></i> Edit CLO';
                document.querySelector('.btn-success').innerHTML = '<i class="fas fa-save"></i> Update CLO';
                
                cloForm.onsubmit = function(e) {
                    e.preventDefault();
                    updateClo(cloCode);
                };
            }
        }

        function updateClo(oldCloCode) {
            const cloCode = document.getElementById('cloCode').value;
            const description = document.getElementById('cloDescription').value;
            const level = document.getElementById('cloLevel').value;
            
            if (!cloCode || !description || !level) {
                alert('Please fill out all fields.');
                return;
            }

            currentClos = currentClos.filter(c => c.code !== oldCloCode);
            
            const updatedClo = {
                code: cloCode,
                description: description,
                level: level
            };
            
            currentClos.push(updatedClo);
            renderCloTable();
            resetFormToAddMode();
            
            alert(`CLO ${cloCode} updated successfully! (Simulated)`);
        }

        function deleteClo(cloCode) {
            if (confirm(`Are you sure you want to delete ${cloCode}?`)) {
                currentClos = currentClos.filter(c => c.code !== cloCode);
                renderCloTable();
                if (document.getElementById('cloCode').value === cloCode) {
                    resetFormToAddMode();
                }
                alert(`CLO ${cloCode} deleted successfully! (Simulated)`);
            }
        }

        function handleAddClo(e) {
            e.preventDefault();
            
            const cloCode = document.getElementById('cloCode').value;
            const description = document.getElementById('cloDescription').value;
            const level = document.getElementById('cloLevel').value;
            
            if (!cloCode || !description || !level) {
                alert('Please fill out all fields.');
                return;
            }
            
            const newClo = {
                code: cloCode,
                description: description,
                level: level
            };
            
            addClo(newClo);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.course-card').forEach(card => {
                card.addEventListener('click', function() {
                    const courseCode = this.dataset.course;
                    loadClosForCourse(courseCode);
                });
            });
            
            backToCoursesBtn.addEventListener('click', function() {
                cloManagement.classList.remove('active');
                coursesList.style.display = 'block';
                document.querySelector('.breadcrumb span').textContent = 'CLO Management';
                resetFormToAddMode();
            });
            
            addCloBtnInitial.addEventListener('click', () => {
                if (currentCourse && cloManagement.classList.contains('active')) {
                    resetFormToAddMode();
                    document.getElementById('cloCode').focus();
                } else {
                    alert('Please select a course from the grid below first to add a CLO.');
                }
            });

            cloForm.onsubmit = handleAddClo;
            
            for (const courseId in sampleClos) {
                const count = sampleClos[courseId].length;
                const countElement = document.querySelector(`.clo-count span[data-clo-count="${courseId}"]`);
                if (countElement) {
                    countElement.textContent = `${count} CLOs defined`;
                }
            }
        });
    </script>
@endsection