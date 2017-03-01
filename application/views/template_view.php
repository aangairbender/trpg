<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Невероятные приключения уже ждут тебя!">
    <meta name="keywords" content>
    <!-- start iphone / android support -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0">
    <!-- end iphone /android support -->
    <title>Восхождение к легенде</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css" />
</head>
<body>
<div id="header">
    <span class="title">Восхождение к легенде</span>
    <?php $this->widget("Widget_Userinfo"); ?>
</div>
<div class="separator"></div>
<div id="content">
    <?php include($content_view);?>
</div>
<div id="footer">
    <div class="text">
        Верстка от Жеки. Все лева защищены.
    </div>
</div>

</body>
</html>