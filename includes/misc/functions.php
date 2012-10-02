<?php

/**
 * Remove HTML tags, including invisible text such as style and
 * script code, and embedded objects.  Add line breaks around
 * block-level tags to prevent word joining after tag removal.
 *
 * @param <type> $text
 * @return <type>
 */
function strip_html_tags($text) {
    // PHP's strip_tags() function will remove tags, but it
    // doesn't remove scripts, styles, and other unwanted
    // invisible text between tags.  Also, as a prelude to
    // tokenizing the text, we need to insure that when
    // block-level tags (such as <p> or <div>) are removed,
    // neighboring words aren't joined.
    $text = preg_replace(
            array(
        // Remove invisible content
        '@<head[^>]*?>.*?</head>@siu',
        '@<style[^>]*?>.*?</style>@siu',
        '@<script[^>]*?.*?</script>@siu',
        '@<object[^>]*?.*?</object>@siu',
        '@<embed[^>]*?.*?</embed>@siu',
        '@<applet[^>]*?.*?</applet>@siu',
        '@<noframes[^>]*?.*?</noframes>@siu',
        '@<noscript[^>]*?.*?</noscript>@siu',
        '@<noembed[^>]*?.*?</noembed>@siu',
        // Add line breaks before & after blocks
        '@<((br)|(hr))@iu',
        '@</?((address)|(blockquote)|(center)|(del))@iu',
        '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
        '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
        '@</?((table)|(th)|(td)|(caption))@iu',
        '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
        '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
        '@</?((frameset)|(frame)|(iframe))@iu',
            ), array(
        ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
        "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
        "\n\$0", "\n\$0",
            ), $text);

    // Remove all remaining tags and comments and return.
    return strip_tags($text);
}

function bb2html($text) {
    $bbcode = array("<", ">",
        "[list]", "[*]", "[/list]",
        "[center]", "[/center]",
        "[img]", "[/img]",
        "[b]", "[/b]",
        "[u]", "[/u]",
        "[i]", "[/i]",
        '[color="', "[/color]",
        "[size=\"", "[/size]",
        '[url="', "[/url]",
        "[mail=\"", "[/mail]",
        "[code]", "[/code]",
        "[quote]", "[/quote]",
        '"]');
    $htmlcode = array("&lt;", "&gt;",
        "<ul>", "<li>", "</ul>",
        "<center>", "</center>",
        "<img src=\"", "\">",
        "<b>", "</b>",
        "<u>", "</u>",
        "<i>", "</i>",
        "<span style=\"color:", "</span>",
        "<span style=\"font-size:", "</span>",
        '<a href="', "</a>",
        "<a href=\"mailto:", "</a>",
        "<code>", "</code>",
        "<table width=100% bgcolor=lightgray><tr><td bgcolor=white>", "</td></tr></table>",
        '">');
    $newtext = str_replace($bbcode, $htmlcode, $text);
    $newtext = nl2br($newtext); //second pass
    return $newtext;
}

$unit = "M";

function distance($lat1, $lon1, $lat2, $lon2, $unit, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}







//language specific number formatting
// de

function de_number_format($number)
{
   number_format($number, 2, ',', '.'); 
}

function en_number_format($number)
{
// en
number_format($number, 2, '.', ',');
}
?>