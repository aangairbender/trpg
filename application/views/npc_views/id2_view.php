<br />
<div style="background-color: inherit; color:orange; font-weight:bold;"> -Йоу, у меня тут есть кое-что интересное. Посмотришь?</div>
<ul class="block">
    <?php foreach ($data['items'] as $t): ?>
    <li>
        <?=$this->helper->itemTitle($t['title'], $t['rarity'], "/game/watchitem/".$t['id']);?> - <b><?=$t['cost']?></b> монет
        <a href="/game/npc/<?=$id?>/action/<?=$t['id']?>">[Купить]</a>
    </li>
    <?php endforeach; ?>
</ul>
