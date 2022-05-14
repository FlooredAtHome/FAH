var idleMax = 25; // Logout after 5 minutes of inactivity
var idleTime = 0;

var idleInterval = setInterval("timerIncrement()",60000);  // 1 minute interval i.e 60 sec * 1000    
$( "*" ).mousemove(function( event ) {
    idleTime = 0; // reset to zero
});

// count minutes
function timerIncrement() {
  idleTime = idleTime + 1;
  console.log(idleTime);
  if (idleTime > idleMax) { 
      window.location="../UserHome/logout";
  }
} 