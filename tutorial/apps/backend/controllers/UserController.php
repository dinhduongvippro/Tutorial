<?php

namespace Modules\Backend\Controllers;
// use Modules\Backend\Models\User;
// use Modules\Backend\Models\Group;
// use Modules\Backend\Services\Utils;
// use Modules\Backend\Models\Module;
class UserController extends BaseController{

	public function initialize() {
		parent::initialize();
	}
		
    public function indexAction(){
    	// global $userSession;
		// $this->checkModule(USER_VIEW); //check module
		// $aParam = $this->getParamQuery();
		// $query = ($aParam['pk_id'] != '') ? "AND group_id='".$aParam['pk_id']."'" : '';
		// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
			// $list = User::find (array(
    			// "status<>".DELETED." $query AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%') ".
				// "AND (full_name like '%".$aParam['search']."%' OR user_name like '%".$aParam['search']."%' ".
				// "OR editor like '%".$aParam['search']."%' OR update_date like '%".$aParam['search']."%')",
				// 'order'=>"full_name ASC",'limit'=>$aParam['size'],'offset'=>($aParam['index']-1)*$aParam['size']
    		// ));
			// $total = User::count("status<>".DELETED." $query AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%') ".
				// "AND (full_name like '%".$aParam['search']."%' OR user_name like '%".$aParam['search']."%' ".
				// "OR editor like '%".$aParam['search']."%' OR update_date like '%".$aParam['search']."%')");
		// }else{
			// $list = User::find (array(
				// "status<>".DELETED." $query AND group_parent like '%,".$userSession["group_id"].",%' ".
				// "AND (full_name like '%".$aParam['search']."%' OR user_name like '%".$aParam['search']."%' ".
				// "OR editor like '%".$aParam['search']."%' OR update_date like '%".$aParam['search']."%')",
				// 'order'=>"full_name ASC",'limit'=>$aParam['size'],'offset'=>($aParam['index']-1)*$aParam['size']
			// ));
			// $total = User::count("status<>".DELETED." $query AND group_parent like '%,".$userSession["group_id"].",%' ".
				// "AND (full_name like '%".$aParam['search']."%' OR user_name like '%".$aParam['search']."%' ".
				// "OR editor like '%".$aParam['search']."%' OR update_date like '%".$aParam['search']."%')");
		// }
		// if (count($list) > 0) {
			// $list = $list->toArray();
			// foreach ($list as $k=>$v){
				// $list[$k]['group_owner'] = Group::findFirst("id='".$v["group_id"]."'")->name;
			// }
			// $this->setView('list', $list);
		// }
		// if (count($total) > 0) $this->setView('total', $total);
		// $this->setView('total_page', ceil($total/$aParam['size']));
		// $this->setView('index', $aParam['index']-1);
		// $this->setView('size', $aParam['size']);
		// $this->setView('search', $aParam['search']);
		// $this->setView('message', $aParam['message']);
		// $this->setView('pk_id', $aParam['pk_id']);
    }
    public function addAction(){
    	// global $userSession;
    	// $this->checkModule(USER_ADD); //check module
    	// if ($this->request->isPost()){
    		// $aParam = $this->getParamPost();
    		// $user = User::findFirst("status<>".DELETED." AND user_name='".$aParam["user_name"]."'");
    		// if ($user == false){
    			// $aParam['id'] 				= Utils::randomToken(20);
    			// $group = Group::findFirst("id='".$aParam["group_id"]."'")->toArray();
    			// $aParam["group_id"] 		= $group["id"];
    			// $aParam["group_parent"] 	= $group["group_parent"].$group["group_id"].",";
    			// $aParam["status"] 			= ACTIVE;
    			// $aParam["password"]    		= sha1($aParam["token"].$aParam["password"]);
    			// $aParam["module"] 			= ",".implode($aParam["select_all"], ",").",";
				// $aParam["role"] 			= AGENT;
    			// $new = new User();
    			// $this->showMessage($new->save($aParam), 'User');
    			// $query = ($aParam['pk_id'] != '') ? "&pk_id=".$aParam['pk_id'] : '';
    			// $this->response->redirect ( "/admin/user?message=Successful$query" );
    		// }else{
    			// $this->showMessage(2, 'User');
    		// }
    	// }
    	// $aParam = $this->getParamQuery();
    	// $this->setView('pk_id', $aParam['pk_id']);
    	// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]){
    		// $listGroup = Group::find(
    			// array("status<>".DELETED." AND (id='".$userSession["group_id"]."' OR group_id = '".$userSession["group_id"]."')", 'order'=>"name ASC")
    		// );
    	// }else{
    		// $listGroup = Group::find(
    			// array("status<>".DELETED." AND group_id = '".$userSession["group_id"]."'", 'order'=>"name ASC")
    		// );
   		// }
    	// if ($userSession['role'] == ADMIN){
    		// $listModule = Module::find(array('order'=>"name ASC"));
    	// }else{
    		// $listModule = Module::find(
    			// array("id in (". trim($userSession["module"],",") .")", 'order'=>"name ASC"
    		// ));
    	// }
    	// if (count($listGroup) > 0) $this->setView('listGroup', $listGroup->toArray());
    	// if (count($listModule) > 0) $this->setView('listModule', $listModule->toArray());
    }
    public function editAction($param1=''){
    	// global $userSession;
		// $this->checkModule(USER_EDIT); //check module
		// if ($this->request->isPost()){
			// $aParam = $this->getParamPost();
			// $user = User::findFirst("status<>".DELETED." AND user_name='".$aParam["user_name"]."' AND id<>'".$param1."'");
			// if ($user == false){
				// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
					// $update = User::findFirst("status<>".DELETED." AND id='$param1' AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')");
				// }else{
					// $update = User::findFirst("status<>".DELETED." AND id='$param1' AND group_parent like '%,".$userSession["group_id"].",%'");
				// }
				// if ($update == true){
					// $group = Group::findFirst("id='".$aParam["group_id"]."'")->toArray();
					// $aParam["group_id"] 		= $group["id"];
					// $aParam["group_parent"] 	= $group["group_parent"].$group["group_id"].",";
					// $aParam["module"] 			= ",".implode($aParam["select_all"], ",").",";
					// if ($aParam['password'] != 'utbot072'){
						// $aParam["password"]    		= sha1($aParam["token"].$aParam["password"]);
					// }else{
						// unset($aParam['token']);unset($aParam['password']);
					// }
					// $this->showMessage($update->update($aParam), 'User');
					// $query = ($aParam['pk_id'] != '') ? "&pk_id=".$aParam['pk_id'] : '';
					// $this->response->redirect ( "/admin/user?message=Successful&index=".$aParam['index']."&size=".$aParam['size'].$query );
				// }else{
					// $this->showMessage(3, 'User');
				// }
			// }else{
				// $this->showMessage(2, 'User');
			// }
		// }
		// $aParam = $this->getParamQuery();
		// $this->setView('index', $aParam['index']);
		// $this->setView('size', $aParam['size']);
		// $this->setView('pk_id', $aParam['pk_id']);
		// $this->setView('id', $param1);
		// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
			// $user = User::findFirst("status<>".DELETED." AND id='$param1' AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')");
		// }else{
			// $user = User::findFirst("status<>".DELETED." AND id='$param1' AND group_parent like '%,".$userSession["group_id"].",%'");
		// }
		// if ($user == true) {
			// $this->setView('user', $user->toArray());
			// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]){
    			// $listGroup = Group::find(
    				// array("status<>".DELETED." AND (id='".$userSession["group_id"]."' OR group_id = '".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')", 'order'=>"name ASC")
    			// );
    		// }else{
    			// $listGroup = Group::find(
    					// array("status<>".DELETED." AND (group_id = '".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')", 'order'=>"name ASC")
    			// );
    		// }
    		// if ($userSession['role'] == ADMIN){
    			// $listModule = Module::find(array('order'=>"name ASC"));
    		// }else{
    			// $listModule = Module::find(
    					// array("id in (". trim($userSession["module"],",") .")", 'order'=>"name ASC"
    			// ));
    		// }
			// if (count($listGroup) > 0) $this->setView('listGroup', $listGroup->toArray());
			// if (count($listModule) > 0) $this->setView('listModule', $listModule->toArray());
		// }else{
			// $this->showMessage(3, 'User');
		// }
    }
    public function deleteAction(){
    	// global $userSession;
    	// $this->checkModule(USER_DELETE); //check module
    	// $aParam = $this->getParamPost();
    	// if($this->isNull($aParam["select_all"])){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Please choose user first!")));
    	// }
    	// $list = explode(",", $aParam["select_all"]);
    	// $countNotDelete=0;
    	// foreach ($list as $v){
	    	// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
				// $user = User::findFirst("status<>".DELETED." AND id='$v' AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')");
			// }else{
				// $user = User::findFirst("status<>".DELETED." AND id='$v' AND group_parent like '%,".$userSession["group_id"].",%'");
			// }
    		// if ($user == true && $user->role != ADMIN) {
    			// $user->editor =$aParam["editor"];
    			// $user->update_date = $aParam["update_date"];
    			// $user->status = DELETED;
    			// $user->update();
    		// }else{
    			// $countNotDelete++;
    		// }
    	// }
    	// $aParam = $this->getParamQuery();
    	// $query = ($aParam['pk_id'] != '') ? "&pk_id=".$aParam['pk_id'] : '';
    	// if ($countNotDelete == 0){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Successful$query")));
    	// }else{
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=You don't have permission!$query")));
    	// }
    }
    
