@extends('layouts.lecturer')

@section('title', 'Marks Entry - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Custom Tailwind Configuration to match previous styles
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
                    // Assessment Colors (Matching Assessment Management)
                    'quiz': '#3498db',
                    'practical': '#1abc9c',
                    'assignment': '#f39c12',
                    'presentation': '#e67e22',
                    'casestudy': '#9b59b6',
                    'midexam': '#e74c3c',
                    'finalexam': '#c0392b',
                    // PLO Colors (Matching Assessment Management)
                    'plo1': '#3498db',
                    'plo2': '#2ecc71',
                    'plo3': '#f39c12',
                    'plo4': '#9b59b6',
                    'plo5': '#e74c3c',
                    'plo6': '#1abc9c',
                    'plo7': '#34495e',
                    'plo8': '#95a5a6',
                },
                tableLayout: {
                    'fixed': 'fixed',
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
        .marks-table-container {
            @apply overflow-x-auto rounded-xl shadow-xl border-2 border-gray-100 bg-white;
        }
        
        .marks-table {
            @apply w-full border-collapse;
            min-width: 1400px;
        }
        
        .marks-table th, .marks-table td {
            @apply p-1 text-center text-xs border border-gray-200 align-middle;
        }
        
        .marks-table thead th {
            @apply sticky top-0 bg-gray-bg font-bold text-dark/80;
        }
        
        .marks-table thead tr:nth-child(1) th {
            @apply bg-primary/20 text-dark;
        }
        
        .marks-table tbody td {
            @apply hover:bg-gray-50 transition-colors duration-100;
        }
        
        .marks-input {
            @apply w-full h-full p-1 text-center bg-transparent border-none outline-none focus:bg-yellow-100 focus:ring-1 focus:ring-yellow-500;
        }

        .sticky-col {
            @apply sticky left-0 z-20 bg-white shadow-md;
        }

        .sticky-col-header {
            @apply sticky left-0 z-30 bg-primary/20 font-bold text-dark;
        }

        .final-marks-col {
            @apply bg-success/10 font-bold text-success;
        }

        .assessment-badge {
            @apply px-2 py-1 rounded-full text-[0.65rem] font-medium flex items-center gap-1;
        }
        
        .quiz-badge { @apply bg-blue-100 text-blue-800; }
        .practical-badge { @apply bg-green-100 text-green-800; }
        .assignment-badge { @apply bg-yellow-100 text-yellow-800; }
        .presentation-badge { @apply bg-orange-100 text-orange-800; }
        .casestudy-badge { @apply bg-purple-100 text-purple-800; }
        .midexam-badge { @apply bg-red-100 text-red-800; }
        .finalexam-badge { @apply bg-red-200 text-red-900; }
        
        .plo-badge-1 { @apply bg-blue-100 text-blue-800; }
        .plo-badge-2 { @apply bg-green-100 text-green-800; }
        .plo-badge-3 { @apply bg-yellow-100 text-yellow-800; }
        .plo-badge-4 { @apply bg-purple-100 text-purple-800; }
        .plo-badge-5 { @apply bg-red-100 text-red-800; }
        .plo-badge-6 { @apply bg-teal-100 text-teal-800; }
        .plo-badge-7 { @apply bg-gray-100 text-gray-800; }
        .plo-badge-8 { @apply bg-gray-200 text-gray-900; }
        
        .grade-a { @apply text-success; }
        .grade-b { @apply text-green-600; }
        .grade-c { @apply text-warning; }
        .grade-d { @apply text-orange-600; }
        .grade-f { @apply text-accent; }
    }
</style>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="header">
    <h1 class="text-3xl font-bold text-gray-800"><i class="fas fa-file-invoice mr-2 text-primary"></i> Student Marks Entry</h1>
    <div class="user-info">
        <div>
            <h3 class="text-sm font-semibold m-0">Dr. Sarah Johnson</h3>
            <p class="text-xs text-gray-500 m-0">Course Lecturer (L001)</p>
        </div>
        <img src="https://i.pravatar.cc/150?img=5" alt="Lecturer Avatar" class="w-12 h-12 rounded-full object-cover ring-4 ring-primary ring-offset-2">
    </div>
</div>

<div class="breadcrumb flex items-center gap-2 mb-8 bg-white p-4 rounded-xl shadow-md text-gray-500 text-sm">
    <a href="#" class="text-primary hover:underline"><i class="fas fa-home"></i> Dashboard</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Marks Entry</span>
</div>

<div class="controls-panel bg-white rounded-2xl p-6 shadow-lg mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="form-group">
        <label for="courseSelect" class="block mb-2 text-secondary font-medium">Select Course</label>
        <select id="courseSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadSections()">
            <option value="">-- Select a Course --</option>
            <option value="CS101" selected>CS101 - Introduction to Programming</option>
            <option value="CS201">CS201 - Data Structures</option>
            <option value="CS301">CS301 - Algorithms</option>
            <option value="EE101">EE101 - Circuit Analysis</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="sectionSelect" class="block mb-2 text-secondary font-medium">Select Section</label>
        <select id="sectionSelect" class="w-full p-3 border border-gray-300 rounded-lg text-base transition-all duration-300 ease-in-out focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" onchange="loadStudentMarks()">
            <option value="">-- Select a Section --</option>
        </select>
    </div>
    
    <div class="file-actions flex flex-col gap-3">
        <button class="btn bg-dark text-white px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-dark/80 hover:translate-y-[-2px] disabled:opacity-50" id="downloadTemplateBtn" disabled onclick="simulateDownload()">
            <i class="fas fa-file-download mr-2"></i> Download Marks Template
        </button>
        <div class="relative">
            <input type="file" id="marksImportFile" accept=".xls,.xlsx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer disabled:cursor-not-allowed" disabled onchange="simulateImport(event)">
            <button class="btn bg-warning text-white w-full px-5 py-2.5 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-warning/80 hover:translate-y-[-2px] disabled:opacity-50" id="importMarksBtn" disabled onclick="document.getElementById('marksImportFile').click()">
                <i class="fas fa-file-upload mr-2"></i> Import Marks Excel
            </button>
        </div>
    </div>
