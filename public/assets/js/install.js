$(document).ready(function() {
    // Check requirements on page load
    $.get('/install/check-requirements', function(data) {
        let html = '<h5>Server Requirements:</h5><ul>';
        html += '<li>PHP 7.4+: ' + (data.php_version ? '✓' : '✗') + '</li>';
        html += '<li>MySQL: ' + (data.mysql ? '✓' : '✗') + '</li>';
        html += '<li>Writable .env: ' + (data.writable_env ? '✓' : '✗') + '</li>';
        html += '<li>Writable public: ' + (data.writable_public ? '✓' : '✗') + '</li>';
        html += '<li>Writable writable: ' + (data.writable_writable ? '✓' : '✗') + '</li>';
        html += '</ul>';
        $('#requirements').html(html);
    });

    // Handle form submission
    $('#installForm').submit(function(e) {
        e.preventDefault();
        $.post('/install/install', $(this).serialize(), function(response) {
            if (response.success) {
                $('#installMessage').html('<div class="alert alert-success">Installation complete! <a href="/">Go to site</a></div>');
            } else {
                $('#installMessage').html('<div class="alert alert-danger">' + response.error + '</div>');
            }
        });
    });
});