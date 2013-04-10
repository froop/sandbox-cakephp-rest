<?php
class ResponseComponent extends Object {

	function initialize(Controller $controller) {
		$this->controller = $controller;
	}

	function setJson($output) {
		$this->controller->header('Content-type: application/json');
		$this->controller->set('output', $output);
		$this->controller->render('/commons/json');
	}

	function setBadRequest($message) {
		$this->controller->header('HTTP/1.1 400 Bad Request');
		$this->setMessageBody($message);
	}

	function setNotFound() {
		$this->controller->header('HTTP/1.1 404 Not Found');
		$this->setEmptyBody();
	}

	function setNotModified() {
		$this->controller->header('HTTP/1.1 304 Not Modified');
		$this->setEmptyBody();
	}

	private function setMessageBody($output) {
		$this->controller->set('output', $output);
		$this->controller->render('/commons/message');
	}

	private function setEmptyBody() {
		$this->controller->render('/commons/empty');
	}
}
