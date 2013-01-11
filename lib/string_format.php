<?php
function string_format($string, $args) {
    if(!is_array($args) || count($args) == 0) { return $string; }

    $pattern = '|(\{)([A-Za-z0-9\-_]*)(\})|';

    $i = 0;
    $c = count($args) - 1;

    $cb = function($matches) use ($args, &$i, $c) {
        $in = $matches[2];
        $out = $in;

        if($in == '') {
            if(array_key_exists($i, $args)) {
                $out = $args[$i];
                $i++;
            } else {
                $out = $matches[0];
            }
        } else {
            if(array_key_exists($in, $args)) {
                $out = $args[$in];
            } else {
                $out = $matches[0];
            }
        }

        return $out;
    };

    return preg_replace_callback($pattern, $cb, $string);
}
?>