</div>

<div class="marks-display hidden" id="marksTableArea">
    <h2 class="text-xl font-bold text-secondary mb-4 flex items-center">
        <i class="fas fa-table mr-2 text-primary"></i> Marks Sheet for <span id="marksTitle"></span>
    </h2>

    <div class="marks-table-container">
        <table class="marks-table">
            <thead id="marksTableHeader">
                <!-- Header will be dynamically generated -->
            </thead>
            <tbody id="marksTableBody">
                <!-- Body will be dynamically generated -->
            </tbody>
        </table>
    </div>
    
    <div class="summary-card bg-white rounded-2xl p-6 shadow-lg mt-6">
        <h3 class="text-lg font-bold text-secondary mb-4">Assessment Summary</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="assessmentSummary">
            <!-- Summary will be dynamically generated -->
        </div>
    </div>
    
    <div class="action-buttons flex justify-end gap-4 mt-7">
        <button class="btn bg-accent text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-accent/80 hover:translate-y-[-2px]" onclick="resetMarks()">
            <i class="fas fa-trash-restore mr-2"></i> Reset Marks
        </button>
        <button class="btn btn-success bg-success text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-success/80 hover:translate-y-[-2px]" onclick="saveMarks()">
            <i class="fas fa-save mr-2"></i> Save Marks
        </button>
    </div>
</div>

