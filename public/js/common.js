var x;
var startstop = 0;

var milisec = 0;
var sec = 0; /* holds incrementing value */
var min = 0;
var hour = 0;
/* Contains and outputs returned value of  function checkTime */

var miliSecOut = 0;
var secOut = 0;
var minOut = 0;
var hourOut = 0;

/* Output variable End */
$(document).ready(function() {

  url = 'check/tracker/session';

  $.ajax({
    type: "get",
    url: url,
    success: function (data) {
      if(data.success) {
        milisec = 0;
        sec = data.success.seconds;
        min = data.success.minuts;
        hour = data.success.hours;
        x = setInterval(timer, 10);
        document.getElementById("start").innerHTML = "Stop";
        startstop = 1;
      }
    },
    error: function(data) {
      document.getElementById("start").innerHTML = "Start";
      startstop = 0;
    }
});
});

function startStop() { /* Toggle StartStop */

  startstop = startstop + 1;

  if (startstop === 1) {
    start();
    document.getElementById("start").innerHTML = "Stop";
  } else if (startstop === 2) {
    document.getElementById("start").innerHTML = "Start";
    startstop = 0;
    stop();
  }

}


function start() {
  event.preventDefault();
  var project_id = $('#projectId').val();
  var task = $('#task').val();
  var url = '/start/project';

  $.ajax({
    type: "post",
    url: url,
    data: {
      task: task,
      project_id: project_id,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      if(success = data.success) {
        if(success) {
          milisec = 0;
          sec = data.success.seconds;
          min = data.success.minuts;
          hour = data.success.hours;
          x = setInterval(timer, 10);
          document.getElementById("start").innerHTML = "Stop";
          startstop = 1;
          $('#task_error').addClass('d-none');
            $('#project_error').addClass('d-none');
        }
      }

      if(errors = data.errors) {
        if(errors.task) {
          $('#task_error').removeClass('d-none');
        }
        if(errors.project_id) {
          $('#project_error').removeClass('d-none');
        }
      }
    },
    error: function(data) {
      console.log(['errr', data]);
    }
  });
} /* Start */

function stop() {
  var url = '/stop/project/1';

  $.ajax({
    type: "get",
    url: url,
    success: function (data) {
      if(data.success) {
        clearInterval(x);
        resetTime();
        window.location.reload();
      }
    },
    error: function(data) {
    }
  });
}

function timer() {

  miliSecOut = checkTime(milisec);
  secOut = checkTime(sec);
  minOut = checkTime(min);
  hourOut = checkTime(hour, false);

  milisec = ++milisec;

  if (milisec === 100) {
    milisec = 0;
    sec = ++sec;
  }

  if (sec == 60) {
    min = ++min;
    sec = 0;
  }

  if (min == 60) {
    min = 0;
    hour = ++hour;

  }
  showTime();
}

function checkTime(i, format=true) {
  if (i < 10 && format == true) {
    if(i.length < 2) {
      i = "0" + i;
    }
  }
  return i;
}

function showTime(i) {
  document.getElementById("milisec").innerHTML = miliSecOut;
  document.getElementById("sec").innerHTML = secOut;
  document.getElementById("min").innerHTML = minOut;
  document.getElementById("hour").innerHTML = hourOut;
}

function resetTime() {
  document.getElementById("milisec").innerHTML = 00;
  document.getElementById("sec").innerHTML = 00;
  document.getElementById("min").innerHTML = 00;
  document.getElementById("hour").innerHTML = 00;
}
