<div class="page">
    <div class="page_visitor">
        <div class="page_visitor_index">
            <div class="header">
                <h2><?=$title?></h2>
            </div>
            <div class="block">
                <?=$description?>
            </div>
        </div>
    </div>
</div>

<div class="content_separator"></div>
<ul class="navigation">
    <?php foreach ($mobs as $t):?>
        <li>
            <a href="/game/mob/<?=$t['id']?>">
            <span class="body">
                <span class="icon_sprite icon_mob"></span>
                <?=$t['title']?>
            </span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<div class="content_separator"></div>
<ul class="navigation">
    <?php foreach ($characters as $t):?>
    <li>
        <a href="/game/profile/<?=$t['id']?>">
            <span class="body">
                <span class="icon_sprite icon_travel"></span>
                <?=$t['username']?>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

<div class="content_separator"></div>
<ul class="navigation">
    <?php foreach ($transitions as $t):?>
    <li>
        <a href="/game/goto/<?=$t['id']?>">
            <span class="body">
                <span class="icon_sprite icon_travel"></span>
                <?=$t['title']?>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>