@extends('layouts.admin')

@section('title', 'Term Details - EduManage')

@section('content')
<style type="text/tailwindcss">
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

    @layer components {
        .page-header {
            @apply bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .breadcrumb-card {
            @apply bg-white p-4 rounded-xl shadow-md mb-6 border border-gray-100;
        }

        .breadcrumb-nav {
            @apply flex items-center gap-2 text-sm text-gray-600;
        }

        .breadcrumb-nav a {
            @apply text-teal-600 hover:text-teal-700 font-medium transition-colors;
        }

        .upload-section {
            @apply bg-gradient-to-br from-white via-blue-50 to-purple-50 rounded-2xl shadow-xl p-8 mb-8 border-2 border-gray-100;
        }

        .section-title {
            @apply text-2xl font-bold text-gray-800 mb-6 pb-4 border-b-2 border-gray-200 flex items-center gap-3;
        }

        .upload-card {
            @apply bg-white rounded-xl shadow-lg p-6 border-2 border-dashed border-blue-300 hover:border-blue-500 transition-all duration-300;
        }

        .upload-area {
            @apply text-center py-12 cursor-pointer hover:bg-blue-50 rounded-xl transition-all;
        }

        .download-btn {
            @apply bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3.5 rounded-xl font-semibold shadow-lg;
            @apply hover:from-emerald-700 hover:to-emerald-800 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl;
            @apply flex items-center justify-center gap-2;
        }

        .upload-btn {
            @apply bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-3.5 rounded-xl font-semibold shadow-lg;
            @apply hover:from-purple-700 hover:to-purple-800 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl;
            @apply flex items-center justify-center gap-2;
        }

        .students-section {
            @apply bg-white rounded-2xl shadow-xl p-8 border border-gray-100;
        }

        .table-container {
            @apply overflow-x-auto rounded-xl border-2 border-gray-200;
        }

        .student-table {
            @apply w-full border-collapse;
        }

        .student-table thead {
            @apply bg-gradient-to-r from-purple-600 to-purple-700 text-white;
        }

        .student-table th {
            @apply px-6 py-4 text-left font-bold text-sm uppercase tracking-wider;
        }

        .student-table td {
            @apply px-6 py-4 border-b border-gray-200;
        }

        .student-table tbody tr {
            @apply hover:bg-blue-50 transition-colors duration-200;
        }

        .status-badge {
            @apply px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1;
        }

        .status-active {
            @apply bg-green-100 text-green-700 border border-green-300;
        }

        .status-inactive {
            @apply bg-red-100 text-red-700 border border-red-300;
        }

        .action-btn {
            @apply px-4 py-2 rounded-lg font-medium transition-all duration-200;
            @apply flex items-center gap-2 justify-center;
        }

        .btn-edit {
            @apply bg-blue-100 text-blue-700 hover:bg-blue-200 border border-blue-300;
        }

        .btn-delete {
            @apply bg-red-100 text-red-700 hover:bg-red-200 border border-red-300;
        }

        .empty-state {
            @apply text-center py-16 px-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300;
        }

        .info-box {
            @apply bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-purple-500 rounded-lg p-6 mt-6;
        }

        .stats-grid {
            @apply grid grid-cols-1 md:grid-cols-4 gap-4 mb-8;
        }

        .stat-card {
            @apply bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-5 border-l-4;
        }

        .stat-card.purple {
            @apply border-purple-500;
        }

        .stat-card.blue {
            @apply border-blue-500;
        }

        .stat-card.green {
            @apply border-green-500;
        }

        .stat-card.orange {
            @apply border-orange-500;
        }

        .stat-value {
            @apply text-2xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent;
        }

        .stat-label {
            @apply text-sm font-medium text-gray-600 mt-1;
        }

        .loading-spinner {
            @apply inline-block w-5 h-5 border-3 border-white border-t-transparent rounded-full animate-spin;
        }

        .file-name {
            @apply mt-4 text-sm font-medium text-gray-700 bg-blue-100 px-4 py-2 rounded-lg inline-block;
        }
    }
</style>

<div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-card">
        <div class="breadcrumb-nav">
            <a href="{{ url('/admin-dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ url('/add-sections') }}">
                Add New Term
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-gray-800 font-semibold">Term 25/56 Details</span>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center gap-3">
                    <i class="fas fa-calendar-alt text-purple-600"></i>
                    Term 25/56
                </h1>
                <p class="text-gray-600 text-lg">Academic Year 2025/2026 - Student Management</p>
            </div>
            <div class="user-info">
                <div class="text-right">
                    <h3 class="font-semibold text-gray-800">Dr. Admin User</h3>
                    <p class="text-sm text-gray-500">System Administrator</p>
                </div>
                <img src="https://i.pravatar.cc/150?img=33" alt="Admin Avatar" class="w-12 h-12 rounded-full ring-4 ring-purple-500 ring-offset-2">
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card purple">
            <i class="fas fa-users text-purple-600 text-3xl mb-2"></i>
            <div class="stat-value" id="totalStudents">150</div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card green">
            <i class="fas fa-user-check text-green-600 text-3xl mb-2"></i>
            <div class="stat-value" id="activeStudents">145</div>
            <div class="stat-label">Active Students</div>
        </div>
        <div class="stat-card orange">
            <i class="fas fa-user-times text-orange-600 text-3xl mb-2"></i>
            <div class="stat-value" id="inactiveStudents">5</div>
            <div class="stat-label">Inactive Students</div>
        </div>
        <div class="stat-card blue">
            <i class="fas fa-graduation-cap text-blue-600 text-3xl mb-2"></i>
            <div class="stat-value" id="programCount">8</div>
            <div class="stat-label">Programs</div>
        </div>
    </div>

    <!-- Upload Section -->
    <div class="upload-section">
        <h2 class="section-title">
            <i class="fas fa-cloud-upload-alt text-purple-600"></i>
            Student Data Management
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Download Template -->
            <div class="upload-card">
                <div class="text-center py-8">
                    <i class="fas fa-file-excel text-emerald-600 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Download Excel Template</h3>
                    <p class="text-gray-600 mb-6">Get the standardized template for student data entry</p>
                    <button onclick="downloadTemplate()" class="download-btn">
                        <i class="fas fa-download"></i>
                        Download Template
                    </button>
                </div>
            </div>

            <!-- Upload Excel -->
            <div class="upload-card">
                <div class="upload-area" onclick="document.getElementById('excelFile').click()">
                    <i class="fas fa-cloud-upload-alt text-purple-600 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Upload Student Data</h3>
                    <p class="text-gray-600 mb-4">Click to browse or drag and drop Excel file</p>
                    <p class="text-sm text-gray-500">Supported: .xlsx, .xls</p>
                    <input type="file" id="excelFile" accept=".xlsx,.xls" class="hidden" onchange="handleFileUpload(event)">
                    <div id="fileName" class="file-name hidden"></div>
                </div>
                <button id="uploadBtn" onclick="uploadFile()" class="upload-btn w-full mt-4 hidden">
                    <i class="fas fa-upload"></i>
                    <span id="uploadBtnText">Upload File</span>
                </button>
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <h3 class="font-bold text-purple-900 mb-3 flex items-center gap-2 text-lg">
                <i class="fas fa-info-circle"></i>
                Excel Template Requirements
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <ul class="space-y-2 text-purple-800">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Student ID:</strong> Unique identifier (e.g., S001)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Full Name:</strong> Student's complete name</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Email:</strong> Valid email address</span>
                    </li>
                </ul>
                <ul class="space-y-2 text-purple-800">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Program:</strong> Academic program name</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Intake Year:</strong> Year of enrollment</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-purple-600 mt-1"></i>
                        <span><strong>Status:</strong> Active or Inactive</span>
                    </li>
                </ul>
            </div>
            <p class="text-sm text-purple-700 mt-4 font-semibold">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Important: First row must contain column headers exactly as shown in the template
            </p>
        </div>
    </div>

    <!-- Students List -->
    <div class="students-section">
        <div class="flex justify-between items-center mb-6">
            <h2 class="section-title mb-0 pb-0 border-0">
                <i class="fas fa-users text-blue-600"></i>
                Enrolled Students
            </h2>
            <div class="flex gap-3">
                <button onclick="exportStudents()" class="action-btn bg-emerald-100 text-emerald-700 hover:bg-emerald-200 border border-emerald-300">
                    <i class="fas fa-file-export"></i>
                    Export List
                </button>
                <button onclick="refreshList()" class="action-btn bg-blue-100 text-blue-700 hover:bg-blue-200 border border-blue-300">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="flex gap-4 mb-6">
            <div class="flex-1">
                <input type="text" id="searchStudent" placeholder="Search by name, ID, or email..." 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    oninput="filterStudents()">
            </div>
            <select id="filterProgram" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500" onchange="filterStudents()">
                <option value="">All Programs</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
            </select>
            <select id="filterStatus" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500" onchange="filterStudents()">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="table-container">
            <table class="student-table" id="studentTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Student Email</th>
                        <th>Program</th>
                        <th>Intake Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Sample Data -->
                    <tr>
                        <td class="font-semibold text-gray-600">1</td>
                        <td class="font-bold text-purple-700">S001</td>
                        <td class="font-medium text-gray-800">Alice Johnson</td>
                        <td class="text-gray-600">alice.johnson@student.edu</td>
                        <td class="text-gray-700">Computer Science</td>
                        <td class="text-gray-700">2025</td>
                        <td>
                            <span class="status-badge status-active">
                                <i class="fas fa-circle text-xs"></i> Active
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button class="action-btn btn-edit" onclick="editStudent('S001')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteStudent('S001')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-gray-600">2</td>
                        <td class="font-bold text-purple-700">S002</td>
                        <td class="font-medium text-gray-800">Michael Brown</td>
                        <td class="text-gray-600">michael.brown@student.edu</td>
                        <td class="text-gray-700">Computer Science</td>
                        <td class="text-gray-700">2025</td>
                        <td>
                            <span class="status-badge status-active">
                                <i class="fas fa-circle text-xs"></i> Active
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button class="action-btn btn-edit" onclick="editStudent('S002')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteStudent('S002')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-gray-600">3</td>
                        <td class="font-bold text-purple-700">S003</td>
                        <td class="font-medium text-gray-800">Sarah Williams</td>
                        <td class="text-gray-600">sarah.williams@student.edu</td>
                        <td class="text-gray-700">Electrical Engineering</td>
                        <td class="text-gray-700">2025</td>
                        <td>
                            <span class="status-badge status-active">
                                <i class="fas fa-circle text-xs"></i> Active
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button class="action-btn btn-edit" onclick="editStudent('S003')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteStudent('S003')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-gray-600">Showing <span class="font-bold">1-3</span> of <span class="font-bold">150</span> students</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 border-2 border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold">1</button>
                <button class="px-4 py-2 border-2 border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border-2 border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                <button class="px-4 py-2 border-2 border-gray-300 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedFile = null;

    // Download Excel Template
    function downloadTemplate() {
        // Create a simple CSV template
        const template = `Student ID,Full Name,Email,Program,Intake Year,Status
S001,John Doe,john.doe@student.edu,Computer Science,2025,Active
S002,Jane Smith,jane.smith@student.edu,Electrical Engineering,2025,Active`;

        const blob = new Blob([template], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'student_template.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);

        // Success notification
        showNotification('Template downloaded successfully!', 'success');
    }

    // Handle File Selection
    function handleFileUpload(event) {
        selectedFile = event.target.files[0];
        if (selectedFile) {
            const fileName = document.getElementById('fileName');
            const uploadBtn = document.getElementById('uploadBtn');
            
            fileName.textContent = selectedFile.name;
            fileName.classList.remove('hidden');
            uploadBtn.classList.remove('hidden');
        }
    }

    // Upload File
    function uploadFile() {
        if (!selectedFile) {
            showNotification('Please select a file first', 'error');
            return;
        }

        const uploadBtn = document.getElementById('uploadBtn');
        const uploadBtnText = document.getElementById('uploadBtnText');
        
        uploadBtn.disabled = true;
        uploadBtnText.innerHTML = '<span class="loading-spinner mr-2"></span> Uploading...';

        // Simulate upload process
        setTimeout(() => {
            // Reset button
            uploadBtn.disabled = false;
            uploadBtnText.innerHTML = 'Upload File';
            
            // Clear file
            document.getElementById('excelFile').value = '';
            document.getElementById('fileName').classList.add('hidden');
            uploadBtn.classList.add('hidden');
            selectedFile = null;

            // Update stats
            const totalStudents = document.getElementById('totalStudents');
            totalStudents.textContent = parseInt(totalStudents.textContent) + 10;
            
            const activeStudents = document.getElementById('activeStudents');
            activeStudents.textContent = parseInt(activeStudents.textContent) + 10;

            showNotification('10 students imported successfully!', 'success');
            
            // Refresh table
            refreshList();
        }, 2000);
    }

    // Filter Students
    function filterStudents() {
        const search = document.getElementById('searchStudent').value.toLowerCase();
        const program = document.getElementById('filterProgram').value;
        const status = document.getElementById('filterStatus').value;
        
        const rows = document.querySelectorAll('#studentTableBody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowProgram = row.children[4].textContent;
            const rowStatus = row.children[6].textContent.trim();
            
            const matchSearch = text.includes(search);
            const matchProgram = !program || rowProgram === program;
            const matchStatus = !status || rowStatus.includes(status);
            
            if (matchSearch && matchProgram && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Export Students
    function exportStudents() {
        showNotification('Exporting student list...', 'info');
        // Implementation for export functionality
    }

    // Refresh List
    function refreshList() {
        showNotification('Student list refreshed', 'success');
    }

    // Edit Student
    function editStudent(id) {
        showNotification(`Editing student ${id}`, 'info');
    }

    // Delete Student
    function deleteStudent(id) {
        if (confirm(`Are you sure you want to delete student ${id}?`)) {
            showNotification(`Student ${id} deleted`, 'success');
        }
    }

    // Show Notification
    function showNotification(message, type) {
        const colors = {
            success: 'from-green-500 to-green-600',
            error: 'from-red-500 to-red-600',
            info: 'from-blue-500 to-blue-600'
        };

        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            info: 'info-circle'
        };

        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl z-50 transform transition-all duration-500 translate-x-full`;
        notification.innerHTML = `
            <div class="flex items-center gap-3">
                <i class="fas fa-${icons[type]} text-2xl"></i>
                <span class="font-semibold">${message}</span>
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => notification.style.transform = 'translateX(0)', 10);
        setTimeout(() => {
            notification.style.transform = 'translateX(150%)';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
</script>
@endsection