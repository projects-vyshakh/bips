$(document).ready(function(){


    var runValidation   =   function(){
        $("#form").validate({
            // Specify validation rules
            rules: {
                notes           :   "required",
            },
            // Specify validation error messages
            messages: {
                notes           :   "Please enter your notes.",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    }


    runValidation();
})
