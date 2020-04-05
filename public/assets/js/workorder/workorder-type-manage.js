$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();
    var dataString  =   '_token='+_token;

    var onPageLoad  =   function(){
        $('.add-new').click(function(){
            $('.name').val('');
            $('.status').val('Active');

            $('.update').text('Save').addClass('save').removeClass('update');
        })
    }

    var listTable =   function(){

        var table = $('#work-order-type').DataTable( {
            responsive: true,

            "fnDrawCallback": function (oSettings) {
                //Triggering edit button
                $('.ordertype-edit').click(function(e){
                    e.preventDefault();

                   $('.save').remove();
                   $('.btn_div').append('<button type="button" class="btn btn-info waves-effect waves-light update">Update</button>')

                    $('.name').val('');
                    $('.status').val('Active');

                    var name        =   $(this).attr('data-type-value');
                    var status      =   $(this).attr('data-status-value');
                    var id          =   $(this).attr('data-id');


                    $('.name').val(name);
                    $('.status').val(status);



                    updateWorkorderType($(this));




                    $('#con-close-modal').modal('show');
                })


                //Triggering delete button
                $('.ordertype-delete').click(function(e){
                    e.preventDefault();
                    var id  =   $(this).attr('data-id');
                    deleteWorkorderType(id)
                })
            },


        } );

    }

    var save    =   function(){
        $('.save').click(function(){
            //e.preventDefault();



            var name        =   $('.name').val();
            var status      =   $('.status').val();
            var action      =   "save";
            var dataString  =  '&name='+name+'&status='+status+'&action='+action+'&_token='+_token;


            $.ajax({
                type: "POST",
                url: '../handleSaveWorkorderType',
                dataType:"JSON",
                data: dataString,
                success: function(data)
                {
                    $('.name').val('');
                    $('.status').val('Active');

                    if(data!=""){
                        if(data['status'] == 'success'){
                            $('#con-close-modal').modal('hide');
                            swal(data['title'],data['message'],data['status'])

                            $('.confirm').click(function(){
                                location.reload();
                            })

                        }
                        else{
                            swal(data['title'],data['message']+"!",data['status'])


                        }
                    }

                }
            });


        })
    }

    var updateWorkorderType   =   function(element){


        $('.update').click(function(e){
            e.preventDefault();

            console.log(element);

            var id      =   element.attr('data-id');
            var name    =   $('.name').val();
            var status  =   $('.status').val();

            var dataString  =   'id='+id+'&name='+name+'&status='+status+'&_token='+_token;

            $.ajax({
                type: "POST",
                url: '../handleUpdateWorkorderType',
                dataType:"JSON",
                data: dataString,
                success: function(data)
                {
                    $('.name').val('');
                    $('.status').val('Active');

                    if(data!=""){
                        if(data['status'] == 'success'){
                            $('#con-close-modal').modal('hide');
                            swal(data['title'],data['message'],data['status'])

                            $('.confirm').click(function(){
                                location.reload();
                            })

                        }
                        else{
                            swal(data['title'],data['message']+"!",data['status'])


                        }
                    }

                }
            });
        })

    }

    var deleteWorkorderType  =   function(id){
        swal({
            title: "Are you sure?",
            text: "Do you want to delete the Workorder Type?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-outline-danger",
            confirmButtonClass: "btn-outline-info",
            confirmButtonText: "Delete",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {


            $.ajax({
                type: "POST",
                url: '../handleWorkorderTypeDelete',
                dataType:"JSON",
                data: 'id='+id+'&_token='+_token,
                success: function(data)
                {
                    if(data['status'] == 'success'){
                        swal(data['title'],data['message'],data['status'])

                        $('.confirm').click(function(){
                            location.reload();
                        })

                    }
                    else{
                        swal(data['title'],data['message']+"!",data['status'])


                    }

                }
            });
            /* setTimeout(function () {
                 swal("Ajax request finished!");
             }, 2000);*/
        });
    }


    listTable();
    save(dataString);

    onPageLoad();







})

