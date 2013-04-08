<?php
class PagesController extends AppController {
	public $uses = array();

	function display() {
		$this->redirect('/files/');
	}
}
