$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();

    var listTable =   function(){

        var table = $('#work-order').DataTable( {
            responsive: true,
            "fnDrawCallback": function (oSettings) {

                //Triggering delete button
                $('.delete').click(function(e){
                    e.preventDefault();
                    var uuid    =   $(this).attr('data-uuid');
                    listDelete(uuid);
                })
            },

        } );

    }

    var listDelete  =   function(uuid){
        $('.delete').click(function(e){
            e.preventDefault();



            swal({
                title: "Are you sure?",
                text: "Do you want to delete the Workorder?",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-outline-danger",
                confirmButtonClass: "btn-outline-info",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {


                $.ajax({
                    type: "POST",
                    url: '../handleWorkorderDelete',
                    dataType:"JSON",
                    data: 'uuid='+uuid+'&_token='+_token,
                    success: function(data)
                    {
                        if(data!=""){
                            if(data['status'] == 'success'){
                                swal(data['title'],data['message']+"!",data['status'])

                                $('.confirm').click(function(){
                                    location.reload();
                                })

                            }
                        }

                    }
                });
                /* setTimeout(function () {
                     swal("Ajax request finished!");
                 }, 2000);*/
            });
        })
    }







    listTable();
    listDelete();






})

