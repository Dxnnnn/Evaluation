<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYEE EVALUATION</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f5f7fb url('{{ asset('background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
        }
        
        .header {
            background: #1e3a8a;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 10;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }
        
        .welcome-text {
            background: #f58606ff;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .main-title {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            position: relative;
        }
        
        .logo::after {
           
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 10px;
            white-space: nowrap;
            color: #8a5b1eff;
        }
        
        .menu-icon {
            width: 30px;
            height: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            cursor: pointer;
        }
        
        .menu-icon div {
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 1px;
        }
        
        .main-content {
            position: relative;
            z-index: 5;
            padding: 60px 40px;
            text-align: center;
        }
        
        .get-started {
            font-size: 48px;
            font-weight: bold;
            background: linear-gradient(45deg, #dc2626, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        
        .evaluate-today {
            font-size: 24px;
            color: #dc2626;
            margin-bottom: 30px;
        }
        
        .cta-button {
            background: #16a34a;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .cta-button:hover {
            background: #15803d;
        }
        
        .dashboard-panel {
            position: fixed;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            background: #dbeafe;
            padding: 25px;
            border-radius: 15px;
            width: 200px;
            position: relative;
            z-index: 5;
        }
        
        .dashboard-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #1e3a8a;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .dashboard-item {
            text-align: center;
            padding: 15px 10px;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .dashboard-item:hover {
            transform: translateY(-2px);
        }
        
        .dashboard-item .icon {
            font-size: 24px;
            margin-bottom: 8px;
        }
        
        .dashboard-item .label {
            font-size: 12px;
            color: #374151;
            font-weight: 500;
        }
        
        .logout-item {
            grid-column: 1 / -1;
            background: #fef2f2;
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="user-avatar">👤</div>
            <div class="welcome-text">Welcome Back... Administrator</div>
        </div>
        
        <div class="main-title">EMPLOYEE EVALUATION</div>
        
        <div class="header-right">
            <div class="logo">BC</div>
            <div class="menu-icon">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="get-started">GET STARTED...</div>
        <div class="evaluate-today">Evaluate Today</div>
        <button class="cta-button">Go to Evaluations</button>
    </div>

    <div class="dashboard-panel">
        <div class="dashboard-title">Dashboard</div>
        <div class="dashboard-grid">
            <div class="dashboard-item">
                <div class="icon">👤+</div>
                <div class="label">Employee</div>
            </div>
            <div class="dashboard-item">
                <div class="icon">📋</div>
                <div class="label">Position</div>
            </div>
            <div class="dashboard-item">
                <div class="icon">📄</div>
                <div class="label">Evaluation Form</div>
            </div>
            <div class="dashboard-item">
                <div class="icon">🏢</div>
                <div class="label">Department</div>
            </div>
            <div class="dashboard-item logout-item">
                <div class="icon">🚪</div>
                <div class="label">Log Out</div>
            </div>
        </div>
    </div>
</body>
</html>
