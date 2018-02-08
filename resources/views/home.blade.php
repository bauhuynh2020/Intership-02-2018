@extends('layouts.master')
@section('stylesheet')
    <style>
        .panel > .panel-heading {
            padding: 5px 10px;
        }

        .panel > .panel-body {
            padding: 7px 12px;
        }

        .panel > .panel-body > h2 {
            margin: unset;
            text-align: center;
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="panel panel-flat">
        <br/>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Miners Online</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-miners-online">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Pool Hash Rate</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-pool-hash-rate">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Last Block Found</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-last-block-found">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Network Difficulty</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-network-diff">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h6 class="panel-title">Blockchain height</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-blockchain-height">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Price</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-price">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>Statistical</h3>
                </div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        (function ($) {
            $(function () {
                var api = 'http://beta-pirl.pool.sexy/api/stats';

                var options = {
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            title: function (i, v) {
                                var timeStamp = v['labels'][i[0]['index']];
                                return 'Timestamp: ' + timeStampChart(timeStamp).toLocaleString();
                            },
                            label: function (i, v) {
                                var hashRate = v['datasets'][0]['data'][i['index']];
                                return 'Hashrate: ' + hashPower(hashRate);
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Time'
                            },
                            ticks: {
                                callback: function (v, i) {
                                    return timeStampChart(v).toLocaleTimeString(navigator.language, {
                                        hour: 'numeric',
                                        minute: '2-digit',
                                        hour12: true
                                    });
                                }
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Hashrate'
                            },
                            ticks: {
                                callback: function (v, i) {
                                    return hashPower(v);
                                }
                            }
                        }]
                    }
                }

                // Chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: "Hashrate",
                            borderColor: 'rgb(255, 51, 102)',
                            backgroundColor: 'rgba(255, 51, 255, .4)',
                            data: [],
                        }]
                    },
                    options: options
                });

                var refreshHome = function () {
                    $.ajax({
                        url: api,
                        method: 'get'
                    })
                        .done(function (response) {

                            $('#stats-miners-online').text(response.minersTotal);
                            $('#stats-pool-hash-rate').text(hashPower(response.hashrate));
                            $('#stats-last-block-found').text(getMinute(response.stats.lastBlockFound));
                            $('#stats-network-diff').text((response.nodes[0].difficulty / 1000000000000).toFixed(3) + ' T');
                            $('#stats-blockchain-height').text(response.nodes[0].height);
                            $('#stats-price').html(response.prices.BTC + ' <i class="fa fa-bitcoin"></i>');

                            var rangerPoint = 20;
                            var poolHistory = response.poolHistory;
                            var chartTimestamp = new Array();
                            var chartHashrate = new Array();
                            var endPoint = poolHistory.length - 1;
                            var startPoint = endPoint - rangerPoint;

                            while (startPoint < endPoint) {
                                chartTimestamp.push(poolHistory[startPoint].timestamp);
                                chartHashrate.push(poolHistory[startPoint].hashrate);
                                startPoint++;
                            }

                            chart.data.labels = chartTimestamp;
                            chart.data.datasets[0].data = chartHashrate;
                            chart.update();

                            setTimeout(function () {
                                refreshHome();
                            }, time);
                        })
                }

                refreshHome();
            })
        })(jQuery)

        function getMinute(number) {
            var dateDiff = new Date(1000 * number);
            var dateCurrent = new Date();
            var timeDiff = Math.abs(dateCurrent.getTime() - dateDiff.getTime());
            var diffDays = Math.ceil(timeDiff / 1000);

            return (diffDays / 60).toFixed(0) + ' minutes ago';
        }

        function timeStampChart(number) {
            number = new Date(1000 * number);

            return number;
        }
    </script>
@stop