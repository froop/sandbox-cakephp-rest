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

	function view($id) {
		$result = $this->Sample->findById($id);
		$output = $result["Sample"];
		$this->set('output', $output);
	}

	function edit($id) {
		$this->Sample->id = $id;
		if ($this->Sample->save($this->params['form'])) {
			$output = 'Saved';
		} else {
			$output = 'Error';
		}
		$this->set('output', $output);
	}
}
