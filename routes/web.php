<?php

Route::get('/', function () {
    return view('home');
})->name('get.home');

Route::get('/miners', function () {
    return view('miner');
})->name('get.miners');

Route::get('account/{id}', function () {
    return view('account', array(
        'id' => request()->route('id')
    ));
});

Route::get('/blocks', function () {
    return view('block');
})->name('get.blocks');

Route::get('/payments', function () {
    return view('payment');
})->name('get.payments');
