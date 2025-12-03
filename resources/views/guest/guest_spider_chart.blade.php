@extends('layouts.guest')

@section('title', 'Attainment Report - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
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
        
        .spider-chart-container {
            @apply relative w-full h-96;
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
    }
</style>

<div class="header">
    <h1 class="text-3xl font-bold text-gray-800"><i class="fas fa-chart-line mr-2 text-primary"></i> Attainment Report</h1>
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
    <span>Attainment Report</span>
</div>

<div class="controls-panel bg-white rounded-2xl p-6 shadow-lg mb-8 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="form-group">
        <label for="departmentSelect" class="block mb-2 text-secondary font-medium">Select Department</label>
        <select id="departmentSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadCourses()">
            <option value="">-- Select a Department --</option>
            <option value="CS" selected>Computer Science (CS)</option>
            <option value="EE">Electrical Engineering (EE)</option>
            <option value="ME">Mechanical Engineering (ME)</option>
            <option value="CE">Civil Engineering (CE)</option>
            <option value="IT">Information Technology (IT)</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="courseSelect" class="block mb-2 text-secondary font-medium">Select Course</label>
        <select id="courseSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadSections()">
            <option value="">-- Select a Course --</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="sectionSelect" class="block mb-2 text-secondary font-medium">Select Section</label>
        <select id="sectionSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadStudents()">
            <option value="">-- Select a Section --</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="studentSelect" class="block mb-2 text-secondary font-medium">Select Student (Optional)</label>
        <select id="studentSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadAttainmentData()">
            <option value="">-- View Course Average --</option>
            <option value="all">All Students (Course Average)</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- PLO Attainment Chart -->
    <div class="attainment-card">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-secondary">
                <i class="fas fa-bullseye mr-2 text-blue-600"></i> PLO Attainment
            </h2>
            <div class="flex items-center gap-2">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                    <span class="text-xs text-gray-600">Attainment</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <span class="text-xs text-gray-600">Baseline (50%)</span>
                </div>
            </div>
        </div>
        <div class="spider-chart-container">
            <canvas id="ploSpiderChart"></canvas>
        </div>
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4" id="ploStats">
            <!-- PLO stats will be dynamically generated -->
        </div>
    </div>

    <!-- CLO Attainment Chart -->
    <div class="attainment-card">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-secondary">
                <i class="fas fa-book mr-2 text-green-600"></i> CLO Attainment
            </h2>
            <div class="flex items-center gap-2">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                    <span class="text-xs text-gray-600">Attainment</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <span class="text-xs text-gray-600">Baseline (50%)</span>
                </div>
            </div>
        </div>
        <div class="spider-chart-container">
            <canvas id="cloSpiderChart"></canvas>
        </div>
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4" id="cloStats">
            <!-- CLO stats will be dynamically generated -->
        </div>
    </div>
</div>

<!-- Summary Statistics -->
<div class="attainment-card mt-8">
    <h2 class="text-xl font-bold text-secondary mb-6">
        <i class="fas fa-chart-bar mr-2 text-purple-600"></i> Summary Statistics
    </h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="summaryStats">
        <!-- Summary stats will be dynamically generated -->
    </div>
</div>

<!-- Action Buttons -->
<div class="action-buttons flex justify-end gap-4 mt-8">
    <button class="btn bg-dark text-white px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-dark/80 hover:translate-y-[-2px]" onclick="exportReport()">
        <i class="fas fa-file-export mr-2"></i> Export Report
    </button>
    <button class="btn btn-success bg-success text-white px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-success/80 hover:translate-y-[-2px]" onclick="printReport()">
        <i class="fas fa-print mr-2"></i> Print Report
    </button>
</div>

<script>
    // Sample Data Structure (This would come from your backend in real implementation)
    const departmentData = {
        'CS': {
            name: 'Computer Science',
            courses: ['CS101', 'CS201', 'CS301'],
            courseDetails: {
                'CS101': {
                    name: 'Introduction to Programming',
                    sections: ['A', 'C'],
                    students: {
                        'A': [
                            { id: 'S1001', name: 'John Smith', program: 'CS', year: '2' },
                            { id: 'S1002', name: 'Emma Watson', program: 'CS', year: '2' },
                            { id: 'S1003', name: 'Michael Brown', program: 'CS', year: '3' },
                            { id: 'S1004', name: 'Sarah Johnson', program: 'CS', year: '2' }
                        ],
                        'C': [
                            { id: 'S2001', name: 'David Wilson', program: 'CS', year: '3' },
                            { id: 'S2002', name: 'Lisa Anderson', program: 'CS', year: '1' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1', 'PLO2'],
                        'CLO2': ['PLO1', 'PLO2', 'PLO3', 'PLO5'],
                        'CLO3': ['PLO3'],
                        'CLO4': ['PLO4']
                    },
                    attainmentData: {
                        'S1001': {
                            clo: { 'CLO1': 85, 'CLO2': 78, 'CLO3': 92, 'CLO4': 65 },
                            plo: { 'PLO1': 82, 'PLO2': 75, 'PLO3': 88, 'PLO4': 65, 'PLO5': 70 }
                        },
                        'S1002': {
                            clo: { 'CLO1': 92, 'CLO2': 88, 'CLO3': 95, 'CLO4': 78 },
                            plo: { 'PLO1': 90, 'PLO2': 85, 'PLO3': 92, 'PLO4': 78, 'PLO5': 82 }
                        },
                        'S1003': {
                            clo: { 'CLO1': 72, 'CLO2': 65, 'CLO3': 78, 'CLO4': 55 },
                            plo: { 'PLO1': 70, 'PLO2': 68, 'PLO3': 72, 'PLO4': 55, 'PLO5': 60 }
                        },
                        'S1004': {
                            clo: { 'CLO1': 45, 'CLO2': 52, 'CLO3': 60, 'CLO4': 40 },
                            plo: { 'PLO1': 48, 'PLO2': 50, 'PLO3': 58, 'PLO4': 40, 'PLO5': 45 }
                        },
                        'S2001': {
                            clo: { 'CLO1': 80, 'CLO2': 75, 'CLO3': 85, 'CLO4': 60 },
                            plo: { 'PLO1': 78, 'PLO2': 72, 'PLO3': 80, 'PLO4': 60, 'PLO5': 65 }
                        },
                        'S2002': {
                            clo: { 'CLO1': 88, 'CLO2': 82, 'CLO3': 90, 'CLO4': 70 },
                            plo: { 'PLO1': 85, 'PLO2': 80, 'PLO3': 87, 'PLO4': 70, 'PLO5': 75 }
                        }
                    }
                },
                'CS201': {
                    name: 'Data Structures',
                    sections: ['A'],
                    students: {
                        'A': [
                            { id: 'S3001', name: 'Robert Taylor', program: 'CS', year: '2' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1'],
                        'CLO2': ['PLO2']
                    },
                    attainmentData: {
                        'S3001': {
                            clo: { 'CLO1': 75, 'CLO2': 80 },
                            plo: { 'PLO1': 75, 'PLO2': 80 }
                        }
                    }
                },
                'CS301': {
                    name: 'Algorithms',
                    sections: ['B'],
                    students: {
                        'B': [
                            { id: 'S4001', name: 'Alex Chen', program: 'CS', year: '3' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO2', 'PLO3']
                    },
                    attainmentData: {
                        'S4001': {
                            clo: { 'CLO1': 85 },
                            plo: { 'PLO2': 82, 'PLO3': 88 }
                        }
                    }
                }
            }
        },
        'EE': {
            name: 'Electrical Engineering',
            courses: ['EE101', 'EE201', 'EE301'],
            courseDetails: {
                'EE101': {
                    name: 'Circuit Analysis',
                    sections: ['A'],
                    students: {
                        'A': [
                            { id: 'E1001', name: 'Thomas Edison', program: 'EE', year: '2' },
                            { id: 'E1002', name: 'Nikola Tesla', program: 'EE', year: '3' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1', 'PLO3'],
                        'CLO2': ['PLO2', 'PLO4']
                    },
                    attainmentData: {
                        'E1001': {
                            clo: { 'CLO1': 88, 'CLO2': 75 },
                            plo: { 'PLO1': 85, 'PLO2': 72, 'PLO3': 90, 'PLO4': 70 }
                        },
                        'E1002': {
                            clo: { 'CLO1': 92, 'CLO2': 85 },
                            plo: { 'PLO1': 90, 'PLO2': 82, 'PLO3': 95, 'PLO4': 80 }
                        }
                    }
                }
            }
        },
        'ME': {
            name: 'Mechanical Engineering',
            courses: ['ME101'],
            courseDetails: {
                'ME101': {
                    name: 'Thermodynamics',
                    sections: ['A'],
                    students: {
                        'A': [
                            { id: 'M1001', name: 'James Watt', program: 'ME', year: '3' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1', 'PLO2'],
                        'CLO2': ['PLO3', 'PLO4']
                    },
                    attainmentData: {
                        'M1001': {
                            clo: { 'CLO1': 80, 'CLO2': 75 },
                            plo: { 'PLO1': 78, 'PLO2': 82, 'PLO3': 72, 'PLO4': 77 }
                        }
                    }
                }
            }
        },
        'CE': {
            name: 'Civil Engineering',
            courses: ['CE101'],
            courseDetails: {
                'CE101': {
                    name: 'Structural Analysis',
                    sections: ['A'],
                    students: {
                        'A': [
                            { id: 'C1001', name: 'John Smeaton', program: 'CE', year: '2' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1', 'PLO3'],
                        'CLO2': ['PLO2', 'PLO4']
                    },
                    attainmentData: {
                        'C1001': {
                            clo: { 'CLO1': 85, 'CLO2': 78 },
                            plo: { 'PLO1': 82, 'PLO2': 75, 'PLO3': 88, 'PLO4': 72 }
                        }
                    }
                }
            }
        },
        'IT': {
            name: 'Information Technology',
            courses: ['IT101'],
            courseDetails: {
                'IT101': {
                    name: 'Database Systems',
                    sections: ['A'],
                    students: {
                        'A': [
                            { id: 'I1001', name: 'Alan Turing', program: 'IT', year: '3' }
                        ]
                    },
                    cloPloMapping: {
                        'CLO1': ['PLO1', 'PLO2'],
                        'CLO2': ['PLO3', 'PLO4']
                    },
                    attainmentData: {
                        'I1001': {
                            clo: { 'CLO1': 90, 'CLO2': 85 },
                            plo: { 'PLO1': 88, 'PLO2': 92, 'PLO3': 82, 'PLO4': 87 }
                        }
                    }
                }
            }
        }
    };

    let ploChart = null;
    let cloChart = null;
    let currentDepartment = 'CS';
    let currentCourseCode = 'CS101';

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Load courses for default department (CS)
        loadCourses();
        
        // Set default department and load data
        setTimeout(() => {
            const departmentSelect = document.getElementById('departmentSelect');
            if (departmentSelect.value) {
                loadCourses();
                setTimeout(() => {
                    const courseSelect = document.getElementById('courseSelect');
                    if (courseSelect.options.length > 1) {
                        courseSelect.value = 'CS101';
                        loadSections();
                        setTimeout(() => {
                            const sectionSelect = document.getElementById('sectionSelect');
                            if (sectionSelect.options.length > 1) {
                                sectionSelect.value = 'A';
                                loadStudents();
                                // Load course average by default
                                loadAttainmentData();
                            }
                        }, 100);
                    }
                }, 100);
            }
        }, 100);
    });

    function loadCourses() {
        const departmentSelect = document.getElementById('departmentSelect');
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const studentSelect = document.getElementById('studentSelect');
        
        const selectedDepartment = departmentSelect.value;
        
        // Clear all dependent dropdowns
        courseSelect.innerHTML = '<option value="">-- Select a Course --</option>';
        sectionSelect.innerHTML = '<option value="">-- Select a Section --</option>';
        studentSelect.innerHTML = '<option value="">-- View Course Average --</option><option value="all">All Students (Course Average)</option>';
        
        if (selectedDepartment && departmentData[selectedDepartment]) {
            currentDepartment = selectedDepartment;
            
            // Populate courses for selected department
            departmentData[selectedDepartment].courses.forEach(courseCode => {
                const course = departmentData[selectedDepartment].courseDetails[courseCode];
                const option = document.createElement('option');
                option.value = courseCode;
                option.textContent = `${courseCode} - ${course.name}`;
                courseSelect.appendChild(option);
            });
            
            // Auto-select first course if available
            if (departmentData[selectedDepartment].courses.length > 0) {
                courseSelect.value = departmentData[selectedDepartment].courses[0];
                currentCourseCode = courseSelect.value;
                loadSections();
            }
        }
    }

    function loadSections() {
        const departmentSelect = document.getElementById('departmentSelect');
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const studentSelect = document.getElementById('studentSelect');
        
        const selectedDepartment = departmentSelect.value;
        const selectedCourse = courseSelect.value;
        
        // Clear dependent dropdowns
        sectionSelect.innerHTML = '<option value="">-- Select a Section --</option>';
        studentSelect.innerHTML = '<option value="">-- View Course Average --</option><option value="all">All Students (Course Average)</option>';
        
        if (selectedDepartment && selectedCourse && 
            departmentData[selectedDepartment] && 
            departmentData[selectedDepartment].courseDetails[selectedCourse]) {
            
            currentCourseCode = selectedCourse;
            const course = departmentData[selectedDepartment].courseDetails[selectedCourse];
            
            // Populate sections for selected course
            course.sections.forEach(sectionCode => {
                const option = document.createElement('option');
                option.value = sectionCode;
                option.textContent = `Section ${sectionCode}`;
                sectionSelect.appendChild(option);
            });
            
            // Auto-select first section if available
            if (course.sections.length > 0) {
                sectionSelect.value = course.sections[0];
                loadStudents();
            }
        }
    }

    function loadStudents() {
        const departmentSelect = document.getElementById('departmentSelect');
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const studentSelect = document.getElementById('studentSelect');
        
        const selectedDepartment = departmentSelect.value;
        const selectedCourse = courseSelect.value;
        const selectedSection = sectionSelect.value;
        
        // Clear existing student options except the first two
        studentSelect.innerHTML = '<option value="">-- View Course Average --</option><option value="all">All Students (Course Average)</option>';
        
        if (selectedDepartment && selectedCourse && selectedSection && 
            departmentData[selectedDepartment] && 
            departmentData[selectedDepartment].courseDetails[selectedCourse] &&
            departmentData[selectedDepartment].courseDetails[selectedCourse].students[selectedSection]) {
            
            const course = departmentData[selectedDepartment].courseDetails[selectedCourse];
            
            course.students[selectedSection].forEach(student => {
                const option = document.createElement('option');
                option.value = student.id;
                option.textContent = `${student.id} - ${student.name}`;
                studentSelect.appendChild(option);
            });
        }
        
        // Load data for course average by default
        loadAttainmentData();
    }

    function loadAttainmentData() {
        const departmentSelect = document.getElementById('departmentSelect');
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const studentSelect = document.getElementById('studentSelect');
        
        const selectedDepartment = departmentSelect.value;
        const selectedCourse = courseSelect.value;
        const selectedSection = sectionSelect.value;
        const studentId = studentSelect.value;
        
        if (!selectedDepartment || !selectedCourse || !departmentData[selectedDepartment]) {
            alert("Please select a department and course first.");
            return;
        }
        
        const course = departmentData[selectedDepartment].courseDetails[selectedCourse];
        if (!course) {
            alert("Selected course not found.");
            return;
        }
        
        let attainmentData;
        let titleSuffix = "";
        
        if (studentId === "all" || studentId === "") {
            // Calculate course average
            attainmentData = calculateCourseAverage(selectedDepartment, selectedCourse, selectedSection);
            titleSuffix = selectedSection ? ` - Section ${selectedSection} Average` : " - Course Average";
        } else {
            // Get individual student data
            attainmentData = course.attainmentData[studentId];
            const student = findStudentById(selectedDepartment, selectedCourse, selectedSection, studentId);
            titleSuffix = student ? ` - ${student.name} (${studentId})` : ` - Student ${studentId}`;
        }
        
        if (!attainmentData) {
            alert("No attainment data available for the selected options.");
            return;
        }
        
        // Update charts
        renderPLOSpiderChart(attainmentData.plo, titleSuffix);
        renderCLOSpiderChart(attainmentData.clo, titleSuffix);
        
        // Update summary statistics
        renderSummaryStats(attainmentData, studentId);
    }

    function calculateCourseAverage(departmentCode, courseCode, sectionCode = null) {
        const department = departmentData[departmentCode];
        if (!department) return null;
        
        const course = department.courseDetails[courseCode];
        if (!course) return null;
        
        let cloSums = {};
        let ploSums = {};
        let cloCounts = {};
        let ploCounts = {};
        let studentCount = 0;
        
        // Determine which students to include
        let studentsToInclude = [];
        if (sectionCode) {
            studentsToInclude = course.students[sectionCode] || [];
        } else {
            // Include all students from all sections
            Object.values(course.students).forEach(sectionStudents => {
                studentsToInclude = studentsToInclude.concat(sectionStudents);
            });
        }
        
        // Sum up attainment for all included students
        studentsToInclude.forEach(student => {
            const studentData = course.attainmentData[student.id];
            if (studentData) {
                studentCount++;
                
                // Sum CLO attainment
                Object.entries(studentData.clo).forEach(([clo, value]) => {
                    cloSums[clo] = (cloSums[clo] || 0) + value;
                    cloCounts[clo] = (cloCounts[clo] || 0) + 1;
                });
                
                // Sum PLO attainment
                Object.entries(studentData.plo).forEach(([plo, value]) => {
                    ploSums[plo] = (ploSums[plo] || 0) + value;
                    ploCounts[plo] = (ploCounts[plo] || 0) + 1;
                });
            }
        });
        
        // Calculate averages
        const cloAverages = {};
        Object.keys(cloSums).forEach(clo => {
            cloAverages[clo] = Math.round(cloSums[clo] / cloCounts[clo]);
        });
        
        const ploAverages = {};
        Object.keys(ploSums).forEach(plo => {
            ploAverages[plo] = Math.round(ploSums[plo] / ploCounts[plo]);
        });
        
        return {
            clo: cloAverages,
            plo: ploAverages,
            studentCount: studentCount
        };
    }

    function findStudentById(departmentCode, courseCode, sectionCode, studentId) {
        const department = departmentData[departmentCode];
        if (!department) return null;
        
        const course = department.courseDetails[courseCode];
        if (!course) return null;
        
        if (sectionCode && course.students[sectionCode]) {
            return course.students[sectionCode].find(s => s.id === studentId);
        }
        
        // Search through all sections if section not specified
        for (const section in course.students) {
            const student = course.students[section].find(s => s.id === studentId);
            if (student) return student;
        }
        
        return null;
    }

    function renderPLOSpiderChart(ploData, titleSuffix) {
        const ctx = document.getElementById('ploSpiderChart').getContext('2d');
        
        // Destroy existing chart if it exists
        if (ploChart) {
            ploChart.destroy();
        }
        
        const ploNames = Object.keys(ploData).sort();
        const ploValues = ploNames.map(plo => ploData[plo]);
        const baseline = Array(ploNames.length).fill(50);
        
        const data = {
            labels: ploNames,
            datasets: [
                {
                    label: 'Attainment',
                    data: ploValues,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgb(59, 130, 246)',
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(59, 130, 246)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Baseline (50%)',
                    data: baseline,
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderColor: 'rgb(239, 68, 68)',
                    pointBackgroundColor: 'rgb(239, 68, 68)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(239, 68, 68)',
                    borderWidth: 1,
                    borderDash: [5, 5],
                    fill: false
                }
            ]
        };
        
        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'PLO Attainment' + titleSuffix,
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}%`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: {
                            stepSize: 20,
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        pointLabels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        };
        
        ploChart = new Chart(ctx, config);
        
        // Update PLO stats
        renderPLOStats(ploData);
    }

    function renderCLOSpiderChart(cloData, titleSuffix) {
        const ctx = document.getElementById('cloSpiderChart').getContext('2d');
        
        // Destroy existing chart if it exists
        if (cloChart) {
            cloChart.destroy();
        }
        
        const cloNames = Object.keys(cloData).sort();
        const cloValues = cloNames.map(clo => cloData[clo]);
        const baseline = Array(cloNames.length).fill(50);
        
        const data = {
            labels: cloNames,
            datasets: [
                {
                    label: 'Attainment',
                    data: cloValues,
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: 'rgb(34, 197, 94)',
                    pointBackgroundColor: 'rgb(34, 197, 94)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(34, 197, 94)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Baseline (50%)',
                    data: baseline,
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderColor: 'rgb(239, 68, 68)',
                    pointBackgroundColor: 'rgb(239, 68, 68)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(239, 68, 68)',
                    borderWidth: 1,
                    borderDash: [5, 5],
                    fill: false
                }
            ]
        };
        
        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'CLO Attainment' + titleSuffix,
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}%`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: {
                            stepSize: 20,
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        pointLabels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        };
        
        cloChart = new Chart(ctx, config);
        
        // Update CLO stats
        renderCLOStats(cloData);
    }

    function renderPLOStats(ploData) {
        const ploStatsDiv = document.getElementById('ploStats');
        let html = '';
        
        Object.entries(ploData).forEach(([plo, value]) => {
            let attainmentClass = 'attainment-high';
            if (value < 50) attainmentClass = 'attainment-low';
            else if (value < 70) attainmentClass = 'attainment-medium';
            
            html += `
                <div class="stat-card">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-gray-700">${plo}</span>
                        <span class="${attainmentClass}">${value}%</span>
                    </div>
                    <div class="cloplobar">
                        <div class="cloplobar-fill bg-blue-500" style="width: ${value}%"></div>
                    </div>
                    <div class="flex justify-between mt-1 text-xs text-gray-500">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>
            `;
        });
        
        ploStatsDiv.innerHTML = html;
    }

    function renderCLOStats(cloData) {
        const cloStatsDiv = document.getElementById('cloStats');
        let html = '';
        
        Object.entries(cloData).forEach(([clo, value]) => {
            let attainmentClass = 'attainment-high';
            if (value < 50) attainmentClass = 'attainment-low';
            else if (value < 70) attainmentClass = 'attainment-medium';
            
            html += `
                <div class="stat-card">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-gray-700">${clo}</span>
                        <span class="${attainmentClass}">${value}%</span>
                    </div>
                    <div class="cloplobar">
                        <div class="cloplobar-fill bg-green-500" style="width: ${value}%"></div>
                    </div>
                    <div class="flex justify-between mt-1 text-xs text-gray-500">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>
            `;
        });
        
        cloStatsDiv.innerHTML = html;
    }

    function renderSummaryStats(attainmentData, studentId) {
        const ploData = attainmentData.plo;
        const cloData = attainmentData.clo;
        
        const ploValues = Object.values(ploData);
        const cloValues = Object.values(cloData);
        
        const averagePLO = ploValues.reduce((a, b) => a + b, 0) / ploValues.length;
        const averageCLO = cloValues.reduce((a, b) => a + b, 0) / cloValues.length;
        
        const ploAboveBaseline = ploValues.filter(v => v >= 50).length;
        const cloAboveBaseline = cloValues.filter(v => v >= 50).length;
        
        const ploPercentage = Math.round((ploAboveBaseline / ploValues.length) * 100);
        const cloPercentage = Math.round((cloAboveBaseline / cloValues.length) * 100);
        
        const highestPLO = Math.max(...ploValues);
        const lowestPLO = Math.min(...ploValues);
        const highestCLO = Math.max(...cloValues);
        const lowestCLO = Math.min(...cloValues);
        
        const summaryStatsDiv = document.getElementById('summaryStats');
        const studentCount = attainmentData.studentCount || 1;
        
        let html = `
            <div class="stat-card">
                <div class="flex items-center mb-2">
                    <i class="fas fa-user-graduate text-blue-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-500">Students Analyzed</p>
                        <p class="text-2xl font-bold text-gray-800">${studentCount}</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center mb-2">
                    <i class="fas fa-bullseye text-blue-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-500">Average PLO Attainment</p>
                        <p class="text-2xl font-bold text-gray-800">${averagePLO.toFixed(1)}%</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">${ploAboveBaseline}/${ploValues.length} PLOs achieved</p>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center mb-2">
                    <i class="fas fa-book text-green-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-500">Average CLO Attainment</p>
                        <p class="text-2xl font-bold text-gray-800">${averageCLO.toFixed(1)}%</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">${cloAboveBaseline}/${cloValues.length} CLOs achieved</p>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center mb-2">
                    <i class="fas fa-chart-bar text-purple-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-500">Attainment Range</p>
                        <p class="text-lg font-bold text-gray-800">PLO: ${lowestPLO}-${highestPLO}%</p>
                        <p class="text-lg font-bold text-gray-800">CLO: ${lowestCLO}-${highestCLO}%</p>
                    </div>
                </div>
            </div>
        `;
        
        summaryStatsDiv.innerHTML = html;
    }

    function exportReport() {
        const departmentSelect = document.getElementById('departmentSelect');
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const studentSelect = document.getElementById('studentSelect');
        
        const department = departmentSelect.options[departmentSelect.selectedIndex].text;
        const course = courseSelect.options[courseSelect.selectedIndex].text;
        const section = sectionSelect.value ? `Section ${sectionSelect.value}` : 'All Sections';
        const student = studentSelect.options[studentSelect.selectedIndex].text;
        
        // In a real application, this would generate and download a PDF/Excel file
        alert(`Exporting report for:\nDepartment: ${department}\nCourse: ${course}\nSection: ${section}\nStudent: ${student}\n\nThis would generate a PDF/Excel file in a real application.`);
    }

    function printReport() {
        window.print();
    }
</script>
@endsection