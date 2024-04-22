
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

  setTimeout(function() {
    buttonElement.src = originalSrc; 
  }, 100);
  setTimeout(function() {
    window.location.href = targetHTML; 
  }, 100);

}

setInterval(updateCurrentTimeDate, 1000);

updateCurrentTimeDate();
