<?php
class ResponseComponent extends Object {

	function initialize(Controller $controller) {
		$this->controller = $controller;
	}

	function setBadRequest($message) {
		$this->controller->header('HTTP/1.1 400 Bad Request');
		$this->setMessage($message);
	}

	function setNotFound() {
		$this->controller->header('HTTP/1.1 404 Not Found');
		$this->setEmpty();
	}

	function setNotModified() {
		$this->controller->header('HTTP/1.1 304 Not Modified');
		$this->setEmpty();
	}

	function setJson($output) {
		$this->controller->set('output', $output);
		$this->controller->render('/commons/json');
	}

	function setMessage($output) {
		$this->controller->set('output', $output);
		$this->controller->render('/commons/message');
	}

	function setEmpty() {
		$this->controller->render('/commons/empty');
	}
}
