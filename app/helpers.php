<?php


function show_price($value, $currency = 'idrtoidr')
{
    return number_format($value, $currency != 'idrtoidr' ? 2 : 0, ',', ',');
}
