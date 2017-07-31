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


<!--<div class="block">
    <a style="color:rgb(234,28,52);" href="/game/startpve/<?=$real_id?>"><strong>Атаковать</strong></a>
</div>-->

<?php
  $path = __DIR__ . "/npc_views/id" . $id . "_view.php";
  if(file_exists($path)) include($path);
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
