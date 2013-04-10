<?php
class LastModifiedComponent extends Object {

	function initialize(Controller $controller) {
		$this->controller = $controller;
	}

	/**
	 * クライアントへの前回の応答後にデータに変更があったか確認.
	 * @param DateTime $dataModified
	 * @return boolean 変更ありなら true
	 */
	function check(DateTime $dataModified) {
		if ($dataModified) {
			$currentTime = clone $dataModified;
			$currentTime->setTimeZone(new DateTimeZone('GMT'));
			$prevTime = $this->_getHeaderModified();
			if ($prevTime && $prevTime >= $currentTime) {
				return false;
			}
			$this->controller->header('Last-Modified: '
					. $currentTime->format('D, d M Y H:i:s') . ' GMT');
		}
		return true;
	}

	/**
	 * HTTP リクエストヘッダーの If-Modified-Since の日時を取得.
	 * @return NULL|DateTime
	 */
	private function _getHeaderModified() {
		$requestHeaders = apache_request_headers();
		if (!isset($requestHeaders["If-Modified-Since"])) {
			return null;
		}
		return new DateTime($requestHeaders["If-Modified-Since"]);
	}
}
