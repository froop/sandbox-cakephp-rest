sandbox-cakephp-rest
====================

CakePHP (ver1.3) で REST を試す。

Libraries
--------------------

### CakePHP 1.3

https://github.com/cakephp/cakephp/zipball/1.3.15

* application/app/config/*
* application/cake/*


### jQuery 1.9

http://jquery.com/

* application/app/webroot/js/lib/jquery.js


### MySQL Connector/J 5.1 (テストDB作成用)

http://www-jp.mysql.com/downloads/connector/j/

* database/lib/mysql-connector-java-5.1.*-bin.jar


Config
--------------------

### application/app/config/routes.php

* 末尾に追加

	// 拡張子でリソースの種類を判断 (利用するにはURLの末尾に「.json」を付加)
	Router::parseExtensions('json');

### application/app/config/database.php

* $default の `'encoding' => 'utf8'` コメント解除
