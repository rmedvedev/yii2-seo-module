Настройка
=========

Для установки данного модуля добавьте в секцию modules файла настроек Yii2 следующую запись:

~~~
'seo' => \rusmd89\seo\SeoModule::class
~~~

в секцию components добавьте следующий код:
```php
    'seo' => [
        'class' => \rusmd89\seo\components\Seo::class,
        'cacheExpire' => 24 * 3600, //время жизни кэша
    ],
```

Быстрый старт
----------------------------------------
Добавим в настройки компоненты следующий код:
```php
   'params' => [
                'article' => ArticleRoute::class,
               ],

```

Создадим файл ArticleRoute.php:
```php
class ArticleRoute implements \rusmd89\seo\classes\RouteParameter
{
    public function getModel($attribute)
    {
        return Article::findOne($attribute);
    }
}
```

В админке SEO модуля можно добавить seo теги на любые страницы,
роутинг страниц необходимо задавать регулярными выражениями.

Добавим запись в SEO админке по адресу /seo/seo-pages

Поле Route =
~~~
/article/(?P<article\d+>)
~~~

Поле Title = 
~~~
Пример {{ article.title }}
~~~

Тогда на странице /article/1 для записи в таблице article с полем
title = "Заголовок 1" будет задан seo тег title  = 'Пример Заголовок 1'


