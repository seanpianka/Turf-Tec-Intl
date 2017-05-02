<?php

function subgroup_array($array, $group_size)
{
    $arr = array();

    for ($i = 0; $i < count($array); $i += $group_size)
    {
        array_push($arr, array_slice($array, $i, $group_size));
    }

    return $arr;
}