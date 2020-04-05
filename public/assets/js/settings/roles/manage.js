$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();

    var pageOnLoad  =   function(){

    }

    var list =   function(){
        var table = $('#data-table').DataTable( {
            responsive: true,
        } );

    }


    var rolesDelete  =   function(){
        $('.delete').click(function(e){
            e.preventDefault();

            var id    =   $(this).attr('data-id');

            swal({
                title: "Are you sure?",
                text: "Do you want to delete the User?",
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
                    url: '../handleRolesDelete',
                    dataType:"JSON",
                    data: 'id='+id+'&_token='+_token,
                    success: function(data)
                    {
                        if(data!=""){
                            if(data['status'] == 'success'){
                                swal(data['title'],data['message']+"!")
                                location.href = "manage-roles";
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



    pageOnLoad();
    list();
    rolesDelete();






})

