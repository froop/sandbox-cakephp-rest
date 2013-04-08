<?php
class Sample extends AppModel {
	public $useTable = 'samples';
	public $primaryKey = 'id';

	public $validate = array(
		"text1" => array(
			"notEmpty"	=> array("rule" => "notEmpty"),
		),
	);
}
