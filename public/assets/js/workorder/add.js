$(document).ready(function(){
    runDatePickers();

    var runValidation   =   function(){
        $("#form").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                cust_name           :   "required",
                accno               :   "required",
                //order_notes         :   "required",
                service_address     :   "required",
                order_date          :   "required",
                phone           :   {
                    "required"  :   true,
                    "digits"    :   true
                },



            },
            // Specify validation error messages
            messages: {
                cust_name           :   "Please enter a name.",
                accno               :   "Please enter account number.",
                service_address     :   "Please enter service address.",
                //order_notes         :   "Please enter order notes.",
                order_date          :   "Please enter order date.",
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



})
