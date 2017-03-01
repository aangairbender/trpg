<div class="page">
    <div class="page_visitor">
        <div class="page_visitor_index">
            <div class="header">
                <h2>Ваш рюкзак</h2>
            </div>
            <div class="block">
                Занято: <?=$used . "/" .$capacity?>
            </div>
        </div>
    </div>
</div>

<div class="content_separator"></div>
<ul class="block">
    <?php foreach ($items as $t): ?>
    <li>
        <a href="/game/item/<?=$t['id']?>">
            <?=$t['title']?>

            <?php
                switch ($t['rarity'])
                {
                    case 1:
                        echo "<strong style='color: lightgray'>[Обычный]</strong>";
                        break;
                    case 2:
                        echo "<strong style='color: blue'>[Редкий]</strong>";
                        break;
                    case 3:
                        echo "<strong style='color: purple'>[Эпический]</strong>";
                        break;
                    case 4:
                        echo "<strong style='color: orange'>[Легендарный]</strong>";
                        break;
                }
                echo "[x" . $t['amount'] ."]";
            ?>
        </a>
    </li>
    <?php endforeach; ?>
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