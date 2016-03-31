<?php

namespace Modules\Backend\Controllers;
use Modules\Backend\Models\MenuTop;
class MenutopController extends BaseController{

	public function initialize() {
		parent::initialize();
	}
		
    public function indexAction(){
    	global $userSession;
		$data = $this->query(DB,"SELECT * FROM menuTop");
		foreach($data as $k=>$v){
			if($v != 0){
				$dataSub = $this->query(DB,"SELECT * FROM menuTop WHERE id = ".$v["numTwo"]);
				$data[$k]["numTwo"] = $dataSub[0]["name"]!=null?$dataSub[0]["name"]:0;
			}
		}
    	$this->setView('data',$data);
    }
	public function addAction(){
    	global $userSession;
		$parent = $this->query(DB,"SELECT * FROM menuTop WHERE level = 1");
		$this->setView('dataParent',$parent);
		if ($this->request->isPost()){
			$aParamPost = $this->getParamPost();
			
			$menu = Menutop::findFirst(array("name = '".$aParamPost["name"]."'"));
			if ($menu == false){
				$new = new Menutop();
				if($aParamPost["level"]==1){
					$aParamPost["numTwo"] = 0;
				}else if($aParamPost["level"]==2){
					$aParamPost["numTwo"] = $aParamPost["parent"];
				}
				$this->showMessage($new->save($aParamPost), 'Menu');
				$this->response->redirect ( "/admin/menutop");
			}
			else{
				$this->showMessage(3, 'Menu');
			}
		}
    }
	public function editAction(){
    	global $userSession;
		$aParam 	= $this->getParamQuery();
		$data = $this->query(DB,"SELECT * FROM menuTop WHERE id =".$aParam["id"]);
		if ($data == true) {
			$parent = $this->query(DB,"SELECT * FROM menuTop WHERE level = 1");
			$this->setView('dataParent',$parent);
    		$this->setView('result',$data[0]);
    	}else{
    		$this->showMessage(3, 'Menu');
    	}
		if ($this->request->isPost()){
			$aParamPost = $this->getParamPost();
			// print_r($aParamPost);exit;
			$menu = Menutop::findFirst(array("name = '".$aParamPost["name"]."' AND id <> ".$aParam["id"]." "));
			if ($menu == false){
				$update = Menutop::findFirst("id = ".$aParam["id"]);
				if ($update == true){
					if($aParamPost["level"]==1){
						$aParamPost["numTwo"] = 0;
					}else if($aParamPost["level"]==2){
						$aParamPost["numTwo"] = $aParamPost["parent"];
					}
					
					$this->showMessage($update->update($aParamPost), 'Menu');
					$this->response->redirect ( "/admin/menutop");
				}
			}
			else{
				$this->showMessage(3, 'Menu');
			}
		}
    }
	public function deleteAction(){
    	global $userSession;
		$aParamPost = $this->getParamPost();
		if ($aParamPost["select_all"]!=null){
			$menu = Menutop::findFirst(array("id = ".$aParamPost["select_all"]));
			if ($menu == true){
				$menuParent = Menutop::findFirst(array("numTwo = ".$aParamPost["select_all"]));
				
				if ($menuParent == false){
					$messenger = $this->alertMessage($menu->delete(), 'Menu');
					$temp  =   "/admin/menutop";$f = 1;
				}else{
					$messenger = $this->alertMessage(5, 'Menu');
					$temp  =   "/admin/menutop";$f = 0;
				}
			}
			else{
				$messenger 	= $this->alertMessage(0, 'Menu');
				$temp 	 	=   "/admin/menutop";$f = 0;
			}
		}else{
			$f = 0;
			$messenger 	= $this->alertMessage(0, 'Menu');
			$temp  		=  "/admin/menutop";
		}
		return $this->sendJson(json_encode(array("messenger"=>$messenger,"href"=>$temp,"f"=>$f)));

    }
}
