<!-- Vendor js -->
<script src="../public/assets/js/vendor.min.js"></script>

<script src="../public/assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="../public/assets/libs/peity/jquery.peity.min.js"></script>

<!-- Sparkline charts -->
<script src="../public/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- init js -->
<script src="../public/assets/js/pages/dashboard-1.init.js"></script>

<!-- App js -->
<script src="../public/assets/js/app.min.js"></script>

<!-- Validation js (Parsleyjs) -->
<script src="../public/assets/libs/parsleyjs/parsley.min.js"></script>

<!-- validation init -->
<script src="../public/assets/js/pages/form-validation.init.js"></script>

{{--Clocker Script--}}
<script type="text/javascript" src="../public/assets/libs/tiny-timer/dist/jquery.tinytimer.js"></script>


<script>
    $('.alert').delay(3000).fadeOut(400)
</script>

<script>
    var _token  =   $("input[name=_token]").val();
    var dataString    =   "_token="+_token;
    $.ajax({
        type: "POST",
            url: '../setAttendanceTimer',
        dataType: "JSON",
        data: dataString,
        success: function (data) {
            console.log(data);
            var totalSec            =   data.timerInSeconds;
            var clockedOutStatus    =   data.data.is_clocked_out;

            if(totalSec!=''){
                var options = {
                    timerCounter: totalSec*1000,
                };





                if(clockedOutStatus == 'No'){
                    $(".clocker-div").timer( options ).start();
                    $('.clocked-status').text("CLOCKED-IN").removeClass('badge-warning').addClass('badge-success');
                    $('.punch-out').show();
                    $('.punch-in').hide();
                }
                else{
                    $(".clocker-div").timer( options ).stop();
                    $('.clocked-status').text("CLOCKED-OUT").removeClass('badge-success').addClass('badge-warning');
                    $('.punch-out').hide();
                    $('.punch-in').show();
                }
            }

        }
    });
</script>


<script>
  //var currentTimer  =   $('.current-time').val();
  var offset  =    -4;
  var d       =    new Date();
  var utc     =    d.getTime() + (d.getTimezoneOffset() * 60000);
  var nd      =   new Date(utc + (3600000*offset));
  var ctime   =   nd.toLocaleString().split(',')[1];

  //var ctime =   "00:00:00 a";


  var csplit   =   ctime.split(":");
  var chours   =   csplit[0];
  var cminutes =   csplit[1];
  var cseconds =   csplit[2];
  var choursToSec      =   chours*3600;
  var cminToSec        =   cminutes*60;
  var ctotalSec        =   parseInt(choursToSec)+parseInt(cminToSec)+parseInt(cseconds);

  var options = {
      timerCounter: ctotalSec*1000,
      onTick: function() {
          console.log(
              "Counter value: " +   this.counter + "\n" +
              "Target: " +          this.target + "\n" +
              "Is Running: " +      this.enabled + "\n" +
              "Current history: " + JSON.stringify(this.history)
          );

          if(this.counter >= 1001 && this.counter<=1010){
              //alert("Ds");

          }

      },
  };
  $(".current-timer").timer( options ).start();


</script>


@yield('scripts')
