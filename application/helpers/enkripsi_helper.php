<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
function encrypt_url($s)
{
    $cryptKey    = 'd8578edf8458ce06fbc5bb76a58c5ca4';
    $qEncoded    = base64_encode($s . $cryptKey);
    return ($qEncoded);
}
function decrypt_url($s)
{
    $cryptKey    = 'd8578edf8458ce06fbc5bb76a58c5ca4';
    $qDecoded    = base64_decode($s . $cryptKey);
    return ($qDecoded);
}
