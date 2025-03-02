<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mock Test Site Installer</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .installer-container { max-width: 600px; margin: 50px auto; }
    </style>
</head>
<body>
    <div class="installer-container card p-4">
        <h3 class="text-center">Mock Test Site Installer</h3>
        <div id="requirements" class="mb-3"></div>
        <form id="installForm">
            <div class="mb-3">
                <label>Base URL</label>
                <input type="text" name="base_url" class="form-control" value="http://localhost/mock-test-site/public/" required>
            </div>
            <div class="mb-3">
                <label>Database Host</label>
                <input type="text" name="db_host" class="form-control" value="localhost" required>
            </div>
            <div class="mb-3">
                <label>Database Name</label>
                <input type="text" name="db_name" class="form-control" value="mock_test_db" required>
            </div>
            <div class="mb-3">
                <label>Database User</label>
                <input type="text" name="db_user" class="form-control" value="root" required>
            </div>
            <div class="mb-3">
                <label>Database Password</label>
                <input type="password" name="db_pass" class="form-control">
            </div>
            <div class="mb-3">
                <label>Admin Email</label>
                <input type="email" name="admin_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Admin Password</label>
                <input type="password" name="admin_pass" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Install</button>
        </form>
        <div id="installMessage" class="mt-3"></div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/install.js"></script>
</body>
</html>