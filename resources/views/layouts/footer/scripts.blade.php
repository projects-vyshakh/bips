<!-- Vendor js -->
<script src="../public/assets/js/vendor.min.js"></script>

<script src="../public/assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="../public/assets/libs/peity/jquery.peity.min.js"></script>

<!-- Sparkline charts -->
<script src="../public/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- init js -->
<script src="../public/assets/js/pages/dashboard-1.init.js"></script>

<!-- App js -->
<script src="../public/assets/js/app.min.js"></script>

<!-- Validation js (Parsleyjs) -->
<script src="../public/assets/libs/parsleyjs/parsley.min.js"></script>

<!-- validation init -->
<script src="../public/assets/js/pages/form-validation.init.js"></script>

{{--Clocker Script--}}
<script type="text/javascript" src="../public/assets/libs/tiny-timer/dist/jquery.tinytimer.js"></script>


<script>
    $('.alert').delay(3000).fadeOut(400)
</script>

<script>
    var clocker =   $('.clocker').val();
    var split   =   clocker.split(":");
    var hours   =   split[0];
    var minutes =   split[1];
    var seconds =   split[2];




    var hoursToSec      =   hours*3600;
    var minToSec        =   minutes*60;
    var totalSec        =   parseInt(hoursToSec)+parseInt(minToSec)+parseInt(seconds);



    var options = {
        timerCounter: totalSec*1000
    };
    $(".clocker-div").timer( options ).start();
</script>


@yield('scripts')
