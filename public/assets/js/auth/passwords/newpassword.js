$(document).ready(function(){

    var runValidation   =   function(){
        $("#form").validate({
            // Specify validation rules
            rules: {

                password            :   "required",
                cpassword           :   {
                    "required"      :   false,
                    "equalTo"       :   "#password",
                },
            },
            // Specify validation error messages
            messages: {
                password            :   "Please enter a valid password",
                cpassword           :   {
                    "required"      :   "Please enter a valid confirm password",
                    "equqlTo"       :   "Confirm password must be same as password"
                },


            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    }


    runValidation();
});
