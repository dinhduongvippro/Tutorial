<?php

namespace Modules\Frontend\Models;

class MenuTop extends \Phalcon\Mvc\Model {
	public function initialize() {
		$this->setConnectionService (DB);
	}
}