<?php

class Helper
{
    const RARITIES = array(
        "1" => array(
            "color" => "#FFFFFF",
            "title" => "Обычный",
        ),
        "2" => array(
            "color" => "#0070FF",
            "title" => "Редкий",
        ),
        "3" => array(
            "color" => "#A335EE",
            "title" => "Эпический",
        ),
        "4" => array(
            "color" => "#FF8000",
            "title" => "Легендарный",
        )
    );

    public function itemTitle($title, $rarity,  $anchor = null, $amount = null)
    {
        $resHtml = sprintf("<strong style=\"color:%s;\">%s</strong>", Helper::RARITIES[$rarity]['color'], $title);
        if($anchor)
            $resHtml = sprintf("<a href=\"%s\">%s</a>",$anchor,$resHtml);
        if($amount)
            $resHtml .= sprintf("[x%d]", $amount);
        return $resHtml;
    }

    public function showRarity($rarity)
    {
        return sprintf("<span style=\"color:%s;\">%s</span>",Helper::RARITIES[$rarity]['color'], Helper::RARITIES[$rarity]['title']);
    }


    public function processBB($s)
    {
        $s = preg_replace('/\[c=(.*?)\](.*?)\[\/c\]/is','<span style="color: $1;">$2</span>',$s); // colors
        $s = preg_replace('/\[br\]/is','<br />',$s); // new lines
        return $s;
    }

}
