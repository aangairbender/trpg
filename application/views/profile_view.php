<div class="page">
    <div class="page_visitor">
        <div class="page_visitor_index">
            <div class="header">
                <h2><?=$username?></h2>
            </div>
        </div>
    </div>
</div>

<div class="content_separator"></div>
<ul class="block">
    <li>
        <?=$online==1?"<span style='color:lightgreen;'>Онлайн</span>":"<span style='color:darkgray;'>Оффлайн</span>"?>
    </li>
    <li>
        Уровень: <?=$level?>
    </li>
    <li>
        Опыт: <?=$exp?>
    </li>

    <li>
        Сила: <?=$str?>
    </li>

    <li>
        Выносливость: <?=$vit?>
    </li>

    <li>
        Ловкость: <?=$dex?>
    </li>
</ul>


<div class="content_separator"></div>
<ul class="navigation">
    <li>
        <a href="/game/">
            <span class="body">
                <span class="icon_sprite icon_travel"></span>
                Назад
            </span>
        </a>
    </li>
</ul>