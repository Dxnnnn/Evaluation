<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('evaluation_form.css') }}?v={{ time() }}">
</head>
<body>
    <div class="header">
        <div class="header-left">
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <div class="user-avatar">👤</div>
            <div class="welcome-text">Welcome Back... {{ ucfirst($role) }}</div>
        </div>
        
        <div class="main-title">EVALUATION FORM</div>
        
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

<div class="evaluation-container">

    @php
        $statementCategories = [
            'Performance & Productivity' => [
                'Meets deadlines and manages tasks efficiently.',
                'Produces high-quality work consistently.',
                'Maintains productivity levels throughout the work period.',
                'Effectively prioritizes tasks and responsibilities.',
                'Demonstrates strong attention to detail in work output.',
                'Completes assigned work within expected timeframes.',
                'Shows improvement in performance over time.'
            ],
            'Communication Skills' => [
                'Communicates effectively with others.',
                'Listens actively and responds appropriately to feedback.',
                'Expresses ideas and information clearly and concisely.',
                'Maintains professional communication in all interactions.',
                'Provides timely updates on work progress and issues.',
                'Demonstrates strong written communication skills.',
                'Effectively communicates with team members and supervisors.'
            ],
            'Teamwork & Collaboration' => [
                'Exhibits teamwork and collaboration skills.',
                'Works well with others to achieve common goals.',
                'Shares knowledge and resources with team members.',
                'Respects diverse opinions and perspectives.',
                'Contributes positively to team discussions and meetings.',
                'Supports colleagues and offers assistance when needed.',
                'Builds and maintains positive working relationships.'
            ],
            'Professionalism & Work Ethics' => [
                'Demonstrates professionalism at work.',
                'Shows initiative and responsibility.',
                'Maintains a positive and respectful attitude.',
                'Adheres to company policies and procedures.',
                'Shows commitment to organizational values and goals.',
                'Maintains confidentiality when required.',
                'Demonstrates reliability and dependability in all tasks.'
            ],
            'Problem Solving & Innovation' => [
                'Identifies problems and proposes effective solutions.',
                'Thinks creatively to overcome challenges.',
                'Adapts quickly to changing circumstances and requirements.',
                'Uses available resources efficiently to solve problems.',
                'Demonstrates analytical thinking in decision-making.',
                'Suggests improvements to processes and procedures.',
                'Shows willingness to learn and apply new skills.'
            ],
            'Leadership & Initiative' => [
                'Takes ownership of tasks and responsibilities.',
                'Shows leadership qualities when appropriate.',
                'Mentors and guides less experienced colleagues.',
                'Proactively identifies opportunities for improvement.',
                'Takes on additional responsibilities when needed.',
                'Demonstrates self-motivation and drive.',
                'Shows accountability for actions and decisions.'
            ]
        ];

        // Flatten statements for form processing
        $allStatements = [];
        foreach ($statementCategories as $category => $statements) {
            foreach ($statements as $statement) {
                $allStatements[] = $statement;
            }
        }

        $employees = [
            '1' => 'Leny Yamilo',
            '2' => 'Nigel Dela Riarte',
            '3' => 'Verniette Totoy',
            '4' => 'Erika Jane Quitorio',
            '5' => 'Rey Michael Moraca',
        ];

        $submittedData = session('evaluation_data');
        $submittedAt = session('submitted_at');
        $now = \Carbon\Carbon::now();
        $canEdit = $submittedAt ? $now->diffInHours(\Carbon\Carbon::parse($submittedAt)) < 24 : false;
    @endphp

    {{-- ===================== READ-ONLY VIEW AFTER SUBMISSION ===================== --}}
    @if($submittedData)
        <div class="submitted-info">
            <p><strong>Employee:</strong> {{ isset($employees[$submittedData['employee_id']]) ? $employees[$submittedData['employee_id']] : 'Employee #' . $submittedData['employee_id'] }}</p>
            <p><strong>Submitted at:</strong> {{ $submittedAt }}</p>
        </div>

        <div class="rating-table-container">
            <table class="rating-table">
                <thead>
                    <tr>
                        <th>Statement</th>
                        @for($i=1;$i<=5;$i++)
                        <th>{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @php $statementIndex = 0; @endphp
                    @foreach($statementCategories as $category => $statements)
                        <tr class="category-header-row">
                            <td colspan="6" class="category-header">{{ $category }}</td>
                        </tr>
                        @foreach($statements as $statement)
                            <tr>
                                <td class="statement">{{ $statement }}</td>
                                @for($i=1;$i<=5;$i++)
                                    <td>
                                        <input type="radio" disabled {{ isset($submittedData['ratings'][$statementIndex]) && $submittedData['ratings'][$statementIndex] == $i ? 'checked' : '' }}>
                                        {{ isset($submittedData['ratings'][$statementIndex]) && $submittedData['ratings'][$statementIndex] == $i ? $i : '' }}
                                    </td>
                                @endfor
                            </tr>
                            @php $statementIndex++; @endphp
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <p><strong>Remarks:</strong></p>
        <p>{{ $submittedData['remarks'] }}</p>

        <!-- Action Button -->
        <div class="evaluation-actions">
            <button class="edit-btn" onclick="handleEdit()">EDIT</button>
        </div>

        {{-- ===================== EDIT FORM (HIDDEN UNTIL EDIT CLICKED) ===================== --}}
        <form id="editForm" method="POST" action="{{ route('evaluation.submit') }}" style="display:none; margin-top:20px;">
            @csrf

            <div class="employee-select-group">
                <label for="employee_id">Select Employee <span class="required-asterisk">*</span></label>
                <select id="employee_id" name="employee_id" class="employee-select-input" required>
                    <option value="">-- Select an Employee --</option>
                    @foreach($employees as $id => $name)
                        <option value="{{ $id }}" {{ $submittedData['employee_id'] == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="rating-table-container">
                <table class="rating-table">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            @for($i=1;$i<=5;$i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @php $statementIndex = 0; @endphp
                        @foreach($statementCategories as $category => $statements)
                            <tr class="category-header-row">
                                <td colspan="6" class="category-header">{{ $category }}</td>
                            </tr>
                            @foreach($statements as $statement)
                                <tr>
                                    <td class="statement">{{ $statement }}</td>
                                    @for($i=1;$i<=5;$i++)
                                        <td>
                                            <input type="radio" name="statement_{{ $statementIndex }}" value="{{ $i }}" required
                                                {{ isset($submittedData['ratings'][$statementIndex]) && $submittedData['ratings'][$statementIndex] == $i ? 'checked' : '' }}>
                                        </td>
                                    @endfor
                                </tr>
                                @php $statementIndex++; @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="remarks-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-input">{{ $submittedData['remarks'] }}</textarea>
            </div>

            <!-- Horizontal Buttons -->
            <div class="evaluation-actions">
                <button type="submit" class="submit-btn">SAVE CHANGES</button>
                <button type="button" class="edit-btn" onclick="window.location.reload()">CANCEL</button>
            </div>

        </form>

    @else
    {{-- ===================== NEW SUBMISSION FORM ===================== --}}
        <form method="POST" action="{{ route('evaluation.submit') }}">
            @csrf

            <div class="employee-select-group">
                <label for="employee_id">Select Employee <span class="required-asterisk">*</span></label>
                <select id="employee_id" name="employee_id" class="employee-select-input" required>
                    <option value="">-- Select an Employee --</option>
                    @foreach($employees as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="rating-table-container">
                <table class="rating-table">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            @for($i=1;$i<=5;$i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @php $statementIndex = 0; @endphp
                        @foreach($statementCategories as $category => $statements)
                            <tr class="category-header-row">
                                <td colspan="6" class="category-header">{{ $category }}</td>
                            </tr>
                            @foreach($statements as $statement)
                                <tr>
                                    <td class="statement">{{ $statement }}</td>
                                    @for($i=1;$i<=5;$i++)
                                        <td><input type="radio" name="statement_{{ $statementIndex }}" value="{{ $i }}" required></td>
                                    @endfor
                                </tr>
                                @php $statementIndex++; @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="remarks-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-input" placeholder="Type your remarks here..."></textarea>
            </div>

            <div class="evaluation-actions">
                <button type="submit" class="submit-btn">SUBMIT</button>
                <button type="button" class="edit-btn" onclick="window.history.back()">CANCEL</button>
            </div>

        </form>
    @endif

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
            @if(isset($role) && $role === 'admin')
                <a href="#" class="sidebar-item">
                    <div class="icon">👤+</div>
                    <div class="label">Manage Users</div>
                </a>
                <a href="{{ route('employee.list') }}" class="sidebar-item">
                    <div class="icon">📋</div>
                    <div class="label">Employee List</div>
                </a>
                <a href="{{ route('evaluation.form') }}" class="sidebar-item active">
                    <div class="icon">📄</div>
                    <div class="label">Evaluation Form</div>
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
                <a href="{{ route('evaluation.form') }}" class="sidebar-item active">
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
function handleEdit() {
    const canEdit = {{ $canEdit ? 'true' : 'false' }};
    if (!canEdit) return alert("You can only edit within 24 hours.");

    document.getElementById('editForm').style.display = 'block';
    window.scrollTo(0, document.getElementById('editForm').offsetTop);
}

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

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});
</script>

</body>
</html>
