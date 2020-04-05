$(document).ready(function() {


    var _token = $("input[name=_token]").val();

    var pageOnLoad = function () {

        if ($('.shortname').val() == "admin") {
            $('.shortname').attr('readonly', true);
        }
    }

    var runValidation   =   function(){
        $("#form").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name            :   "required",
                shortname       :   "required",
            },
            // Specify validation error messages
            messages: {
                name                :   "Please enter a name.",
                shortname           :   "Please enter short name.",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    pageOnLoad();
    runValidation();
});
