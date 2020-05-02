$(document).ready(function(){
    var _token          =   $("input[name=_token]").val();
    var dataString      =   "_token="+_token;
    var currentDayType  =   $('.current-day-type').val();


    var alertManage =   function () {
        $('.alert').delay(3000).fadeOut(400)
    }

    var showCurrentTimer    =   function(){
        //var currentTimer  =   $('.current-time').val();
        var offset  =    -4;
        var d       =    new Date();
        var utc     =    d.getTime() + (d.getTimezoneOffset() * 60000);
        var nd      =   new Date(utc + (3600000*offset));
        var ctime   =   nd.toLocaleString().split(',')[1];
        var dayStatus   =   ctime.split(' ')[2];


        //var ctime    =   $('.current-time').val();
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
                console.log(this.counter)
                /*console.log(
                    "Counter value: " +   this.counter + "\n" +
                    "Target: " +          this.target + "\n" +
                    "Is Running: " +      this.enabled + "\n" +
                    "Current history: " + JSON.stringify(this.history)
                );*/

                if(this.counter >= 43200000 && this.counter<=43201030){
                   if(dayStatus == "PM" || dayStatus == "pm"){
                       addClockOut();
                       $(".current-timer").timer().zero();
                       $(".current-timer").timer().stop();
                   }

                }
            },
        };
        $(".current-timer").timer( options ).start();
    }

    var showTimer   =   function(){
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
                        onTick: function() {
                            console.log(this.counter);


                        },
                    };

                    if(clockedOutStatus == 'No'){
                        $(".clocker-div").timer( options ).start();
                        $('.clocked-status').text("CLOCKED-IN").removeClass('badge-warning').addClass('badge-success');
                        $('.punch-out').show();
                        $('.punch-in').hide();

                        $('.break-stop').remove();
                        $('.break-start').remove();
                        $('.break-status').append('<a href="" class="btn btn-outline-success waves-effect waves-light mt-2 btn-lg break-start">Start Break</a>')

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

    }

    var addClockOut  =   function(){
        $.ajax({
            type: "POST",
            url: '../handleClockOut',
            dataType:"JSON",
            data: dataString,
            success: function(data)
            {
                addClockIn();
            }
        });
    }

    var addClockIn  =   function(){
        $.ajax({
            type: "POST",
            url: '../handleClockIn',
            dataType:"JSON",
            data: dataString,
            success: function(data)
            {
                $(".current-timer").timer().start();
                showTimer();
            }
        });
    }


    alertManage();
    showCurrentTimer();
    showTimer();

});
