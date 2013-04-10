<?php
class DummiesController extends AppController {
	public $uses = array();

	function sleep() {
		sleep(2);
	}
}
