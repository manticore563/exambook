<?php $this->extend('templates/header'); ?>
<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2><?php echo $test['title']; ?></h2>
    <div id="timer" class="mb-3">Time Left: <span id="time"><?php echo $test['duration']; ?>:00</span></div>
    <div id="question-container">
        <?php if (!empty($questions)): ?>
            <div id="question-<?php echo $current_question; ?>" class="question">
                <p><strong><?php echo ($current_question + 1); ?>. <?php echo $questions[$current_question]['question_text']; ?></strong></p>
                <form id="answerForm">
                    <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                    <input type="hidden" name="question_id" value="<?php echo $questions[$current_question]['id']; ?>">
                    <input type="hidden" name="next_question" value="<?php echo $current_question + 1; ?>">
                    <div class="form-check">
                        <input type="radio" name="selected_answer" value="A" class="form-check-input" id="option_a">
                        <label class="form-check-label" for="option_a"><?php echo $questions[$current_question]['option_a']; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="selected_answer" value="B" class="form-check-input" id="option_b">
                        <label class="form-check-label" for="option_b"><?php echo $questions[$current_question]['option_b']; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="selected_answer" value="C" class="form-check-input" id="option_c">
                        <label class="form-check-label" for="option_c"><?php echo $questions[$current_question]['option_c']; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="selected_answer" value="D" class="form-check-input" id="option_d">
                        <label class="form-check-label" for="option_d"><?php echo $questions[$current_question]['option_d']; ?></label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Next</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/test_timer.js"></script>
<script>
    $(document).ready(function() {
        let duration = <?php echo $test['duration'] * 60; ?>;
        startTimer(duration);

        $('#answerForm').submit(function(e) {
            e.preventDefault();
            $.post('/tests/submit-answer', $(this).serialize(), function(response) {
                if (response.success) {
                    if (response.finished) {
                        window.location = '/tests/results/<?php echo $test['id']; ?>';
                    } else {
                        let q = response.question;
                        $('#question-container').html(`
                            <div id="question-${response.question_number}" class="question">
                                <p><strong>${response.question_number + 1}. ${q.question_text}</strong></p>
                                <form id="answerForm">
                                    <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                                    <input type="hidden" name="question_id" value="${q.id}">
                                    <input type="hidden" name="next_question" value="${response.question_number + 1}">
                                    <div class="form-check">
                                        <input type="radio" name="selected_answer" value="A" class="form-check-input" id="option_a">
                                        <label class="form-check-label" for="option_a">${q.option_a}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="selected_answer" value="B" class="form-check-input" id="option_b">
                                        <label class="form-check-label" for="option_b">${q.option_b}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="selected_answer" value="C" class="form-check-input" id="option_c">
                                        <label class="form-check-label" for="option_c">${q.option_c}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="selected_answer" value="D" class="form-check-input" id="option_d">
                                        <label class="form-check-label" for="option_d">${q.option_d}</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Next</button>
                                </form>
                            </div>
                        `);
                    }
                }
            });
        });
    });
</script>
<?php $this->endSection(); ?>