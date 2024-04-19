  var pathName = window.location.pathname;

  var startIndex = pathName.lastIndexOf("frame-") + "frame-".length;
  var endIndex = pathName.lastIndexOf(".html");
  var previousFrameURL;

  frameNumber = pathName.substring(startIndex, endIndex);
  if (frameNumber <= 10){
    previousFrameURL = 'frame-0' + (frameNumber-1) + '.html';
  } else{
    // Construct the URL for the previous frame based on the frame number
    previousFrameURL = 'frame-' + (frameNumber - 1) + '.html';
  }
  

  // Redirect to the previous frame after a delay of 2000 milliseconds
  setTimeout(function() {
    window.location.href = previousFrameURL; 
  }, 2000);
