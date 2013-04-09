<?php
class SamplesController extends AppController {
	public $uses = array('Sample');
	public $components = array('RequestHandler');

	/**
	 * 一覧データを JSON で取得.
	 * GET /samples
	 */
	function index() {
		$list = $this->Sample->find('all', array(
				'fields' => array('id', 'text1', 'modified'),
				'order' => array('modified DESC')));

		$dataModified = $this->_getDataModified($list);
		if ($dataModified) {
			$beforeModified = $this->_getHeaderModified();
			if ($beforeModified && $beforeModified >= $dataModified) {
				$this->_responseNotModified();
				return;
			}
			$this->header('Last-Modified: '
					. $dataModified->format('D, d M Y H:i:s') . ' GMT');
		}

		$this->_outputJson(array(
				'key1' => 'value1',
				'list' => $list
		));
	}

	private function _getDataModified($list) {
		if (!isset($list[0])) {
			return null;
		}
		$modified = new DateTime($list[0]['Sample']['modified']);
		$modified->setTimeZone(new DateTimeZone('GMT'));
		return $modified;
	}

	private function _getHeaderModified() {
		$requestHeaders = apache_request_headers();
		if (!isset($requestHeaders["If-Modified-Since"])) {
			return null;
		}
		return new DateTime($requestHeaders["If-Modified-Since"]);
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
		$this->_outputJson($result['Sample']);
	}

	private function _outputJson($output) {
		$this->set('output', $output);
		$this->render('json');
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

	private function _save() {
		$success = $this->Sample->save($this->params['form']);
		if (!$success) {
			$errors = $this->Sample->invalidFields();
			$this->_responseBadRequest($errors['text1']);
			return;
		}
		$this->set('output', 'Saved');
		$this->render('message');
	}

	private function _responseBadRequest($message) {
		$this->header('HTTP/1.1 400 Bad Request');
		$this->set('output', $message);
		$this->render('message');
	}

	private function _responseNotFound() {
		$this->header('HTTP/1.1 404 Not Found');
		$this->render('empty');
	}

	private function _responseNotModified() {
		$this->header('HTTP/1.1 304 Not Modified');
		$this->render('empty');
	}
}
