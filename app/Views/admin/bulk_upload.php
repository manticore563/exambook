<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Bulk Upload Questions for <?php echo $test['title']; ?></h2>
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success"><?php echo session('message'); ?></div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?php echo session('error'); ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Upload Word File (.docx)</label>
            <input type="file" name="word_file" class="form-control" accept=".docx" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="/admin/add-questions/<?php echo $test['id']; ?>" class="btn btn-secondary">Back</a>
    </form>
    <p class="mt-3"><strong>Format Example:</strong></p>
    <pre>
Q1. What is 2 + 2?
A) 3  B) 4  C) 5  D) 6
Answer: B
    </pre>
</div>
<?php $this->endSection(); ?>