<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Brand</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-body">

    <div class="login-wrapper">
        <div class="login-header">
            <div class="logo-icon-bg">
                <svg viewBox="0 0 24 24" width="24" height="24">
                    <path fill="currentColor" d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12zm-7-8c-1.66 0-3-1.34-3-3H7c0 2.76 2.24 5 5 5s5-2.24 5-5h-2c0 1.66-1.34 3-3 3z"/>
                </svg>
            </div>
            <span class="logo-text">Brand Admin</span>
        </div>
        
        <div class="login-card">
            <h2>Log In</h2>
            <p class="login-subtitle">Enter your admin portal credentials</p>
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-blue btn-full login-btn">Sign In</button>
            </form>
        </div>
        
        <div class="login-footer">
            <a href="{{ route('home') }}">← Back to Storefront</a>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>
    
    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>