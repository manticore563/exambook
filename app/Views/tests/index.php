<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Available Tests</h2>
    <div class="row">
        <?php foreach ($tests as $test): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $test['title']; ?></h5>
                        <p class="card-text">Duration: <?php echo $test['duration']; ?> minutes</p>
                        <a href="/tests/take/<?php echo $test['id']; ?>" class="btn btn-primary">Take Test</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $this->endSection(); ?>