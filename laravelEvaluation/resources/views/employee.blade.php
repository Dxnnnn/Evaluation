<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($role) }} Employee List - Faculty Evaluation System</title>

    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="dashboard.css">
    <!-- Flatpickr Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Select2 for better dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Toastr for notifications -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="header-left">
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <div class="user-avatar">👤</div>
            <div class="welcome-text">Welcome Back... {{ ucfirst($role) }}</div>
        </div>
        
        <div class="main-title">EMPLOYEE LIST</div>
        
        <div class="header-right">
            <div class="logo">BC</div>
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="employee-container">
            <div class="employee-controls">
                <div class="search-filter">
                    <input type="text" placeholder="Search Employee..." class="search-input">
                    <button class="filter-btn">Filter By...</button>
                </div>
                <button class="add-employee-btn">ADD EMPLOYEE</button>
            </div>

            <div class="employee-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Employee Birthday</th>
                            <th>Day Hired</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($employees) && $employees->count())
                            @foreach($employees as $employee)
                                <tr data-employee='@json($employee)'>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->lastName }}</td>
                                    <td>{{ $employee->firstName }}</td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->status }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>{{ optional($employee->birthday)->format('Y-m-d') }}</td>
                                    <td>{{ optional($employee->dateHired)->format('Y-m-d') }}</td>
                                    <td>
                                        <button type="button" class="apply-btn" onclick="event.stopPropagation(); openEditEmployeeModal(this.closest('tr'))">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" style="text-align:center; padding:20px;">No employees found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Edit/Delete Employee Modal -->
            <div id="editEmployeeModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>EDIT/ DELETE<br>EMPLOYEE</h2>
                        <button type="button" class="close-modal-btn">&times;</button>
                    </div>
                    <form id="editEmployeeForm" class="modal-form">
                        <input type="hidden" name="id">

                        <div class="panel-label">Last Name:</div>
                        <input class="panel-input" type="text" name="lastName">

                        <div class="panel-label">First Name:</div>
                        <input class="panel-input" type="text" name="firstName">

                        <div class="panel-label">Gender:</div>
                        <select class="panel-input select2" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>

                        <div class="panel-label">Status:</div>
                        <select class="panel-input select2" name="status">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="On Leave">On Leave</option>
                        </select>

                        <div class="panel-label">Department:</div>
                        <select class="panel-input select2" name="department">
                            <option value="">Select Department</option>
                            <option value="IT">IT</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                        </select>

                        <div class="panel-label">Email:</div>
                        <input class="panel-input" type="email" name="email" required>

                        <div class="panel-label">Employee Birthday:</div>
                        <input class="panel-input" type="date" name="birthday">

                        <div></div>
                        <div class="panel-actions">
                            <button type="submit" class="btn-apply">✓ APPLY</button>
                            <button type="button" class="btn-delete" id="deleteEmployeeBtn">🗑️ DELETE</button>
                            <button type="button" class="btn-cancel" id="cancelEditBtn">✖ CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Employee Modal -->
            <div id="addEmployeeModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>ADD<br>EMPLOYEE</h2>
                        <button type="button" class="close-modal-btn">&times;</button>
                    </div>
                    <form id="addEmployeeForm" class="modal-form">
                        @csrf

                        <div class="panel-label">Last Name:</div>
                        <input class="panel-input" type="text" name="lastName" required placeholder="">

                        <div class="panel-label">First Name:</div>
                        <input class="panel-input" type="text" name="firstName" required placeholder="">

                        <div class="panel-label">Gender:</div>
                        <select class="panel-input select2" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>

                        <div class="panel-label">Status:</div>
                        <select class="panel-input select2" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="On Leave">On Leave</option>
                        </select>

                        <div class="panel-label">Department:</div>
                        <select class="panel-input select2" name="department" required>
                            <option value="">Select Department</option>
                            <option value="IT">Information Technology</option>
                            <option value="HR">Human Resources</option>
                            <option value="Finance">Finance</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Operations">Operations</option>
                        </select>

                        <div class="panel-label">Employee Birthday:</div>
                        <input class="panel-input datepicker" type="text" name="birthday" required placeholder="">

                        <div class="panel-label">Email:</div>
                        <input class="panel-input" type="email" name="email" required placeholder="">

                        <div></div>
                        <div class="panel-actions">
                            <button type="submit" class="btn-apply">✓ APPLY</button>
                            <button type="button" class="btn-cancel" id="cancelAddBtn">✖ CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
    
    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">Menu</div>
            <button class="close-btn" onclick="closeSidebar()">×</button>
        </div>
        
        <div class="sidebar-menu">
            @if($role === 'admin')
                <a href="#" class="sidebar-item">
                    <div class="icon">👤+</div>
                    <div class="label">Manage Users</div>
                </a>
                <a href="{{ route('employee.list') }}" class="sidebar-item active">
                    <div class="icon">📋</div>
                    <div class="label">Employee List</div>
                </a>
                <a href="{{ route('evaluation.form') }}" class="sidebar-item">
                    <div class="icon">📄</div>
                    <div class="label">Evaluation Forms</div>
                </a>
                <a href="#" class="sidebar-item">
                    <div class="icon">🏢</div>
                    <div class="label">Departments</div>
                </a>
                <a href="#" class="sidebar-item">
                    <div class="icon">📊</div>
                    <div class="label">Positions</div>
                </a>
                <a href="#" class="sidebar-item">
                    <div class="icon">⚙️</div>
                    <div class="label">Settings</div>
                </a>
            @else
                <a href="{{ route('evaluation.form') }}" class="sidebar-item">
                    <div class="icon">📝</div>
                    <div class="label">My Evaluations</div>
                </a>
                <a href="#" class="sidebar-item">
                    <div class="icon">⚙️</div>
                    <div class="label">Settings</div>
                </a>
            @endif
            
            <a href="#" class="sidebar-item logout-item" onclick="logout()">
                <div class="icon">🚪</div>
                <div class="label">Log Out</div>
            </a>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'block';
                sidebar.classList.add('open');
                overlay.classList.add('open');
            } else {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                setTimeout(() => {
                    sidebar.style.display = 'none';
                }, 300);
            }
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            setTimeout(() => {
                sidebar.style.display = 'none';
            }, 300);
        }
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Modal functions
        function openAddEmployeeModal() {
            const modal = document.getElementById('addEmployeeModal');
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function openEditEmployeeModal(employeeData) {
            const modal = document.getElementById('editEmployeeModal');
            let data = employeeData;
            // if a table row element was passed, read its dataset
            if (employeeData instanceof Element) {
                try {
                    data = JSON.parse(employeeData.dataset.employee);
                } catch (e) {
                    console.error('Invalid employee data', e);
                    data = null;
                }
            }

            if (!data) return;

            // Populate form with employee data
            const form = document.getElementById('editEmployeeForm');
            // ensure id hidden field exists
            if (!form.querySelector('[name="id"]')) {
                const hid = document.createElement('input');
                hid.type = 'hidden'; hid.name = 'id';
                form.appendChild(hid);
            }
            form.querySelector('[name="lastName"]').value = data.lastName || '';
            form.querySelector('[name="firstName"]').value = data.firstName || '';
            form.querySelector('[name="gender"]').value = data.gender || '';
            form.querySelector('[name="status"]').value = data.status || '';
            form.querySelector('[name="department"]').value = data.department || '';
            form.querySelector('[name="email"]').value = data.email || '';
            form.querySelector('[name="birthday"]').value = data.birthday ? data.birthday.split('T')[0] : '';
            form.querySelector('[name="id"]').value = data.id || '';

            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            modal.querySelector('form').reset(); // Reset form when closing
        }

        // Add event listeners for the Add Employee button
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.querySelector('.add-employee-btn');
            if (addButton) {
                addButton.addEventListener('click', openAddEmployeeModal);
            }
            
            // Add event listeners for all Cancel buttons
            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeModal(btn.closest('.modal').id);
                });
            });

            // Handle form submissions
            document.getElementById('addEmployeeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch('{{ route("employee.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal('addEmployeeModal');
                        window.location.reload(); // Refresh to show new employee
                    } else {
                        alert(data.message || 'Error adding employee');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding employee');
                });
            });
        });

        // Do NOT close modals when clicking outside or pressing Escape.
        // Only the top-right close button (X) will close the modal, or a successful form submit.
        
        // Close sidebar when pressing Escape key (do not close modals)
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    </script>

    <!-- Required JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('#addEmployeeModal')
            });

            // Initialize Flatpickr date picker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                maxDate: new Date(),
                disableMobile: true
            });

            // Configure Toastr
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            };

            // Form validation and submission
            $('#addEmployeeForm').on('submit', function(e) {
                e.preventDefault();
                
                // Clear previous errors
                $('.form-error').text('');
                
                // Show loading state
                const submitBtn = $(this).find('.apply-btn');
                submitBtn.prop('disabled', true);
                submitBtn.find('.button-text').hide();
                submitBtn.find('.button-loader').show();

                const formData = new FormData(this);

                fetch('{{ route("employee.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                })
                .then(async response => {
                    const data = await response.json();
                    if (data.success) {
                        toastr.success('Employee added successfully!');
                        closeModal('addEmployeeModal');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // Handle validation errors or other issues
                        if (data.errors) {
                            // Clear previous errors
                            $('.form-error').text('');
                            
                            // Show error for each field
                            Object.keys(data.errors).forEach(field => {
                                const input = $(`[name="${field}"]`);
                                const errorDiv = input.next('.form-error');
                                if (!errorDiv.length) {
                                    // Create error div if it doesn't exist
                                    input.after($('<div>').addClass('form-error'));
                                }
                                input.next('.form-error').text(data.errors[field][0]);
                            });
                        }
                        toastr.error(data.message || 'Please check the form for errors');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An unexpected error occurred');
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.button-text').show();
                    submitBtn.find('.button-loader').hide();
                });
            });

            // Reset form on modal close (only the top-right X closes the modal)
            $('.close-modal-btn').click(function() {
                const modal = $(this).closest('.modal');
                closeModal(modal.attr('id'));
                setTimeout(() => {
                    modal.find('form')[0].reset();
                    modal.find('.select2').val('').trigger('change');
                    modal.find('.form-error').text('');
                }, 300);
            });

            // Initialize select2 for edit modal selects
            $('#editEmployeeModal .select2').select2({ width: '100%', dropdownParent: $('#editEmployeeModal') });

            // Cancel buttons (explicit) - also reset
            $('#cancelAddBtn').on('click', function() {
                const modal = $('#addEmployeeModal');
                closeModal('addEmployeeModal');
                setTimeout(() => {
                    modal.find('form')[0].reset();
                    modal.find('.select2').val('').trigger('change');
                    modal.find('.form-error').text('');
                }, 300);
            });

            $('#cancelEditBtn').on('click', function() {
                const modal = $('#editEmployeeModal');
                closeModal('editEmployeeModal');
                setTimeout(() => {
                    modal.find('form')[0].reset();
                    modal.find('.select2').val('').trigger('change');
                    modal.find('.form-error').text('');
                }, 300);
            });

            // Handle Edit (Apply) form submit -> persist update and update table row
            $('#editEmployeeForm').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);
                const id = formData.get('id');
                if (!id) return toastr.error('Missing employee id');
                
                // Convert FormData to object and ensure all required fields are included
                const payload = {
                    lastName: formData.get('lastName'),
                    firstName: formData.get('firstName'),
                    gender: formData.get('gender'),
                    status: formData.get('status'),
                    department: formData.get('department'),
                    birthday: formData.get('birthday'),
                    email: $('#editEmployeeForm [name="email"]').val() || '' // needed for validation
                };

                // Debug what we're sending
                console.log('Updating employee:', id, payload);

                fetch('{{ url("/employee") }}/' + id, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // update the corresponding table row
                        const rows = $('tr[data-employee]').filter(function() {
                            try { return JSON.parse(this.dataset.employee).id == id; } catch(e){ return false; }
                        });
                        if (rows.length) {
                            const row = rows.first();
                            const emp = data.employee;
                            // update dataset
                            row.attr('data-employee', JSON.stringify(emp));
                            // update visible cells (assumes same column order)
                            const tds = row.find('td');
                            tds.eq(1).text(emp.lastName);
                            tds.eq(2).text(emp.firstName);
                            tds.eq(3).text(emp.gender);
                            tds.eq(4).text(emp.status);
                            tds.eq(5).text(emp.department);
                            tds.eq(6).text(emp.birthday ? emp.birthday.split('T')[0] : '');
                            // dateHired left unchanged
                        }
                        toastr.success(data.message || 'Employee updated');
                        closeModal('editEmployeeModal');
                    } else {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                $(`[name="${field}"]`).next('.form-error').text(data.errors[field][0]);
                            });
                        }
                        toastr.error(data.message || 'Error updating employee');
                    }
                })
                .catch(err => {
                    console.error(err);
                    toastr.error('Unexpected error updating employee');
                });
            });

            // Delete button: call server to delete and remove the row
            $('#deleteEmployeeBtn').on('click', function() {
                if (!confirm('Are you sure you want to delete this employee?')) return;
                const id = $('#editEmployeeForm [name="id"]').val();
                if (!id) return toastr.error('Missing employee id');

                fetch(`/employee/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // remove table row
                        $('tr[data-employee]').filter(function() {
                            try { return JSON.parse(this.dataset.employee).id == id; } catch(e){ return false; }
                        }).remove();
                        toastr.success(data.message || 'Employee deleted');
                        closeModal('editEmployeeModal');
                    } else {
                        toastr.error(data.message || 'Error deleting employee');
                    }
                })
                .catch(err => {
                    console.error(err);
                    toastr.error('Unexpected error deleting employee');
                });
            });
        });
    </script>
</body>
</html>
