@extends('layouts.guest')

@section('title', 'CLO/PLO Report - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3498db',
                    'secondary': '#2c3e50',
                    'accent': '#e74c3c',
                    'success': '#2ecc71',
                    'warning': '#f39c12',
                    'dark': '#34495e',
                    'gray-bg': '#f5f7fa',
                }
            }
        }
    }
</script>
<style type="text/tailwindcss">
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    
    @layer components {
        .attainment-card {
            @apply bg-white rounded-2xl p-6 shadow-lg border border-gray-100;
        }
        
        .stat-card {
            @apply bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 shadow-sm border border-blue-200;
        }
        
        .attainment-badge {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium;
        }
        
        .attainment-high { @apply bg-green-100 text-green-800; }
        .attainment-medium { @apply bg-yellow-100 text-yellow-800; }
        .attainment-low { @apply bg-red-100 text-red-800; }
        
        .cloplobar {
            @apply h-4 rounded-full bg-gray-200 overflow-hidden relative;
        }
        
        .cloplobar-fill {
            @apply h-full rounded-full transition-all duration-500;
        }
        
        .table-container {
            @apply overflow-x-auto rounded-lg border border-gray-200;
        }
        
        .data-table {
            @apply min-w-full divide-y divide-gray-200;
        }
        
        .data-table thead {
            @apply bg-gradient-to-r from-blue-50 to-blue-100;
        }
        
        .data-table th {
            @apply px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider;
        }
        
        .data-table tbody {
            @apply bg-white divide-y divide-gray-200;
        }
        
        .data-table td {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900;
        }
        
        .progress-bar {
            @apply w-full bg-gray-200 rounded-full h-2.5;
        }
        
        .progress-fill {
            @apply h-2.5 rounded-full transition-all duration-500;
        }
    }
</style>

<div class="header">
    <h1 class="text-3xl font-bold text-gray-800"><i class="fas fa-file-alt mr-2 text-primary"></i> CLO/PLO Report</h1>
    <div class="user-info">
        <div>
            <h3 class="text-sm font-semibold m-0">Dr. Sarah Johnson</h3>
            <p class="text-xs text-gray-500 m-0">Course Leader (CL001)</p>
        </div>
        <img src="https://i.pravatar.cc/150?img=5" alt="Lecturer Avatar" class="w-12 h-12 rounded-full object-cover ring-4 ring-primary ring-offset-2">
    </div>
</div>

<div class="breadcrumb flex items-center gap-2 mb-8 bg-white p-4 rounded-xl shadow-md text-gray-500 text-sm">
    <a href="#" class="text-primary hover:underline"><i class="fas fa-home"></i> Dashboard</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>CLO/PLO Report</span>
</div>

<!-- Filters Panel -->
<div class="controls-panel bg-white rounded-2xl p-6 shadow-lg mb-8 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="form-group">
        <label for="filterDepartment" class="block mb-2 text-secondary font-medium">Select Department</label>
        <select id="filterDepartment" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="filterReports()">
            <option value="">All Departments</option>
            <option value="CS">Computer Science (CS)</option>
            <option value="EE">Electrical Engineering (EE)</option>
            <option value="ME">Mechanical Engineering (ME)</option>
            <option value="CE">Civil Engineering (CE)</option>
            <option value="IT">Information Technology (IT)</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="filterCourse" class="block mb-2 text-secondary font-medium">Select Course</label>
        <select id="filterCourse" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="filterReports()">
            <option value="">All Courses</option>
            <option value="CS101">CS101 - Intro to Programming</option>
            <option value="CS201">CS201 - Data Structures</option>
            <option value="CS301">CS301 - Algorithms</option>
            <option value="EE101">EE101 - Circuit Analysis</option>
            <option value="ME101">ME101 - Thermodynamics</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="filterSection" class="block mb-2 text-secondary font-medium">Select Section</label>
        <select id="filterSection" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="filterReports()">
            <option value="">All Sections</option>
            <option value="A">Section A</option>
            <option value="B">Section B</option>
            <option value="C">Section C</option>
            <option value="D">Section D</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="filterAttainment" class="block mb-2 text-secondary font-medium">Attainment Level</label>
        <select id="filterAttainment" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="filterReports()">
            <option value="">All Levels</option>
            <option value="high">High (≥70%)</option>
            <option value="medium">Medium (50-69%)</option>
            <option value="low">Low (<50%)</option>
        </select>
    </div>
</div>

