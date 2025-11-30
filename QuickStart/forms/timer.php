<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro</title>
    <link href="../assets/img/cluezy-about.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/timer.css">
    <?php include "navigasi.php"; ?>
</head>

<body>

</body>

</html>
<div class="timer">
    <div class="container">
        <div class="card">
            <div class="timer-container">
                <div id="modeLabel">Session</div>
                <div id="timeDisplayLarge">25:00</div>
                <div class="controls-row">
                    <button id="startPauseBtn" class="control-button" title="Play/Pause">
                        <i class="fas fa-play"></i>
                    </button>
                    <button id="resetBtn" class="control-button" title="Reset">
                        <i class="fas fa-redo"></i>
                    </button>
                </div>

                <div class="length-controls">
                    <div class="length-control">
                        <div class="length-title">Break Length</div>
                        <div id="breakLength" class="length-value">5</div>
                        <div class="length-buttons">
                            <button id="breakIncrement" class="length-button">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button id="breakDecrement" class="length-button">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="length-control">
                        <div class="length-title">Session Length</div>
                        <div id="sessionLength" class="length-value">25</div>
                        <div class="length-buttons">
                            <button id="sessionIncrement" class="length-button">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button id="sessionDecrement" class="length-button">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="length-control">
                        <div class="length-title">Repeat Length</div>
                        <div id="repeatlength" class="length-value">25</div>
                        <div class="length-buttons">
                            <button id="repeatIncrement" class="length-button">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button id="repeatDecrement" class="length-button">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="notification" id="notification">
        Timer completed! Starting next session.
    </div>
</div>

<script>
    const startPauseBtn = document.getElementById('startPauseBtn');
    const resetBtn = document.getElementById('resetBtn');
    const modeLabel = document.getElementById('modeLabel');
    const timeDisplayLarge = document.getElementById('timeDisplayLarge');
    const breakLengthDisplay = document.getElementById('breakLength');
    const sessionLengthDisplay = document.getElementById('sessionLength');
    const repeatLengthDisplay = document.getElementById('repeatlength');
    const progressBar = document.querySelector('.progress-bar');
    const notification = document.getElementById('notification');

    const breakIncrement = document.getElementById('breakIncrement');
    const breakDecrement = document.getElementById('breakDecrement');
    const sessionIncrement = document.getElementById('sessionIncrement');
    const sessionDecrement = document.getElementById('sessionDecrement');
    const repeatIncrement = document.getElementById('repeatIncrement');
    const repeatDecrement = document.getElementById('repeatDecrement');

    let breakLength = 5;
    let sessionLength = 25;
    let repeatLength = 4;
    let finishedRepeat = 0;
    let timerMode = 'session';
    let timerSeconds = sessionLength * 60;
    let timerRunning = false;
    let timerInterval = null;
    let totalSeconds = sessionLength * 60;

    function updateTimeDisplay(sec) {
        let m = Math.floor(sec / 60);
        let s = sec % 60;
        timeDisplayLarge.textContent = `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;

        // Update progress bar
        if (timerRunning) {
            const progressPercentage = (1 - (sec / totalSeconds)) * 100;
            progressBar.style.width = `${progressPercentage}%`;
        }
    }

    function updateLengthsDisplay() {
        breakLengthDisplay.textContent = breakLength;
        sessionLengthDisplay.textContent = sessionLength;
        repeatLengthDisplay.textContent = repeatLength;

    }

    function switchMode() {
        if (timerMode === 'session') {
            timerMode = 'break';
            timerSeconds = breakLength * 60;
            totalSeconds = breakLength * 60;
            modeLabel.textContent = 'Break';

            document.body.classList.add('timer-active');
        } else {
            finishedRepeat++;
            if (finishedRepeat >= repeatLength) {
                notification.textContent = `All sessions completed! Take a longer break.`;
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000);
                return;
            }

            timerMode = 'session';
            timerSeconds = sessionLength * 60;
            totalSeconds = sessionLength * 60;
            modeLabel.textContent = 'Session';
            document.body.classList.remove('timer-active');
        }
        updateTimeDisplay(timerSeconds);
        progressBar.style.width = '0%';

        // Show notification
        notification.textContent = `${modeLabel.textContent} started!`;
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    function timerTick() {
        if (timerSeconds > 0) {
            timerSeconds--;
            updateTimeDisplay(timerSeconds);
        } else {
            clearInterval(timerInterval);
            timerRunning = false;
            startPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            switchMode();
            startPauseBtn.click();
        }
    }

    function setLengthButtonsDisabled(state) {
        breakIncrement.disabled = state;
        breakDecrement.disabled = state;
        sessionIncrement.disabled = state;
        sessionDecrement.disabled = state;
        repeatIncrement.disabled = state;
        repeatDecrement.disabled = state;

        const buttons = document.querySelectorAll('.length-button');
        buttons.forEach(btn => {
            btn.style.opacity = state ? '0.5' : '1';
            btn.style.pointerEvents = state ? 'none' : 'auto';
        });
    }


    startPauseBtn.addEventListener('click', () => {
        if (timerRunning) {
            // Pause
            clearInterval(timerInterval);
            timerRunning = false;
            startPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            document.body.classList.remove('timer-active');
            setLengthButtonsDisabled(false);
        } else {
            // Start
            timerInterval = setInterval(timerTick, 1000);
            timerRunning = true;
            startPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            document.body.classList.add('timer-active');
            totalSeconds = timerMode === 'session' ? sessionLength * 60 : breakLength * 60;
            setLengthButtonsDisabled(true);
        }
    });

    resetBtn.addEventListener('click', () => {
        clearInterval(timerInterval);
        timerRunning = false;
        timerMode = 'session';
        timerSeconds = sessionLength * 60;
        modeLabel.textContent = 'Session';
        updateTimeDisplay(timerSeconds);
        startPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
        progressBar.style.width = '0%';
        document.body.classList.remove('timer-active');
        setLengthButtonsDisabled(false);
    });

    breakIncrement.addEventListener('click', () => {
        if (breakLength < 60) {
            breakLength++;
            updateLengthsDisplay();
            if (timerMode === 'break' && !timerRunning) {
                timerSeconds = breakLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    breakDecrement.addEventListener('click', () => {
        if (breakLength > 1) {
            breakLength--;
            updateLengthsDisplay();
            if (timerMode === 'break' && !timerRunning) {
                timerSeconds = breakLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    sessionIncrement.addEventListener('click', () => {
        if (sessionLength < 60) {
            sessionLength++;
            updateLengthsDisplay();
            if (timerMode === 'session' && !timerRunning) {
                timerSeconds = sessionLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    sessionDecrement.addEventListener('click', () => {
        if (sessionLength > 1) {
            sessionLength--;
            updateLengthsDisplay();
            if (timerMode === 'session' && !timerRunning) {
                timerSeconds = sessionLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    repeatIncrement.addEventListener('click', () => {
        if (repeatLength < 60) {
            repeatLength++;
            updateLengthsDisplay();
            if (timerMode === 'repeat' && !timerRunning) {
                timerSeconds = repeatLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    repeatDecrement.addEventListener('click', () => {
        if (repeatLength > 1) {
            repeatLength--;
            updateLengthsDisplay();
            if (timerMode === 'repeat' && !timerRunning) {
                timerSeconds = repeatLength * 60;
                updateTimeDisplay(timerSeconds);
            }
        }
    });

    // Initialize display
    updateTimeDisplay(timerSeconds);
    updateLengthsDisplay();
</script>
</body>
<!-- <?php include "footer.php"; ?> -->

</html>