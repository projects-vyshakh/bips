$(document).ready(function(){

    var runDatePickers  =   function () {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,


        });
    }

    var runValidation   =   function(){
        $("form[name='ticketsForm']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side

                date: "required",
                complaint: "required",

            },
            // Specify validation error messages
            messages: {

                date: "Please enter a date",
                complaint: "Please enter your complaint",

            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    runDatePickers();
    runValidation();


})
