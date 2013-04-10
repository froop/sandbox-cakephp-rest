<?php
class SamplesController extends AppController {
	public $uses = array('Sample');
	public $components = array('RequestHandler', 'LastModified');

	/**
	 * 一覧データを JSON で取得.
	 * GET /samples
	 */
	function index() {
		$list = $this->Sample->sortByModified();

		if (!$this->LastModified->check($this->_getDataModified($list))) {
			$this->_responseNotModified();
			return;
		}

		$this->_responseJson(array(
				'key1' => 'value1',
				'list' => $list
		));
	}

	/**
	 * 詳細データを JSON で取得.
	 * GET /samples/:id
	 */
	function view($id) {
		$result = $this->Sample->findById($id);
		if (!$result) {
			$this->_responseNotFound();
			return;
		}
		$this->_responseJson($result['Sample']);
	}

	/**
	 * 詳細データを追加.
	 * POST /samples
	 */
	function add() {
		$this->_save();
	}

	/**
	 * 詳細データを更新.
	 * POST /samples/:id
	 */
	function edit($id) {
		if (!$this->Sample->findById($id)) {
			$this->_responseNotFound();
			return;
		}
		$this->Sample->id = $id;
		$this->_save();
	}


	/**
	 * Database INSERT or UPDATE.
	 */
	private function _save() {
		$success = $this->Sample->save($this->params['form']);
		if (!$success) {
			$errors = $this->Sample->invalidFields();
			$this->_responseBadRequest($errors['text1']);
			return;
		}
		$this->set('output', 'Saved');
		$this->render('/commons/message');
	}

	/**
	 * 表示対象データの一番新しい更新日時を取得.
	 * @param array $list
	 * @return NULL|DateTime
	 */
	private function _getDataModified(array $list) {
		if (!isset($list[0])) {
			return null;
		}
		$modified = new DateTime($list[0]['Sample']['modified']);
		return $modified;
	}

	private function _responseJson($output) {
		$this->set('output', $output);
		$this->render('/commons/json');
	}

	private function _responseBadRequest($message) {
		$this->header('HTTP/1.1 400 Bad Request');
		$this->set('output', $message);
		$this->render('/commons/message');
	}

	private function _responseNotFound() {
		$this->header('HTTP/1.1 404 Not Found');
		$this->render('/commons/empty');
	}

	private function _responseNotModified() {
		$this->header('HTTP/1.1 304 Not Modified');
		$this->render('/commons/empty');
	}
}
