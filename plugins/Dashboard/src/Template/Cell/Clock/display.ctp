<div class="col-lg-3">
    <div class="widget style1 gray-bg">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-clock-o fa-4x"></i>
            </div>
            <div class="col-xs-9 text-right">
                <span class="font-bold"><?= date('D, d M Y') ?></span>
                <h2 id="clock">00:00:00 AM</h2>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function updateClock ( )
    {
        var currentTime = new Date ( );
        var currentHours = currentTime.getHours ( );
        var currentMinutes = currentTime.getMinutes ( );
        var currentSeconds = currentTime.getSeconds ( );

        // Pad the minutes and seconds with leading zeros, if required
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

        // Choose either "AM" or "PM" as appropriate
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

        // Convert the hours component to 12-hour format if needed
        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

        // Convert an hours component of "0" to "12"
        currentHours = ( currentHours == 0 ) ? 12 : currentHours;

        // Compose the string for display
        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

        $("#clock").html(currentTimeString);

    }

    $(document).ready(function() {
        setInterval('updateClock()', 1000);
    });
</script>
