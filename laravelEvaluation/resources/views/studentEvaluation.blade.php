<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Evaluation - Faculty Evaluation System</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="studentEvaluation.css">
    
</head>
<body>
    <div class="header">
        <div class="header-left">
             <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <div class="user-avatar">👤</div>
            <div class="welcome-text">Welcome Back... {{ ucfirst($role) }}</div>
        </div>
        
        <div class="main-title">
            @if($role === 'admin')
                EMPLOYEE EVALUATION
            @else
                STUDENT EVALUATION
            @endif
        </div>

        
        <div class="header-right">
            <div class="logo">BC</div>
        
        
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        <form id="evaluation-form" class="evaluation-form" method="POST" action="{{ route('student.evaluation.store') }}">
            @csrf
            
            <!-- Course Code and Instructor Selection -->
            <div class="selection-container">
                <div class="selection-group">
                    <label for="course_code" class="form-label">Course Code:</label>
                    <select id="course_code" name="course_code" class="form-select" required>
                        <option value="">Select Course Code</option>
                        <option value="IT310">IT310 - Application Dev't & Emerging Technologies </option>
                        <option value="IT311">IT311 - Operating System</option>
                        <option value="IT312">IT312 - Human Computer Interaction</option>
                        <option value="ITELEC1">ITELEC1 - IT Elective I</option>
                        <option value="ITTEL2">ITTEL2 - IT Track Elective II</option>
                        <option value="STAT">STAT - Statistics & Probability</option>
                        <option value="TECHNO">TECHNO - Technopreneurship</option>
                    </select>
                </div>
                <div class="selection-group">
                    <label for="instructor" class="form-label">Instructor:</label>
                    <select id="instructor" name="instructor" class="form-select" required>
                        <option value="">Select Instructor</option>
                        <option value="1">Quitorio, Erika Jane</option>
                        <option value="2">Riarte, Nigel Dela</option>
                        <option value="3">Totoy, Verniette</option>
                        <option value="4">Yamilo, Leny</option>
                        <option value="5">Moraca, Rey Micheal</option>
                    </select>
                </div>
            </div>

            <!-- Rating Scale -->
            <div class="rating-scale">
                <h3 class="rating-scale-title">Rating Scale:</h3>
                <div class="rating-scale-grid">
                    <div><strong>1</strong><br>Needs Improvement</div>
                    <div><strong>2</strong><br>Below Expectations</div>
                    <div><strong>3</strong><br>Meets Expectations</div>
                    <div><strong>4</strong><br>Exceeds Expectations</div>
                    <div><strong>5</strong><br>Outstanding</div>
                </div>
            </div>

            <!-- Evaluation Table -->
            <div class="table-container">
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Performance Criteria</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Professionalism -->
                        <tr class="category-header">
                            <td colspan="6">PROFESSIONALISM</td>
                        </tr>
                        <tr>
                            <td>Consistently demonstrates professional appearance and demeanor throughout the course, maintaining appropriate dress code, arriving on time for classes, and exhibiting a positive attitude that reflects their commitment to professional teaching standards and serves as a good role model for students.</td>
                            <td><input type="radio" name="rating_1" value="1"></td>
                            <td><input type="radio" name="rating_1" value="2"></td>
                            <td><input type="radio" name="rating_1" value="3"></td>
                            <td><input type="radio" name="rating_1" value="4"></td>
                            <td><input type="radio" name="rating_1" value="5"></td>
                        </tr>
                        <tr>
                            <td>Shows respect for all students by treating everyone fairly and equally, listening attentively to student questions and concerns, valuing diverse perspectives and opinions, and creating an inclusive learning environment where all students feel valued and respected regardless of their background or abilities.</td>
                            <td><input type="radio" name="rating_2" value="1"></td>
                            <td><input type="radio" name="rating_2" value="2"></td>
                            <td><input type="radio" name="rating_2" value="3"></td>
                            <td><input type="radio" name="rating_2" value="4"></td>
                            <td><input type="radio" name="rating_2" value="5"></td>
                        </tr>
                        <tr>
                            <td>Maintains ethical standards and academic integrity by protecting student privacy and confidential information, adhering to institutional policies, demonstrating honesty in grading and evaluation, and setting clear expectations for academic conduct that promote integrity among students.</td>
                            <td><input type="radio" name="rating_3" value="1"></td>
                            <td><input type="radio" name="rating_3" value="2"></td>
                            <td><input type="radio" name="rating_3" value="3"></td>
                            <td><input type="radio" name="rating_3" value="4"></td>
                            <td><input type="radio" name="rating_3" value="5"></td>
                        </tr>
                        <tr>
                            <td>Demonstrates accountability and responsibility by taking ownership of their teaching methods, meeting class schedules consistently, accepting and responding to student feedback constructively, and following through on commitments such as returning graded assignments promptly and being available during office hours as promised.</td>
                            <td><input type="radio" name="rating_4" value="1"></td>
                            <td><input type="radio" name="rating_4" value="2"></td>
                            <td><input type="radio" name="rating_4" value="3"></td>
                            <td><input type="radio" name="rating_4" value="4"></td>
                            <td><input type="radio" name="rating_4" value="5"></td>
                        </tr>

                        <!-- Teaching Methods -->
                        <tr class="category-header">
                            <td colspan="6">TEACHING METHODS</td>
                        </tr>
                        <tr>
                            <td>Delivers course content clearly and effectively by explaining complex concepts in understandable terms, using appropriate examples and illustrations, organizing material in a logical sequence, and ensuring that students can follow the progression of topics throughout the course.</td>
                            <td><input type="radio" name="rating_5" value="1"></td>
                            <td><input type="radio" name="rating_5" value="2"></td>
                            <td><input type="radio" name="rating_5" value="3"></td>
                            <td><input type="radio" name="rating_5" value="4"></td>
                            <td><input type="radio" name="rating_5" value="5"></td>
                        </tr>
                        <tr>
                            <td>Demonstrates proper use of educational technology and tools by effectively utilizing multimedia resources, learning management systems, presentation software, and other digital tools to enhance the learning experience and make course materials more accessible and engaging for students.</td>
                            <td><input type="radio" name="rating_6" value="1"></td>
                            <td><input type="radio" name="rating_6" value="2"></td>
                            <td><input type="radio" name="rating_6" value="3"></td>
                            <td><input type="radio" name="rating_6" value="4"></td>
                            <td><input type="radio" name="rating_6" value="5"></td>
                        </tr>
                        <tr>
                            <td>Uses a variety of teaching methods and approaches by incorporating lectures, discussions, group activities, hands-on exercises, case studies, and other instructional strategies that accommodate different learning styles and keep students engaged and actively participating in the learning process.</td>
                            <td><input type="radio" name="rating_7" value="1"></td>
                            <td><input type="radio" name="rating_7" value="2"></td>
                            <td><input type="radio" name="rating_7" value="3"></td>
                            <td><input type="radio" name="rating_7" value="4"></td>
                            <td><input type="radio" name="rating_7" value="5"></td>
                        </tr>
                        <tr>
                            <td>Provides clear and detailed instructions for assignments and assessments by explaining requirements thoroughly, providing rubrics or grading criteria, giving examples of expected work, and ensuring that students understand what is expected of them before they begin their assignments or projects.</td>
                            <td><input type="radio" name="rating_8" value="1"></td>
                            <td><input type="radio" name="rating_8" value="2"></td>
                            <td><input type="radio" name="rating_8" value="3"></td>
                            <td><input type="radio" name="rating_8" value="4"></td>
                            <td><input type="radio" name="rating_8" value="5"></td>
                        </tr>

                        <!-- Knowledge and Expertise -->
                        <tr class="category-header">
                            <td colspan="6">KNOWLEDGE AND EXPERTISE</td>
                        </tr>
                        <tr>
                            <td>Demonstrates deep knowledge and expertise in the subject matter by providing accurate information, staying current with developments in the field, answering student questions confidently and accurately, and showing enthusiasm for the subject that inspires student interest and engagement.</td>
                            <td><input type="radio" name="rating_9" value="1"></td>
                            <td><input type="radio" name="rating_9" value="2"></td>
                            <td><input type="radio" name="rating_9" value="3"></td>
                            <td><input type="radio" name="rating_9" value="4"></td>
                            <td><input type="radio" name="rating_9" value="5"></td>
                        </tr>
                        <tr>
                            <td>Connects course content to real-world applications by providing relevant examples from industry or practice, relating theoretical concepts to practical situations, sharing professional experiences when appropriate, and helping students understand how the material applies beyond the classroom.</td>
                            <td><input type="radio" name="rating_10" value="1"></td>
                            <td><input type="radio" name="rating_10" value="2"></td>
                            <td><input type="radio" name="rating_10" value="3"></td>
                            <td><input type="radio" name="rating_10" value="4"></td>
                            <td><input type="radio" name="rating_10" value="5"></td>
                        </tr>
                        <tr>
                            <td>Adapts teaching methods to meet student needs by recognizing when students are struggling with concepts, adjusting the pace of instruction accordingly, providing additional explanations or alternative approaches when needed, and ensuring that all students have opportunities to learn and succeed.</td>
                            <td><input type="radio" name="rating_11" value="1"></td>
                            <td><input type="radio" name="rating_11" value="2"></td>
                            <td><input type="radio" name="rating_11" value="3"></td>
                            <td><input type="radio" name="rating_11" value="4"></td>
                            <td><input type="radio" name="rating_11" value="5"></td>
                        </tr>
                        <tr>
                            <td>Encourages critical thinking and problem-solving by posing challenging questions, facilitating discussions that require analysis and evaluation, assigning projects that require application of concepts, and guiding students to develop their own solutions rather than simply providing answers.</td>
                            <td><input type="radio" name="rating_12" value="1"></td>
                            <td><input type="radio" name="rating_12" value="2"></td>
                            <td><input type="radio" name="rating_12" value="3"></td>
                            <td><input type="radio" name="rating_12" value="4"></td>
                            <td><input type="radio" name="rating_12" value="5"></td>
                        </tr>

                        <!-- Communication and Feedback -->
                        <tr class="category-header">
                            <td colspan="6">COMMUNICATION AND FEEDBACK</td>
                        </tr>
                        <tr>
                            <td>Communicates clearly and effectively by speaking at an appropriate pace and volume, using language that students can understand, explaining concepts in multiple ways when needed, and ensuring that instructions and expectations are clearly conveyed so that students know what is required of them.</td>
                            <td><input type="radio" name="rating_13" value="1"></td>
                            <td><input type="radio" name="rating_13" value="2"></td>
                            <td><input type="radio" name="rating_13" value="3"></td>
                            <td><input type="radio" name="rating_13" value="4"></td>
                            <td><input type="radio" name="rating_13" value="5"></td>
                        </tr>
                        <tr>
                            <td>Encourages student participation and interaction by creating a welcoming classroom atmosphere, asking questions that promote discussion, listening attentively to student responses, valuing student contributions, and making students feel comfortable sharing their thoughts and asking questions without fear of judgment.</td>
                            <td><input type="radio" name="rating_14" value="1"></td>
                            <td><input type="radio" name="rating_14" value="2"></td>
                            <td><input type="radio" name="rating_14" value="3"></td>
                            <td><input type="radio" name="rating_14" value="4"></td>
                            <td><input type="radio" name="rating_14" value="5"></td>
                        </tr>
                        <tr>
                            <td>Provides timely and constructive feedback by returning graded assignments promptly, offering specific comments on student work, explaining both strengths and areas for improvement, providing guidance on how to enhance performance, and being available to discuss grades and feedback with students who have questions or concerns.</td>
                            <td><input type="radio" name="rating_15" value="1"></td>
                            <td><input type="radio" name="rating_15" value="2"></td>
                            <td><input type="radio" name="rating_15" value="3"></td>
                            <td><input type="radio" name="rating_15" value="4"></td>
                            <td><input type="radio" name="rating_15" value="5"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <label class="comments-label">Additional Comments:</label>
                <textarea name="comments" class="comments-textarea" rows="4"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="submit-container">
                <button type="submit" class="submit-button">
                    Submit Evaluation
                </button>
            </div>
        </form>
        
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
                <a href="{{ route('employee.list') }}" class="sidebar-item">
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
                <a href="{{ route('dashboard') }}" class="sidebar-item">
                    <div class="icon">🏠</div>
                    <div class="label">Dashboard</div>
                </a>
                <a href="{{ route('student.evaluation') }}" class="sidebar-item">
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


    <form id="logout-form" class="logout-form" action="{{ route('logout') }}" method="POST">
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

