<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFS Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>

<body class="font-sans">

    <div class="min-h-screen bg-gradient-to-br from-amber-100 via-teal-50 to-amber-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Login Interface -->
            <div id="loginContainer" class="bg-gradient-to-br from-white to-amber-50 rounded-3xl shadow-2xl p-8 backdrop-blur-sm bg-opacity-95">

                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <img src="images/cfs_logo.png" alt="CFS Logo" class="h-24 w-auto">
                </div>

                <!-- Title -->
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">
                    Welcome Back
                </h1>

                <p class="text-center text-gray-600 text-sm mb-8">
                    Login to your CFS account
                </p>

                <!-- Form -->
                <div class="space-y-5">
                    <!-- Role -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Your Role</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-500 w-5 h-5 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <select id="roleInput" placeholder="Select Role"
                                    class="w-full pl-12 pr-4 py-3 bg-gradient-to-r from-gray-50 to-amber-50 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-2 focus:ring-teal-200 text-gray-900 placeholder-gray-500 font-medium transition appearance-none cursor-pointer hover:border-teal-300">
                                <option value="">-- Select Role --</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="guest">Guest</option>
                            </select>
                        </div>
                    </div>

                    <!-- Staff ID -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Staff ID</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-500 w-5 h-5 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <input type="text" id="staffIdInput" placeholder="Enter your Staff ID"
                                class="w-full pl-12 pr-4 py-3 bg-gradient-to-r from-gray-50 to-amber-50 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-2 focus:ring-teal-200 text-gray-900 placeholder-gray-400 transition">
                        </div>
                    </div>


                    <!-- Password -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-500 w-5 h-5 pointer-events-none"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                 <rect width="18" height="11" x="3" y="11" rx="2"/>
                                 <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="passwordInput" placeholder="Enter your password"
                                   class="w-full pl-12 pr-12 py-3 bg-gradient-to-r from-gray-50 to-amber-50 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-2 focus:ring-teal-200 text-gray-900 placeholder-gray-400 transition">

                            <!-- Toggle eye button -->
                            <button id="passwordToggle"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-500 transition">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                     <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                     <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                     <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                     <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                     <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.27-1.46"/>
                                     <path d="M2 2l20 20"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Forgot password -->
                    <div class="text-right">
                        <button id="forgotPasswordBtn" class="text-sm text-teal-600 hover:text-teal-700 font-medium transition">
                            Forgot password?
                        </button>
                    </div>

                    <!-- Submit -->
                    <button id="submitButton"
                            class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white py-3 rounded-xl font-semibold
                                   hover:from-teal-600 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:scale-105 duration-200">
                        Login Now
                    </button>
                </div>

            </div>

            <!-- Reset Password Interface -->
            <div id="resetContainer" class="hidden bg-gradient-to-br from-white to-amber-50 rounded-3xl shadow-2xl p-8 backdrop-blur-sm bg-opacity-95">

                <!-- Back Button -->
                <button id="backButton" class="flex items-center text-teal-600 hover:text-teal-700 mb-6 font-medium transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-sm">Back to Login</span>
                </button>

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div class="bg-gradient-to-br from-teal-100 to-amber-100 rounded-2xl p-4 shadow-md">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="11" x="3" y="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">
                    Reset Password
                </h1>

                <p class="text-center text-gray-600 text-sm mb-8">
                    Enter your new password below.
                </p>

                <!-- Form -->
                <div class="space-y-5">
                    <!-- New Password -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-500 w-5 h-5 pointer-events-none"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                 <rect width="18" height="11" x="3" y="11" rx="2"/>
                                 <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="newPasswordInput" placeholder="Enter new password"
                                   class="w-full pl-12 pr-12 py-3 bg-gradient-to-r from-gray-50 to-amber-50 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-2 focus:ring-teal-200 text-gray-900 placeholder-gray-400 transition">
                            <button class="passwordToggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-500 transition"
                                    data-input="newPasswordInput">
                                <svg class="eyeIcon w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                     <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                     <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg class="eyeOffIcon w-5 h-5 hidden" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                     <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                     <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                     <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.27-1.46"/>
                                     <path d="M2 2l20 20"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-500 w-5 h-5 pointer-events-none"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                 <rect width="18" height="11" x="3" y="11" rx="2"/>
                                 <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="confirmPasswordInput" placeholder="Confirm your password"
                                   class="w-full pl-12 pr-12 py-3 bg-gradient-to-r from-gray-50 to-amber-50 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-2 focus:ring-teal-200 text-gray-900 placeholder-gray-400 transition">
                            <button class="passwordToggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-500 transition"
                                    data-input="confirmPasswordInput">
                                <svg class="eyeIcon w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                     <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                     <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg class="eyeOffIcon w-5 h-5 hidden" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                     <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                     <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                     <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.27-1.46"/>
                                     <path d="M2 2l20 20"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Error message -->
                    <div id="errorMessage" class="text-sm text-red-600 hidden bg-red-50 p-3 rounded-lg border border-red-200"></div>

                    <!-- Submit -->
                    <button id="confirmResetButton"
                            class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white py-3 rounded-xl font-semibold
                                   hover:from-teal-600 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:scale-105 duration-200">
                        Confirm Password
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Login interface elements
            const loginContainer = document.getElementById('loginContainer');
            const resetContainer = document.getElementById('resetContainer');
            const passwordInput = document.getElementById('passwordInput');
            const staffIdInput = document.getElementById('staffIdInput');
            const roleInput = document.getElementById('roleInput');
            const passwordToggle = document.getElementById('passwordToggle');
            const submitButton = document.getElementById('submitButton');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');
            const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
            const backButton = document.getElementById('backButton');
            
            // Reset password elements
            const newPasswordInput = document.getElementById('newPasswordInput');
            const confirmPasswordInput = document.getElementById('confirmPasswordInput');
            const confirmResetButton = document.getElementById('confirmResetButton');
            const errorMessage = document.getElementById('errorMessage');
            const passwordToggles = document.querySelectorAll('.passwordToggle');

            let showPassword = false;

            const togglePasswordVisibility = () => {
                showPassword = !showPassword;
                passwordInput.type = showPassword ? 'text' : 'password';
                eyeIcon.classList.toggle('hidden');
                eyeOffIcon.classList.toggle('hidden');
            };

            const handleSubmit = () => {
                const staffIdInput = staffIdInput.value;
                const password = passwordInput.value;
                const role = roleInput.value;
                if (!staffIdInput || !password || !role) {
                    alert('Please fill in all fields');
                    return;
                }
                console.log('Login attempt:', { staffIdInput, password, role });
                alert('Login successful!');
            };

            const showResetPassword = () => {
                loginContainer.classList.add('hidden');
                resetContainer.classList.remove('hidden');
                newPasswordInput.value = '';
                confirmPasswordInput.value = '';
                errorMessage.classList.add('hidden');
            };

            const showLoginPage = () => {
                resetContainer.classList.add('hidden');
                loginContainer.classList.remove('hidden');
            };

            const toggleResetPasswordVisibility = (inputId) => {
                const input = document.getElementById(inputId);
                const btn = event.currentTarget;
                const eyeIconEl = btn.querySelector('.eyeIcon');
                const eyeOffIconEl = btn.querySelector('.eyeOffIcon');
                
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                eyeIconEl.classList.toggle('hidden');
                eyeOffIconEl.classList.toggle('hidden');
            };

            const handleResetPassword = () => {
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                errorMessage.classList.add('hidden');
                
                if (!newPassword || !confirmPassword) {
                    errorMessage.textContent = 'Please fill in all fields';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                
                if (newPassword !== confirmPassword) {
                    errorMessage.textContent = 'Passwords do not match';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                
                if (newPassword.length < 6) {
                    errorMessage.textContent = 'Password must be at least 6 characters';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                
                console.log('Password reset successful:', { newPassword });
                alert('Password reset successful!');
                showLoginPage();
            };

            // Event listeners
            passwordToggle.addEventListener('click', togglePasswordVisibility);
            submitButton.addEventListener('click', handleSubmit);
            forgotPasswordBtn.addEventListener('click', showResetPassword);
            backButton.addEventListener('click', showLoginPage);
            confirmResetButton.addEventListener('click', handleResetPassword);
            
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    toggleResetPasswordVisibility(toggle.dataset.input);
                });
            });
        });
    </script>

</body>
</html>