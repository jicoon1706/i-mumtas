@extends('layouts.admin')

@section('title', 'Add New Term - EduManage')

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

        .page-title {
            @apply text-3xl font-bold text-gray-800 mb-2 flex items-center gap-3;
        }

        .page-subtitle {
            @apply text-gray-600 text-lg;
        }

        .content-card {
            @apply bg-white rounded-2xl shadow-xl p-8 border border-gray-100;
        }

        .section-title {
            @apply text-2xl font-bold text-gray-800 mb-6 pb-4 border-b-2 border-gray-200 flex items-center gap-3;
        }

        .stats-grid {
            @apply grid grid-cols-1 md:grid-cols-3 gap-6 mb-8;
        }

        .stat-card {
            @apply bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 border-l-4 transform transition-all duration-300 hover:scale-105 hover:shadow-xl;
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

        .stat-icon {
            @apply w-14 h-14 rounded-xl flex items-center justify-center text-2xl mb-4 shadow-md;
        }

        .stat-icon.purple {
            @apply bg-gradient-to-br from-purple-500 to-purple-600 text-white;
        }

        .stat-icon.blue {
            @apply bg-gradient-to-br from-blue-500 to-blue-600 text-white;
        }

        .stat-icon.green {
            @apply bg-gradient-to-br from-green-500 to-green-600 text-white;
        }

        .stat-label {
            @apply text-sm font-medium text-gray-600 mb-2;
        }

        .stat-value {
            @apply text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent;
        }

        .form-card {
            @apply bg-gradient-to-br from-white via-blue-50 to-purple-50 rounded-2xl shadow-xl p-8 border-2 border-gray-100;
        }

        .form-group {
            @apply mb-6;
        }

        .form-label {
            @apply block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2;
        }

        .form-control {
            @apply w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm transition-all duration-200;
            @apply focus:ring-4 focus:ring-purple-200 focus:border-purple-500 focus:outline-none;
            @apply hover:border-gray-300;
        }

        .form-control:focus {
            @apply transform scale-[1.01];
        }

        .btn-group {
            @apply flex flex-col sm:flex-row gap-4 mt-8;
        }

        .btn {
            @apply px-6 py-3.5 rounded-xl font-semibold transition-all duration-300 cursor-pointer text-center shadow-lg;
            @apply flex items-center justify-center gap-2 transform hover:-translate-y-1 hover:shadow-xl;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 text-white;
            @apply hover:from-purple-700 hover:via-purple-800 hover:to-purple-900;
        }

        .btn-outline {
            @apply bg-white border-2 border-gray-300 text-gray-700 shadow-md;
            @apply hover:bg-gray-50 hover:border-gray-400 hover:shadow-lg;
        }

        .terms-list-card {
            @apply bg-white rounded-2xl shadow-xl p-8 border border-gray-100;
        }

        .term-item {
            @apply bg-gradient-to-r from-gray-50 to-white border-2 border-gray-200 rounded-xl p-5 mb-4;
            @apply hover:border-purple-300 hover:shadow-md transition-all duration-200;
        }

        .term-header-row {
            @apply flex justify-between items-center;
        }

        .term-name {
            @apply text-lg font-bold text-gray-800 mb-1;
        }

        .term-description {
            @apply text-sm text-gray-600;
        }

        .badge {
            @apply px-4 py-2 rounded-full text-sm font-bold shadow-sm;
        }

        .badge-info {
            @apply bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 border border-blue-300;
        }

        .empty-state {
            @apply text-center py-16 px-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300;
        }

        .empty-icon {
            @apply text-7xl mb-6 text-gray-300;
        }

        .empty-title {
            @apply text-2xl font-bold text-gray-600 mb-2;
        }

        .empty-description {
            @apply text-gray-500;
        }

        .info-box {
            @apply bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-purple-500 rounded-lg p-6 mt-6;
        }

        .info-title {
            @apply font-bold text-purple-900 mb-3 flex items-center gap-2 text-lg;
        }

        .info-list {
            @apply space-y-2 text-purple-800;
        }

        .info-item {
            @apply flex items-start gap-3;
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

        .breadcrumb-separator {
            @apply text-gray-400 text-xs;
        }
    }
</style>

<div class="main-content">
    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-card">
        <div class="breadcrumb-nav">
            <a href="{{ url('/admin-dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right breadcrumb-separator"></i>
            <span class="text-gray-800 font-semibold">Add New Term</span>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-calendar-plus text-purple-600"></i>
                    Add New Academic Term
                </h1>
                <p class="page-subtitle">Create and manage academic terms for student enrollment</p>
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

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card purple">
            <div class="stat-icon purple">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-label">Total Terms</div>
            <div class="stat-value" id="totalTerms">3</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-label">Total Students</div>
            <div class="stat-value" id="totalStudents">320</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-label">Active Terms</div>
            <div class="stat-value" id="activeTerms">2</div>
        </div>
    </div>

    <!-- Create New Term Form -->
    <div class="form-card">
        <h2 class="section-title">
            <i class="fas fa-plus-circle text-purple-600"></i>
            Create New Term
        </h2>

        <form id="termForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="termName" class="form-label">
                        <i class="fas fa-tag text-purple-500"></i>
                        Term Name
                    </label>
                    <input 
                        type="text" 
                        id="termName" 
                        class="form-control" 
                        placeholder="e.g., 25/56" 
                        required
                    >
                    <small class="text-gray-500 text-xs mt-1 block">
                        <i class="fas fa-info-circle"></i> Use format: YY/YY (e.g., 25/56)
                    </small>
                </div>

                <div class="form-group">
                    <label for="termYear" class="form-label">
                        <i class="fas fa-calendar text-purple-500"></i>
                        Academic Year
                    </label>
                    <input 
                        type="text" 
                        id="termYear" 
                        class="form-control" 
                        placeholder="e.g., 2025/2026" 
                        required
                    >
                    <small class="text-gray-500 text-xs mt-1 block">
                        <i class="fas fa-info-circle"></i> Full academic year format
                    </small>
                </div>
            </div>

            <div class="form-group">
                <label for="termDescription" class="form-label">
                    <i class="fas fa-align-left text-purple-500"></i>
                    Description
                </label>
                <textarea 
                    id="termDescription" 
                    class="form-control" 
                    rows="4" 
                    placeholder="Enter additional details about this term..."
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label for="termStatus" class="form-label">
                    <i class="fas fa-toggle-on text-purple-500"></i>
                    Status
                </label>
                <select id="termStatus" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="upcoming">Upcoming</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary flex-1">
                    <i class="fas fa-save"></i>
                    Create Term
                </button>
                <button type="button" class="btn btn-outline" onclick="clearForm()">
                    <i class="fas fa-times"></i>
                    Clear Form
                </button>
            </div>
        </form>

        <!-- Info Box -->
        <div class="info-box">
            <h3 class="info-title">
                <i class="fas fa-lightbulb"></i>
                Term Creation Guidelines
            </h3>
            <ul class="info-list">
                <li class="info-item">
                    <i class="fas fa-check-circle text-purple-600"></i>
                    <span>Ensure term name follows the YY/YY format for consistency</span>
                </li>
                <li class="info-item">
                    <i class="fas fa-check-circle text-purple-600"></i>
                    <span>Academic year should match the term name pattern</span>
                </li>
                <li class="info-item">
                    <i class="fas fa-check-circle text-purple-600"></i>
                    <span>Add a clear description to help identify the term later</span>
                </li>
                <li class="info-item">
                    <i class="fas fa-check-circle text-purple-600"></i>
                    <span>Set status to 'Active' only when ready to enroll students</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Existing Terms List -->
    <div class="terms-list-card mt-8">
        <h2 class="section-title">
            <i class="fas fa-list text-blue-600"></i>
            Existing Terms
        </h2>

        <div id="termsList">
            <!-- Term Item -->
            <a href="{{ url('/new-term-details') }}" class="term-item block cursor-pointer">
                <div class="term-header-row">
                    <div>
                        <h3 class="term-name">
                            <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                            Term 25/56
                        </h3>
                        <p class="term-description">Academic Year 2025/2026</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge badge-info">
                            <i class="fas fa-users mr-1"></i>
                            150 Students
                        </span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                            <i class="fas fa-circle text-xs mr-1"></i> Active
                        </span>
                        <i class="fas fa-chevron-right text-purple-600"></i>
                    </div>
                </div>
            </a>

            <a href="{{ url('/term-details/24-55') }}" class="term-item block cursor-pointer">
                <div class="term-header-row">
                    <div>
                        <h3 class="term-name">
                            <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                            Term 24/55
                        </h3>
                        <p class="term-description">Academic Year 2024/2025</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge badge-info">
                            <i class="fas fa-users mr-1"></i>
                            120 Students
                        </span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                            <i class="fas fa-circle text-xs mr-1"></i> Active
                        </span>
                        <i class="fas fa-chevron-right text-purple-600"></i>
                    </div>
                </div>
            </a>

            <a href="{{ url('/term-details/23-54') }}" class="term-item block cursor-pointer">
                <div class="term-header-row">
                    <div>
                        <h3 class="term-name">
                            <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                            Term 23/54
                        </h3>
                        <p class="term-description">Academic Year 2023/2024</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge badge-info">
                            <i class="fas fa-users mr-1"></i>
                            50 Students
                        </span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">
                            <i class="fas fa-circle text-xs mr-1"></i> Inactive
                        </span>
                        <i class="fas fa-chevron-right text-purple-600"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    // Form submission handler
    document.getElementById('termForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const termName = document.getElementById('termName').value;
        const termYear = document.getElementById('termYear').value;
        const termDescription = document.getElementById('termDescription').value;
        const termStatus = document.getElementById('termStatus').value;
        
        // Validation
        if (!termName || !termYear || !termDescription) {
            alert('Please fill in all required fields');
            return;
        }
        
        // Success message with animation
        const successMessage = document.createElement('div');
        successMessage.className = 'fixed top-4 right-4 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 transform transition-all duration-500';
        successMessage.innerHTML = `
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-2xl"></i>
                <div>
                    <p class="font-bold">Term Created Successfully!</p>
                    <p class="text-sm opacity-90">Term ${termName} has been added</p>
                </div>
            </div>
        `;
        document.body.appendChild(successMessage);
        
        // Animate in
        setTimeout(() => successMessage.style.transform = 'translateY(0)', 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            successMessage.style.transform = 'translateY(-100%)';
            setTimeout(() => successMessage.remove(), 500);
        }, 3000);
        
        // Clear form
        clearForm();
        
        // Update statistics (demo)
        updateStats();
    });
    
    function clearForm() {
        document.getElementById('termForm').reset();
    }
    
    function updateStats() {
        const totalTermsEl = document.getElementById('totalTerms');
        const currentTotal = parseInt(totalTermsEl.textContent);
        totalTermsEl.textContent = currentTotal + 1;
        
        // Animate the number change
        totalTermsEl.style.transform = 'scale(1.2)';
        totalTermsEl.style.color = '#10b981';
        setTimeout(() => {
            totalTermsEl.style.transform = 'scale(1)';
            totalTermsEl.style.color = '';
        }, 300);
    }
    
    // Add input animations
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.parentElement.querySelector('.form-label').style.color = '#9333ea';
        });
        
        control.addEventListener('blur', function() {
            this.parentElement.querySelector('.form-label').style.color = '';
        });
    });
</script>
@endsection