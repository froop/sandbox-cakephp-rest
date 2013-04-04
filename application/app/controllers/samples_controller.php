<?php
class SamplesController extends AppController {
	var $name = 'Samples';
	var $uses = array("Sample");
	var $components = array('RequestHandler');

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
