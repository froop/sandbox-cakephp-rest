<?php
class SamplesController extends AppController {
	var $name = 'Samples';
	var $uses = array("Sample");
	var $components = array('RequestHandler');

	function index() {
		$output = array(
				'key1' => 'value1',
				'list' => $this->Sample->find('all', array(
						'fields' => array('id', 'text1', 'modified')))
		);
		$this->set('output', $output);
	}
}
