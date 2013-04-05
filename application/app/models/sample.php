<?php
class Sample extends AppModel {
	var $name = 'Sample';

	var $validate = array(
		"text1" => array(
			"notEmpty"	=> array("rule" => "notEmpty"),
		),
	);
}