<!-- Summary Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center mb-2">
            <i class="fas fa-university text-blue-600 mr-3"></i>
            <div>
                <p class="text-sm text-gray-500">Departments</p>
                <p class="text-2xl font-bold text-gray-800" id="departmentCount">5</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="flex items-center mb-2">
            <i class="fas fa-book text-green-600 mr-3"></i>
            <div>
                <p class="text-sm text-gray-500">Courses</p>
                <p class="text-2xl font-bold text-gray-800" id="courseCount">8</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="flex items-center mb-2">
            <i class="fas fa-users text-purple-600 mr-3"></i>
            <div>
                <p class="text-sm text-gray-500">Sections</p>
                <p class="text-2xl font-bold text-gray-800" id="sectionCount">12</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="flex items-center mb-2">
            <i class="fas fa-chart-line text-orange-600 mr-3"></i>
            <div>
                <p class="text-sm text-gray-500">Avg. Attainment</p>
                <p class="text-2xl font-bold text-gray-800" id="avgAttainment">72.5%</p>
            </div>
        </div>
        <div class="progress-bar mt-2">
            <div class="progress-fill bg-orange-500" style="width: 72.5%"></div>
        </div>
    </div>
</div>

<!-- CLO/PLO Report Table -->
<div class="attainment-card">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-secondary">
                <i class="fas fa-table mr-2 text-blue-600"></i> CLO/PLO Attainment Report
            </h2>
            <p class="text-sm text-gray-600 mt-1">Showing <span id="reportCount">10</span> reports</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="resetFilters()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 flex items-center">
                <i class="fas fa-redo mr-2"></i> Reset
            </button>
            <button onclick="exportToExcel()" class="px-4 py-2 bg-success text-white rounded-lg hover:bg-green-700 transition-all duration-300 flex items-center">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </button>
            <button onclick="exportToPDF()" class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-red-700 transition-all duration-300 flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
        </div>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-12">#</th>
                    <th>Department</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Section</th>
                    <th>CLOs</th>
                    <th>PLOs</th>
                    <th>Avg. CLO</th>
                    <th>Avg. PLO</th>
                    <th>Overall Attainment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportTableBody">
                <!-- Reports will be populated here -->
            </tbody>
        </table>
    </div>
    
    <!-- Removed pagination section -->
</div>

<!-- Detailed View Modal -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Detailed Report</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <div class="py-4 max-h-[60vh] overflow-y-auto" id="modalContent">
            <!-- Modal content will be inserted here -->
        </div>
        
        <div class="pt-4 border-t flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 mr-2">Close</button>
            <button onclick="printDetailedReport()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-print mr-2"></i> Print
            </button>
        </div>
    </div>
</div>

