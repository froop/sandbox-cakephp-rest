<?php
class SamplesController extends AppController {
	var $name = 'Samples';
	var $uses = array('Sample');
	var $components = array('RequestHandler');

	function index() {
		$this->_outputJson(array(
				'key1' => 'value1',
				'list' => $this->Sample->find('all', array(
						'fields' => array('id', 'text1', 'modified')))
		));
	}

	function view($id) {
		$result = $this->Sample->findById($id);
		$this->_outputJson($result['Sample']);
	}

	private function _outputJson($output) {
		$this->set('output', $output);
	}

	function add() {
		$this->_save();
	}

	function edit($id) {
		$this->Sample->id = $id;
		$this->_save();
	}

	private function _save() {
		if ($this->Sample->save($this->params['form'])) {
			$output = 'Saved';
		} else {
			$this->header('HTTP/1.1 400 Bad Request');
			$errors = $this->Sample->invalidFields();
			$output = $errors['text1'];
		}
		$this->set('output', $output);
		$this->render('message');
	}
}
