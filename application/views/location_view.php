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
<ul>
  <li>
    <span class="body">
      <span class="icon_sprite icon_mob"></span>
      <span>Мобы:</span>
      <ul>
        <?php foreach ($mobs as $t):?>
          <li>
              <a href="/game/mob/<?=$t['id']?>">
              <span>
                  <?=$t['title']?>
              </span>
              </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </span>
  </li>
</ul>

<div class="content_separator"></div>
<ul>
  <li>
    <span class="body">
      <span class="icon_sprite icon_user"></span>
      <span>Персонажи:</span>
      <ul>
        <?php foreach ($npcs as $t):?>
          <li>
              <a href="/game/npc/<?=$t['id']?>">
              <span>
                  <?=$t['title']?>
              </span>
              </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </span>
  </li>
</ul>


<div class="content_separator"></div>
<ul>
  <li>
    <span class="body">
      <span class="icon_sprite icon_travel"></span>
      <span>Поблизости:</span>
      <ul>
        <?php foreach ($transitions as $t):?>
          <li>
              <a href="/game/goto/<?=$t['id']?>"><?=$t['title']?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </span>
  </li>
</ul>
