$(document).ready(function(){
    var _token      =   $("input[name=_token]").val();
    var dataString  =   '_token='+_token;




    var runValidation   =   function(){

        $("#form").validate({
            // Specify validation rules
            rules: {
                notes           :   "required",
            },
            // Specify validation error messageseturn ['code'=>400, 'status'=>'error','title'=>'Error','message'=>$this->saveFailMessage("Clock In")];
            messages: {
                notes           :   "Please enter your notes.",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                //form.submit();

            }
        });
    }

    var addClockIn  =   function(){

        $('.clock-in').click(function(e){
            e.preventDefault();
            var notes   =   $('.notes').val();

            $('#clock-in').attr('disabled','disabled');
            $('.icon-clock').hide();
            $('.button-spinner').show();
            $('.spinner-text').show();

            if(notes==""){
                $('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
                return false;
            }

           // removeErrorOnNotes();

            var dataString    =   "_token="+_token+'&notes='+notes;
            $.ajax({
                type: "POST",
                url: '../handleClockIn',
                dataType:"JSON",
                data: dataString,
                success: function(data)
                {
                    swal({
                        title:data['title'],
                        text: data['message'],
                        type: data['status']
                    })

                    $(".clocker-div").timer().start();

                    $('.clocked-status').text('CLOCKED-IN').removeClass('badge-warning').addClass('badge-success');
                    $('.punch-out').show();
                    $('.punch-in').hide();

                    //Append  start break button
                    $('.break-stop').remove();
                    $('.break-start').remove();
                    $('.break-status').append('<a href="" class="btn btn-outline-success waves-effect waves-light mt-2 btn-lg break-start">Start Break</a>')



                    if(data['code'] == 200){
                        $('#clock-in').removeAttr('disabled');
                        $('.button-spinner').hide();
                        $('.spinner-text').hide();
                        $('.icon-clock').show();

                        $('.confirm').click(function(e){
                            e.preventDefault();

                           // window.location = "punch";
                        })
                    }

                    //Triggering start break;
                    startBreak();
                    stopBreak();


                }
            });

        })
    }
    var addClockOut  =   function(){
        $('.clock-out').click(function(e){
            e.preventDefault();

            $('.error-message').remove();

            var notes   =   $('.out_notes').val();

            if(notes==""){
                $('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
                return false;
            }


            $('#clock-out').attr('disabled','disabled');
            $('.icon-clock').hide();
            $('.button-spinner').show();
            $('.spinner-text').show();



            removeErrorOnNotes();

            var dataString    =   "_token="+_token+'&notes='+notes;
            $.ajax({
                type: "POST",
                url: '../handleClockOut',
                dataType:"JSON",
                data: dataString,
                success: function(data)
                {
                    swal({
                        title:data['title'],
                        text: data['message'],
                        type: data['status']
                    })

                    $(".clocker-div").timer().stop();

                    $('.clocked-status').text('CLOCKED-OUT').removeClass('badge-success').addClass('badge-warning');
                    $('.punch-out').hide();
                    $('.punch-in').show();


                    $('.break-stop').remove();
                    $('.break-start').remove();
                   // $('.break-status').append('<a href="" class="btn btn-outline-danger break-stop">Stop Break</a>')

                    if(data['code'] == 200){
                        $('#clock-out').removeAttr('disabled');
                        $('.button-spinner').hide();
                        $('.spinner-text').hide();
                        $('.icon-clock').show();

                        $('.confirm').click(function(e){
                            e.preventDefault();

                            // window.location = "punch";
                        })
                    }
                }
            });

        })
    }

    var removeErrorOnNotes  =   function(){
        $('.notes,.out_notes').keyup(function(){
            //$('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
            //alert($(this).length)
            if($(this).length >= 1){
                $('.error-message').remove();
            }

        })
    }

    var startBreak  =   function(){

        $('.break-start').click(function(e){
            dataString  +=   '&action='+'start';
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../handleBreak',
                dataType: "JSON",
                data: dataString,
                success: function (data) {
                    swal({
                        title:data['title'],
                        text: data['message'],
                        type: data['status']
                    });

                    $('.confirm').click(function(){
                        $('.break-stop').remove();
                        $('.break-start').remove();
                        $('.break-status').append('<a href="" class="btn btn-outline-danger waves-effect waves-light mt-2 btn-lg break-stop">Stop Break</a>')
                        stopBreak();
                    })

                }
            });
        })
    }

    var stopBreak   =   function(){
        $('.break-stop').click(function(e){
            dataString  +=   '&action='+'stop';
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../handleBreak',
                dataType: "JSON",
                data: dataString,
                success: function (data) {
                    swal({
                        title:data['title'],
                        text: data['message'],
                        type: data['status']
                    });

                    $('.confirm').click(function(){
                        $('.break-stop').remove();
                        $('.break-start').remove();
                        $('.break-status').append('<a href="" class="btn btn-outline-success waves-effect waves-light mt-2 btn-lg break-start">Start Break</a>')
                        startBreak();
                    })

                }
            });
        })
    }

    //addClockIn();
    addClockOut();
    removeErrorOnNotes();
    startBreak();

    //runValidation();





})
