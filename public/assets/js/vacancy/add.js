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
                vacancy_name    :   "required",
                total_vacancy   :   "required",
                qualification   :   "required",
                job_location    :   "required",
                closing_date    :   "required",
                email           :   {
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
                vacancy_name    :   "Please enter a vacancy name.",
                total_vacancy   :   "Please enter total vacancy.",
                qualification   :   "Please enter qualification.",
                job_location    :   "Please enter job location.",
                closing_date    :   "Please enter closing date.",
                email           :   {
                    "required"  :   "Please enter a valid email",
                    "email"     :   "Please enter a valid email",
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

    runDatePickers();
    runValidation();


})
