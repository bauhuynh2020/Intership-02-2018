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
                            <h6 class="panel-title">Total payments sent</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="total-payment-sent">0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total amounts</h6>
                        </div>
                        <div class="panel-body">
                            <h2 class="text-bold" id="total-amounts">0</h2>
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
                                <th class="col-lg-2">Time</th>
                                <th class="col-lg-1">Amount</th>
                                <th class="col-lg-3">Address</th>
                                <th class="col-lg-4">Tx ID</th>
                            </tr>
                            </thead>
                            <tbody id="payments-tbody">
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h2>Loading...</h2>
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
                var refreshPayments = function () {
                    $.ajax({
                        url: '{{ config('pool_config.api.host') }}payments',
                        method: 'get'
                    })
                        .done(function (response) {
                            var payments = response.payments;
                            var tbodyOfTable = '';
                            var totalAmounts = 0;

                            $.each(payments, function (key, item) {
                                totalAmounts = totalAmounts + item.amount;

                                tbodyOfTable += '<tr>' +
                                    '<td>' + intToDate(item.timestamp) + '</td>' +
                                    '<td>' + balancePrice(item.amount) + '</td>' +
                                    '<td><a data-toggle="address">' + item.address + '</a></td>' +
                                    '<td><a data-toggle="tx">' + item.tx + '</a></td>' +
                                    '</tr>';
                            })
                            $('#payments-tbody').html(tbodyOfTable);

                            $('#total-payment-sent').text(response.paymentsTotal);
                            $('#total-amounts').text(balancePrice(totalAmounts).toFixed(6));
                        })
                }

                refreshPayments();
                setInterval(function () {
                    refreshPayments();
                }, time);

                $(document).on('click', 'tbody a', function () {
                    switch ($(this).data('toggle')) {
                        case 'address':
                            $(this).attr('href', '{{ config('pool_config.block_explorer.addr') }}' + $(this).text());
                            break;
                        default:
                            $(this).attr('href', '{{ config('pool_config.block_explorer.tx') }}' + $(this).text());
                            break;
                    }
                    $(this).attr('target', '_blank');
                });
            })
        })(jQuery)
    </script>
@stop