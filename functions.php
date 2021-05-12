<?php

function strRandom($length) {
    $string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle(str_repeat($string, $length)), 0, $length);
}

