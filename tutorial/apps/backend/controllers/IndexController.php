<?php

namespace Modules\Backend\Controllers;

class IndexController extends BaseController{

	public function initialize() {
		parent::initialize();
	}
		
    public function indexAction(){
    	global $userSession;
		$menuParent = $this->query(DB,"SELECT count(id) as total FROM menutop WHERE level = 1")[0]["total"];
		$menuSub 	= $this->query(DB,"SELECT count(id) as total FROM menutop WHERE level = 2")[0]["total"];
		$advertiser = $this->query(DB,"SELECT count(id) as total FROM advertiser")[0]["total"];
    	$this->setView('total',array('menuParent'=>$menuParent,'menuSub'=>$menuSub,'advertiser'=>$advertiser,));
    }
}
