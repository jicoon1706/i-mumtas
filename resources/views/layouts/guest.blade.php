<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduManage Guest')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer base {
            :root {
                --primary: #17A2B8;
                --primary-light: #20c9e3;
                --primary-dark: #138496;
                --secondary: #2c3e50;
                --success: #28a745;
                --warning: #ffc107;
                --danger: #dc3545;
                --bg-main: #f8f9fa;
                --bg-sidebar: #0f2d3a;
                
                --dept-color: #3b82f6;
                --dept-light: #dbeafe;
                --course-color: #f59e0b;
                --course-light: #fef3c7;
                --assign-color: #10b981;
                --assign-light: #d1fae5;
            }

            body {
                @apply font-sans text-gray-700 min-h-screen;
                /* Background is only visible around the .admin-container */
                background: linear-gradient(135deg, #17A2B8 0%, #0f8a9e 100%);
            }

            h1, h2, h3, h4, h5, h6 {
                @apply text-gray-800 font-bold;
            }
        }

        @layer components {
            .admin-container {
                /* Set up the main flex container for sidebar and content */
                @apply flex min-h-screen;
            }

            .sidebar {
                @apply w-64 flex-shrink-0 shadow-2xl flex flex-col;
                /* Rich teal gradient for sidebar */
                background: linear-gradient(180deg, #1E40AF 0%, #3B82F6 50%, #60A5FA 100%);
                /* background: linear-gradient(180deg, #6B46C1 0%, #8B5CF6 50%, #A78BFA 100%); */
            }

            .main-content {
                /* Allow content to take the remaining space and set a neutral background */
                @apply flex-1 p-8 overflow-auto;
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #BFDBFE 100%);
                /* background: linear-gradient(135deg, #F5F3FF 0%, #E9D5FF 50%, #D8B4FE 100%); */
            }

            .logo {
                @apply p-6 border-b border-teal-800;
            }
            
            .logo h2 {
                @apply text-2xl font-bold text-white;
            }
            
            .logo h2 span {
                @apply bg-gradient-to-r from-teal-400 to-cyan-500 bg-clip-text text-transparent;
            }

            .nav-links li a {
                @apply flex items-center p-4 text-teal-100 hover:bg-teal-800/50 hover:text-white transition-all duration-200 relative;
            }
            
            .nav-links li a::before {
                content: '';
                @apply absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-teal-400 to-cyan-400 transform scale-y-0 transition-transform duration-200;
            }
            
            .nav-links li a:hover::before {
                @apply scale-y-100;
            }

            .nav-links li.active a {
                @apply bg-teal-800/70 text-white font-semibold;
            }
            
            .nav-links li.active a::before {
                @apply scale-y-100;
            }

            .nav-links i {
                @apply text-lg mr-4 w-5 text-center;
            }
            
            /* Add base Header and User Info styles here for global use */
            .header {
                @apply flex justify-between items-center bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-100;
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            }

            .user-info {
                @apply flex items-center space-x-3;
            }
            .user-info img {
                @apply w-12 h-12 rounded-full object-cover ring-4 ring-teal-500 ring-offset-2;
            }
            .user-info h3 {
                @apply text-sm font-semibold m-0;
            }
            .user-info p {
                @apply text-xs text-gray-500 m-0;
            }
            
            /* Add a generic footer style for the main content area */
            footer {
                @apply text-center py-4 mt-8 text-sm text-gray-500;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div 
    x-data="{ open: false, lastScroll: 0, idleTimeout: null }"
    x-init="

        // Expand when scrolling down slightly
        window.addEventListener('scroll', () => {
            if (window.scrollY > 30) {
                open = true;
                clearTimeout(idleTimeout);

                // Collapse after 2 seconds of no scroll
                idleTimeout = setTimeout(() => open = false, 2000);
            }
        });

    "
    @mouseenter="open = true"
    @mouseleave="open = false"
    :class="open ? 'w-64' : 'w-20'"
    class="sidebar transition-all duration-300 flex flex-col shadow-2xl overflow-hidden"
>
    <!-- LOGO -->
    <div class="logo p-6 border-b border-teal-800 flex items-center justify-center">
        <template x-if="open">
            <h2 class="text-2xl font-bold text-white">
                Edu<span class="bg-gradient-to-r from-teal-400 to-cyan-500 bg-clip-text text-transparent">Manage</span>
            </h2>
        </template>

        <template x-if="!open">
            <i class="fas fa-graduation-cap text-white text-2xl"></i>
        </template>
    </div>

    <!-- NAVIGATION -->
    <ul class="nav-links mt-2">
        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-home w-5 text-center"></i>
                <span x-show="open" class="ml-3">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-cogs w-5 text-center"></i>
                <span x-show="open" class="ml-3">Course Management</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-book w-5 text-center"></i>
                <span x-show="open" class="ml-3">Students</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span x-show="open" class="ml-3">PLO</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-users w-5 text-center"></i>
                <span x-show="open" class="ml-3">Section</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-user-circle w-5 text-center"></i>
                <span x-show="open" class="ml-3">Profile</span>
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-4 text-teal-100 hover:bg-teal-800/50 transition-all">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span x-show="open" class="ml-3">Logout</span>
            </a>
        </li>
    </ul>
</div>


        <div class="main-content">
            @yield('content')
            <footer>
                 <p>EduManage Course Management System &copy; 2023. All rights reserved.</p>
            </footer>
        </div>
    </div>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>