<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Test Results</h2>
    <div class="card">
        <div class="card-body">
            <p>Total Questions: <?php echo $total_questions; ?></p>
            <p>Correct Answers: <?php echo $correct_answers; ?></p>
            <p>Score: <?php echo number_format($score, 2); ?>%</p>
            <a href="/tests" class="btn btn-primary">Back to Tests</a>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>