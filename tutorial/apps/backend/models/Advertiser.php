<?php

namespace Modules\Backend\Models;

class Advertiser extends \Phalcon\Mvc\Model {
	public function initialize() {
		$this->setConnectionService (DB);
	}
}