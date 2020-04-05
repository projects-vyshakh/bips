$(document).ready(function(){
    var runAssign   =   function(){


        $('.assign-vacancies').click(function(e){
            e.preventDefault();
            var date = $(this).attr('vacancy-date');
            $('.date').val(date)
           $('#con-close-modal').modal('show');

        });
    }

    runAssign();

});
