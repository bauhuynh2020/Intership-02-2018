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
                            <h6 class="panel-title">Pool Hashrate</h6>
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
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Current round variance</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="stats-current-round_variance">0</h2>
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
                var getDuration = function (d1, d2) {
                    d3 = new Date(d2 - d1);
                    d0 = new Date(0);

                    return {
                        getHours: function () {
                            return d3.getHours() - d0.getHours();
                        },
                        getMinutes: function () {
                            return d3.getMinutes() - d0.getMinutes();
                        },
                        getMilliseconds: function () {
                            return d3.getMilliseconds() - d0.getMilliseconds();
                        },
                        toString: function () {
                            return this.getHours() + ":" +
                                this.getMinutes() + ":" +
                                this.getMilliseconds();
                        },
                    };
                }

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
                            $('#stats-last-block-found').text(getTime(response.stats.lastBlockFound, response.now));
                            $('#stats-network-diff').text((response.nodes[0].difficulty / 1000000000000).toFixed(3) + ' T');
                            $('#stats-blockchain-height').text(response.nodes[0].height);
                            $('#stats-price').html(response.prices.BTC + ' <i class="fa fa-bitcoin"></i>');
                            var difficulty = parseInt(response.nodes[0].difficulty);
                            var nShares = response.nShares;
                            var currentRound = (nShares / difficulty) * 100
                            $('#stats-current-round_variance').text(currentRound.toFixed(2) + ' %');

                            var rangerPoint = 50;
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

                            // var minHash = Math.min(...chartHashrate);
                            // var maxHash = Math.max(...chartHashrate);
                            // var stepHash = maxHash - minHash;

                            chart.data.labels = chartTimestamp;
                            chart.data.datasets[0].data = chartHashrate;

                            // chart.options.scales.yAxes[0].ticks.min = minHash;
                            // chart.options.scales.yAxes[0].ticks.max = maxHash + stepHash;
                            // chart.options.scales.yAxes[0].ticks.stepSize = stepHash;
                            chart.update();
                        })
                }

                refreshHome();
                setInterval(function () {
                    refreshHome();
                }, time);
            })
        })(jQuery)

        function getTime(d1, d2) {
            var dateDiff = new Date(1000 * d1);
            var dateCurrent = new Date(d2);
            var timeDiff = Math.abs(dateCurrent.getTime() - dateDiff.getTime());
            // var diffDays = Math.ceil(timeDiff / 1000);
            //
            // return (diffDays / 60).toFixed(0) + ' minutes ago';

            var hours = Math.floor(timeDiff / (24 * 60 * 1000));
            var minutes = Math.floor(timeDiff / (60 * 1000));
            var seconds = timeDiff % 60;

            var time = '';
            if (hours > 0) {
                time += hours + ' h ';
            }
            if (minutes > 0) {
                time += minutes + 'm ';
            }

            return time + seconds + ' s';
        }

        function timeStampChart(number) {
            number = new Date(1000 * number);

            return number;
        }
    </script>
@stop