# Описание
Тестовое задание #1


# Требования для запуска
- php 7.1 и выше
- composer 1.6.3 и выше

# Конфигурация и запуск
Скрипт start.sh в корне проекта, запуск в один поток:
```sh
#!/bin/sh
composer install
composer dump-autoload --optimize
export seo_file_path="seo_test.csv"
export cookies="seo=test;"
vendor/phpunit/phpunit/phpunit tests/SEOTest.php
```

Скрипт start_parallel.sh, запуск в параллели, по умолчанию количество потоков равно количеству свободных процессоров:

```sh
#!/bin/sh
composer install
composer dump-autoload --optimize
export seo_file_path="seo_test.csv"
export cookies="seo=test;"
find tests/SEOTest.php | php vendor/liuggio/fastest/fastest -v
```

где:
- seo_file_path - путь до csv файла с seo-данными;
- cookies - строка с необходимыми cookie-данными, передаваемыми в seo-адреса

# Отчет

Отчет формируется в консоле запуска (для сохранения отчета в конец sh-файла запуска можно добавить ` > report.txt`)

```sh
PHPUnit 7.0.1 by Sebastian Bergmann and contributors.

...F..F.                                                            8 / 8 (100%)

Time: 9.81 seconds, Memory: 6.00MB

There were 2 failures:

1) Tests\SEOTest::testTitle with data set #3 ('https://www.sports.ru/hockey/', 'Хоккей России и мира, новости...аблицы', 'Свежие новости российского и ...ьщиков')
Titles is not equals on url: https://www.sports.ru/hockey/
Failed asserting that two strings are equal.
--- Expected
+++ Actual
@@ @@
-'Хоккей России и мира, новости хоккея, КХЛ, онлайн трансляции, видео голов, трансферы, результаты, статистика, таблицы'
+'Хоккей России и мира, новости хоккея, КХЛ, НХЛ, Евротур, онлайн трансляции, видео голов, трансферы, результаты, статистика, таблицы'

/Users/Vadim/Downloads/test-task-1-master/tests/SEOTest.php:41

2) Tests\SEOTest::testDescription with data set #2 ('https://www.sports.ru/tennis/', 'Теннис России и мира, новости...йтинги', 'Свежие новости тенниса, онлай...стика.')
Meta descriptions is not equals on url: https://www.sports.ru/tennis/
Failed asserting that two strings are equal.
--- Expected
+++ Actual
@@ @@
-'Свежие новости тенниса, онлайн трансляции, статистика.'
+'Свежие новости тенниса, онлайн трансляции, статистика, видео, рейтинги, турниры Большого шлема. Блоги теннисистов и тренеров, форумы болельщиков'

/Users/Vadim/Downloads/test-task-1-master/tests/SEOTest.php:54

FAILURES!
Tests: 8, Assertions: 8, Failures: 2.

```
