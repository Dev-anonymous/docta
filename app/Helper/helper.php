<?php

use App\Models\App;

function makeRand($prefix = '', $max = 5)
{
    $max = (int) $max;
    if (!$max or $max <= 0) {
        return 0;
    }

    $num = '';
    while ($max > 0) {
        $max--;
        $num .= rand(1, 9);
    }
    return "$prefix$num-" . time();
}

function uid()
{
    return request()->header('uid');
}

function userapp()
{
    $uid = request()->header('uid');
    return App::where('uid', $uid)->first();
}
