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
        <div class="panel-heading">
            <h6 class="panel-title"></h6>
            <div class="heading-elements">

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Immature Balance</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-immature-balance">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Pending Balance</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-pending-balance">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Paid</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-total-paid">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Last 24h Reward</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-last-24h-reward">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h6 class="panel-title">Last Share Submitted</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-last-share-submitted">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Workers Online</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-workers-online">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Hashrate (30m)</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-hashrate-30m">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Hashrate (3h)</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-hashrate-3h">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Blocks Found</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-blocks-found">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Payments</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-total-payments">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Your Round Share</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-your-round-share">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h6 class="panel-title">Daily estimated gain</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="account-daily-estimated-gain">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>Hashrate / Workers</h3>
                </div>
                <canvas id="myChart"></canvas>
            </div>
            <div class="row">
                <div class="">
                    <div class="panel-heading">
                        <h6 class="panel-title"></h6>
                        <div class="heading-elements">
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#account-tab-workers">Workers</a></li>
                                <li><a data-toggle="tab" href="#account-tab-rewards">Rewards</a></li>
                                <li><a data-toggle="tab" href="#account-tab-payouts">Payouts</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="account-tab-workers">
                                    <h3>Your Workers</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="col-lg-3">ID</th>
                                                <th class="col-lg-3">Hashrate (rough, short average)</th>
                                                <th class="col-lg-3">Hashrate (accurate, long average)</th>
                                                <th class="col-lg-2">Last Share</th>
                                            </tr>
                                            </thead>
                                            <tbody id="account-yourworkers">
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <h3>Loading...</h3>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="account-tab-rewards">
                                    <h3>Your Latest Rewards</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody id="account-rewards-1">
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <h3>Loading...</h3>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="col-lg-3">Block Height</th>
                                                <th class="col-lg-4">Rewards</th>
                                                <th class="col-lg-4">Round Share</th>
                                            </tr>
                                            </thead>
                                            <tbody id="account-rewards-2">
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <h3>Loading...</h3>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="account-tab-payouts">
                                    <h3>Your Latest Payouts</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="col-lg-3">Time</th>
                                                <th class="col-lg-6">Tx ID</th>
                                                <th class="col-lg-2">Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody id="account-payouts">
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
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        (function ($) {
            $(function () {
                var api = 'http://beta-pirl.pool.sexy/api/accounts/' + '{{ $id }}';

                var options = {
                    tooltips: {
                        displayColors: false,
                        intersect: true,
                        callbacks: {
                            title: function (i, v) {
                                var timeStamp = v['labels'][i[0]['index']];
                                return 'Timestamp: ' + timeStampChart(timeStamp).toLocaleString();
                            },
                            label: function (i, v) {
                                switch (i.datasetIndex) {
                                    case 0:
                                        var hashRate = v['datasets'][0]['data'][i['index']];
                                        return 'Hashrate: ' + hashPower(hashRate);
                                        break;
                                    case 1:
                                        var worker = v['datasets'][1]['data'][i['index']];
                                        return 'Workers: ' + worker;
                                        break;
                                }
                            }
                        }
                    },
                    scales: {
                        xAxes: [
                            {
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
                            }
                        ], yAxes: [
                            {
                                id: 'hashrates',
                                position: 'left',
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Hashrate'
                                },
                                ticks: {
                                    callback: function (v, i) {
                                        return hashPower(v);
                                    }
                                }
                            }, {
                                id: 'workers',
                                position: 'right',
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Workers'
                                },
                                ticks: {
                                    callback: function (v, i) {
                                        return v.toFixed(0);
                                    }
                                }
                            }
                        ]
                    }
                };

                // Chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [
                            {
                                yAxisID: 'hashrates',
                                label: "Hashrate history",
                                borderColor: 'rgb(255, 51, 102)',
                                backgroundColor: 'rgba(255, 51, 255, .4)',
                                data: [],
                            }, {
                                yAxisID: 'workers',
                                label: "Workers history",
                                borderColor: 'rgb(0, 0, 238)',
                                backgroundColor: 'rgba(0, 102, 255, .4)',
                                data: [],
                            }
                        ]
                    },
                    options: options
                });

                var accountRefresh = function () {
                    $.ajax({
                        url: api,
                        method: 'get'
                    })
                        .done(function (response) {

                            //Main
                            $('#account-immature-balance').text(balancePrice(response.stats.immature));
                            $('#account-pending-balance').text(balancePrice(response.stats.balance));
                            $('#account-total-paid').text(balancePrice(response.stats.paid));
                            $('#account-last-24h-reward').text(balancePrice(response['24hreward']));

                            $('#account-last-share-submitted').text(getSeconds(response.stats.lastShare));
                            $('#account-workers-online').text(response.workersOnline);
                            $('#account-hashrate-30m').text(hashPower(response.currentHashrate));
                            $('#account-hashrate-3h').text(hashPower(response.hashrate));
                            $('#account-blocks-found').text(response.stats.blocksFound);
                            $('#account-total-payments').text(response.paymentsTotal);
                            $('#account-your-round-share').text(balancePrice(response.roundShares));
                            $('#account-daily-estimated-gain').text((response.earnings.USD).toFixed(2) + ' USD');

                            // Charts
                            var rangerPoint = 50;
                            var poolHistory = response.hashHistory;
                            var chartTimestamp = new Array();
                            var chartHashrate = new Array();
                            var chartWorkers = new Array();
                            var endPoint = poolHistory.length - 1;
                            var startPoint = endPoint - rangerPoint;

                            while (startPoint < endPoint) {
                                chartTimestamp.push(poolHistory[startPoint].timestamp);
                                chartHashrate.push(poolHistory[startPoint].value);
                                chartWorkers.push(poolHistory[startPoint].onlineWorkers);
                                startPoint++;
                            }

                            chart.data.labels = chartTimestamp;
                            chart.data.datasets[0].data = chartHashrate;
                            chart.data.datasets[1].data = chartWorkers;
                            chart.update();

                            // YourWorkers
                            var workers = response.workers;
                            var tbodyOfTable = '';

                            $.each(workers, function (key, item) {
                                var offline;
                                if (item.offline) {
                                    offline = 'class=danger';
                                }
                                tbodyOfTable += '<tr ' + offline + '>' +
                                    '<td>' + key + '</td>' +
                                    '<td>' + hashPower(item.hr) + '</td>' +
                                    '<td>' + hashPower(item.hr2) + '</td>' +
                                    '<td>' + getSeconds(item.lastBeat) + '</td>' +
                                    '</tr>';
                            })
                            $('#account-yourworkers').html(tbodyOfTable);

                            // Rewards 1
                            var sumrewards = response.sumrewards;
                            var tbodyOfTable = '';

                            $.each(sumrewards, function (key, item) {
                                tbodyOfTable += '<tr>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + balancePrice(item.reward) + '</td>' +
                                    '</tr>';
                            })
                            $('#account-rewards-1').html(tbodyOfTable);

                            // Rewards 2
                            var rewards = response.rewards;
                            var tbodyOfTable = '';

                            $.each(rewards, function (key, item) {
                                tbodyOfTable += '<tr>' +
                                    '<td>' + item.blockheight + '</td>' +
                                    '<td>' + balancePrice(item.reward) + '</td>' +
                                    '<td>' + (item.percent * 100).toFixed(2) + ' %</td>' +
                                    '</tr>';
                            })
                            $('#account-rewards-2').html(tbodyOfTable);

                            // Payouts
                            var payments = response.payments;
                            var tbodyOfTable = '';

                            $.each(payments, function (key, item) {
                                tbodyOfTable += '<tr>' +
                                    '<td>' + intToDate(item.timestamp) + '</td>' +
                                    '<td><a>' + item.tx + '</a></td>' +
                                    '<td>' + balancePrice(item.amount) + '</td>' +
                                    '</tr>';
                            })
                            $('#account-payouts').html(tbodyOfTable);

                            setTimeout(function () {
                                accountRefresh();
                            }, time);
                        })
                }

                accountRefresh();

                $(document).on('click', '#account-payouts a', function () {
                    var tx = 'https://explorer.pirl.io/#/tx/';
                    $(this)
                        .attr('href', tx + $(this).text())
                        .attr('target', '_blank');
                });
            })
        })(jQuery)

        function getSeconds(number) {
            var dateDiff = new Date(1000 * number);
            var dateCurrent = new Date();
            var timeDiff = Math.abs(dateCurrent.getTime() - dateDiff.getTime());
            var diffDays = Math.ceil(timeDiff / 1000);

            if (diffDays > 60) {
                return '1 m ' + (diffDays - 60) + ' s';
            }

            return diffDays + ' s';
        }
    </script>
@stop