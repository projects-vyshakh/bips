$(document).ready(function(){

    var runDatePickers  =   function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    }

    var profileValidation   =   function(){
        $("form[name='profileForm']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                phone: {
                    required: true,
                    number: true
                },
                dob: "required",
                qualification: "required",

            },
            // Specify validation error messages
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                phone: {
                    required: "Please enter your phone",
                    number: "Please enter a valid number"
                },
                email: "Please enter a valid email address",
                dob: "Please enter your date of birth",
                qualification: "Please enter your qualification",

            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    }



    runDatePickers();
    profileValidation();



})