<script>
    const currentLecturerId = "L001";
    
    // --- ASSESSMENT STRUCTURE (Matches the Assessment Management Page with detailed CLO-PLO breakdown) ---
    const assessmentStructure = {
        'CS101': {
            assessments: [
                {
                    name: 'Quiz 1',
                    rawMax: 10,
                    weight: 10,
                    type: 'quiz',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO1', marks: 3, percentage: 3 },
                        { clo: 'CLO1', plo: 'PLO2', marks: 2, percentage: 2 },
                        { clo: 'CLO2', plo: 'PLO1', marks: 5, percentage: 5 }
                    ]
                },
                {
                    name: 'Quiz 2',
                    rawMax: 5,
                    weight: 5,
                    type: 'quiz',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO1', marks: 5, percentage: 5 }
                    ]
                },
                {
                    name: 'Quiz 3',
                    rawMax: 5,
                    weight: 5,
                    type: 'quiz',
                    cloPloPairs: [
                        { clo: 'CLO2', plo: 'PLO2', marks: 5, percentage: 5 }
                    ]
                },
                {
                    name: 'Lab Test 1',
                    rawMax: 20,
                    weight: 20,
                    type: 'practical',
                    cloPloPairs: [
                        { clo: 'CLO2', plo: 'PLO3', marks: 6, percentage: 6 },
                        { clo: 'CLO2', plo: 'PLO5', marks: 4, percentage: 4 },
                        { clo: 'CLO3', plo: 'PLO3', marks: 10, percentage: 10 }
                    ]
                },
                {
                    name: 'Lab Test 2',
                    rawMax: 10,
                    weight: 10,
                    type: 'practical',
                    cloPloPairs: [
                        { clo: 'CLO3', plo: 'PLO3', marks: 10, percentage: 10 }
                    ]
                },
                {
                    name: 'Assignment 1',
                    rawMax: 15,
                    weight: 15,
                    type: 'assignment',
                    cloPloPairs: [
                        { clo: 'CLO2', plo: 'PLO2', marks: 7, percentage: 7 },
                        { clo: 'CLO2', plo: 'PLO3', marks: 3, percentage: 3 },
                        { clo: 'CLO4', plo: 'PLO4', marks: 5, percentage: 5 }
                    ]
                },
                {
                    name: 'Mid-Semester Examination',
                    rawMax: 20,
                    weight: 20,
                    type: 'midexam',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO1', marks: 5, percentage: 5 },
                        { clo: 'CLO2', plo: 'PLO2', marks: 8, percentage: 8 },
                        { clo: 'CLO2', plo: 'PLO3', marks: 4, percentage: 4 },
                        { clo: 'CLO3', plo: 'PLO3', marks: 3, percentage: 3 }
                    ]
                },
                {
                    name: 'End of Semester Exam',
                    rawMax: 40,
                    weight: 40,
                    type: 'finalexam',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO1', marks: 10, percentage: 10 },
                        { clo: 'CLO2', plo: 'PLO2', marks: 15, percentage: 15 },
                        { clo: 'CLO3', plo: 'PLO3', marks: 10, percentage: 10 },
                        { clo: 'CLO4', plo: 'PLO4', marks: 5, percentage: 5 }
                    ]
                }
            ],
            totalWeight: 100 // Sum of all assessment weights
        },
        'CS201': {
            assessments: [
                {
                    name: 'Midterm',
                    rawMax: 100,
                    weight: 20,
                    type: 'midexam',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO1', marks: 50, percentage: 10 },
                        { clo: 'CLO2', plo: 'PLO2', marks: 50, percentage: 10 }
                    ]
                }
            ],
            totalWeight: 20
        },
        'CS301': {
            assessments: [
                {
                    name: 'Quiz 1',
                    rawMax: 25,
                    weight: 5,
                    type: 'quiz',
                    cloPloPairs: [
                        { clo: 'CLO1', plo: 'PLO2', marks: 10, percentage: 2 },
                        { clo: 'CLO1', plo: 'PLO3', marks: 15, percentage: 3 }
                    ]
                }
            ],
            totalWeight: 5
        }
    };

    // Student and Section Data
    const assignedSections = {
        'CS101': ['A', 'C'],
        'CS201': ['A'],
        'CS301': ['B'],
        'EE101': ['A']
    };
    
    const sectionStudents = {
        'CS101-A': [
            { 
                id: 'S1001', 
                name: 'John Smith', 
                program: 'CS', 
                year: '2', 
                marks: { 
                    'Quiz 1': { total: 8.5, breakdown: { 'CLO1→PLO1': 2.5, 'CLO1→PLO2': 1.7, 'CLO2→PLO1': 4.3 } },
                    'Quiz 2': { total: 4.2, breakdown: { 'CLO1→PLO1': 4.2 } },
                    'Quiz 3': { total: 4.8, breakdown: { 'CLO2→PLO2': 4.8 } },
                    'Lab Test 1': { total: 18.5, breakdown: { 'CLO2→PLO3': 5.6, 'CLO2→PLO5': 3.7, 'CLO3→PLO3': 9.2 } },
                    'Lab Test 2': { total: 9.2, breakdown: { 'CLO3→PLO3': 9.2 } },
                    'Assignment 1': { total: 14.0, breakdown: { 'CLO2→PLO2': 6.5, 'CLO2→PLO3': 2.8, 'CLO4→PLO4': 4.7 } },
                    'Mid-Semester Examination': { total: 17.5, breakdown: { 'CLO1→PLO1': 4.4, 'CLO2→PLO2': 7.0, 'CLO2→PLO3': 3.5, 'CLO3→PLO3': 2.6 } },
                    'End of Semester Exam': { total: 32.5, breakdown: { 'CLO1→PLO1': 8.1, 'CLO2→PLO2': 12.2, 'CLO3→PLO3': 8.1, 'CLO4→PLO4': 4.1 } }
                } 
            },
            { 
                id: 'S1002', 
                name: 'Emma Watson', 
                program: 'CS', 
                year: '2', 
                marks: { 
                    'Quiz 1': { total: 9.5, breakdown: { 'CLO1→PLO1': 2.9, 'CLO1→PLO2': 1.9, 'CLO2→PLO1': 4.7 } },
                    'Quiz 2': { total: 4.8, breakdown: { 'CLO1→PLO1': 4.8 } },
                    'Quiz 3': { total: 4.5, breakdown: { 'CLO2→PLO2': 4.5 } },
                    'Lab Test 1': { total: 19.0, breakdown: { 'CLO2→PLO3': 5.7, 'CLO2→PLO5': 3.8, 'CLO3→PLO3': 9.5 } },
                    'Lab Test 2': { total: 9.8, breakdown: { 'CLO3→PLO3': 9.8 } },
                    'Assignment 1': { total: 13.5, breakdown: { 'CLO2→PLO2': 6.3, 'CLO2→PLO3': 2.7, 'CLO4→PLO4': 4.5 } },
                    'Mid-Semester Examination': { total: 18.5, breakdown: { 'CLO1→PLO1': 4.6, 'CLO2→PLO2': 7.4, 'CLO2→PLO3': 3.7, 'CLO3→PLO3': 2.8 } },
                    'End of Semester Exam': { total: 35.0, breakdown: { 'CLO1→PLO1': 8.8, 'CLO2→PLO2': 13.1, 'CLO3→PLO3': 8.8, 'CLO4→PLO4': 4.3 } }
                } 
            },
            { 
                id: 'S1003', 
                name: 'Michael Brown', 
                program: 'CS', 
                year: '3', 
                marks: { 
                    'Quiz 1': { total: 7.8, breakdown: { 'CLO1→PLO1': 2.3, 'CLO1→PLO2': 1.6, 'CLO2→PLO1': 3.9 } },
                    'Quiz 2': { total: 3.9, breakdown: { 'CLO1→PLO1': 3.9 } },
                    'Quiz 3': { total: 4.0, breakdown: { 'CLO2→PLO2': 4.0 } },
                    'Lab Test 1': { total: 16.5, breakdown: { 'CLO2→PLO3': 5.0, 'CLO2→PLO5': 3.3, 'CLO3→PLO3': 8.2 } },
                    'Lab Test 2': { total: 8.5, breakdown: { 'CLO3→PLO3': 8.5 } },
                    'Assignment 1': { total: 12.0, breakdown: { 'CLO2→PLO2': 5.6, 'CLO2→PLO3': 2.4, 'CLO4→PLO4': 4.0 } },
                    'Mid-Semester Examination': { total: 16.0, breakdown: { 'CLO1→PLO1': 4.0, 'CLO2→PLO2': 6.4, 'CLO2→PLO3': 3.2, 'CLO3→PLO3': 2.4 } },
                    'End of Semester Exam': { total: 28.5, breakdown: { 'CLO1→PLO1': 7.1, 'CLO2→PLO2': 10.7, 'CLO3→PLO3': 7.1, 'CLO4→PLO4': 3.6 } }
                } 
            },
            { 
                id: 'S1004', 
                name: 'Sarah Johnson', 
                program: 'CS', 
                year: '2', 
                marks: { 
                    'Quiz 1': { total: 0, breakdown: { 'CLO1→PLO1': 0, 'CLO1→PLO2': 0, 'CLO2→PLO1': 0 } },
                    'Quiz 2': { total: 0, breakdown: { 'CLO1→PLO1': 0 } },
                    'Quiz 3': { total: 0, breakdown: { 'CLO2→PLO2': 0 } },
                    'Lab Test 1': { total: 0, breakdown: { 'CLO2→PLO3': 0, 'CLO2→PLO5': 0, 'CLO3→PLO3': 0 } },
                    'Lab Test 2': { total: 0, breakdown: { 'CLO3→PLO3': 0 } },
                    'Assignment 1': { total: 0, breakdown: { 'CLO2→PLO2': 0, 'CLO2→PLO3': 0, 'CLO4→PLO4': 0 } },
                    'Mid-Semester Examination': { total: 0, breakdown: { 'CLO1→PLO1': 0, 'CLO2→PLO2': 0, 'CLO2→PLO3': 0, 'CLO3→PLO3': 0 } },
                    'End of Semester Exam': { total: 0, breakdown: { 'CLO1→PLO1': 0, 'CLO2→PLO2': 0, 'CLO3→PLO3': 0, 'CLO4→PLO4': 0 } }
                } 
            },
        ],
        'CS101-C': [
            { 
                id: 'S2001', 
                name: 'David Wilson', 
                program: 'CS', 
                year: '3', 
                marks: { 
                    'Quiz 1': { total: 0, breakdown: {} },
                    'Quiz 2': { total: 0, breakdown: {} },
                    'Quiz 3': { total: 0, breakdown: {} },
                    'Lab Test 1': { total: 0, breakdown: {} },
                    'Lab Test 2': { total: 0, breakdown: {} },
                    'Assignment 1': { total: 0, breakdown: {} },
                    'Mid-Semester Examination': { total: 0, breakdown: {} },
                    'End of Semester Exam': { total: 0, breakdown: {} }
                } 
            },
            { 
                id: 'S2002', 
                name: 'Lisa Anderson', 
                program: 'CS', 
                year: '1', 
                marks: { 
                    'Quiz 1': { total: 0, breakdown: {} },
                    'Quiz 2': { total: 0, breakdown: {} },
                    'Quiz 3': { total: 0, breakdown: {} },
                    'Lab Test 1': { total: 0, breakdown: {} },
                    'Lab Test 2': { total: 0, breakdown: {} },
                    'Assignment 1': { total: 0, breakdown: {} },
                    'Mid-Semester Examination': { total: 0, breakdown: {} },
                    'End of Semester Exam': { total: 0, breakdown: {} }
                } 
            },
        ],
        'CS201-A': [
            { 
                id: 'S3001', 
                name: 'Robert Taylor', 
                program: 'CS', 
                year: '2', 
                marks: { 
                    'Midterm': { total: 0, breakdown: { 'CLO1→PLO1': 0, 'CLO2→PLO2': 0 } }
                } 
            },
        ],
        'CS301-B': [
            { 
                id: 'S4001', 
                name: 'Alex Chen', 
                program: 'CS', 
                year: '3', 
                marks: { 
                    'Quiz 1': { total: 0, breakdown: { 'CLO1→PLO2': 0, 'CLO1→PLO3': 0 } }
                } 
            },
        ]
    };
    
    // --- UTILITY FUNCTIONS ---
    function getSectionId(course, section) {
        return `${course}-${section}`;
    }

    function calculateWeightedMark(rawMark, rawMax, weight) {
        if (rawMax === 0 || rawMark === null || rawMark === undefined) return 0.0;
        return (rawMark / rawMax) * weight;
    }
    
    function getAssessmentColor(type) {
        const colors = {
            'quiz': 'quiz',
            'practical': 'practical',
            'assignment': 'assignment',
            'presentation': 'presentation',
            'casestudy': 'casestudy',
            'midexam': 'midexam',
            'finalexam': 'finalexam'
        };
        return colors[type] || 'primary';
    }
    
    function getPloColor(ploNumber) {
        return `plo-badge-${ploNumber}`;
    }
    
    function formatCloPloKey(clo, plo) {
        return `${clo}→${plo}`;
    }
    
    function getGradeClass(finalGrade) {
        if (finalGrade >= 85) return 'grade-a';
        if (finalGrade >= 75) return 'grade-b';
        if (finalGrade >= 65) return 'grade-c';
        if (finalGrade >= 50) return 'grade-d';
        return 'grade-f';
    }
    
    function getGradeLetter(finalGrade) {
        if (finalGrade >= 85) return 'A';
        if (finalGrade >= 75) return 'B';
        if (finalGrade >= 65) return 'C';
        if (finalGrade >= 50) return 'D';
        return 'F';
    }

    // --- DYNAMIC LOADING FUNCTIONS ---
    
    function loadSections() {
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const selectedCourse = courseSelect.value;
        
        sectionSelect.innerHTML = '<option value="">-- Select a Section --</option>';
        document.getElementById('marksTableArea').classList.add('hidden');
        
        if (selectedCourse && assignedSections[selectedCourse]) {
            assignedSections[selectedCourse].forEach(sectionCode => {
                const option = document.createElement('option');
                option.value = sectionCode;
                option.textContent = `Section ${sectionCode}`;
                sectionSelect.appendChild(option);
            });
            
            // Enable download/import buttons
            document.getElementById('downloadTemplateBtn').disabled = false;
            document.getElementById('importMarksBtn').disabled = false;
            document.getElementById('marksImportFile').disabled = false;

        } else {
            document.getElementById('downloadTemplateBtn').disabled = true;
            document.getElementById('importMarksBtn').disabled = true;
            document.getElementById('marksImportFile').disabled = true;
        }
    }

    function loadStudentMarks() {
        const courseSelect = document.getElementById('courseSelect');
        const sectionSelect = document.getElementById('sectionSelect');
        const courseCode = courseSelect.value;
        const sectionCode = sectionSelect.value;
        const sectionId = getSectionId(courseCode, sectionCode);
        
        const marksArea = document.getElementById('marksTableArea');
        
        if (sectionCode && sectionStudents[sectionId] && assessmentStructure[courseCode]) {
            renderMarksTable(courseCode, sectionId, sectionStudents[sectionId], assessmentStructure[courseCode]);
            document.getElementById('marksTitle').textContent = `${courseCode} - Section ${sectionCode}`;
            marksArea.classList.remove('hidden');
        } else {
            marksArea.classList.add('hidden');
        }
    }

    // --- TABLE RENDERING FUNCTION ---

    function renderMarksTable(courseCode, sectionId, students, courseStructure) {
        const header = document.getElementById('marksTableHeader');
        const body = document.getElementById('marksTableBody');
        const summary = document.getElementById('assessmentSummary');
        const assessments = courseStructure.assessments;
        const totalWeight = courseStructure.totalWeight;

        // 1. Render Simplified Header
        let headerRows = '';
        
        // Calculate total columns needed
        let totalCloPloColumns = 0;
        assessments.forEach(a => {
            totalCloPloColumns += Math.max(1, a.cloPloPairs.length);
        });
        
        // First Row: Assessment names spanning columns for CLO-PLO pairs
        headerRows += '<tr>';
        headerRows += `<th class="sticky-col-header" rowspan="3">Student ID</th>`;
        
        assessments.forEach(a => {
            const colspan = Math.max(1, a.cloPloPairs.length);
            const colorClass = getAssessmentColor(a.type);
            headerRows += `<th colspan="${colspan}" class="${colorClass}-badge font-semibold">
                ${a.name}<br>
                <span class="text-[0.6rem]">Total: ${a.rawMax} marks (${a.weight}%)</span>
            </th>`;
        });
        
        headerRows += `<th class="final-marks-col" rowspan="3">
            Final Grade<br>
            <span class="text-[0.6rem]">100%</span>
        </th>`;
        headerRows += '</tr>';

        // Second Row: CLO-PLO pairs with percentage only
        headerRows += '<tr>';
        assessments.forEach(a => {
            if (a.cloPloPairs.length > 0) {
                a.cloPloPairs.forEach(pair => {
                    const ploNumber = pair.plo.replace('PLO', '');
                    headerRows += `<th class="text-[0.65rem] ${getPloColor(ploNumber)}">
                        ${pair.clo}→${pair.plo}<br>
                        <span class="text-[0.55rem]">${pair.percentage}%</span>
                    </th>`;
                });
            } else {
                headerRows += `<th class="text-[0.65rem] text-gray-500">
                    No CLO-PLO mapping<br>
                    <span class="text-[0.55rem]">${a.weight}%</span>
                </th>`;
            }
        });
        headerRows += '</tr>';

        // Third Row: Max marks per CLO-PLO pair
        headerRows += '<tr>';
        assessments.forEach(a => {
            if (a.cloPloPairs.length > 0) {
                a.cloPloPairs.forEach(pair => {
                    headerRows += `<th class="text-[0.6rem] text-gray-600">
                        Max: ${pair.marks}m
                    </th>`;
                });
            } else {
                headerRows += `<th class="text-[0.6rem] text-gray-600">
                    Max: ${a.rawMax}m
                </th>`;
            }
        });
        headerRows += '</tr>';

        header.innerHTML = headerRows;

        // 2. Render Summary
        let summaryHTML = `
            <div class="summary-item">
                <span class="text-sm text-gray-500">Total Assessments</span>
                <span class="text-lg font-bold">${assessments.length}</span>
            </div>
            <div class="summary-item">
                <span class="text-sm text-gray-500">Total Weight</span>
                <span class="text-lg font-bold">${totalWeight}%</span>
            </div>
            <div class="summary-item">
                <span class="text-sm text-gray-500">Students</span>
                <span class="text-lg font-bold">${students.length}</span>
            </div>
            <div class="summary-item">
                <span class="text-sm text-gray-500">CLO-PLO Pairs</span>
                <span class="text-lg font-bold">${assessments.reduce((sum, a) => sum + a.cloPloPairs.length, 0)}</span>
            </div>
        `;
        summary.innerHTML = summaryHTML;

        // 3. Render Body (Student Data)
        body.innerHTML = '';

        students.forEach(student => {
            let studentRow = `<tr>`;
            
            // Student ID (spans 3 rows)
            studentRow += `<td class="sticky-col text-center p-2 font-bold" rowspan="3">${student.id}</td>`;
            
            let totalWeightedMark = 0;

            // --- FIRST ROW: Marks Entry ---
            assessments.forEach(a => {
                const studentMarks = student.marks[a.name] || { total: 0, breakdown: {} };
                
                if (a.cloPloPairs.length > 0) {
                    // Create individual inputs for each CLO-PLO pair
                    a.cloPloPairs.forEach(pair => {
                        const key = formatCloPloKey(pair.clo, pair.plo);
                        const rawMark = studentMarks.breakdown[key] !== undefined ? studentMarks.breakdown[key] : 0.0;
                        
                        studentRow += `<td class="p-1">
                            <input 
                                type="number" 
                                class="marks-input raw-mark-input w-full" 
                                data-studentid="${student.id}" 
                                data-assessment="${a.name}" 
                                data-cloplo="${key}"
                                data-max="${pair.marks}"
                                data-weight="${pair.percentage}"
                                value="${rawMark.toFixed(1)}" 
                                min="0" 
                                max="${pair.marks}" 
                                step="0.1"
                                onchange="updateCalculations(this)">
                        </td>`;
                    });
                } else {
                    // Single input for assessment without CLO-PLO breakdown
                    const rawMark = studentMarks.total || 0.0;
                    
                    studentRow += `<td class="p-1">
                        <input 
                            type="number" 
                            class="marks-input raw-mark-input w-full" 
                            data-studentid="${student.id}" 
                            data-assessment="${a.name}" 
                            data-cloplo="total"
                            data-max="${a.rawMax}"
                            data-weight="${a.weight}"
                            value="${rawMark.toFixed(1)}" 
                            min="0" 
                            max="${a.rawMax}" 
                            step="0.1"
                            onchange="updateCalculations(this)">
                    </td>`;
                }
            });
            
            // Calculate initial final grade for this student
            assessments.forEach(a => {
                const studentMarks = student.marks[a.name] || { total: 0, breakdown: {} };
                const totalRawMark = a.cloPloPairs.length > 0 ? 
                    a.cloPloPairs.reduce((sum, pair) => {
                        const key = formatCloPloKey(pair.clo, pair.plo);
                        return sum + (studentMarks.breakdown[key] || 0);
                    }, 0) : studentMarks.total || 0;
                
                const assessmentWeightedMark = calculateWeightedMark(totalRawMark, a.rawMax, a.weight);
                totalWeightedMark += assessmentWeightedMark;
            });
            
            // Final Grade column (will be filled in row 3) - NOW WITH ACTUAL VALUE
            const gradeClass = getGradeClass(totalWeightedMark);
            const gradeLetter = getGradeLetter(totalWeightedMark);
            studentRow += `<td class="final-marks-col p-3 font-bold text-lg ${gradeClass}" data-studentid="${student.id}" rowspan="3">
                ${totalWeightedMark.toFixed(1)}%<br>
                <span class="text-sm font-normal">${gradeLetter}</span>
            </td>`;
            
            studentRow += '</tr>';
            
            // --- SECOND ROW: Weighted Marks ---
            studentRow += `<tr>`;
            
            assessments.forEach(a => {
                const studentMarks = student.marks[a.name] || { total: 0, breakdown: {} };
                
                if (a.cloPloPairs.length > 0) {
                    // Display weighted marks for each CLO-PLO pair
                    a.cloPloPairs.forEach(pair => {
                        const key = formatCloPloKey(pair.clo, pair.plo);
                        const rawMark = studentMarks.breakdown[key] !== undefined ? studentMarks.breakdown[key] : 0.0;
                        const weightedMark = calculateWeightedMark(rawMark, pair.marks, pair.percentage);
                        
                        studentRow += `<td class="text-xs font-semibold bg-gray-50">
                            ${weightedMark.toFixed(1)}%
                        </td>`;
                    });
                } else {
                    // Single weighted mark for assessment without breakdown
                    const rawMark = studentMarks.total || 0.0;
                    const weightedMark = calculateWeightedMark(rawMark, a.rawMax, a.weight);
                    
                    studentRow += `<td class="text-xs font-semibold bg-gray-50">
                        ${weightedMark.toFixed(1)}%
                    </td>`;
                }
            });
            
            studentRow += '</tr>';
            
            // --- THIRD ROW: Assessment Totals ---
            studentRow += `<tr>`;
            
            assessments.forEach(a => {
                const studentMarks = student.marks[a.name] || { total: 0, breakdown: {} };
                const colspan = Math.max(1, a.cloPloPairs.length);
                
                // Calculate total raw marks for this assessment
                const totalRawMark = a.cloPloPairs.length > 0 ? 
                    a.cloPloPairs.reduce((sum, pair) => {
                        const key = formatCloPloKey(pair.clo, pair.plo);
                        return sum + (studentMarks.breakdown[key] || 0);
                    }, 0) : studentMarks.total || 0;
                
                const assessmentWeightedMark = calculateWeightedMark(totalRawMark, a.rawMax, a.weight);
                
                const colorClass = getAssessmentColor(a.type);
                studentRow += `<td class="text-xs font-bold ${colorClass}-badge" colspan="${colspan}">
                    ${totalRawMark.toFixed(1)}m (${assessmentWeightedMark.toFixed(1)}%)
                </td>`;
            });
            
            studentRow += '</tr>';
            
            body.innerHTML += studentRow;
        });
    }

    // --- INTERACTIVITY HANDLERS ---
    
    // Function to update calculated marks when a raw mark input changes
    window.updateCalculations = function(inputElement) {
        const studentId = inputElement.dataset.studentid;
        const assessmentName = inputElement.dataset.assessment;
        const cloPloKey = inputElement.dataset.cloplo;
        const maxMarks = parseFloat(inputElement.dataset.max);
        const weight = parseFloat(inputElement.dataset.weight);
        let rawMark = parseFloat(inputElement.value) || 0.0;
        
        // Clamp value to max
        if (rawMark > maxMarks) {
            rawMark = maxMarks;
            inputElement.value = maxMarks.toFixed(1);
        } else if (rawMark < 0) {
            rawMark = 0.0;
            inputElement.value = 0.0.toFixed(1);
        }
        
        const weightedMark = calculateWeightedMark(rawMark, maxMarks, weight);

        // Update the corresponding weighted mark cell
        const courseCode = document.getElementById('courseSelect').value;
        const assessments = assessmentStructure[courseCode]?.assessments || [];
        const assessment = assessments.find(a => a.name === assessmentName);
        
        if (!assessment) return;
        
        // Find the row for this student
        const studentRow = inputElement.closest('tr');
        if (!studentRow) return;
        
        // Find the assessment total cell
        const assessmentIndex = assessments.findIndex(a => a.name === assessmentName);
        let cellIndex = 1; // Start after student ID column
        
        for (let i = 0; i < assessmentIndex; i++) {
            cellIndex += Math.max(1, assessments[i].cloPloPairs.length);
        }
        
        // Calculate total raw marks for this assessment
        let totalRawMarks = 0;
        const assessmentInputs = studentRow.parentElement.querySelectorAll(`input[data-studentid="${studentId}"][data-assessment="${assessmentName}"]`);
        assessmentInputs.forEach(input => {
            totalRawMarks += parseFloat(input.value) || 0;
        });
        
        const assessmentWeightedMark = calculateWeightedMark(totalRawMarks, assessment.rawMax, assessment.weight);
        
        // Update assessment total cell (in the third row)
        const assessmentTotalRow = studentRow.nextElementSibling?.nextElementSibling;
        if (assessmentTotalRow) {
            const assessmentTotalCell = assessmentTotalRow.cells[cellIndex];
            if (assessmentTotalCell) {
                const colorClass = getAssessmentColor(assessment.type);
                assessmentTotalCell.className = `text-xs font-bold ${colorClass}-badge`;
                assessmentTotalCell.setAttribute('colspan', Math.max(1, assessment.cloPloPairs.length));
                assessmentTotalCell.innerHTML = `${totalRawMarks.toFixed(1)}m (${assessmentWeightedMark.toFixed(1)}%)`;
            }
        }
        
        // Update weighted marks cell (in the second row)
        const weightedRow = studentRow.nextElementSibling;
        if (weightedRow) {
            // Find which CLO-PLO pair this input corresponds to
            if (assessment.cloPloPairs.length > 0) {
                const pairIndex = assessment.cloPloPairs.findIndex(pair => 
                    formatCloPloKey(pair.clo, pair.plo) === cloPloKey
                );
                if (pairIndex !== -1) {
                    const weightedCell = weightedRow.cells[cellIndex + pairIndex];
                    if (weightedCell) {
                        weightedCell.textContent = `${weightedMark.toFixed(1)}%`;
                    }
                }
            } else {
                const weightedCell = weightedRow.cells[cellIndex];
                if (weightedCell) {
                    weightedCell.textContent = `${weightedMark.toFixed(1)}%`;
                }
            }
        }
        
        // Recalculate and update final grade
        updateFinalGrade(studentId);
    }
    
    // Function to update final grade for a student
    function updateFinalGrade(studentId) {
        const courseCode = document.getElementById('courseSelect').value;
        const assessments = assessmentStructure[courseCode]?.assessments || [];
        
        let totalWeightedMark = 0;
        
        // Find all assessment total cells for this student
        const studentRows = document.querySelectorAll(`tr:has(td[data-studentid="${studentId}"])`);
        if (studentRows.length < 3) return;
        
        const assessmentTotalRow = studentRows[2]; // Third row has assessment totals
        
        // Extract weighted marks from assessment total cells
        for (let i = 1; i < assessmentTotalRow.cells.length - 1; i++) {
            const cell = assessmentTotalRow.cells[i];
            const match = cell.textContent.match(/\(([\d.]+)%\)/);
            if (match) {
                totalWeightedMark += parseFloat(match[1]) || 0;
            }
        }
        
        // Update final grade cell
        const finalGradeCell = document.querySelector(`.final-marks-col[data-studentid="${studentId}"]`);
        if (finalGradeCell) {
            const gradeClass = getGradeClass(totalWeightedMark);
            const gradeLetter = getGradeLetter(totalWeightedMark);
            finalGradeCell.innerHTML = `${totalWeightedMark.toFixed(1)}%<br><span class="text-sm font-normal">${gradeLetter}</span>`;
            finalGradeCell.className = `final-marks-col p-3 font-bold text-lg ${gradeClass}`;
        }
    }

    // Function to save all marks
    function saveMarks() {
        const courseCode = document.getElementById('courseSelect').value;
        const sectionCode = document.getElementById('sectionSelect').value;
        const assessments = assessmentStructure[courseCode]?.assessments || [];
        
        const updatedMarks = [];
        
        document.querySelectorAll('.raw-mark-input').forEach(input => {
            const cloPloKey = input.dataset.cloplo;
            updatedMarks.push({
                studentId: input.dataset.studentid,
                assessment: input.dataset.assessment,
                cloPloPair: cloPloKey,
                rawMark: parseFloat(input.value) || 0.0,
                maxMarks: parseFloat(input.dataset.max),
                weightPercentage: parseFloat(input.dataset.weight),
                weightedMark: calculateWeightedMark(parseFloat(input.value) || 0.0, 
                                                  parseFloat(input.dataset.max), 
                                                  parseFloat(input.dataset.weight))
            });
        });
        
        // Simulate API call
        console.log(`[SIMULATED SAVE] Saving marks for ${courseCode}-${sectionCode}:`, updatedMarks);
        
        // Show success message with detailed summary
        const totalStudents = new Set(updatedMarks.map(m => m.studentId)).size;
        const totalCloPloPairs = assessments.reduce((sum, a) => sum + Math.max(1, a.cloPloPairs.length), 0);
        
        alert(`✅ Successfully saved marks for ${courseCode} Section ${sectionCode}!\n\n` +
              `📊 Summary:\n` +
              `• Students: ${totalStudents}\n` +
              `• Assessments: ${assessments.length}\n` +
              `• CLO-PLO pairs: ${totalCloPloPairs}\n` +
              `• Total marks entries: ${updatedMarks.length}`);
    }

    // Function to reset all marks
    function resetMarks() {
        if (confirm("Are you sure you want to reset all current marks in the table to 0? This cannot be undone.")) {
            document.querySelectorAll('.raw-mark-input').forEach(input => {
                input.value = 0.0.toFixed(1);
                updateCalculations(input);
            });
            alert('All marks have been reset to 0!');
        }
    }

    // Function to simulate Excel download
    function simulateDownload() {
        const courseCode = document.getElementById('courseSelect').value;
        const sectionCode = document.getElementById('sectionSelect').value;
        if (!courseCode || !sectionCode) {
            alert("Please select both a Course and a Section first.");
            return;
        }
        
        const assessments = assessmentStructure[courseCode]?.assessments || [];
        
        // Create detailed template data
        const templateData = {
            course: courseCode,
            section: sectionCode,
            assessments: assessments.map(a => ({
                name: a.name,
                maxMarks: a.rawMax,
                weight: a.weight,
                cloPloPairs: a.cloPloPairs.map(p => ({
                    clo: p.clo,
                    plo: p.plo,
                    maxMarks: p.marks,
                    weight: p.percentage
                }))
            })),
            columns: [
                'Student ID', 
                ...assessments.flatMap(a => 
                    a.cloPloPairs.length > 0 
                        ? a.cloPloPairs.map(p => `${a.name} - ${p.clo}→${p.plo}`)
                        : [a.name]
                )
            ]
        };
        
        console.log('Downloading detailed template:', templateData);
        
        const assessmentList = assessments.map(a => 
            a.cloPloPairs.length > 0 
                ? `${a.name} (${a.rawMax}m, ${a.weight}%):\n` + 
                  a.cloPloPairs.map(p => `  - ${p.clo}→${p.plo}: ${p.marks}m (${p.percentage}%)`).join('\n')
                : `${a.name}: ${a.rawMax}m (${a.weight}%)`
        ).join('\n\n');
        
        alert(`📥 Downloading detailed marks template for ${courseCode} Section ${sectionCode}.\n\n` +
              `Template includes columns for:\n` +
              `- Student ID\n` +
              `- Detailed CLO-PLO breakdowns:\n\n${assessmentList}`);
    }

    // Function to simulate Excel import
    function simulateImport(event) {
        const file = event.target.files[0];
        if (file) {
            alert(`📤 Simulating import of file: ${file.name}.\n\nMarks will be updated from the Excel file with detailed CLO-PLO breakdown.`);
            
            // Simulate successful import by updating some data
            const courseCode = document.getElementById('courseSelect').value;
            const sectionCode = document.getElementById('sectionSelect').value;
            const sectionId = getSectionId(courseCode, sectionCode);
            
            // Inject new simulated data after import
            if (sectionId === 'CS101-A') {
                sectionStudents['CS101-A'].forEach((student, index) => {
                    if (index === 3) { // Update Sarah Johnson's marks with detailed breakdown
                        student.marks = { 
                            'Quiz 1': { 
                                total: 9.0, 
                                breakdown: { 
                                    'CLO1→PLO1': 2.7, 
                                    'CLO1→PLO2': 1.8, 
                                    'CLO2→PLO1': 4.5 
                                } 
                            },
                            'Quiz 2': { 
                                total: 4.5, 
                                breakdown: { 
                                    'CLO1→PLO1': 4.5 
                                } 
                            },
                            'Quiz 3': { 
                                total: 4.5, 
                                breakdown: { 
                                    'CLO2→PLO2': 4.5 
                                } 
                            },
                            'Lab Test 1': { 
                                total: 18.0, 
                                breakdown: { 
                                    'CLO2→PLO3': 5.4, 
                                    'CLO2→PLO5': 3.6, 
                                    'CLO3→PLO3': 9.0 
                                } 
                            },
                            'Lab Test 2': { 
                                total: 9.0, 
                                breakdown: { 
                                    'CLO3→PLO3': 9.0 
                                } 
                            },
                            'Assignment 1': { 
                                total: 14.5, 
                                breakdown: { 
                                    'CLO2→PLO2': 6.8, 
                                    'CLO2→PLO3': 2.9, 
                                    'CLO4→PLO4': 4.8 
                                } 
                            },
                            'Mid-Semester Examination': { 
                                total: 18.0, 
                                breakdown: { 
                                    'CLO1→PLO1': 4.5, 
                                    'CLO2→PLO2': 7.2, 
                                    'CLO2→PLO3': 3.6, 
                                    'CLO3→PLO3': 2.7 
                                } 
                            },
                            'End of Semester Exam': { 
                                total: 0, 
                                breakdown: { 
                                    'CLO1→PLO1': 0, 
                                    'CLO2→PLO2': 0, 
                                    'CLO3→PLO3': 0, 
                                    'CLO4→PLO4': 0 
                                } 
                            }
                        };
                    }
                });
            }
            
            loadStudentMarks(); // Re-render table with new data
            
            // Reset file input to allow re-upload
            event.target.value = null; 
        }
    }

    // --- INITIALIZATION ---
    document.addEventListener('DOMContentLoaded', function() {
        // Load sections for the default selected course (CS101)
        loadSections(); 
        
        // Set default section if available
        setTimeout(() => {
            const sectionSelect = document.getElementById('sectionSelect');
            if (sectionSelect.options.length > 1) {
                sectionSelect.value = 'A';
                loadStudentMarks();
            }
        }, 100);
    });
</script>
@endsection