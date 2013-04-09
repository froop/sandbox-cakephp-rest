sandbox-cakephp-rest
====================

CakePHP (ver1.3) で REST を試す。

Libraries
--------------------

### CakePHP 1.3

https://github.com/cakephp/cakephp/zipball/1.3.15

* application/app/config
* application/cake
* application/plugins
* application/vendors


### jQuery 1.9

http://jquery.com/

* application/app/webroot/js/lib/jquery.js


### jQuery URL Parser plugin

https://github.com/allmarkedup/jQuery-URL-Parser

* application/app/webroot/js/lib/purl.js


### MySQL Connector/J (テストDB作成用)

http://www-jp.mysql.com/downloads/connector/j/

* database/lib/mysql-connector-java-*-bin.jar


Config
--------------------

### application/app/config/routes.php

    // REST API
    Router::connect(
        '/api/:controller',
        array('action' => 'index', '[method]' => 'GET')
    );
    Router::connect(
        '/api/:controller',
        array('action' => 'add', '[method]' => 'POST')
    );
    Router::connect(
        '/api/:controller/:id',
        array('action' => 'view', '[method]' => 'GET'),
        array('id' => '[0-9]+', 'pass' => array('id'))
    );
    Router::connect(
        '/api/:controller/:id',
        array('action' => 'edit', '[method]' => 'POST'),
        array('id' => '[0-9]+', 'pass' => array('id'))
    );
    //// RESTのデフォルトルールを使用の場合は下記を指定
    //Router::mapResources('samples');
    
    // 拡張子でリソースの種類を判断 (利用するにはURLの末尾に「.json」を付加)
    Router::parseExtensions('json');


### application/app/config/database.php

$default の `'encoding' => 'utf8'` コメント解除