<script>
    // Sample data structure
    const reportData = [
        {
            id: 1,
            department: "CS",
            departmentName: "Computer Science",
            courseCode: "CS101",
            courseName: "Introduction to Programming",
            section: "A",
            students: 45,
            cloCount: 4,
            ploCount: 5,
            cloValues: [85, 78, 92, 65],
            ploValues: [82, 75, 88, 65, 70],
            avgCLO: 80.0,
            avgPLO: 76.0,
            overall: 78.0,
            semester: "Fall 2023",
            instructor: "Dr. Sarah Johnson",
            status: "Completed",
            lastUpdated: "2023-12-15",
            trend: "up",
            improvement: "+5.2%"
        },
        {
            id: 2,
            department: "CS",
            departmentName: "Computer Science",
            courseCode: "CS101",
            courseName: "Introduction to Programming",
            section: "C",
            students: 38,
            cloCount: 4,
            ploCount: 5,
            cloValues: [80, 75, 85, 60],
            ploValues: [78, 72, 80, 60, 65],
            avgCLO: 75.0,
            avgPLO: 71.0,
            overall: 73.0,
            semester: "Fall 2023",
            instructor: "Dr. Michael Chen",
            status: "Completed",
            lastUpdated: "2023-12-18",
            trend: "stable",
            improvement: "+1.8%"
        },
        {
            id: 3,
            department: "CS",
            departmentName: "Computer Science",
            courseCode: "CS201",
            courseName: "Data Structures",
            section: "A",
            students: 32,
            cloCount: 3,
            ploCount: 4,
            cloValues: [88, 82, 90],
            ploValues: [85, 80, 87, 75],
            avgCLO: 86.7,
            avgPLO: 81.8,
            overall: 84.3,
            semester: "Fall 2023",
            instructor: "Dr. Robert Wilson",
            status: "Completed",
            lastUpdated: "2023-12-20",
            trend: "up",
            improvement: "+8.5%"
        },
        {
            id: 4,
            department: "CS",
            departmentName: "Computer Science",
            courseCode: "CS301",
            courseName: "Algorithms",
            section: "B",
            students: 28,
            cloCount: 5,
            ploCount: 6,
            cloValues: [92, 85, 88, 76, 81],
            ploValues: [90, 83, 85, 74, 79, 82],
            avgCLO: 84.4,
            avgPLO: 82.2,
            overall: 83.3,
            semester: "Fall 2023",
            instructor: "Dr. Emily Davis",
            status: "In Progress",
            lastUpdated: "2023-12-10",
            trend: "up",
            improvement: "+12.3%"
        },
        {
            id: 5,
            department: "EE",
            departmentName: "Electrical Engineering",
            courseCode: "EE101",
            courseName: "Circuit Analysis",
            section: "A",
            students: 40,
            cloCount: 3,
            ploCount: 4,
            cloValues: [88, 75, 82],
            ploValues: [85, 72, 90, 70],
            avgCLO: 81.7,
            avgPLO: 79.3,
            overall: 80.5,
            semester: "Fall 2023",
            instructor: "Dr. Thomas Edison",
            status: "Completed",
            lastUpdated: "2023-12-22",
            trend: "stable",
            improvement: "+2.1%"
        },
        {
            id: 6,
            department: "EE",
            departmentName: "Electrical Engineering",
            courseCode: "EE201",
            courseName: "Digital Systems",
            section: "B",
            students: 35,
            cloCount: 4,
            ploCount: 5,
            cloValues: [76, 81, 79, 84],
            ploValues: [74, 79, 77, 82, 80],
            avgCLO: 80.0,
            avgPLO: 78.4,
            overall: 79.2,
            semester: "Fall 2023",
            instructor: "Dr. Nikola Tesla",
            status: "Completed",
            lastUpdated: "2023-12-19",
            trend: "down",
            improvement: "-3.5%"
        },
        {
            id: 7,
            department: "ME",
            departmentName: "Mechanical Engineering",
            courseCode: "ME101",
            courseName: "Thermodynamics",
            section: "A",
            students: 42,
            cloCount: 4,
            ploCount: 4,
            cloValues: [72, 68, 75, 65],
            ploValues: [70, 66, 73, 63],
            avgCLO: 70.0,
            avgPLO: 68.0,
            overall: 69.0,
            semester: "Fall 2023",
            instructor: "Dr. James Watt",
            status: "Completed",
            lastUpdated: "2023-12-16",
            trend: "up",
            improvement: "+4.7%"
        },
        {
            id: 8,
            department: "CE",
            departmentName: "Civil Engineering",
            courseCode: "CE101",
            courseName: "Structural Analysis",
            section: "A",
            students: 36,
            cloCount: 3,
            ploCount: 4,
            cloValues: [85, 78, 82],
            ploValues: [82, 75, 88, 72],
            avgCLO: 81.7,
            avgPLO: 79.3,
            overall: 80.5,
            semester: "Fall 2023",
            instructor: "Dr. John Smeaton",
            status: "Completed",
            lastUpdated: "2023-12-21",
            trend: "stable",
            improvement: "+1.2%"
        },
        {
            id: 9,
            department: "IT",
            departmentName: "Information Technology",
            courseCode: "IT101",
            courseName: "Database Systems",
            section: "A",
            students: 48,
            cloCount: 5,
            ploCount: 5,
            cloValues: [90, 85, 88, 82, 87],
            ploValues: [88, 83, 86, 80, 85],
            avgCLO: 86.4,
            avgPLO: 84.4,
            overall: 85.4,
            semester: "Fall 2023",
            instructor: "Dr. Alan Turing",
            status: "Completed",
            lastUpdated: "2023-12-17",
            trend: "up",
            improvement: "+9.8%"
        },
        {
            id: 10,
            department: "CS",
            departmentName: "Computer Science",
            courseCode: "CS101",
            courseName: "Introduction to Programming",
            section: "D",
            students: 30,
            cloCount: 4,
            ploCount: 5,
            cloValues: [45, 52, 60, 40],
            ploValues: [48, 50, 58, 40, 45],
            avgCLO: 49.3,
            avgPLO: 48.2,
            overall: 48.8,
            semester: "Fall 2023",
            instructor: "Dr. Sarah Johnson",
            status: "Needs Attention",
            lastUpdated: "2023-12-14",
            trend: "down",
            improvement: "-15.3%"
        }
    ];

    let filteredData = [...reportData];
    let sortColumn = 'id';
    let sortDirection = 'asc';

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateSummaryStats();
        renderReportTable();
    });

    function updateSummaryStats() {
        const departments = new Set(filteredData.map(item => item.department));
        const courses = new Set(filteredData.map(item => item.courseCode));
        const sections = new Set(filteredData.map(item => `${item.courseCode}-${item.section}`));
        
        const totalAttainment = filteredData.reduce((sum, item) => sum + item.overall, 0);
        const avgAttainment = filteredData.length > 0 ? (totalAttainment / filteredData.length).toFixed(1) : 0;
        
        document.getElementById('departmentCount').textContent = departments.size;
        document.getElementById('courseCount').textContent = courses.size;
        document.getElementById('sectionCount').textContent = sections.size;
        document.getElementById('avgAttainment').textContent = `${avgAttainment}%`;
        
        // Update progress bar
        const avgProgress = document.querySelector('.progress-fill');
        if (avgProgress) {
            avgProgress.style.width = `${avgAttainment}%`;
        }
        
        // Update report count
        document.getElementById('reportCount').textContent = filteredData.length;
    }

    function filterReports() {
        const deptFilter = document.getElementById('filterDepartment').value;
        const courseFilter = document.getElementById('filterCourse').value;
        const sectionFilter = document.getElementById('filterSection').value;
        const attainmentFilter = document.getElementById('filterAttainment').value;
        
        filteredData = reportData.filter(item => {
            // Department filter
            if (deptFilter && item.department !== deptFilter) return false;
            
            // Course filter
            if (courseFilter && item.courseCode !== courseFilter) return false;
            
            // Section filter
            if (sectionFilter && item.section !== sectionFilter) return false;
            
            // Attainment filter
            if (attainmentFilter) {
                if (attainmentFilter === 'high' && item.overall < 70) return false;
                if (attainmentFilter === 'medium' && (item.overall < 50 || item.overall >= 70)) return false;
                if (attainmentFilter === 'low' && item.overall >= 50) return false;
            }
            
            return true;
        });
        
        // Apply current sort
        sortData();
        
        updateSummaryStats();
        renderReportTable();
    }

    function resetFilters() {
        document.getElementById('filterDepartment').value = '';
        document.getElementById('filterCourse').value = '';
        document.getElementById('filterSection').value = '';
        document.getElementById('filterAttainment').value = '';
        
        filterReports();
    }

    function sortData() {
        filteredData.sort((a, b) => {
            let aVal, bVal;
            
            switch(sortColumn) {
                case 'id':
                    aVal = a.id;
                    bVal = b.id;
                    break;
                case 'department':
                    aVal = a.department;
                    bVal = b.department;
                    break;
                case 'course':
                    aVal = a.courseCode;
                    bVal = b.courseCode;
                    break;
                case 'section':
                    aVal = a.section;
                    bVal = b.section;
                    break;
                case 'clo':
                    aVal = a.avgCLO;
                    bVal = b.avgCLO;
                    break;
                case 'plo':
                    aVal = a.avgPLO;
                    bVal = b.avgPLO;
                    break;
                case 'overall':
                    aVal = a.overall;
                    bVal = b.overall;
                    break;
                case 'status':
                    aVal = a.status;
                    bVal = b.status;
                    break;
                default:
                    aVal = a.id;
                    bVal = b.id;
            }
            
            if (sortDirection === 'asc') {
                return aVal > bVal ? 1 : -1;
            } else {
                return aVal < bVal ? 1 : -1;
            }
        });
    }

    function renderReportTable() {
        const tbody = document.getElementById('reportTableBody');
        
        let html = '';
        
        if (filteredData.length === 0) {
            html = `
                <tr>
                    <td colspan="12" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                        <p class="text-lg">No reports found</p>
                        <p class="text-sm mt-2">Try adjusting your filters</p>
                    </td>
                </tr>
            `;
        } else {
            filteredData.forEach((report, index) => {
                const overall = report.overall;
                let attainmentClass = 'attainment-high';
                let statusBadge = 'bg-green-100 text-green-800';
                
                if (overall < 50) {
                    attainmentClass = 'attainment-low';
                    statusBadge = 'bg-red-100 text-red-800';
                } else if (overall < 70) {
                    attainmentClass = 'attainment-medium';
                    statusBadge = 'bg-yellow-100 text-yellow-800';
                }
                
                if (report.status === 'Needs Attention') {
                    statusBadge = 'bg-red-100 text-red-800';
                } else if (report.status === 'In Progress') {
                    statusBadge = 'bg-yellow-100 text-yellow-800';
                }
                
                let trendIcon = 'fas fa-arrow-up text-green-500';
                if (report.trend === 'down') trendIcon = 'fas fa-arrow-down text-red-500';
                if (report.trend === 'stable') trendIcon = 'fas fa-minus text-yellow-500';
                
                html += `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-center">${index + 1}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full ${getDeptColor(report.department)} flex items-center justify-center text-white font-bold mr-3">
                                    ${report.department}
                                </div>
                                <span class="font-medium">${report.departmentName}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">${report.courseCode}</td>
                        <td class="px-6 py-4">${report.courseName}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-bold">
                                ${report.section}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                ${report.cloValues.map((value, i) => `
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs ${getCLOColor(value)}">
                                        CLO${i+1}: ${value}%
                                    </span>
                                `).join('')}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                ${report.ploValues.map((value, i) => `
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs ${getPLOColor(value)}">
                                        PLO${i+1}: ${value}%
                                    </span>
                                `).join('')}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="font-bold mr-2">${report.avgCLO.toFixed(1)}%</span>
                                <div class="progress-bar w-20">
                                    <div class="progress-fill ${getProgressColor(report.avgCLO)}" style="width: ${report.avgCLO}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="font-bold mr-2">${report.avgPLO.toFixed(1)}%</span>
                                <div class="progress-bar w-20">
                                    <div class="progress-fill ${getProgressColor(report.avgPLO)}" style="width: ${report.avgPLO}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="${attainmentClass} font-bold mr-2">${overall.toFixed(1)}%</span>
                                <i class="${trendIcon} text-sm"></i>
                                <span class="text-xs ${getImprovementColor(report.improvement)} ml-1">
                                    ${report.improvement}
                                </span>
                            </div>
                            <div class="progress-bar mt-1">
                                <div class="progress-fill ${getProgressColor(overall)}" style="width: ${overall}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="${statusBadge} attainment-badge">${report.status}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <button onclick="viewDetails(${report.id})" class="text-blue-600 hover:text-blue-800" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="downloadReport(${report.id})" class="text-green-600 hover:text-green-800" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        tbody.innerHTML = html;
    }

    function getDeptColor(dept) {
        const colors = {
            'CS': 'bg-blue-500',
            'EE': 'bg-green-500',
            'ME': 'bg-red-500',
            'CE': 'bg-yellow-500',
            'IT': 'bg-purple-500'
        };
        return colors[dept] || 'bg-gray-500';
    }

    function getCLOColor(value) {
        if (value >= 70) return 'bg-green-100 text-green-800';
        if (value >= 50) return 'bg-yellow-100 text-yellow-800';
        return 'bg-red-100 text-red-800';
    }

    function getPLOColor(value) {
        if (value >= 70) return 'bg-blue-100 text-blue-800';
        if (value >= 50) return 'bg-yellow-100 text-yellow-800';
        return 'bg-red-100 text-red-800';
    }

    function getProgressColor(value) {
        if (value >= 70) return 'bg-green-500';
        if (value >= 50) return 'bg-yellow-500';
        return 'bg-red-500';
    }

    function getImprovementColor(improvement) {
        if (improvement.startsWith('+')) return 'text-green-600';
        if (improvement.startsWith('-')) return 'text-red-600';
        return 'text-yellow-600';
    }

    function viewDetails(reportId) {
        const report = reportData.find(r => r.id === reportId);
        if (!report) return;
        
        const modal = document.getElementById('detailModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        
        modalTitle.textContent = `${report.courseCode} - Section ${report.section} Detailed Report`;
        
        let detailsHtml = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-700 mb-2"><i class="fas fa-info-circle mr-2 text-blue-600"></i> Course Information</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Department:</span>
                            <span class="font-medium">${report.departmentName} (${report.department})</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Course:</span>
                            <span class="font-medium">${report.courseCode} - ${report.courseName}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Section:</span>
                            <span class="font-medium">Section ${report.section}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Instructor:</span>
                            <span class="font-medium">${report.instructor}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Semester:</span>
                            <span class="font-medium">${report.semester}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Students:</span>
                            <span class="font-medium">${report.students}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-700 mb-2"><i class="fas fa-chart-bar mr-2 text-green-600"></i> Attainment Summary</h4>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Average CLO Attainment</span>
                                <span class="text-sm font-bold">${report.avgCLO.toFixed(1)}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill ${getProgressColor(report.avgCLO)}" style="width: ${report.avgCLO}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Average PLO Attainment</span>
                                <span class="text-sm font-bold">${report.avgPLO.toFixed(1)}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill ${getProgressColor(report.avgPLO)}" style="width: ${report.avgPLO}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm text-gray-600">Overall Attainment</span>
                                <span class="text-sm font-bold">${report.overall.toFixed(1)}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill ${getProgressColor(report.overall)}" style="width: ${report.overall}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between pt-2 border-t">
                            <div class="text-center">
                                <div class="text-xs text-gray-500">Trend</div>
                                <div class="font-medium ${report.trend === 'up' ? 'text-green-600' : report.trend === 'down' ? 'text-red-600' : 'text-yellow-600'}">
                                    ${report.trend.charAt(0).toUpperCase() + report.trend.slice(1)}
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="text-xs text-gray-500">Improvement</div>
                                <div class="font-medium ${getImprovementColor(report.improvement)}">
                                    ${report.improvement}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <h4 class="font-bold text-gray-700 mb-3"><i class="fas fa-bullseye mr-2 text-blue-600"></i> CLO Attainment Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-${report.cloCount} gap-4">
                    ${report.cloValues.map((value, index) => `
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-blue-800">CLO${index + 1}</span>
                                <span class="${getCLOColor(value)} px-2 py-1 rounded text-xs">${value}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill ${getProgressColor(value)}" style="width: ${value}%"></div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
            
            <div class="mb-6">
                <h4 class="font-bold text-gray-700 mb-3"><i class="fas fa-chart-line mr-2 text-green-600"></i> PLO Attainment Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-${report.ploCount} gap-4">
                    ${report.ploValues.map((value, index) => `
                        <div class="bg-green-50 p-3 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-green-800">PLO${index + 1}</span>
                                <span class="${getPLOColor(value)} px-2 py-1 rounded text-xs">${value}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill ${getProgressColor(value)}" style="width: ${value}%"></div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
            
            <div class="text-sm text-gray-500">
                <p><i class="fas fa-clock mr-1"></i> Last updated: ${report.lastUpdated}</p>
            </div>
        `;
        
        modalContent.innerHTML = detailsHtml;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
    }

    function downloadReport(reportId) {
        const report = reportData.find(r => r.id === reportId);
        if (!report) return;
        
        alert(`Downloading report for ${report.courseCode} - Section ${report.section}\n\nThis would download a PDF file in a real application.`);
        
        // In a real application, you would generate and download a PDF
        simulateDownload(`${report.courseCode}_Section${report.section}_Report.pdf`);
    }

    function simulateDownload(filename) {
        // Create a temporary link for download simulation
        const link = document.createElement('a');
        link.href = '#';
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportToExcel() {
        const deptFilter = document.getElementById('filterDepartment').value;
        const courseFilter = document.getElementById('filterCourse').value;
        const sectionFilter = document.getElementById('filterSection').value;
        
        let filename = 'CLO_PLO_Report';
        if (deptFilter) filename += `_${deptFilter}`;
        if (courseFilter) filename += `_${courseFilter}`;
        if (sectionFilter) filename += `_Section${sectionFilter}`;
        filename += '.xlsx';
        
        alert(`Exporting ${filteredData.length} reports to Excel as "${filename}"\n\nThis would generate an Excel file in a real application.`);
        simulateDownload(filename);
    }

    function exportToPDF() {
        const deptFilter = document.getElementById('filterDepartment').value;
        const courseFilter = document.getElementById('filterCourse').value;
        const sectionFilter = document.getElementById('filterSection').value;
        
        let filename = 'CLO_PLO_Report';
        if (deptFilter) filename += `_${deptFilter}`;
        if (courseFilter) filename += `_${courseFilter}`;
        if (sectionFilter) filename += `_Section${sectionFilter}`;
        filename += '.pdf';
        
        alert(`Exporting ${filteredData.length} reports to PDF as "${filename}"\n\nThis would generate a PDF file in a real application.`);
        simulateDownload(filename);
    }

    function printDetailedReport() {
        alert('Printing detailed report...\n\nIn a real application, this would print the detailed report view.');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection