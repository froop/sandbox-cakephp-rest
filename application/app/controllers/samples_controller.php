<?php
class SamplesController extends AppController {
	var $components = array('RequestHandler');
	var $uses = array();

	function index() {
		$output->sample = array(
				array('key1' => 'value1', 'key2' => 123)
		);
		$this->set('output', $output);
	}
}
