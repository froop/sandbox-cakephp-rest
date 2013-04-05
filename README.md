sandbox-cakephp-rest
====================

CakePHP (ver1.3) で REST を試す。


Config
--------------------

### application/app/config/routes.php

* 末尾に追加

	// 拡張子でリソースの種類を判断 (利用するにはURLの末尾に「.json」を付加)
	Router::parseExtensions('json');

### application/app/config/database.php

* $default の `'encoding' => 'utf8'` コメント解除
