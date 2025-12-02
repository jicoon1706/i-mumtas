@extends('layouts.lecturer')

@section('title', 'My Assigned Sections - EduManage')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Move critical styles to regular CSS */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 100%);
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 2px solid #ccfbf1;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(180deg, #14b8a6 0%, #0f766e 100%);
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            color: #1f2937;
        }

        .header h1 i {
            font-size: 2.25rem;
            margin-right: 0.75rem;
            background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info img {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
            border: 3px solid #14b8a6;
        }

        .user-info h3 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0;
            color: #14b8a6;
        }

        .user-info p {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            background: white;
            padding: 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            color: #6b7280;
            font-size: 0.875rem;
        }

        .breadcrumb a {
            color: #14b8a6;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }
        
        .list-container {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }

        .section-card {
            background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid #3b82f6;
            cursor: pointer;
        }
        
        .section-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            border-left-color: #1d4ed8;
            transform: translateY(-4px);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .section-info h3 {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }
        
        .section-info span {
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
            color: #3b82f6;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.875rem;
        }

        .detail-item span:first-child {
            color: #6b7280;
        }

        .detail-item span:last-child {
            color: #1f2937;
            font-weight: 500;
        }
        
        .student-info-section {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 2px solid #eff6ff;
        }

        .student-info-section.hidden {
            display: none;
        }

        .student-info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .student-info-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #1f2937;
        }

        .student-info-title i {
            font-size: 1.875rem;
            color: #3b82f6;
        }

        .student-info-title h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-info {
            color: white;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .btn-info:hover {
            transform: translateY(-2px);
        }

        .btn-outline {
            background: white;
            border: 2px solid #14b8a6;
            color: #14b8a6;
        }

        .btn-outline:hover {
            background: #f0fdfa;
        }
        
        .table-container {
            overflow-x: auto;
            margin-bottom: 1.5rem;
            max-height: 60vh;
            overflow-y: auto;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid #e5e7eb;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead tr {
            position: sticky;
            top: 0;
            z-index: 10;
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
        }

        .data-table th {
            padding: 1rem;
            text-align: left;
            font-weight: bold;
            font-size: 0.875rem;
            border-bottom: 2px solid #99f6e4;
            color: #0f766e;
        }

        .data-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .data-table tbody tr:hover {
            background-color: #f0fdfa;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.875rem;
            color: #374151;
        }

        .summary-box {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
        }

        .summary-box h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #3b82f6;
        }

        .summary-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
        }

        .summary-stats span {
            color: #6b7280;
        }

        .summary-stats strong {
            color: #3b82f6;
        }

        .w-full {
            width: 100%;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .gap-4 {
            gap: 1rem;
        }

        .flex {
            display: flex;
        }

        .hidden {
            display: none;
        }
    </style>

    <div id="sections-list-view">
        <div class="header">
            <div>
                <h1>
                    <i class="fas fa-chalkboard-teacher"></i>
                    My Assigned Sections
                </h1>
                <p style="color: #6b7280;">View and manage students for your assigned courses and sections</p>
            </div>
            <div class="user-info">
                <img src="https://i.pravatar.cc/150?img=5" alt="Lecturer Avatar">
                <div>
                    <h3>Dr. Sarah Johnson</h3>
                    <p>Course Lecturer (L001)</p>
                </div>
            </div>
        </div>

        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
            <i class="fas fa-chevron-right" style="font-size: 0.75rem;"></i>
            <span>My Sections</span>
        </div>
        
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">
            Sections for <span id="lecturer-name">Dr. Sarah Johnson (L001)</span>
        </h2>

        <div class="list-container" id="assigned-sections-grid"></div>
    </div>

    <div class="student-info-section hidden" id="section-students-view">
        <div class="student-info-header">
            <div class="student-info-title">
                <i class="fas fa-user-graduate"></i>
                <h2>Enrolled Students - <span id="section-view-title"></span></h2>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline" id="back-to-sections">
                    <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Back to My Sections
                </button>
            </div>
        </div>

        <div class="summary-box">
            <h3>Section Summary</h3>
            <div class="summary-stats">
                <span>Total Enrolled: <strong id="summary-enrolled">0</strong></span>
                <span>Capacity: <strong id="summary-capacity">0</strong></span>
                <span>Schedule: <strong id="summary-schedule">N/A</strong></span>
                <span>Location: <strong id="summary-location">N/A</strong></span>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Program</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody id="enrolled-students-table"></tbody>
            </table>
        </div>
    </div>

    <script>
        // --- Simulated Data for Dr. Sarah Johnson (L001) ---
        const currentLecturer = { id: "L001", name: "Dr. Sarah Johnson" };

        const allStudents = [
            { id: 'S1001', name: 'John Smith', program: 'Computer Science', year: '2' },
            { id: 'S1002', name: 'Emma Watson', program: 'Computer Science', year: '2' },
            { id: 'S1003', name: 'Michael Brown', program: 'Computer Science', year: '3' },
            { id: 'S1004', name: 'Sarah Johnson', program: 'Computer Science', year: '2' },
            { id: 'S1005', name: 'David Wilson', program: 'Computer Science', year: '3' },
            { id: 'S1006', name: 'Lisa Anderson', program: 'Computer Science', year: '1' },
            { id: 'S1007', name: 'Robert Taylor', program: 'Computer Science', year: '2' },
            { id: 'S1008', name: 'Jennifer Lee', program: 'Computer Science', year: '3' },
            { id: 'S1009', name: 'Thomas Clark', program: 'Computer Science', year: '2' },
            { id: 'S1010', name: 'Maria Garcia', program: 'Computer Science', year: '1' },
            { id: 'S1011', name: 'Alice Lee', program: 'Electrical Engineering', year: '1' },
            { id: 'S1012', name: 'Ben Chu', program: 'Electrical Engineering', year: '2' },
        ];
        
        const sectionsData = [
            { 
                courseCode: 'CS101', 
                courseName: 'Introduction to Programming', 
                sectionCode: 'A', 
                capacity: 40, 
                lecturerId: 'L001', 
                schedule: 'Mon-Wed-Fri 10:00 AM', 
                location: 'Room 101', 
                enrolledStudents: ['S1001', 'S1002', 'S1003', 'S1004', 'S1005'] 
            },
            { 
                courseCode: 'CS101', 
                courseName: 'Introduction to Programming', 
                sectionCode: 'B', 
                capacity: 40, 
                lecturerId: 'L002',
                schedule: 'Tue-Thu 2:00 PM', 
                location: 'Room 102', 
                enrolledStudents: ['S1006', 'S1007', 'S1008'] 
            },
            { 
                courseCode: 'CS201', 
                courseName: 'Data Structures', 
                sectionCode: 'A', 
                capacity: 40, 
                lecturerId: 'L001',
                schedule: 'Mon-Wed-Fri 9:00 AM', 
                location: 'Lab 201', 
                enrolledStudents: ['S1009', 'S1010', 'S1011', 'S1012'] 
            },
            { 
                courseCode: 'EE101', 
                courseName: 'Circuit Analysis', 
                sectionCode: 'C', 
                capacity: 40, 
                lecturerId: 'L004', 
                schedule: 'Tue-Thu 11:00 AM', 
                location: 'Room 302', 
                enrolledStudents: [] 
            }
        ];
        
        const myAssignedSections = sectionsData.filter(section => section.lecturerId === currentLecturer.id);

        const sectionsListView = document.getElementById('sections-list-view');
        const sectionStudentsView = document.getElementById('section-students-view');
        const assignedSectionsGrid = document.getElementById('assigned-sections-grid');
        const backToSectionsBtn = document.getElementById('back-to-sections');
        const sectionViewTitle = document.getElementById('section-view-title');
        const enrolledStudentsTable = document.getElementById('enrolled-students-table');
        const summaryEnrolled = document.getElementById('summary-enrolled');
        const summaryCapacity = document.getElementById('summary-capacity');
        const summarySchedule = document.getElementById('summary-schedule');
        const summaryLocation = document.getElementById('summary-location');
        
        function setView(showElement, hideElement) {
            hideElement.classList.add('hidden');
            showElement.classList.remove('hidden');
        }

        function renderAssignedSections() {
            assignedSectionsGrid.innerHTML = '';
            
            if (myAssignedSections.length === 0) {
                assignedSectionsGrid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2.5rem; color: #6b7280;">
                        <i class="fas fa-users-slash" style="font-size: 2.25rem; margin-bottom: 1rem; display: block;"></i>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #2c3e50;">No Sections Assigned</h3>
                        <p>Please check with the system administrator for your course assignments.</p>
                    </div>
                `;
                return;
            }

            myAssignedSections.forEach(section => {
                const enrolledCount = section.enrolledStudents.length;
                const enrollmentPercent = (enrolledCount / section.capacity) * 100;
                
                let statusColor, bgColor;
                if (enrollmentPercent >= 90) {
                    statusColor = 'background-color: #ef4444;'; 
                    bgColor = 'color: white;';
                } else if (enrollmentPercent >= 70) {
                    statusColor = 'background-color: #f59e0b;';
                    bgColor = 'color: white;';
                } else {
                    statusColor = 'background-color: #10b981;';
                    bgColor = 'color: white;';
                }
                
                const card = document.createElement('div');
                card.className = 'section-card';
                card.dataset.course = section.courseCode;
                card.dataset.section = section.sectionCode;

                card.innerHTML = `
                    <div class="section-header">
                        <div class="section-info">
                            <h3>${section.courseName} - Section ${section.sectionCode}</h3>
                            <span>${section.courseCode}</span>
                        </div>
                        <span style="padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; ${statusColor} ${bgColor}">
                            ${Math.round(enrollmentPercent)}% Full
                        </span>
                    </div>
                    <div style="margin-top: 1rem;">
                        <div class="detail-item">
                            <span>Enrolled Students:</span>
                            <span>${enrolledCount} / ${section.capacity}</span>
                        </div>
                        <div class="detail-item">
                            <span>Schedule:</span>
                            <span>${section.schedule}</span>
                        </div>
                        <div class="detail-item">
                            <span>Location:</span>
                            <span>${section.location}</span>
                        </div>
                    </div>
                    <button class="btn btn-info w-full mt-4 view-students-btn" data-course="${section.courseCode}" data-section="${section.sectionCode}">
                        <i class="fas fa-eye" style="margin-right: 0.5rem;"></i> View Students
                    </button>
                `;
                assignedSectionsGrid.appendChild(card);
            });
            
            document.querySelectorAll('.view-students-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const courseCode = this.dataset.course;
                    const sectionCode = this.dataset.section;
                    viewSectionStudents(courseCode, sectionCode);
                });
            });
        }

        function viewSectionStudents(courseCode, sectionCode) {
            const section = myAssignedSections.find(s => s.courseCode === courseCode && s.sectionCode === sectionCode);
            if (!section) return;

            setView(sectionStudentsView, sectionsListView);
            
            sectionViewTitle.textContent = `${courseCode} ${sectionCode} - ${section.courseName}`;
            summaryEnrolled.textContent = section.enrolledStudents.length;
            summaryCapacity.textContent = section.capacity;
            summarySchedule.textContent = section.schedule;
            summaryLocation.textContent = section.location;
            
            document.querySelector('.breadcrumb span').innerHTML = `Students in ${courseCode} ${sectionCode}`;

            renderEnrolledStudents(section.enrolledStudents);
        }

        function renderEnrolledStudents(studentIds) {
            enrolledStudentsTable.innerHTML = '';
            
            if (studentIds.length === 0) {
                enrolledStudentsTable.innerHTML = `
                    <tr>
                        <td colspan="5" style="text-center: center; padding: 2rem; color: #6b7280;">
                            <i class="fas fa-users-slash" style="font-size: 1.875rem; margin-bottom: 0.75rem; display: block;"></i>
                            No students are currently enrolled in this section.
                        </td>
                    </tr>
                `;
                return;
            }

            studentIds.forEach((studentId, index) => {
                const student = allStudents.find(s => s.id === studentId);
                if (!student) return;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td style="font-weight: 500;">${student.id}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 2rem; height: 2rem; border-radius: 50%; background-color: #dbeafe; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-weight: bold; font-size: 0.875rem;">
                                ${student.name.charAt(0)}
                            </div>
                            <div style="font-weight: 500;">${student.name}</div>
                        </div>
                    </td>
                    <td>${student.program}</td>
                    <td>Year ${student.year}</td>
                `;
                enrolledStudentsTable.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderAssignedSections();

            backToSectionsBtn.addEventListener('click', function() {
                setView(sectionsListView, sectionStudentsView);
                document.querySelector('.breadcrumb span').textContent = 'My Sections';
            });
        });
    </script>
@endsection