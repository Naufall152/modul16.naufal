<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-primary d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <i class="bi bi-hexagon-fill text-primary" style="font-size: 50px;"></i>
            <h3 class="mt-2">Employee Data Master</h3>
        </div>
        <form method="POST" action="/login">
            <!-- CSRF Token (if using Laravel) -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Your Password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right"></i> Log In
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

