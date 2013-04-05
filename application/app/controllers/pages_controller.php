<?php
class PagesController extends AppController {
	var $uses = array();

	function display() {
		$this->redirect('/files/');
	}
}
