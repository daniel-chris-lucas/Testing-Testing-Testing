<?php

Route::get('emailtest', function () {
    Mail::send('emails.welcome', [], function ($message) {
        $message->to('joe@example.com')->subject('welcome');
    });
});
