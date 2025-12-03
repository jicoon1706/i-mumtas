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
                background: linear-gradient(135deg, #17A2B8 0%, #0f8a9e 100%);
            }

            h1, h2, h3, h4, h5, h6 {
                @apply text-gray-800 font-bold;
            }
        }

        @layer components {
            .admin-container {
                @apply flex min-h-screen;
            }

            .sidebar {
                @apply flex-shrink-0 shadow-2xl flex flex-col transition-all duration-300 ease-in-out;
                background: linear-gradient(180deg, #1E40AF 0%, #3B82F6 50%, #60A5FA 100%);
                width: 80px;
            }

            .sidebar.expanded {
                width: 256px;
            }

            .main-content {
                @apply flex-1 p-8 overflow-auto transition-all duration-300;
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #BFDBFE 100%);
            }

            .logo {
                @apply p-6 border-b border-teal-800 transition-all duration-300;
            }
            
            .logo h2 {
                @apply text-2xl font-bold text-white whitespace-nowrap overflow-hidden;
            }
            
            .logo h2 span {
                @apply bg-gradient-to-r from-teal-400 to-cyan-500 bg-clip-text text-transparent;
            }

            .logo p {
                @apply text-teal-300 text-sm mt-1 whitespace-nowrap overflow-hidden;
            }

            .sidebar:not(.expanded) .logo h2 {
                @apply text-center;
            }

            .sidebar:not(.expanded) .logo p {
                @apply opacity-0;
            }

            .nav-links li a {
                @apply flex items-center p-4 text-teal-100 hover:bg-teal-800/50 hover:text-white transition-all duration-200 relative w-full text-left;
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
                @apply text-lg w-5 text-center flex-shrink-0;
            }

            .nav-links span {
                @apply whitespace-nowrap overflow-hidden transition-all duration-300;
            }

            .sidebar:not(.expanded) .nav-links span {
                @apply opacity-0 w-0;
            }

            .sidebar.expanded .nav-links i {
                @apply mr-4;
            }

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
            
            footer {
                @apply text-center py-4 mt-8 text-sm text-gray-500;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container" x-data="{ sidebarExpanded: false }">
        <div 
            class="sidebar"
            :class="{ 'expanded': sidebarExpanded }"
            @mouseenter="sidebarExpanded = true"
            @mouseleave="sidebarExpanded = false"
        >
            <div class="logo">
                <h2 x-show="sidebarExpanded" x-transition>Edu<span>Manage</span></h2>
                <h2 x-show="!sidebarExpanded" class="text-center">EM</h2>
                <p x-show="sidebarExpanded" x-transition>Guest Panel</p>
            </div>
            
            <ul class="nav-links space-y-1">
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/guest-view-spider-chart">
                        <i class="fas fa-cogs"></i>
                        <span>Spider Chart</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-book"></i>
                        <span>Students</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-chart-line"></i>
                        <span>PLO</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <span>Section</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
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