<div class="page">
    <div class="page_visitor">
        <div class="page_visitor_index">
            <div class="header">
                <h2><?=$this->helper->itemTitle($title, $rarity); ?></h2>
            </div>
            <div class="block">
                <?=$description?>
            </div>
            <div class="block">
                Редкость:
                <br />
                <?=$this->helper->showRarity($rarity);?>
            </div>
            <div class="block">
                Бонусы:
                <br />
                <?=$this->helper->processBB($bonuses);?>
            </div>
            <div class="block">
                Вес:
                <br />
                <?=$size?>
            </div>
        </div>
    </div>
</div>

<?php
    if($show_actions)
        include('/item_actions_view.php')
?>




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

