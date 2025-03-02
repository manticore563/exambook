<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Add Questions to <?php echo $test['title']; ?></h2>
    <form method="post">
        <div class="mb-3">
            <label>Question Text</label>
            <textarea name="question_text" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Option A</label>
            <input type="text" name="option_a" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Option B</label>
            <input type="text" name="option_b" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Option C</label>
            <input type="text" name="option_c" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Option D</label>
            <input type="text" name="option_d" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Correct Answer</label>
            <select name="correct_answer" class="form-control" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Question</button>
        <a href="/admin/bulk-upload/<?php echo $test['id']; ?>" class="btn btn-secondary">Bulk Upload</a>
    </form>
</div>
<?php $this->endSection(); ?>