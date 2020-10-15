A MVC framework from scratch with using of the design pattern Front Controller and PHPQuery for page rendering.

If you are looking for PHPQuery's doc :
    Packagist : <https://packagist.org/packages/somesh/php-query>
    Github : <https://github.com/slaith/phpQuery>

Instructions:
    git clone https://gitlab.com/rachid_ettabaai/front-controller-with-phpquery.git
    cd front-controller-with-phpquery
    composer install
    mysql --user="username" -p < "sql/schema.sql" (using MySQL id)
    php -S localhost:8080 -t public/