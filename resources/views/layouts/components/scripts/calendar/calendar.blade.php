<style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
</style>

<!-- Plugin css -->
<link href="../public/assets/libs/fullcalendar-external/packages/core/main.css" rel="stylesheet" type="text/css" />
<link href="../public/assets/libs/fullcalendar-external/packages/daygrid/main.css" rel="stylesheet" type="text/css" />





<script src="../public/assets/libs/fullcalendar-external/packages/core/main.js"></script>
<script src="../public/assets/libs/fullcalendar-external/packages/interaction/main.js"></script>
<script src="../public/assets/libs/fullcalendar-external/packages/daygrid/main.js"></script>
@include('layouts.components.scripts.sweetalert.sweetalert')
<!-- Calendar init -->
{{--<script src="../public/assets/js/availability/calendar.init.js"></script>--}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var _token  =   $("input[name=_token]").val();
        var dataString  =   '_token='+_token;

        var today   =   new Date();
        var year    =   today.getFullYear();
        var month   =   today.getMonth()+1;
        var day     =   today.getDate();

        if(month<10){
            month = "0"+month;
        }
        if(day<10){
            day = "0"+day;
        }

        var date    =   year+'-'+month+'-'+day;



        $.ajax({
            type: "POST",
            url: '../getAvailability',
            data: dataString,
            dataType:"JSON",
            success: function(data)
            {
                //console.log(data)
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction', 'dayGrid' ],
                    dateClick: function(info) {
                        //alert('Clicked on: ' + info.dateStr);
                        //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        //alert('Current view: ' + info.view.type);
                        // change the day's background color just for fun
                        //info.dayEl.style.backgroundColor = 'red';

                        $('.date').val(info.dateStr)

                        $('#con-close-modal').modal('show');



                    },

                    header: {
                        left: 'prevYear,prev,next,nextYear today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek,dayGridDay'
                    },
                    defaultDate: date,
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    selectable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events:  data



                });

                calendar.render();

                $('.fc-content').click(function(e){
                    alert($(this).text());
                    //calendar.dateClick();
                })
            }
        });

        $('.assign').click(function(e){
            e.preventDefault();

            var date        =   $('.date').val();
            var employee    =   $('.employees').val();
            var vacancy     =   $('.vacancies').val();
            var dataString  =   '_token='+_token+'&date='+date+'&employee='+employee+'&vacancy='+vacancy;

            $.ajax({
                type: "POST",
                url: '../handleAssignVacancy',
                data: dataString,
                dataType: "JSON",
                success: function (data) {
                    $('#con-close-modal').modal('hide');
                    swal("", data['message'], data['status']);

                }
            });


        })







    });

</script>
