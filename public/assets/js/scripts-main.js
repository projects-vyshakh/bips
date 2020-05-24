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
                /*console.log(
                    "Counter value: " +   this.counter + "\n" +
                    "Target: " +          this.target + "\n" +
                    "Is Running: " +      this.enabled + "\n" +
                    "Current history: " + JSON.stringify(this.history)
                );*/


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
                if(data.data != null){
                    var totalSec            =   data.timerInSeconds;
                    var clockedOutStatus    =   data.data.is_clocked_out;
                    var breakStart          =   data.data.is_break_start;

                    var clockedStatusArray  =   [];
                    var actionPageArray     =   [];
                    var actionButtonArray   =   [];
                    var appendArray         =   [];

                    if(totalSec > 0){
                        var options = {
                            timerCounter: totalSec*1000,
                            onTick: function() {
                                //console.log(this.counter);
                            },
                        };
                    }


                    if(clockedOutStatus == "No"){
                        clockedStatusArray['selector']          =   $('.clocked-status');
                        clockedStatusArray['text']              =   "CLOCKED-IN";
                        clockedStatusArray['removeClass']       =   "badge-warning";
                        clockedStatusArray['addClass']          =   "badge-success";
                        runTimerTopBarStatus(clockedStatusArray);

                        actionPageArray['showDivSelector']   =   $('.punch-out');
                        actionPageArray['hideDivSelector']   =   $('.punch-in');
                        runActionPage(actionPageArray);

                        actionButtonArray['selector']               =   $('.clock-out');
                        actionButtonArray['selectorAction']         =   "removeAttr";
                        actionButtonArray['selectorAttr']           =   "Disable";
                        actionButtonArray['spinnerButton']          =   $('.button-spinner');
                        actionButtonArray['spinnerButtonAction']    =   "hide";
                        actionButtonArray['spinnerText']            =   $('.spinner-text');
                        actionButtonArray['spinnerTextAction']      =   "hide";
                        actionButtonArray['clockIcon']              =   $('.icon-clock');
                        actionButtonArray['clockIconAction']        =   "show";
                        runActionButtons(actionButtonArray);



                        if(breakStart == "No"){
                            //Timer starting
                            $(".clocker-div").timer(options).start();

                            //Removing if buttons already exists
                            runRemoveElements($('.break-start, .break-stop'));

                            //Appending Start Break
                            appendArray['appendTo']        =   $('.break-status');
                            appendArray['appendString']    =   "<a href='' class='btn btn-outline-success waves-effect waves-light mt-2 btn-lg break-start'>Start Break</a>";
                            appendArray['breakStatus']     =    breakStart;
                            runAppendToDom(appendArray);
                        }
                        else{
                            $(".clocker-div").timer(options).stop();
                            //Removing if buttons already exists
                            runRemoveElements($('.break-start, .break-stop'));

                            clockedStatusArray['selector']          =   $('.clocked-status');
                            clockedStatusArray['text']              =   "BREAK - TIME";
                            clockedStatusArray['removeClass']       =   "badge-success";
                            clockedStatusArray['addClass']          =   "badge-success";
                            runTimerTopBarStatus(clockedStatusArray);

                            //Appending Start Break
                            appendArray['appendTo']        =   $('.break-status');
                            appendArray['appendString']    =   "<a href='' class='btn btn-outline-danger waves-effect waves-light mt-2 btn-lg break-stop'>Stop Break</a>";
                            appendArray['breakStatus']     =    breakStart;
                            runAppendToDom(appendArray);
                        }

                    }
                    else{
                        $(".clocker-div").timer( options ).stop();
                        clockedStatusArray['selector']          =   $('.clocked-status');
                        clockedStatusArray['text']              =   "CLOCKED-OUT";
                        clockedStatusArray['removeClass']       =   "badge-success";
                        clockedStatusArray['addClass']          =   "badge-warning";
                        runTimerTopBarStatus(clockedStatusArray);

                        actionPageArray['showDivSelector']   =   $('.punch-in');
                        actionPageArray['hideDivSelector']   =   $('.punch-out');
                        runActionPage(actionPageArray);

                        actionButtonArray['selector']               =   $('.clock-in');
                        actionButtonArray['selectorAction']         =   "removeAttr";
                        actionButtonArray['selectorAttr']           =   "Disable";
                        actionButtonArray['spinnerButton']          =   $('.button-spinner');
                        actionButtonArray['spinnerButtonAction']    =   "hide";
                        actionButtonArray['spinnerText']            =   $('.spinner-text');
                        actionButtonArray['spinnerTextAction']      =   "hide";
                        actionButtonArray['clockIcon']              =   $('.icon-clock');
                        actionButtonArray['clockIconAction']        =   "show";
                        runActionButtons(actionButtonArray);
                    }
                }
                else{
                    $(".clocker-div").timer( options ).stop();
                    $('.clocked-status').text("CLOCKED-OUT").removeClass('badge-success').addClass('badge-warning');
                    $('.punch-out').hide();
                    $('.punch-in').show();
                }

            }
        });

    }
    var addClockIn  =   function(){
        $('.clock-in').click(function(e){
            e.preventDefault();

            if(runCheckNotesValidation($('.notes'))){
                runButtonDisable($('.clock-in'));
                addClockInOutExtended('handleClockIn', $('.notes').val());
            }else{
                runNotesKeyChange($('.notes'));
                runButtonEnable($('.clock-in'));
            }



        });
    }
    var addClockOut  =   function(){
        $('.clock-out').click(function(e){
            e.preventDefault();

            if(runCheckNotesValidation($('.out_notes'))){
                runButtonDisable($('.clock-out'));
                addClockInOutExtended('handleClockOut', $('.out_notes').val());
            }else{
                runNotesKeyChange($('.out_notes'));
                runButtonEnable($('.clock-out'));
            }



        });
    }
    var addClockInOutExtended   =   function(url, data){
        dataString  +=  '&notes='+data;
        $.ajax({
            type: "POST",
            url: '../'+url,
            dataType:"JSON",
            data: dataString,
            success: function(data)
            {

                swal({
                    title:data['title'],
                    text: data['message'],
                    type: data['status']
                });

                showTimer();
            }
        });

    }

    var startBreak  =   function(){
        $('.break-start').click(function(e){
            dataString  +=   '&action='+'start';
            e.preventDefault();
            var url =   "handleBreak";
            breakExtend(url, dataString);

        })
    }
    var stopBreak   =   function(){
        $('.break-stop').click(function(e){
            dataString  +=   '&action='+'stop';
            e.preventDefault();
            var url =   "handleBreak";
            breakExtend(url, dataString);
        })
    }
    var breakExtend =   function(url, dataString){
        $.ajax({
            type: "POST",
            url: '../'+url,
            dataType: "JSON",
            data: dataString,
            success: function (data) {
                swal({
                    title:data['title'],
                    text: data['message'],
                    type: data['status']
                });

                showTimer();



            }
        });
    }

    var runTimerTopBarStatus    =   function(param){
       var selector     =   param['selector'];
       var text         =   param['text'];
       var removeClass  =   param['removeClass'];
       var addClass     =   param['addClass'];
       selector.text(text).removeClass(removeClass).addClass(addClass);
    }
    var runActionPage =   function(param){
        var showDiv =   param['showDivSelector'];
        var hideDiv =   param['hideDivSelector'];
        showDiv.show();
        hideDiv.hide();
    }
    var runActionButtons    =   function(param){
        var selector            =   param['selector'];
        var selectorAction      =   param['selectorAction'];
        var selectorAttr        =   param['selectorAttr'];
        (selectorAction=="removeAttr")?selector.removeAttr(selectorAttr):"";

        var spinnerButton       =   param['spinnerButton'];
        var spinnerButtonAction =   param['spinnerButtonAction'];
        (spinnerButtonAction=="hide")?spinnerButton.hide(): spinnerButton.show();

        var spinnerText         =   param['spinnerText'];
        var spinnerTextAction   =   param['spinnerTextAction'];
        (spinnerTextAction=="hide")?spinnerText.hide(): spinnerText.show();

        var clockIcon           =   param['clockIcon'];
        var clockIconAction     =   param['clockIconAction'];
        (clockIconAction=="hide")?clockIcon.hide(): clockIcon.show();
    }
    var runRemoveElements   =   function(selector){
        selector.remove();
    }
    var runAppendToDom      =   function(param){
        var appendTo    =   param['appendTo'];
        var string      =   param['appendString'];
        var breakStatus =   param['breakStatus'];

        appendTo.append(string);

        (breakStatus == "No")?startBreak(): stopBreak();
    }
    var runCheckNotesValidation =   function(selector){
        $('.error-message').remove();
        if(selector.val()==""){
            $('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
            return false;
        }

        return true;
    }
    var runNotesKeyChange  =   function(selector){
        //$('.error-message').remove();
        selector.keyup(function(){

            if(selector.val().length >0){
                $('.error-message').remove();
            }
            else{
                $('.error-message').remove();
                $('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
                runButtonEnable($('.clock-in'));
            }

        });
    }
    var runButtonDisable   =   function(selector){
        selector.attr('disabled','disabled');
        $('.icon-clock').hide();
        $('.button-spinner').show();
        $('.spinner-text').show();

    }
    var runButtonEnable    =   function(selector){
        selector.removeAttr('disabled');
        $('.icon-clock').show();
        $('.button-spinner').hide();
        $('.spinner-text').hide();

    }








    alertManage();
    showCurrentTimer();
    showTimer();


    addClockIn();
    runNotesKeyChange($('.notes, .out_notes'));




});

