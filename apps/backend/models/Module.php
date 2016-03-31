<?php

namespace Modules\Backend\Models;

class Module extends \Phalcon\Mvc\Model {
	public function initialize() {
		$this->setConnectionService ( 'crm' );
	}
}