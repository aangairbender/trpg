<div class="page">
    <div class="page_visitor">
        <div class="page_visitor_index">
            <div class="header">
                <h2><?=$username?></h2>
            </div>
        </div>
    </div>
</div>

<div class="content_separator"></div>
<ul class="block">
    <li>
        <?=$online==1?"<span style='color:rgb(134, 216, 0);'>Онлайн</span>":"<span style='color:rgb(239, 0, 27);'>Оффлайн</span>"?>
    </li>
    <li>
        Уровень: <?=$level?>
    </li>
    <li>
        Опыт: <?=$exp?>
    </li>
    <br />
    <li>
        Сила: <?=$strength?>
    </li>

    <li>
        Ловкость: <?=$agility?>
    </li>

    <li>
        Интеллект: <?=$intelligence?>
    </li>

    <br />
    <li>
        Бонус к урону: <?=$damage_bonus?>
    </li>
    <li>
        Множитель урона: <?=$damage_multiplier?>
    </li>
    <br />
    <li>Грузоподъемность: <?=$equipment_bag['used']."/".$equipment_bag['capacity']?></li>
    <br />
    <li>Голова: <?=($slots['head']['real_id']==0?"[Пусто]":$this->helper->itemTitle($slots['head']['title'],$slots['head']['rarity'],'/game/item/'.$slots['head']['real_id']))?></li>
    <li>Туловище: <?=($slots['body']['real_id']==0?"[Пусто]":$this->helper->itemTitle($slots['body']['title'],$slots['body']['rarity'],'/game/item/'.$slots['body']['real_id']))?></li>
    <li>Правая рука: <?=($slots['hand1']['real_id']==0?"[Пусто]":$this->helper->itemTitle($slots['hand1']['title'],$slots['hand1']['rarity'],'/game/item/'.$slots['hand1']['real_id']))?></li>
    <li>Левая рука: <?=($slots['hand2']['real_id']==0?"[Пусто]":$this->helper->itemTitle($slots['hand2']['title'],$slots['hand2']['rarity'],'/game/item/'.$slots['hand2']['real_id']))?></li>
    <li>Ноги: <?=($slots['feet']['real_id']==0?"[Пусто]":$this->helper->itemTitle($slots['feet']['title'],$slots['feet']['rarity'],'/game/item/'.$slots['feet']['real_id']))?></li>
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