<?php foreach ($actions as $a): ?>

<div class="block">
    <a style="color:lawngreen;"href="/game/itemaction/<?=$a['id']?>"><?=$a['title']?></a>
</div>

<?php endforeach; ?>

<div class="block">
    <a style="color:darkred;" href="/game/itemdrop/<?=$id?>/1"><strong>Выбросить</strong></a>
</div>
