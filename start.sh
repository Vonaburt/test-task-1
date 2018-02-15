#!/bin/sh
composer install
composer dump-autoload --optimize
export seo_file_path="seo_test.csv"
export cookies="seo=test;"
vendor/phpunit/phpunit/phpunit tests/SEOTest.php