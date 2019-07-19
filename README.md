YII2 MODULE TEST FIRST
========
MODULE-TEST-FIRST

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist konstantinks/yii2-module-test-first "*"
```

or add

```
"konstantinks/yii2-module-test-first": "*"
```

to the require section of your `composer.json` file.


Выполнить миграцию для создания нужной таблицы в базе данных (консоль):

```
yii migrate --migrationPath=@KonstantinKS/ModuleTestFirst/migrations --interactive=0
```


Usage
-----

Введите Url а адресной строке  :

*если включено ЧПУ URL:
```
http://NAME/module-test-first
```

*если не включено:
```
http://NAME/web/index.php?r=module-module-test-first/test-one/index
```