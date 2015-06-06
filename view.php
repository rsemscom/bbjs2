<html>
<head>
    <link rel="stylesheet" href="css/site.css"/>
    <title>Controll Datebase With Ajax</title>
</head>
<body>

<form action="I don`t know what i whant to do=)" method = "POST">
    <label for = "select_type">Выберите операцию</label>
    <select id = "select_type">
        <option value="POST">Добавить</option>
        <option value="DELETE">Удалить</option>
        <option value="PUT">Обновить</option>
        <option value="GET">Получить</option>
    </select>
    <label for = "select_model">Выберите модель</label>
    <select id = "select_model">
        <option value="hotel">Отель</option>
        <option value="country">Страна</option>
    </select>
    <label>Название
    <input id="name" type="text"/></label>
    <label>Id
    <input id="id" type="text"/></label>

    <label>Страна
    <input id="country" type="text"/></label>

    <label>Описание
        <textarea id="description"></textarea></label>

    <input type="submit" value="Ок"/>
</form>
<div id="popup" class="popup">
    <div class="cell">
        <div class="window">
            <div id="head" class="head"></div>
            <div id="content" class="content"></div>
            <input id="popup_ok" type="button" value="Ок">
        </div>
    </div>
</div>


<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="script/main.js"></script>
</body>
</html>