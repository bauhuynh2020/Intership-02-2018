@extends('layouts.master')
@section('stylesheet')
    <style>
        .panel > .panel-body > h2 {
            margin: unset;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="panel panel-flat">
        <br/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total miners</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="total-miners">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total miners offline</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="total-miners-offline">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total hashrate</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="total-hashrate">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-lg-6">Login</th>
                                <th class="col-lg-3">Hashrate</th>
                                <th class="col-lg-2">Last beat</th>
                            </tr>
                            </thead>
                            <tbody id="miners-tbody">
                            <tr>
                                <td colspan="3" class="text-center">
                                    <h3>Loading...</h3>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        (function ($) {
            $(function () {
                var refreshMiners = function () {
                    $.ajax({
                        url: '{{ config('pool_config.api.host') }}miners',
                        method: 'get'
                    })
                        .done(function (response) {
                            var miners = response.miners;
                            var tbodyOfTable = '';
                            var totalMinersOffline = 0;

                            miners = sortObject(miners);

                            $.each(miners, function (key, item) {
                                var offline;
                                if (item.value.offline) {
                                    offline = 'class=danger';
                                    totalMinersOffline++;
                                }
                                tbodyOfTable += '<tr ' + offline + '>' +
                                    '<td><a>' + item.key + '</a></td>' +
                                    '<td>' + hashPower(item.value.hr) + '</td>' +
                                    '<td>' + intToDate(item.value.lastBeat) + '</td>' +
                                    '</tr>';
                            })

                            $('#total-miners').text(response.minersTotal);
                            $('#total-hashrate').text(hashPower(response.hashrate));
                            $('#total-miners-offline').text(totalMinersOffline);
                            $('#miners-tbody').html(tbodyOfTable);
                        })
                }

                refreshMiners();
                setInterval(function () {
                    refreshMiners();
                }, time);

                $(document).on('click', 'tbody a', function () {
                    $(this)
                        .attr('href', '{{ route('get.account') }}/' + $(this).text());
                });
            })
        })(jQuery)

        function sortObject(obj) {
            var arr = [];
            var prop;
            for (prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    arr.push({
                        'key': prop,
                        'value': obj[prop]
                    });
                }
            }
            arr.sort(function (a, b) {
                return b.value.hr - a.value.hr;
            });
            return arr;
        }
    </script>
@stop