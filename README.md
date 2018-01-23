Организация мультиязычности
===========================
Результаты переработки статьи с хабра https://habrahabr.ru/post/226931/

Решен вопрос дубляжа url. Т.е.

```
mysite.ru
mysite.ru/ru 
mysite.ru/en
```

отрабатывают корректно, при доступе на `mysite.ru` открывается сайт по дефолтному языку, 
`mysite.ru/ru` дает ошибку 404 (т.к. `ru` по умолчанию), `mysite.ru/en` открывает английскую версию сайта

Установка
------------

Выполните
```
composer require --prefer-dist alpiiscky/yii2-multilang "*"
```

или добавьте

```
"alpiiscky/yii2-multilang": "*"
```

в раздел require вашего `composer.json` файла.


Использование
-----
Отредактировать `web.php` согласно следующим пунктам:

1. добавить в разделе `components`:
```
'request' => [
    'class' => 'alpiiscky\multilang\components\LangRequest',
    'cookieValidationKey' => '<your code>',
],
```

2. В `urlManager` надо добавить:
```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'class'=>'alpiiscky\multilang\components\LangUrlManager',
    'rules' => [
        '/' => 'site/index',
        '<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
    ]
```

Миграции
-----
```php
php yii migrate --migrationPath=vendor/alpiiscky/yii2-multilang/migrations/
```

Виджет выбора языка
-----
```php
<?= \alpiiscky\multilang\widgets\LanguageWidget::widget([]); ?>
```


Создание url
-----
```php
<?php
use alpiiscky\multilang\helpers\Url;
use alpiiscky\multilang\models\Language;

$current_lang = Language::getCurrent();
?>


<?= Url::toLang('/book', ['lang_id' => $current_lang->id]) ?>
```