<?php

namespace Modules\Backend\Models;

class Group extends \Phalcon\Mvc\Model {
	public function initialize() {
		$this->setConnectionService ( 'db' );
		$this->setSource('groups');
	}
}