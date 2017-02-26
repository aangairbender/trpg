<div class="page">
    <?php if(isset($error)): ?>
        <div class="block"><span><?=$error?></span></div>
    <?php endif ?>
    <ul class="block">
        <form method="post">
            <li>
                <label for="gender">Пол:</label>
                <select id="gender" name="gender">
                    <option value="m" selected="selected">Мужской</option>
                    <option value="f">Женский</option>
                </select>
            </li>
            <li>
                <label for="username">Логин:</label>
                <input type="text" class="text" name="username" id="username" size="30">
                <small>Логин должен содержать от 3 до 20 символов.</small>
            </li>
            <li>
                <label for="password">Пароль:</label>
                <input type="password" class="text" name="password" id="password" size="30">
                <small>Пароль должен содержать как минимум 6 символов.</small>
            </li>
            <li>
                <label for="confirm_password">Повторите пароль:</label>
                <input type="password" class="text" name="confirm_password" id="confirm_password" size="30">
            </li>
            <li>
                <div class="block">
                    <input type="submit" value="Регистрация">
                </div>
            </li>
        </form>
    </ul>
</div>