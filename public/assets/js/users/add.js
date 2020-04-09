$(document).ready(function() {

    var runValidation   =   function(){
        $("#form").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                firstname           :   "required",
                lastname            :   "required",
                designation         :   "required",
                //password            :   "required",
                cpassword           :   {
                    "required"      :   false,
                    "equalTo"       :   "#password",
                },
                email               :   {
                    "required"  :   true,
                    "email"     :   true
                },
                phone           :   {
                    "required"  :   true,
                    "digits"    :   true
                },



            },
            // Specify validation error messages
            messages: {
                firstname           :   "Please enter your first name.",
                lastname            :   "Please enter your last name.",
                password            :   "Please enter a valid password",
                cpassword           :   {
                    "required"      :   "Please enter a valid confirm password",
                    "equqlTo"       :   "Confirm password must be same as password"
                },
                designation         :   "Please enter your designation.",
                email           :   {
                    "required"  :   "Please enter a valid email",
                    "email"    :   "Please enter a valid email",
                },

                phone           :   {
                    "required"  :   "Please enter a valid phone number",
                    "digits"    :   "Please enter a valid phone number",
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

