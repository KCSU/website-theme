<?php
function string_format($string, $args) {
    if(!is_array($args) || count($args) == 0) { return $string; }

    $pattern = '|(\{)([A-Za-z0-9\-_\.]*)(\})|';

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
            if(strpos($in, '.') > 0) {
                $in = explode('.', $in);
            } else {
                $in = array($in);
            }

            $capture = $args;
            foreach($in as $part) {
                if(is_array($capture)) {
                    if(array_key_exists($part, $capture)) {
                        $capture = $capture[$part];
                    } else {
                        return $matches[0];
                    }
                } else {
                    return $matches[0];
                }
            }

            $out = $capture;
        }

        return $out;
    };

    return preg_replace_callback($pattern, $cb, $string);
}

function string_truncate($string, $len = 50, $end = '...') {
    $l_end = strlen($end);
    $len = $l_end < $len ? $len - $l_end : 0;

    return substr($string, 0, $len).$end;
}
?>