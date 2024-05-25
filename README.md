# yii2-test

Развертка проекта.

1. Склонировать проект из гит-репозитория:

        git clone  https://github.com/artembox2020/yii2-test.git <foldername> -b master

2. Загрузить необходимые вендорные библиотеки:

        composer update

3. Содержимое файла config/db-sample.php скопировать в config/db.php, настроить подключение к вашей БД. Структуру БД импортировать из корневого файла db.sql.

4. Настроить корневую папку проекта, это должна быть папка web. На виртуальных хостингах, где корневая папка имеет фиксированное имя(public_hml, htdocs), создайте соответствующую симлинку, например:

        ln -s web public_html 

5. Готово!
