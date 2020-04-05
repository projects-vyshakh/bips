<link href="../public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<script src="../public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script>
    var runDatePickers  =   function () {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,


        });
    }
</script>
