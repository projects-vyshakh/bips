$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();

    var usersList =   function(){
        var table = $('#data-table').DataTable( {
            "responsive": true,
            "scrollX": true,
            "drawCallback": function( settings ) {
                userDelete();
            }
        } );



    }


    var userDelete  =   function(){
        $('.delete').click(function(e){
            e.preventDefault();

            var uuid    =   $(this).attr('data-uuid');

            swal({
                title: "Are you sure?",
                text: "Do you want to delete the User?",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-outline-danger",
                confirmButtonClass: "btn-outline-info",
                confirmButtonText: "Yes, Delete",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {


                $.ajax({
                    type: "POST",
                    url: '../handleUserDelete',
                    dataType:"JSON",
                    data: 'uuid='+uuid+'&_token='+_token,
                    success: function(data)
                    {

                        swal(data['title'],data['message']+"!", data['status'])

                        $('.confirm').click(function(){
                            if(data['code'] == 200){
                                location.reload();
                            }
                        });

                    }
                });
                /* setTimeout(function () {
                     swal("Ajax request finished!");
                 }, 2000);*/
            });
        })
    }




        usersList();
        userDelete();






})

