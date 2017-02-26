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
    <li>
        <a href="/auth/signin">
            <span class="body">
                <img height="16" src="/static/images/icon_witch.gif" width="16">
                Карга
            </span>
        </a>
    </li>
    <li>
        <a href="/auth/signup">
            <span class="body">
                <img height="16" src="/static/images/icon_druid.gif" width="16">
                Гендальф
            </span>
        </a>
    </li>
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