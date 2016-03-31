<?php

namespace Modules\Backend\Controllers;
use Modules\Backend\Models\Advertiser;
class AdvertiserController extends BaseController{

	public function initialize() {
		parent::initialize();
	}
		
    public function indexAction(){
    	global $userSession;
		$data = $this->query(DB,"SELECT * FROM advertiser");
		
    	$this->setView('data',$data);
    }
	public function addAction(){
    	global $userSession;
		if ($this->request->isPost()){
			$aParamPost = $this->getParamPost();
			$advertiser = Advertiser::findFirst(array("local = '".$aParamPost["local"]."'"));
			if ($advertiser == false){
				$new = new Advertiser();
				$aParamPost["alt"] = $aParamPost["name"];
				$this->showMessage($new->save($aParamPost), 'Advertiser');
				$this->response->redirect ( "/admin/advertiser");
			}
			else{
				$this->showMessage(3, 'Advertiser');
			}
		}
    }
	public function editAction(){
    	global $userSession;
		$aParam 	= $this->getParamQuery();
		$data = $this->query(DB,"SELECT * FROM advertiser WHERE id =".$aParam["id"]);
		// print_r($data);exit;
		if ($data == true) {
    		$this->setView('result',$data[0]);
    	}else{
    		$this->showMessage(3, 'Advertiser');
    	}
		if ($this->request->isPost()){
			$aParamPost = $this->getParamPost();
			// print_r($aParamPost);exit;
			$advertiser = Advertiser::findFirst(array("local = '".$aParamPost["local"]."' AND id <> ".$aParam["id"]." "));
			if ($advertiser == false){
				$update = Advertiser::findFirst("id = ".$aParam["id"]);
				if ($update == true){
					$aParamPost["alt"] = $aParamPost["name"];
					$this->showMessage($update->update($aParamPost), 'Advertiser');
					$this->response->redirect ( "/admin/advertiser");
				}
			}
			else{
				$this->showMessage(3, 'Advertiser');
			}
		}
    }
	public function deleteAction(){
    	global $userSession;
		$aParamPost = $this->getParamPost();
		if ($aParamPost["select_all"]!=null){
			$menu = Advertiser::findFirst(array("id = ".$aParamPost["select_all"]." AND status <>".ACTIVE));
			if ($menu == true){
				$messenger = $this->alertMessage($menu->delete(), 'Advertiser');
				$temp  =   "/admin/advertiser";$f = 1;
			}
			else{
				$messenger 	= $this->alertMessage(4, 'Advertiser');
				$temp 	 	=   "/admin/advertiser";$f = 0;
			}
		}else{
			$f = 0;
			$messenger 	= $this->alertMessage(0, 'Advertiser');
			$temp  		=  "/admin/advertiser";
		}
		return $this->sendJson(json_encode(array("messenger"=>$messenger,"href"=>$temp,"f"=>$f)));

    }
}
