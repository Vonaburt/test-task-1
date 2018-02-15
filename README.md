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
