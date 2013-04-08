<?php
class Sample extends AppModel {
	public $name = 'Sample';

	public $validate = array(
		"text1" => array(
			"notEmpty"	=> array("rule" => "notEmpty"),
		),
	);
}
