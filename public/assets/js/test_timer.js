function startTimer(duration) {
    let timer = duration, minutes, seconds;
    let interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        document.getElementById('time').textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            clearInterval(interval);
            alert('Time’s up!');
            window.location = '/tests/results/' + document.querySelector('input[name="test_id"]').value;
        }
    }, 1000);
}