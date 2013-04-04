<?php
class SamplesController extends AppController {
	var $components = array('RequestHandler');
	var $uses = array();

	function index() {
		$output->sample = array(
			'key1' => 'value1',
			'key2' => array(
				array('key21' => 'value21', 'key22' => 21),
				array('key21' => 'value22', 'key22' => 22)
			)
		);
		$this->set('output', $output);
	}
}
