<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ExamBook</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">ExamBook</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('user_id')): ?>
                        <li class="nav-item"><a class="nav-link" href="/tests">Tests</a></li>
                        <?php if (session()->get('username') === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/admin/create-test">Admin</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php $this->renderSection('content'); ?>