#!/bin/sh
composer install
composer dump-autoload --optimize
export seo_file_path="seo_test.csv"
export cookies="seo=test;"
find tests/SEOTest.php | php vendor/liuggio/fastest/fastest -v