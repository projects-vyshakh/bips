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
        $("form[name='form']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                amount          :   {
                    "required"  :   true,
                    "digits"    :   true
                },
                payment_date    :   "required",




            },
            // Specify validation error messages
            messages: {

                payment_date    :   "Please enter payment date.",

                amount           :   {
                    "required"  :   "Please enter a the amount",
                    "digits"    :   "Please enter a valid amount",
                },


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
