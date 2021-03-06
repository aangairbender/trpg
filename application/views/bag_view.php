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
        <?=$this->helper->itemTitle($t['title'], $t['rarity'], "/game/item/".$t['real_id'],$t['amount']);?>
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