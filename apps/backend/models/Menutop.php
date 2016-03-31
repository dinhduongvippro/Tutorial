<?php

namespace Modules\Backend\Models;

class Menutop extends \Phalcon\Mvc\Model {
	public function initialize() {
		$this->setConnectionService (DB);
	}
}