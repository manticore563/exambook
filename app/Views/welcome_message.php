<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5 text-center">
    <h1>Welcome to ExamBook</h1>
    <p>Your online mock test platform.</p>
    <?php if (!session()->get('user_id')): ?>
        <a href="/login" class="btn btn-primary">Get Started</a>
    <?php else: ?>
        <a href="/tests" class="btn btn-primary">Take a Test</a>
    <?php endif; ?>
</div>
<?php $this->endSection(); ?>