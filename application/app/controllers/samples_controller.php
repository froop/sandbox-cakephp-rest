<?php
class SamplesController extends AppController {
	public $uses = array('Sample');
	public $components = array('RequestHandler', 'Response', 'LastModified');

	/**
	 * 一覧データを JSON で取得.
	 * GET /samples
	 */
	function index() {
		$list = $this->Sample->sortByModified();

		if (!$this->LastModified->check($this->_getDataModified($list))) {
			$this->Response->setNotModified();
			return;
		}

		$this->Response->setJson(array(
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
			$this->Response->setNotFound();
			return;
		}
		$this->Response->setJson($result['Sample']);
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
			$this->Response->setNotFound();
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
			$this->Response->setBadRequest($errors['text1']);
			return;
		}
		_responseEmpty();
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
}
