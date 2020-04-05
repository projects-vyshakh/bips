$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();

    var tickets =   function(){
        var table = $('#tickets').DataTable( {
            responsive: true,

        } );

    }

    var ticketDelete    =   function(){
        $('.delete').click(function(e){
            e.preventDefault();

            var ticket      =   $(this).attr('data-ticket');

            var dataString  =   '_token='+_token+'&ticket='+ticket;


            swal({
                    title: "Are you sure?",
                    text: "Do you want to delete the Tickets?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    cancelButtonClass: "btn-info",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        type: "POST",
                        url: '../handleDeleteTicket',
                        dataType:"JSON",
                        data: dataString,
                        success: function(data)
                        {
                            if(data['code'] == 200){
                                var title   =   "Deleted"
                            }
                            else{
                                var title   =   "Error";
                            }
                            swal({
                                title:title,
                                text: data['message'],
                                type: data['status']
                            })

                            $('.confirm').click(function(e){
                                e.preventDefault();

                                window.location = "manage-tickets";
                            })


                        }
                    });

                });
        })
    }

    var statusChange        =   function(){

        $('.status').change(function(){
            var idTicket    =   $(this).attr('tickets');
            var status      =   $(this).val();
            var dataString  =   'tickets='+idTicket+'&_token='+_token+'&status='+status;

            swal({
                title: "Are you sure?",
                text: "Do you want to change the status?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
            },function(){
                $.ajax({
                    type: "POST",
                    url: '../handleTicketsStatusChange',
                    dataType:"JSON",
                    data: dataString,
                    success: function(data)
                    {
                        if(data['code'] == 200){
                            var title   =   "Success"
                        }
                        else{
                            var title   =   "Error";
                        }
                        swal({
                            title:title,
                            text: data['message'],
                            type: data['status']
                        })




                    }
                });

            })
        });
    }


    tickets();
    ticketDelete();
    statusChange();



})
