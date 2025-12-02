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
                    // Assessment Colors
                    'quiz': '#3498db',
                    'practical': '#1abc9c',
                    'assignment': '#f39c12',
                    'casestudy': '#9b59b6',
                    'finalexam': '#c0392b',
                },
                // Added custom styling for the marks table cells
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
            min-width: 1500px; /* Ensure wide enough for marks columns */
        }
        
        .marks-table th, .marks-table td {
            @apply p-2 text-center text-xs border border-gray-200;
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
                            </thead>
            <tbody id="marksTableBody">
                            </tbody>
        </table>
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
    
    // --- SIMULATED DATA ---
    // Assessment Structure (Matching the image structure)
    const assessmentStructure = {
        'CS101': {
            assessments: [
                // Raw Marks: Max, Quiz, Max 10%, CLO
                { name: 'Quiz 1', rawMax: 30, weight: 10, type: 'quiz', clo: 'CLO2' },
                { name: 'Quiz 2', rawMax: 10, weight: 5, type: 'quiz', clo: 'CLO2' },
                // Raw Marks: Max, ASG, Max 15%, CLO
                { name: 'ASG 1', rawMax: 24, weight: 6, type: 'assignment', clo: 'CLO1' },
                // Raw Marks: Max, ASG, Max 30%, CLO
                { name: 'ASG 2', rawMax: 30, weight: 13, type: 'assignment', clo: 'CLO3' },
                // Raw Marks: Max, ASG, Max 12%, CLO
                { name: 'ASG 3', rawMax: 18, weight: 15, type: 'assignment', clo: 'CLO2' },
                // Raw Marks: Max, CASE STUDY, Max 9%, CLO
                { name: 'CASE STUDY', rawMax: 25, weight: 9, type: 'casestudy', clo: 'CLO2' },
                // Final 55% Total
            ],
            convertedWeights: { 
                'Quiz 1': 20, 'Quiz 2': 20, 'ASG 1': 15, 'ASG 2': 25, 'ASG 3': 16, 'CASE STUDY': 9, 'Final Sum': 55 
            }
        },
        'CS201': {
            assessments: [
                { name: 'Midterm', rawMax: 100, weight: 20, type: 'midexam', clo: 'CLO1, CLO2' },
            ],
            convertedWeights: {}
        }
    };

    // Student and Section Data (subset of data from the previous file, assigned to L001)
    const assignedSections = {
        'CS101': ['A', 'C'], // L001 is assigned section A and C for CS101
        'CS201': ['A'],      // L001 is assigned section A for CS201
    };
    
    const sectionStudents = {
        'CS101-A': [
            { id: 'S1001', name: 'John Smith', program: 'CS', year: '2', marks: { 'Quiz 1': 21.0, 'Quiz 2': 7.0, 'ASG 1': 20.0, 'ASG 2': 25.0, 'ASG 3': 18.0, 'CASE STUDY': 18.0 } },
            { id: 'S1002', name: 'Emma Watson', program: 'CS', year: '2', marks: { 'Quiz 1': 25.0, 'Quiz 2': 8.3, 'ASG 1': 11.0, 'ASG 2': 13.0, 'ASG 3': 15.0, 'CASE STUDY': 6.0 } },
            { id: 'S1003', name: 'Michael Brown', program: 'CS', year: '3', marks: { 'Quiz 1': 22.0, 'Quiz 2': 7.3, 'ASG 1': 18.0, 'ASG 2': 24.0, 'ASG 3': 11.0, 'CASE STUDY': 24.0 } },
            { id: 'S1004', name: 'Sarah Johnson', program: 'CS', year: '2', marks: {} },
        ],
        'CS101-C': [
            { id: 'S2001', name: 'David Wilson', program: 'CS', year: '3', marks: {} },
            { id: 'S2002', name: 'Lisa Anderson', program: 'CS', year: '1', marks: {} },
        ],
        'CS201-A': [
            { id: 'S3001', name: 'Robert Taylor', program: 'CS', year: '2', marks: {} },
        ]
    };
    
    // --- UTILITY FUNCTIONS ---
    function getSectionId(course, section) {
        return `${course}-${section}`;
    }

    function calculateConvertedMark(rawMark, rawMax, convertedMax) {
        if (rawMax === 0 || rawMark === null || rawMark === undefined) return 0.0;
        return (rawMark / rawMax) * convertedMax;
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

    // --- TABLE RENDERING FUNCTION (Core Logic) ---

    function renderMarksTable(courseCode, sectionId, students, courseStructure) {
        const header = document.getElementById('marksTableHeader');
        const body = document.getElementById('marksTableBody');
        const assessments = courseStructure.assessments;
        const convertedWeights = courseStructure.convertedWeights;

        // 1. Render Header
        
        // First Row: Raw Marks / Converted Marks (Dividers)
        let headerRow1 = '<tr>';
        headerRow1 += `<th class="sticky-col-header" rowspan="3">Student</th>`;
        headerRow1 += `<th colspan="${assessments.length}" class="bg-dark/10">Raw Marks</th>`;
        headerRow1 += `<th colspan="${assessments.length}" class="bg-primary/20">Converted Marks (%)</th>`;
        headerRow1 += `<th class="final-marks-col" rowspan="3">SUM 55%</th>`;
        headerRow1 += '</tr>';

        // Second Row: Max Marks for Raw and Converted
        let headerRow2 = '<tr>';
        // Raw Max Marks
        assessments.forEach(a => {
            headerRow2 += `<th title="Raw Max Marks for ${a.name}">Max ${a.rawMax}</th>`;
        });
        // Converted Max Marks (Weights)
        assessments.forEach(a => {
            const convertedMax = convertedWeights[a.name] || 0;
            headerRow2 += `<th title="Converted Max Marks for ${a.name} (Weightage)">${convertedMax}</th>`;
        });
        headerRow2 += '</tr>';

        // Third Row: CLO and Assessment Name
        let headerRow3 = '<tr>';
        // Raw Assessment Name/CLO
        assessments.forEach(a => {
            headerRow3 += `<th title="${a.name} covers ${a.clo}"><span class="text-${a.type}">${a.name.substring(0, 3)}</span><br>${a.clo}</th>`;
        });
        // Converted Assessment Name/CLO
        assessments.forEach(a => {
            headerRow3 += `<th title="${a.name} covers ${a.clo}">${a.name.substring(0, 3)}<br>${a.clo}</th>`;
        });
        headerRow3 += '</tr>';

        header.innerHTML = headerRow1 + headerRow2 + headerRow3;


        // 2. Render Body (Student Data)
        body.innerHTML = '';

        students.forEach(student => {
            let studentRow = `<tr><td class="sticky-col font-semibold text-left">${student.id} - ${student.name}</td>`;
            let totalConvertedMark = 0;
            const convertedMarks = {};

            // --- RAW MARKS ENTRY COLUMNS ---
            assessments.forEach(a => {
                const rawMark = student.marks[a.name] !== undefined ? student.marks[a.name] : 0.0;
                
                studentRow += `<td><input 
                    type="number" 
                    class="marks-input raw-mark-input" 
                    data-studentid="${student.id}" 
                    data-assessment="${a.name}" 
                    data-max="${a.rawMax}" 
                    value="${rawMark.toFixed(1)}" 
                    min="0" 
                    max="${a.rawMax}" 
                    step="0.1"
                    onchange="updateCalculations(this)"></td>`;
                
                // Calculate converted marks immediately
                const convertedMax = convertedWeights[a.name] || 0;
                const convertedMark = calculateConvertedMark(rawMark, a.rawMax, convertedMax);
                convertedMarks[a.name] = convertedMark;
                totalConvertedMark += convertedMark;
            });
            
            // --- CONVERTED MARKS DISPLAY COLUMNS ---
            assessments.forEach(a => {
                studentRow += `<td class="converted-mark-cell" data-studentid="${student.id}" data-assessment="${a.name}">${convertedMarks[a.name].toFixed(1)}</td>`;
            });
            
            // --- FINAL SUM COLUMN ---
            studentRow += `<td class="final-marks-col total-sum-cell" data-studentid="${student.id}">${totalConvertedMark.toFixed(1)}</td>`;
            
            studentRow += '</tr>';
            body.innerHTML += studentRow;
        });
    }

    // --- INTERACTIVITY HANDLERS ---
    
    // Function to update calculated marks when a raw mark input changes
    window.updateCalculations = function(inputElement) {
        const studentId = inputElement.dataset.studentid;
        const assessmentName = inputElement.dataset.assessment;
        const rawMax = parseFloat(inputElement.dataset.max);
        let rawMark = parseFloat(inputElement.value) || 0.0;
        
        const courseCode = document.getElementById('courseSelect').value;
        const convertedMax = assessmentStructure[courseCode].convertedWeights[assessmentName] || 0;
        
        // Clamp value to max
        if (rawMark > rawMax) {
            rawMark = rawMax;
            inputElement.value = rawMax.toFixed(1);
        } else if (rawMark < 0) {
            rawMark = 0.0;
            inputElement.value = 0.0.toFixed(1);
        }
        
        const convertedMark = calculateConvertedMark(rawMark, rawMax, convertedMax);

        // Update the corresponding converted mark cell
        const convertedCell = document.querySelector(`.converted-mark-cell[data-studentid="${studentId}"][data-assessment="${assessmentName}"]`);
        if (convertedCell) {
            convertedCell.textContent = convertedMark.toFixed(1);
        }

        // Update the total sum cell
        let totalSum = 0;
        document.querySelectorAll(`.converted-mark-cell[data-studentid="${studentId}"]`).forEach(cell => {
            totalSum += parseFloat(cell.textContent) || 0;
        });

        const totalSumCell = document.querySelector(`.total-sum-cell[data-studentid="${studentId}"]`);
        if (totalSumCell) {
            totalSumCell.textContent = totalSum.toFixed(1);
        }
    }

    // Function to save all marks
    function saveMarks() {
        const courseCode = document.getElementById('courseSelect').value;
        const sectionCode = document.getElementById('sectionSelect').value;
        
        const updatedMarks = [];
        
        document.querySelectorAll('.raw-mark-input').forEach(input => {
            updatedMarks.push({
                studentId: input.dataset.studentid,
                assessment: input.dataset.assessment,
                rawMark: parseFloat(input.value) || 0.0
            });
        });
        
        console.log(`[SIMULATED SAVE] Saving marks for ${courseCode}-${sectionCode}:`, updatedMarks);
        alert(`Successfully saved ${updatedMarks.length} marks for ${courseCode} Section ${sectionCode}!`);
    }

    // Function to reset all marks (simulated)
    function resetMarks() {
        if (confirm("Are you sure you want to reset all current marks in the table to 0?")) {
            document.querySelectorAll('.raw-mark-input').forEach(input => {
                input.value = 0.0.toFixed(1);
                updateCalculations(input);
            });
            alert('Marks reset successfully!');
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
        alert(`Simulating download of marks template for ${courseCode} Section ${sectionCode}. (Columns will match the table structure.)`);
    }

    // Function to simulate Excel import
    function simulateImport(event) {
        const file = event.target.files[0];
        if (file) {
            alert(`Simulating import of file: ${file.name}. Marks will be updated if valid.`);
            
            // Simulate successful import by re-loading data
            const courseCode = document.getElementById('courseSelect').value;
            const sectionCode = document.getElementById('sectionSelect').value;
            const sectionId = getSectionId(courseCode, sectionCode);
            
            // Inject new simulated data after import (simulate update from Excel)
            if (sectionId === 'CS101-A') {
                sectionStudents['CS101-A'].find(s => s.id === 'S1004').marks = { 
                    'Quiz 1': 28.0, 'Quiz 2': 9.0, 'ASG 1': 22.0, 'ASG 2': 28.0, 'ASG 3': 16.0, 'CASE STUDY': 23.0 
                };
            }
            
            loadStudentMarks(); // Re-render table with new data
            
            // Reset file input to allow re-upload
            event.target.value = null; 
        }
    }

    // --- INITIALIZATION ---
    document.addEventListener('DOMContentLoaded', function() {
        // Simulate initial load of sections for the default selected course (CS101)
        loadSections(); 
    });
</script>
@endsection


