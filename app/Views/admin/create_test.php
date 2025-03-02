<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Create New Test</h2>
    <form method="post">
        <div class="mb-3">
            <label>Test Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Duration (minutes)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Test</button>
    </form>
</div>
<?php $this->endSection(); ?>