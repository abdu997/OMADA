<?php
$text = 'Here is link: https://google.com
And http://omadahq.com inside.
And another one at the very end: http://test.net';

function make_links_clickable($text){
    echo preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a target="_blank" href="$1">$1</a>', $text);
}
echo make_links_clickable($text);
?>