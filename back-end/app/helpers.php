<?php


function implode_recursive(string $separator, array $array): string
{
    $string = '';
    foreach ($array as $i => $a) {
        if (is_array($a)) {
            $string .= $i . ': ' . implode_recursive($separator, $a) . ', ';
        } else {
            $string .= $a;
            if ($i < count($array) - 1) {
                $string .= $separator;
            }
        }
    }

    return $string;
}
