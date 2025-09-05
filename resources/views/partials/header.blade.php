<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-building"></i> Assessment System
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Student Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('students.*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-mortarboard"></i> Students
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> All Students
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('students.create') }}">
                            <i class="bi bi-plus-circle"></i> New Student
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('academics.index') }}">
                            <i class="bi bi-book"></i> Academic Info
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('leadership.index') }}">
                            <i class="bi bi-trophy"></i> Leadership
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('profiles.index') }}">
                            <i class="bi bi-person-badge"></i> Student Profiles
                        </a></li>
                    </ul>
                </li>

                <!-- Assessor System -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('assessor_*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-check"></i> Assessors
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('assessor_accounts.index') }}">
                            <i class="bi bi-people"></i> Assessor Accounts
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('assessor_profiles.index') }}">
                            <i class="bi bi-person-badge"></i> Assessor Profiles
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('change_assessor_passwords.index') }}">
                            <i class="bi bi-key"></i> Password Changes
                        </a></li>
                    </ul>
                </li>

                <!-- Submissions -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('submission*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-file-earmark-text"></i> Submissions
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('submissions.index') }}">
                            <i class="bi bi-list-check"></i> All Submissions
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('pending.index') }}">
                            <i class="bi bi-clock"></i> Pending
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('assessed.index') }}">
                            <i class="bi bi-check-circle"></i> Assessed
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('cor.index') }}">
                            <i class="bi bi-upload"></i> COR Submissions
                        </a></li>
                    </ul>
                </li>

                <!-- Rubrics -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('rubric*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-list-ul"></i> Rubrics
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('rubric-categories.index') }}">
                            <i class="bi bi-tags"></i> Categories
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('rubric-sections.index') }}">
                            <i class="bi bi-list-nested"></i> Sections
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('rubric-subsections.index') }}">
                            <i class="bi bi-list"></i> Subsections
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('leadership-subsections.index') }}">
                            <i class="bi bi-trophy"></i> Leadership Subsections
                        </a></li>
                    </ul>
                </li>

                <!-- Reviews & Approvals -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('*review*') || request()->routeIs('*approval*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-clipboard-check"></i> Reviews
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('final-reviews.index') }}">
                            <i class="bi bi-clipboard-check"></i> Final Reviews
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('approvals.index') }}">
                            <i class="bi bi-check2-all"></i> Account Approvals
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('award_reports.index') }}">
                            <i class="bi bi-award"></i> Award Reports
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('submission_oversights.index') }}">
                            <i class="bi bi-eye"></i> Submission Oversight
                        </a></li>
                    </ul>
                </li>

                <!-- Admin Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin*') || request()->routeIs('*admin*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-gear"></i> Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admins.index') }}">
                            <i class="bi bi-person-badge"></i> Admin Profiles
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('accounts.index') }}">
                            <i class="bi bi-people"></i> Manage Accounts
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('passwords.index') }}">
                            <i class="bi bi-key"></i> Admin Passwords
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('password-changes.index') }}">
                            <i class="bi bi-arrow-repeat"></i> Password Changes
                        </a></li>
                    </ul>
                </li>

                <!-- System -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('system*') || request()->routeIs('log*') || request()->routeIs('otp*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-cpu"></i> System
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('system-logs.index') }}">
                            <i class="bi bi-activity"></i> System Logs
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('log-in.index') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login Records
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('otp.index') }}">
                            <i class="bi bi-shield-lock"></i> OTP Management
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('change-password.form') }}">
                            <i class="bi bi-key"></i> Change Password
                        </a></li>
                    </ul>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text">
                        <i class="bi bi-person-circle"></i> Admin Panel
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>
