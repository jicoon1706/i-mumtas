@extends('layouts.admin')

@section('title', 'Course Management - EduManage')

@section('content')
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        @layer base {
            body {
                @apply font-sans text-gray-700 min-h-screen;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }


        }

        @layer components {

            .dept-card {
                @apply bg-white rounded-2xl shadow-xl mb-6 border border-gray-100 overflow-hidden;
            }

            .dept-header {
                @apply flex justify-between items-center p-5 cursor-pointer transition-all duration-200;
                background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
                @apply border-l-4 border-purple-600;
            }

            .dept-header:hover {
                background: linear-gradient(135deg, #e9d5ff 0%, #ddd6fe 100%);
            }

            .dept-title {
                @apply flex items-center space-x-3;
            }

            .dept-header h2 {
                @apply text-purple-900 text-xl;
            }

            .dept-header i {
                @apply text-purple-600 text-2xl;
            }

            .dept-content {
                @apply max-h-0 overflow-hidden transition-all duration-300;
            }

            .dept-content.expanded {
                @apply max-h-screen p-6;
            }

            .chevron-icon {
                @apply transition-transform duration-300 text-purple-600;
            }

            .chevron-icon.rotated {
                @apply rotate-180;
            }

            .plo-item {
                @apply flex flex-col md:flex-row md:justify-between items-start md:items-center p-4 rounded-xl border-2 border-gray-200 bg-gradient-to-r from-white to-gray-50 shadow-md hover:shadow-lg transition-all duration-200 mb-3;
            }

            .plo-details {
                @apply flex-1 mb-3 md:mb-0;
            }

            .plo-details h4 {
                @apply text-base font-semibold text-gray-800 m-0 mb-1;
            }

            .plo-actions {
                @apply flex space-x-2;
            }

            .badge-primary {
                @apply bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm;
            }

            .form-group {
                @apply mb-4;
            }

            .form-group label {
                @apply block text-sm font-medium text-gray-600 mb-1;
            }

            .form-control {
                @apply block w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition-all duration-200;
            }

            .btn {
                @apply px-5 py-2.5 rounded-xl font-medium transition-all duration-200 cursor-pointer text-center shadow-md hover:shadow-xl;
            }

            .btn-primary {
                @apply bg-gradient-to-r from-purple-600 to-purple-700 text-white hover:from-purple-700 hover:to-purple-800 transform hover:-translate-y-0.5;
            }

            .btn-success {
                @apply bg-gradient-to-r from-green-600 to-green-700 text-white hover:from-green-700 hover:to-green-800 transform hover:-translate-y-0.5;
            }

            .btn-danger {
                @apply bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800;
            }

            .btn-outline {
                @apply bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400;
            }

            .btn-sm {
                @apply px-3 py-1.5 text-sm;
            }

            .modal {
                @apply fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden;
                backdrop-filter: blur(4px);
            }

            .modal-content {
                @apply bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 p-6 transform transition-all duration-300;
            }

            .modal-header {
                @apply flex justify-between items-center border-b-2 border-gray-200 pb-4 mb-4;
            }

            .modal-header h3 {
                @apply text-xl font-semibold text-gray-800 flex items-center;
            }

            .modal-header .close {
                @apply text-gray-400 hover:text-gray-600 text-2xl font-light leading-none cursor-pointer transition-colors duration-200;
            }

            .modal-footer {
                @apply flex justify-end space-x-3 pt-4 border-t-2 border-gray-200 mt-4;
            }

            footer {
                @apply text-center py-4 mt-8 text-sm text-white;
            }
        }
    </style>
</head>
<body>
    <div class="main-content" style="margin-left: 0; min-height: 100vh; padding-top: 20px;">
        <div class="header">
            <h1>PLO Management</h1>
            <div class="user-info">
                <div>
                    <h3>Dr. Admin User</h3>
                    <p>System Administrator</p>
                </div>
                <i class="fas fa-user-circle user-profile-icon"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-100">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <a href="#" class="text-blue-500 hover:text-blue-700"><i class="fas fa-home"></i> Dashboard</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span>PLO Management</span>
                </div>
                <div>
                    <button class="btn btn-outline" onclick="location.reload()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
        </div>

        <div id="departmentsContainer"></div>
    </div>

    <div class="modal" id="addPloModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="ploModalTitle"><i class="fas fa-plus-circle text-purple-600"></i> Add New PLO</h3>
                <span class="close" data-modal="addPloModal">&times;</span>
            </div>
            <form id="ploForm">
                <input type="hidden" id="ploIndex" value="">
                <input type="hidden" id="ploDepartment" value="">

                <div class="form-group">
                    <label for="ploCode">PLO Code</label>
                    <input type="text" id="ploCode" class="form-control" placeholder="PLO 1" disabled>
                </div>
                
                <div class="form-group">
                    <label for="ploDescription">PLO Description</label>
                    <textarea id="ploDescription" class="form-control" rows="4" placeholder="Enter the detailed description of the Program Learning Outcome" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="ploVerb">Action Verb (e.g., Apply, Analyze, Design)</label>
                    <input type="text" id="ploVerb" class="form-control" placeholder="e.g., Apply" required>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline close-modal" data-modal="addPloModal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="ploSubmitBtn">Save PLO</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const departments = [
            { id: "cs", name: "Computer Science", icon: "fas fa-laptop-code", color: "#8b5cf6" },
            { id: "ee", name: "Electrical Engineering", icon: "fas fa-bolt", color: "#3b82f6" },
            { id: "me", name: "Mechanical Engineering", icon: "fas fa-cog", color: "#f59e0b" },
            { id: "ce", name: "Civil Engineering", icon: "fas fa-building", color: "#10b981" }
        ];

        let currentPloData = {
            "cs": [
                { code: "PLO 1", description: "Graduates will be able to apply fundamental computing principles and mathematics knowledge.", verb: "Apply" },
                { code: "PLO 2", description: "Graduates will be able to analyze a complex computing problem and apply principles of computing to identify solutions.", verb: "Analyze" },
                { code: "PLO 3", description: "Graduates will be able to design, implement, and evaluate a computing-based solution to meet a given set of computing requirements.", verb: "Design" }
            ],
            "ee": [
                { code: "PLO 1", description: "Ability to apply knowledge of science, mathematics, and engineering.", verb: "Apply" },
                { code: "PLO 2", description: "Ability to identify, formulate, and solve complex engineering problems.", verb: "Formulate" }
            ],
            "me": [],
            "ce": []
        };

        function getNextPloCode(deptId) {
            const currentCount = currentPloData[deptId] ? currentPloData[deptId].length : 0;
            return `PLO ${currentCount + 1}`;
        }

        function renderDepartments() {
            const container = document.getElementById('departmentsContainer');
            container.innerHTML = '';

            departments.forEach(dept => {
                const deptCard = document.createElement('div');
                deptCard.className = 'dept-card';
                
                const plos = currentPloData[dept.id] || [];
                const ploListHTML = plos.length === 0 
                    ? '<p class="text-center text-gray-500 py-8 italic">No PLOs defined for this department. Click "Add New PLO" to begin.</p>'
                    : plos.map((plo, index) => `
                        <div class="plo-item">
                            <div class="plo-details flex items-start space-x-4">
                                <span class="badge-primary px-3 py-1 mt-1">${plo.code}</span>
                                <div>
                                    <h4 class="text-gray-800">${plo.description}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Action Verb: <span class="font-semibold">${plo.verb}</span></p>
                                </div>
                            </div>
                            <div class="plo-actions">
                                <button class="btn btn-outline btn-sm" onclick="editPlo('${dept.id}', ${index})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deletePlo('${dept.id}', ${index})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    `).join('');

                deptCard.innerHTML = `
                    <div class="dept-header" onclick="toggleDepartment('${dept.id}')">
                        <div class="dept-title">
                            <i class="${dept.icon}"></i>
                            <h2>${dept.name} (${dept.id.toUpperCase()})</h2>
                            <span class="badge-primary">${plos.length} PLO${plos.length !== 1 ? 's' : ''}</span>
                        </div>
                        <i class="fas fa-chevron-down chevron-icon" id="chevron-${dept.id}"></i>
                    </div>
                    <div class="dept-content" id="content-${dept.id}">
                        <div class="mb-4">
                            <button class="btn btn-success" onclick="addNewPlo('${dept.id}')">
                                <i class="fas fa-plus"></i> Add New PLO
                            </button>
                        </div>
                        <div class="plo-list">${ploListHTML}</div>
                    </div>
                `;

                container.appendChild(deptCard);
            });
        }

        function toggleDepartment(deptId) {
            const content = document.getElementById(`content-${deptId}`);
            const chevron = document.getElementById(`chevron-${deptId}`);
            
            content.classList.toggle('expanded');
            chevron.classList.toggle('rotated');
        }

        function addNewPlo(deptId) {
            const nextCode = getNextPloCode(deptId);
            const deptName = departments.find(d => d.id === deptId).name;
            
            document.getElementById('ploModalTitle').innerHTML = `<i class="fas fa-plus-circle text-purple-600"></i> Add New PLO - ${deptName}`;
            document.getElementById('ploSubmitBtn').textContent = 'Add PLO';
            document.getElementById('ploIndex').value = '';
            document.getElementById('ploDepartment').value = deptId;
            document.getElementById('ploCode').value = nextCode;
            document.getElementById('ploDescription').value = '';
            document.getElementById('ploVerb').value = '';

            openModal(document.getElementById('addPloModal'));
        }

        function editPlo(deptId, index) {
            const plo = currentPloData[deptId][index];
            const deptName = departments.find(d => d.id === deptId).name;
            
            document.getElementById('ploModalTitle').innerHTML = `<i class="fas fa-edit text-purple-600"></i> Edit ${plo.code} - ${deptName}`;
            document.getElementById('ploSubmitBtn').textContent = 'Save Changes';
            document.getElementById('ploIndex').value = index;
            document.getElementById('ploDepartment').value = deptId;
            document.getElementById('ploCode').value = plo.code;
            document.getElementById('ploDescription').value = plo.description;
            document.getElementById('ploVerb').value = plo.verb;

            openModal(document.getElementById('addPloModal'));
        }

        function deletePlo(deptId, index) {
            const plo = currentPloData[deptId][index];
            if (confirm(`Are you sure you want to delete ${plo.code}? All subsequent PLOs will be renumbered.`)) {
                currentPloData[deptId].splice(index, 1);
                currentPloData[deptId].forEach((p, i) => {
                    p.code = `PLO ${i + 1}`;
                });
                alert(`PLO successfully deleted and renumbered!`);
                renderDepartments();
            }
        }

        function savePlo() {
            const deptId = document.getElementById('ploDepartment').value;
            const index = document.getElementById('ploIndex').value;
            const description = document.getElementById('ploDescription').value.trim();
            const verb = document.getElementById('ploVerb').value.trim();
            const ploCode = document.getElementById('ploCode').value;

            if (!description || !verb) {
                alert('Please fill out all required fields.');
                return false;
            }

            const newPlo = { code: ploCode, description: description, verb: verb };

            if (index === '') {
                currentPloData[deptId].push(newPlo);
                alert(`${ploCode} added successfully!`);
            } else {
                currentPloData[deptId][parseInt(index)] = newPlo;
                alert(`${ploCode} updated successfully!`);
            }

            renderDepartments();
            closeModal(document.getElementById('addPloModal'));
            return false;
        }

        function openModal(modal) {
            modal.style.display = 'flex';
        }

        function closeModal(modal) {
            modal.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();

            document.querySelectorAll('.close, .close-modal').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const modalId = e.currentTarget.getAttribute('data-modal');
                    const modalElement = document.getElementById(modalId) || e.currentTarget.closest('.modal');
                    if (modalElement) {
                        closeModal(modalElement);
                    }
                });
            });

            window.addEventListener('click', (e) => {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (e.target === modal) {
                        closeModal(modal);
                    }
                });
            });

            document.getElementById('ploForm').addEventListener('submit', (e) => {
                e.preventDefault();
                savePlo();
            });
        });
    </script>
@endsection