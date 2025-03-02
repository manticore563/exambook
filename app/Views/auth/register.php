<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Register</h2>
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success"><?php echo session('message'); ?></div>
    <?php endif; ?>
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger"><?php echo $validation->listErrors(); ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo old('username'); ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo old('email'); ?>" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="/login" class="btn btn-link">Login</a>
    </form>
</div>
<?php $this->endSection(); ?>