<?php

if (!function_exists('getUserRole')) {

    function getUserRole()
    {
        return auth()->user()->role ?? null;
    }
}

if (!function_exists('formatDate')) {

    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)
            ->format('d M Y');
    }
}