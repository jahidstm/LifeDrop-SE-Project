<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-format', function () {
    return ["message" => "Hello World", "status" => 200];
});
