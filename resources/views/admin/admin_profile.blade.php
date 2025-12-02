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
                --accent: #e74c3c;
                --light: #ecf0f1;
                --success: #2ecc71;
                --warning: #f39c12;
                --dark: #34495e;
                --gray-bg: #f5f7fa;
                --nav-bg-start: #2c3e50;
                --nav-bg-end: #34495e;
            }
        }

        @layer components {
            .header {
                @apply flex justify-between items-center mb-7 bg-white p-6 rounded-2xl shadow-lg;
            }

            .profile-container {
                @apply flex flex-col lg:flex-row gap-6 mb-7;
            }

            .profile-card {
                @apply bg-white rounded-2xl p-6 shadow-lg lg:w-1/3;
            }

            .profile-header {
                @apply flex flex-col sm:flex-row items-center gap-4 mb-6 pb-6 border-b-2 border-gray-100;
            }

            .profile-pic {
                @apply w-24 h-24 rounded-full object-cover border-4 border-blue-500 shadow-md;
            }

            .password-card {
                @apply bg-white rounded-2xl p-6 shadow-lg lg:w-2/3;
            }

            .card-title {
                @apply text-2xl font-bold mb-6 pb-4 border-b-2 border-gray-200;
                color: var(--secondary);
            }

            .form-group {
                @apply mb-5;
            }

            .form-group label {
                @apply block text-gray-700 font-medium mb-2;
            }

            .form-control {
                @apply w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200;
            }

            .btn {
                @apply px-5 py-3 rounded-xl font-semibold transition-all duration-200 cursor-pointer text-center shadow-md hover:shadow-xl flex items-center justify-center w-full;
            }

            .btn-success {
                @apply bg-gradient-to-r from-emerald-600 to-emerald-700 text-white hover:from-emerald-700 hover:to-emerald-800 transform hover:-translate-y-0.5;
            }

            .password-strength {
                @apply mt-2 h-2 rounded-full bg-gray-200 overflow-hidden;
            }

            .strength-meter {
                @apply h-full w-0 transition-all duration-300;
            }

            .password-requirements {
                @apply mt-4 space-y-2;
            }

            .requirement {
                @apply flex items-center gap-2;
            }

            .requirement i {
                @apply text-xs;
            }

            .staff-id {
                @apply bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-sm font-medium shadow-sm;
            }

            footer {
                @apply text-center py-6 text-gray-500 text-sm;
            }
        }
    </style>

    <div class="main-content p-6">
        
        <div class="header">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Lecturer Profile</h1>
                <p class="text-gray-500 mt-1">Manage your personal information and security settings</p>
            </div>
            <div class="user-info flex items-center gap-4">
                <div class="text-right">
                    <h3 class="font-semibold text-gray-800">Dr. Sarah Johnson</h3>
                    <p class="text-sm text-gray-500">Senior Lecturer</p>
                </div>
                <img src="https://i.pravatar.cc/150?img=32" alt="User Avatar" class="w-12 h-12 rounded-full object-cover border-2 border-blue-300 shadow-md">
            </div>
        </div>

        <div class="profile-container">
            
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://i.pravatar.cc/150?img=32" alt="Profile Picture" class="profile-pic">
                    <div class="profile-info text-center sm:text-left">
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Dr. Sarah Johnson</h2>
                        <p class="text-gray-500 mb-2">Computer Science Department</p>
                        <span class="staff-id">STAFF-ID: L-2021-0452</span>
                    </div>
                </div>

                <div class="profile-details space-y-4">
                    <div class="detail-item">
                        <label class="text-xs text-gray-500 font-medium">Email Address</label>
                        <p class="text-gray-800 font-medium">s.johnson@edumanage.edu</p>
                    </div>
                    <div class="detail-item">
                        <label class="text-xs text-gray-500 font-medium">Phone Number</label>
                        <p class="text-gray-800 font-medium">+1 (555) 123-4567</p>
                    </div>
                    <div class="detail-item">
                        <label class="text-xs text-gray-500 font-medium">Office Location</label>
                        <p class="text-gray-800 font-medium">CS Building, Room 302</p>
                    </div>
                    <div class="detail-item">
                        <label class="text-xs text-gray-500 font-medium">Joined Date</label>
                        <p class="text-gray-800 font-medium">August 15, 2018</p>
                    </div>
                </div>

                <div class="stats-grid grid grid-cols-2 gap-4 mt-6 pt-6 border-t-2 border-gray-100">
                    <div class="stat text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                        <div class="stat-value text-2xl font-bold text-blue-700">8</div>
                        <div class="stat-label text-sm text-gray-600">Courses</div>
                    </div>
                    <div class="stat text-center p-4 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl">
                        <div class="stat-value text-2xl font-bold text-emerald-700">320</div>
                        <div class="stat-label text-sm text-gray-600">Students</div>
                    </div>
                </div>
            </div>

            <div class="password-card">
                <h2 class="card-title">Change Password</h2>
                <form id="passwordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="form-control" placeholder="Enter current password">
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" class="form-control" placeholder="Enter new password">
                        
                        <div class="password-strength mt-2">
                            <div class="strength-meter h-full rounded-full" id="passwordStrength"></div>
                        </div>
                        
                        <div class="password-requirements mt-4">
                            <div class="requirement" id="lengthReq">
                                <i class="fas fa-circle text-gray-400"></i>
                                <span class="text-sm text-gray-500">At least 8 characters</span>
                            </div>
                            <div class="requirement" id="uppercaseReq">
                                <i class="fas fa-circle text-gray-400"></i>
                                <span class="text-sm text-gray-500">One uppercase letter</span>
                            </div>
                            <div class="requirement" id="numberReq">
                                <i class="fas fa-circle text-gray-400"></i>
                                <span class="text-sm text-gray-500">One number</span>
                            </div>
                            <div class="requirement" id="specialReq">
                                <i class="fas fa-circle text-gray-400"></i>
                                <span class="text-sm text-gray-500">One special character</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-6">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm new password">
                        <small id="passwordMatch" class="text-red-500 mt-1 hidden">
                            <i class="fas fa-exclamation-circle mr-1"></i> Passwords do not match
                        </small>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-key mr-2"></i> Update Password
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t-2 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Password Policy Summary</h3>
                    <ul class="text-gray-600 text-sm space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-emerald-500 mt-1 mr-2"></i>
                            <span>Minimum 8 characters in length</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-emerald-500 mt-1 mr-2"></i>
                            <span>At least one uppercase letter (A-Z)</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-emerald-500 mt-1 mr-2"></i>
                            <span>At least one number (0-9)</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-emerald-500 mt-1 mr-2"></i>
                            <span>At least one special character (!@#$%^&*)</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-emerald-500 mt-1 mr-2"></i>
                            <span>Should not match your previous passwords</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        const newPasswordInput = document.getElementById('newPassword');
        const passwordStrength = document.getElementById('passwordStrength');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatch = document.getElementById('passwordMatch');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check password requirements
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
            
            // Update requirement indicators
            updateRequirement('lengthReq', hasLength);
            updateRequirement('uppercaseReq', hasUppercase);
            updateRequirement('numberReq', hasNumber);
            updateRequirement('specialReq', hasSpecial);
            
            // Calculate strength
            if (hasLength) strength += 25;
            if (hasUppercase) strength += 25;
            if (hasNumber) strength += 25;
            if (hasSpecial) strength += 25;
            
            // Update strength meter
            passwordStrength.style.width = `${strength}%`;
            
            // Update strength meter color
            if (strength < 50) {
                passwordStrength.style.background = 'linear-gradient(to right, #ef4444, #dc2626)';
            } else if (strength < 75) {
                passwordStrength.style.background = 'linear-gradient(to right, #f59e0b, #d97706)';
            } else {
                passwordStrength.style.background = 'linear-gradient(to right, #10b981, #059669)';
            }
        });

        function updateRequirement(elementId, isValid) {
            const element = document.getElementById(elementId);
            const icon = element.querySelector('i');
            const text = element.querySelector('span');
            
            if (isValid) {
                icon.className = 'fas fa-check-circle text-emerald-500 mt-1';
                text.classList.remove('text-gray-500');
                text.classList.add('text-emerald-600', 'font-medium');
            } else {
                icon.className = 'fas fa-circle text-gray-400';
                text.classList.remove('text-emerald-600', 'font-medium');
                text.classList.add('text-gray-500');
            }
        }

        // Password confirmation check
        confirmPasswordInput.addEventListener('input', function() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = this.value;
            
            if (newPassword && confirmPassword && newPassword !== confirmPassword) {
                passwordMatch.classList.remove('hidden');
                confirmPasswordInput.classList.add('border-red-400', 'ring-2', 'ring-red-200');
                confirmPasswordInput.classList.remove('border-gray-200');
            } else {
                passwordMatch.classList.add('hidden');
                confirmPasswordInput.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
                confirmPasswordInput.classList.add('border-gray-200');
            }
        });

        // Form submission
        document.getElementById('passwordForm').addEventListener('submit', (e) => {
            e.preventDefault();
            
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (!currentPassword) {
                alert('Please enter your current password');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                alert('Passwords do not match. Please check and try again.');
                return;
            }
            
            // Check password strength
            const hasLength = newPassword.length >= 8;
            const hasUppercase = /[A-Z]/.test(newPassword);
            const hasNumber = /[0-9]/.test(newPassword);
            const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(newPassword);
            
            if (!hasLength || !hasUppercase || !hasNumber || !hasSpecial) {
                alert('Please ensure your new password meets all the requirements.');
                return;
            }
            
            // In a real application, you would send data to a server here
            alert('Password updated successfully!');
            document.getElementById('passwordForm').reset();
            passwordStrength.style.width = '0';
            
            // Reset requirement indicators
            ['lengthReq', 'uppercaseReq', 'numberReq', 'specialReq'].forEach(id => {
                updateRequirement(id, false);
            });
        });
    </script>
@endsection