    public function lockedAction(){
    	// global $userSession;
    	// $this->checkModule(USER_DELETE); //check module
    	// $aParam = $this->getParamPost();
    	// if($this->isNull($aParam["select_all"])){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Please choose user first!")));
    	// }
    	// $list = explode(",", $aParam["select_all"]);
    	// $countNotDelete=0;
    	// foreach ($list as $v){
    		// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
    			// $user = User::findFirst("status<>".DELETED." AND id='$v' AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')");
    		// }else{
    			// $user = User::findFirst("status<>".DELETED." AND id='$v' AND group_parent like '%,".$userSession["group_id"].",%'");
    		// }
    		// if ($user == true && $user->role != ADMIN) {
    			// $user->editor =$aParam["editor"];
    			// $user->update_date = $aParam["update_date"];
    			// $user->status = LOCKED;
    			// $user->update();
    		// }else{
    			// $countNotDelete++;
    		// }
    	// }
    	// $aParam = $this->getParamQuery();
    	// $query = ($aParam['pk_id'] != '') ? "&pk_id=".$aParam['pk_id'] : '';
    	// if ($countNotDelete == 0){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Successful$query")));
    	// }else{
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=You don't have permission!$query")));
    	// }
    }
    
    public function unlockAction(){
    	// global $userSession;
    	// $this->checkModule(USER_DELETE); //check module
    	// $aParam = $this->getParamPost();
    	// if($this->isNull($aParam["select_all"])){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Please choose user first!")));
    	// }
    	// $list = explode(",", $aParam["select_all"]);
    	// $countNotDelete=0;
    	// foreach ($list as $v){
    		// if ($userSession['role'] == ADMIN || $userSession["id"] == $userSession["group"]["owner_id"]) {
    			// $user = User::findFirst("status<>".DELETED." AND id='$v' AND (group_id='".$userSession["group_id"]."' OR group_parent like '%,".$userSession["group_id"].",%')");
    		// }else{
    			// $user = User::findFirst("status<>".DELETED." AND id='$v' AND group_parent like '%,".$userSession["group_id"].",%'");
    		// }
    		// if ($user == true && $user->role != ADMIN) {
    			// $user->editor =$aParam["editor"];
    			// $user->update_date = $aParam["update_date"];
    			// $user->status = ACTIVE;
    			// $user->update();
    		// }else{
    			// $countNotDelete++;
    		// }
    	// }
    	// $aParam = $this->getParamQuery();
    	// $query = ($aParam['pk_id'] != '') ? "&pk_id=".$aParam['pk_id'] : '';
    	// if ($countNotDelete == 0){
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=Successful$query")));
    	// }else{
    		// return $this->sendJson(json_encode(array('message'=>"/admin/user?message=You don't have permission!$query")));
    	// }
    }
}
