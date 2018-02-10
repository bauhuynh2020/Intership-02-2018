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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Pool always pay(s) full block rewards including TX fees and uncle rewards.</h6>
                    <h5>Block maturity requires up to 520 blocks. Usually it's less indeed.</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-lg-2">Blocks</th>
                                <th class="col-lg-2">Shares/Diff</th>
                                <th class="col-lg-2">Uncle Rate</th>
                                <th class="col-lg-2">Orphan Rate</th>
                            </tr>
                            </thead>
                            <tbody id="block-lucks-tbody">
                            <tr>
                                <td colspan="4" class="text-center">
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
    <div class="panel panel-flat">
        <br/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#block-tag-all">All</a></li>
                            <li><a data-toggle="tab" href="#block-tag-mature">Mature
                                    <span class="label label-success" id="block-tag-mature-label">0</span></a></li>
                            <li>
                                <a data-toggle="tab" href="#block-tag-immature">Immature
                                    <span class="label label-success" id="block-tag-immature-label">0</span></a>
                            </li>
                            <li><a data-toggle="tab" href="#block-tag-new-blocks">New blocks
                                    <span class="label label-success" id="block-tag-new-blocks-label">0</span></a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="block-tag-all">
                                <h3>Recently found blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-3">Height</th>
                                            <th class="col-lg-5">Time Found</th>
                                            <th class="col-lg-3">Luck</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-new-blocks-tbody">
                                        <tr>
                                            <td colspan=3" class="text-center">
                                                <h3>Loading...</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <h3>Immature blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-1">Height</th>
                                            <th class="col-lg-6">Block Hash</th>
                                            <th class="col-lg-2">Time Found</th>
                                            <th class="col-lg-1">Luck</th>
                                            <th class="col-lg-1">Reward</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-immature-tbody">
                                        <tr>
                                            <td colspan=5" class="text-center">
                                                <h3>Loading...</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <h3>Mature blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-1">Height</th>
                                            <th class="col-lg-6">Block Hash</th>
                                            <th class="col-lg-2">Time Found</th>
                                            <th class="col-lg-1">Luck</th>
                                            <th class="col-lg-1">Reward</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-mature-tbody">
                                        <tr>
                                            <td colspan=5" class="text-center">
                                                <h3>Loading...</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="block-tag-mature">
                                <h3>Mature blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-1">Height</th>
                                            <th class="col-lg-6">Block Hash</th>
                                            <th class="col-lg-2">Time Found</th>
                                            <th class="col-lg-1">Luck</th>
                                            <th class="col-lg-1">Reward</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-mature-tbody">
                                        <tr>
                                            <td colspan=5" class="text-center">
                                                <h3>Loading...</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="block-tag-immature">
                                <h3>Immature blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-1">Height</th>
                                            <th class="col-lg-6">Block Hash</th>
                                            <th class="col-lg-2">Time Found</th>
                                            <th class="col-lg-1">Luck</th>
                                            <th class="col-lg-1">Reward</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-immature-tbody">
                                        <tr>
                                            <td colspan=5" class="text-center">
                                                <h3>Loading...</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="block-tag-new-blocks">
                                <h3>Recently found blocks</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-3">Height</th>
                                            <th class="col-lg-5">Time Found</th>
                                            <th class="col-lg-3">Luck</th>
                                        </tr>
                                        </thead>
                                        <tbody class="block-tag-new-blocks-tbody">
                                        <tr>
                                            <td colspan=3" class="text-center">
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
@stop
@section('javascript')
    <script>
        (function ($) {
            $(function () {
                var api = 'http://beta-pirl.pool.sexy/api/blocks';

                var refreshBlocks = function () {
                    $.getJSON(api)
                        .done(function (response) {
                            var lucks = response.luck;
                            var tbodyOfTable = '';

                            $.each(lucks, function (key, item) {
                                tbodyOfTable += '<tr>' +
                                    '<td>' + key + '</td>' +
                                    '<td>' + (item.luck * 100).toFixed(0) + ' %</td>' +
                                    '<td>' + (item.uncleRate * 100).toFixed(0) + ' %</td>' +
                                    '<td>' + (item.orphanRate * 100).toFixed(0) + ' %</td>' +
                                    '</tr>';
                            })

                            $('#block-lucks-tbody').html(tbodyOfTable);

                            // Block tag mature
                            var matureds = response.matured;
                            var tbodyOfTable = '';

                            $.each(matureds, function (key, item) {
                                var reward = (((item.reward).substr(0, 8)) / 1000000).toFixed(6);

                                var hash = item.hash;
                                if (item.orphan) {
                                    hash = 'Orphan';
                                    reward = '';
                                }

                                var luckVal = (((item.shares) / (item.difficulty)) * 100).toFixed(0);
                                var danger = 'success';
                                if (luckVal >= 100) {
                                    danger = 'danger';
                                }

                                tbodyOfTable += '<tr>' +
                                    '<td><a>' + item.height + '</a></td>' +
                                    '<td><a>' + hash + '</a></td>' +
                                    '<td>' + intToDate(item.timestamp) + '</td>' +
                                    '<td><span class="label label-' + danger + '">' + luckVal + ' %</span></td>' +
                                    '<td>' + reward + '</td>' +
                                    '</tr>';
                            })
                            $('#block-tag-mature-label').text(response.maturedTotal);
                            $('.block-tag-mature-tbody').html(tbodyOfTable);

                            // Block tag immature
                            var immatures = response.immature;
                            var tbodyOfTable = '<tr><td colspan="5"><h3>No immature blocks yet</h3></td></tr>';

                            if (immatures) {
                                tbodyOfTable = '';
                                $.each(immatures, function (key, item) {
                                    var reward = (item.reward).substr(0, 8);
                                    var luckVal = (((item.shares) / (item.difficulty)) * 100).toFixed(0);
                                    var danger = 'success';
                                    if (luckVal >= 100) {
                                        danger = 'danger';
                                    }

                                    tbodyOfTable += '<tr>' +
                                        '<td><a>' + item.height + '</a></td>' +
                                        '<td><a>' + item.hash + '</a></td>' +
                                        '<td>' + intToDate(item.timestamp) + '</td>' +
                                        '<td><span class="label label-' + danger + '">' + luckVal + ' %</span></td>' +
                                        '<td>' + (reward / 1000000).toFixed(6) + '</td>' +
                                        '</tr>';
                                })
                            }

                            $('#block-tag-immature-label').text(response.immatureTotal);
                            $('.block-tag-immature-tbody').html(tbodyOfTable);

                            // Block tag new blocks
                            var candidates = response.candidates;
                            var tbodyOfTable = '<tr><td colspan="5"><h3>No new blocks yet</h3></td></tr>';

                            if (candidates) {
                                tbodyOfTable = '';
                                $.each(candidates, function (key, item) {
                                    var reward = (item.reward).substr(0, 8);
                                    var luck = ((item.shares) / (item.difficulty)) * 100;

                                    tbodyOfTable += '<tr>' +
                                        '<td><a>' + item.height + '</a></td>' +
                                        '<td>' + intToDate(item.timestamp) + '</td>' +
                                        '<td>' + luck.toFixed(0) + ' %</td>' +
                                        '</tr>';
                                })
                            }

                            $('#block-tag-new-blocks-label').text(response.candidatesTotal);
                            $('.block-tag-new-blocks-tbody').html(tbodyOfTable);
                        })
                }

                refreshBlocks();
                setInterval(function () {
                    refreshBlocks();
                }, time);

                $(document).on('click', '.block-tag-mature-tbody a, .block-tag-new-blocks-tbody a, .block-tag-immature-tbody a', function () {
                    var blocks = 'https://explorer.pirl.io/#/block/';

                    $(this)
                        .attr('href', blocks + $(this).text())
                        .attr('target', '_blank');
                });
            })
        })(jQuery)
    </script>
@stop