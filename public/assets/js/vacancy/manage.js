$(document).ready(function(){

    var _token  =   $("input[name=_token]").val();

    var vacancies =   function(){
        var table = $('#data-table').DataTable( {
            responsive: true,

            "drawCallback": function( settings ) {
                runVacancyStatusChange();
            }

        } );

    }

    var runVacancyStatusChange  =   function(){
        $('.status').on('change',function(e){
            e.preventDefault();

            var status      =   $(this).val();
            var vacancy     =   $(this).attr('vacancy-id');
            var dataString  =   'status='+status+'&vacancy='+vacancy+'&_token='+_token;


            swal({
                title: "Are you sure?",
                text: "Do you want to change the Status?",
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
                    url: '../handleVacancyStatusChange',
                    dataType:"JSON",
                    data: dataString,
                    success: function(data)
                    {
                        if(data!=""){
                            if(data['status'] == 'success'){
                                swal(data['message']+"!");
                            }
                        }

                    }
                });
               /* setTimeout(function () {
                    swal("Ajax request finished!");
                }, 2000);*/
            });

        });
    }




    vacancies();




})
