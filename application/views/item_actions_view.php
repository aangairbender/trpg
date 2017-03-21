<?php foreach ($actions as $a): ?>

<div class="block">
    <a style="color:#d8c904;"href="/game/itemaction/<?=$a['id']?>/<?=$real_id?>"><?=$a['title']?></a>
</div>

<?php endforeach; ?>

<div class="block">
    <a style="color:rgb(234,28,52);" href="/game/itemdrop/<?=$real_id?>/1"><strong>Выбросить</strong></a>
</div>
