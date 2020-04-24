$(document).ready(function(){
    var _token  =   $("input[name=_token]").val();

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

            removeErrorOnNotes();

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
                }
            });

        })
    }
    var addClockOut  =   function(){
        $('.clock-out').click(function(e){
            e.preventDefault();
            var notes   =   $('.out_notes').val();


            $('#clock-out').attr('disabled','disabled');
            $('.icon-clock').hide();
            $('.button-spinner').show();
            $('.spinner-text').show();

            if(notes==""){
                $('.error-div').append('<p class="error-message text-danger">Please enter your notes here.</p>');
                return false;
            }

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


    addClockIn();
    addClockOut();
    removeErrorOnNotes();
    //runValidation();





})
