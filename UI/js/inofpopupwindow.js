
  function updateCurrentTimeDate() {
    var currentTimeDateElement = document.getElementById('current-time/date');

    if (currentTimeDateElement) {
      var now = new Date();
      var timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      var dateString = now.toLocaleDateString([], { day: "2-digit", month: "2-digit", year: "numeric" });

      currentTimeDateElement.innerHTML = timeString + '&nbsp;&nbsp;&nbsp;' + dateString;
    }
  }

  function handleButtonClick(buttonElement, newImagePath, targetHTML) {

    var originalSrc = buttonElement.src;

    buttonElement.src = newImagePath;

    setTimeout(function () {
      buttonElement.src = originalSrc;
    }, 100);

    setTimeout(function () {
      window.location.href = targetHTML;
    }, 200);

    var timer = setInterval(function () {
      // Check conditions and redirect back to 'frame-04.html'
      if (window.location.href !== targetHTML) {
        clearInterval(timer); // Stop the interval
        window.location.href = 'frame-09.html';
      }
    }, 1000); // Check every 1 second);

  }

  setInterval(updateCurrentTimeDate, 1000);

  updateCurrentTimeDate();