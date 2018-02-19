<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pirl Pool Sexy</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('') }}assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('') }}assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('') }}assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('') }}assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('') }}assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
@yield('stylesheet')

<!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('') }}assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <script type="text/javascript" src="{{ asset('') }}assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/js/plugins/ui/moment/moment_locales.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></script>

    <script type="text/javascript" src="{{ asset('') }}assets/js/core/app.js"></script>
    <!-- /theme JS files -->

    <style>
        table th, table td {
            text-align: center;
        }
    </style>
</head>

<body>

<!-- Second navbar -->
@include('layouts.navbar')
<!-- /second navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Main charts -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        @yield('content')

                    </div>
                </div>
            </div>
            <!-- /main charts -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<script>
    var time = 4000;

    $.ajaxSetup({
        cache: false,
        async: false,
        dataType: 'json'
    })

    function intToDate(int) {
        int = new Date(1000 * int);

        return int.toLocaleString();
    }

    function hashPower(number) {
        const MH = 1000;
        const GH = 1000000;
        const TH = 1000000000;

        number = number / 1000;

        if (number > TH) {
            var hashPower = number / TH;
            return hashPower.toFixed(2) + ' TH';
        }

        if (number > GH) {
            var hashPower = number / GH;
            return hashPower.toFixed(2) + ' GH';
        }

        if (number > MH) {
            var hashPower = number / MH;
            return hashPower.toFixed(2) + ' MH';
        }
    }

    function balancePrice(number, ceil = true) {
        number = number / 10;

        if (ceil) {
            number = Math.ceil(number);
        }

        return number / 100000000;
    }

    function timeStampChart(number) {
        number = new Date(1000 * number);

        return number;
    }

    function human_time_diff(from, to) {
        "use strict";

        var now, diff;

        /*---*/
        function difference(diff) {
            var
                MINUTE_IN_SECONDS = 60
                , HOUR_IN_SECONDS = 60 * MINUTE_IN_SECONDS
                , DAY_IN_SECONDS = 24 * HOUR_IN_SECONDS
                , MONTH_IN_SECONDS = 30 * DAY_IN_SECONDS
                , YEAR_IN_SECONDS = 365 * DAY_IN_SECONDS
                , since
                , milliseconds, seconds, minutes, hours, days, months, years
            ;

            if (0 === diff) {
                since = "0 seconds";
            }
            else if (diff > 0 && diff < 1) {
                milliseconds = Math.trunc(diff * 1000);
                since = milliseconds + " " + (1 === milliseconds ? "millisecond" : "milliseconds");
            }
            else if (diff >= 1 && diff < MINUTE_IN_SECONDS) {
                seconds = Math.trunc(diff);
                seconds = Math.max(diff, 1);
                since = seconds + " " + (1 === seconds ? "second" : "seconds");

                diff = diff - (seconds);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }
            else if (diff >= MINUTE_IN_SECONDS && diff < HOUR_IN_SECONDS) {
                minutes = Math.trunc(diff / MINUTE_IN_SECONDS);
                minutes = Math.max(minutes, 1);
                since = minutes + " " + (1 === minutes ? "minute" : "minutes");

                diff = diff - (minutes * MINUTE_IN_SECONDS);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }
            else if (diff >= HOUR_IN_SECONDS && diff < DAY_IN_SECONDS) {
                hours = Math.trunc(diff / HOUR_IN_SECONDS);
                hours = Math.max(hours, 1);
                since = hours + " " + (1 === hours ? "hour" : "hours");

                diff = diff - (hours * HOUR_IN_SECONDS);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }
            else if (diff >= DAY_IN_SECONDS && diff < MONTH_IN_SECONDS) {
                days = Math.trunc(diff / DAY_IN_SECONDS);
                days = Math.max(days, 1);
                since = days + " " + (1 === days ? "day" : "days");

                diff = diff - (days * DAY_IN_SECONDS);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }
            else if (diff >= MONTH_IN_SECONDS && diff < YEAR_IN_SECONDS) {
                months = Math.trunc(diff / MONTH_IN_SECONDS);
                months = Math.max(months, 1);
                since = months + " " + (1 === months ? "month" : "months");

                diff = diff - (months * MONTH_IN_SECONDS);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }
            else if (diff >= YEAR_IN_SECONDS) {
                years = Math.trunc(diff / YEAR_IN_SECONDS);
                years = Math.max(diff, 1);
                since = years + " " + (1 === years ? "year" : "years");

                diff = diff - (years * YEAR_IN_SECONDS);
                if (diff > 0)
                    since = since + ", " + difference(diff);
                /* calculate leftover time, recursively */
            }

            return since;
        }

        /*---*/

        now = new Date();

        from = ("number" === typeof from) ? Math.max(from, 0) :
            ("string" === typeof from) ? Number(new Date(from)) :
                ("object" === typeof from && "date" === from.constructor.name.toLowerCase()) ? Number(from) : Number(now)
        ;

        to = ("number" === typeof to) ? Math.max(to, 0) :
            ("string" === typeof to) ? Number(new Date(to)) :
                ("object" === typeof to && "date" === to.constructor.name.toLowerCase()) ? Number(to) : Number(now)

        if ("nan" === String(from).toLowerCase()) throw new Error("Error While Converting Date (first argument)");
        if ("nan" === String(to).toLowerCase()) throw new Error("Error While Converting Date (second argument)");

        diff = Math.abs(from - to);
        return difference(diff);
    }
</script>
@yield('javascript')

</body>
</html>
