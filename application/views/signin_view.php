<div class="page">
<?php if(isset($error)): ?>
<div class="block"><span><?=$error?></span></div>
<?php endif ?>
    <ul class="block">
        <form method="post">
            <li>
                <label for="username">Логин:</label>
                <input type="text" class="text" name="username" id="username" size="30" autocomplete="off">
            </li>
            <li>
                <label for="password">Пароль:</label>
                <input type="password" class="text" name="password" id="password" size="30" autocomplete="off">
            </li>
            <li>
                <div class="block">
                    <input type="submit" value="Вход">
                </div>
            </li>
        </form>
    </ul>
</div>