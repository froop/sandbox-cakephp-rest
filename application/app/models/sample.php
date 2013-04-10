<?php
class Sample extends AppModel {
	public $useTable = 'samples';
	public $primaryKey = 'id';

	public $validate = array(
		"text1" => array(
			"notEmpty"	=> array("rule" => "notEmpty"),
		),
	);

	function sortByModified() {
		return $this->find('all', array(
				'fields' => array('id', 'text1', 'modified'),
				'order' => array('modified DESC')));
	}
}
