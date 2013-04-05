<?php
class SamplesController extends AppController {
	var $name = 'Samples';
	var $uses = array("Sample");
	var $components = array('RequestHandler');

	function index() {
		$output = array(
				'key1' => 'value1',
				'key2' => array(
						array('key21' => 'value21', 'key22' => 21),
						array('key21' => '日本語22', 'key22' => 22)),
				'key3' => $this->Sample->find('all', array(
						'fields' => array('id', 'text1', 'modified')))
		);
		$this->set('output', $output);
	}
}
