<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($role) }} Dashboard - Faculty Evaluation System</title>

    <link rel="stylesheet" href="dashboard.css">
    
</head>
<body>
    <div class="header">
        <div class="header-left">
             <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <div class="user-avatar">👤</div>
            <div class="welcome-text">Welcome Back... {{ ucfirst($role) }}</div>
        </div>
        
        <div class="main-title">EMPLOYEE EVALUATION</div>
        
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
        
        <div class="get-started">GET STARTED...</div>
        <div class="evaluate-today">
            @if($role === 'admin')
                Manage Faculty Evaluations Today
            @else
                Complete Your Evaluations Today
            @endif
        </div>
        <button class="cta-button">
            @if($role === 'admin')
                Manage Evaluations
            @else
                Go to Evaluations
            @endif
        </button>
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
                <a href="#" class="sidebar-item">
                    <div class="icon">📋</div>
                    <div class="label">Employee List</div>
                </a>
                <a href="#" class="sidebar-item">
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
                <a href="#" class="sidebar-item">
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
                }, 300); // Wait for animation to complete
            }
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            setTimeout(() => {
                sidebar.style.display = 'none';
            }, 300); // Wait for animation to complete
        }
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }
        
        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    </script>
</body>
</html>
