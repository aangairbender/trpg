<div class="info">
    <?php if($visible == 1): ?>
    <div class="icons">
        <div class="body">
                    <span class="parameter_info">
                        <a href="/game/">
                            <span class="icon_sprite icon_sprite_info_block icon_user"></span>
                            <a href="/game/user/"><strong><?=$username?></strong></a>
                        </a>
                    </span>
            <span class="parameter_info">
                        <a href="/game/">
                            <span class="icon_sprite icon_sprite_info_block icon_level"></span>
                            <span><?=$level?></span>
                        </a>
                    </span>
        </div>
    </div>
    <?php endif; ?>
</div>