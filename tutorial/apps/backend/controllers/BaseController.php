<?php
namespace Modules\Backend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\Backend\Services\Utils;
use DateTime;

class BaseController extends Controller{

	public function initialize() {
		global $userSession;
		$this->view->setTemplateAfter('main_backend');
		$userSession = $this->checkLogin();
		// $this->checkModule(ACCESS_ADMIN);
	}
	//kiem tra dang nhap
	public function checkLogin(){
		$this->session->set('url_current_admin', $this->request->getUri());
		$userSession = $this->session->get("userSession");
		// print_r($userSession);exit;
		if (isset($userSession)){
			return $userSession;
		}
		$this->response->redirect ( "admin/login" );
	}
	public function query($db, $sql){
		$result = $this->$db->query($sql)->fetchAll(\Phalcon\Db::FETCH_ASSOC);
		return $result;
	}
	//kiem tra module
	public function checkModule($module){
		global $userSession;
		if (preg_match("/,".$module.",/", $userSession["module"]) == 0 
			|| preg_match("/,".ACCESS_ADMIN.",/", $userSession["module"]) == 0){
			$this->response->redirect ("admin/login" );
		}
	}
	//kiem tra module
	public static function checkModuleLayout($module){
		global $userSession;
		if (preg_match("/,".$module.",/", $userSession["module"]) == 0
			|| preg_match("/,".ACCESS_ADMIN.",/", $userSession["module"]) == 0){
			return false;
		}
		return true;
	}
	//gui du lieu dang JSON
	public function sendJson($json){
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent($json);
		return $this->response->send();
	}
	//lay thong tin dang POST
	public function getParamPost(){
		global $userSession;
		$aParam = array();
		$aParam["id"] 					= $this->request->getPost ( "id" );
		$aParam["name"] 				= $this->request->getPost ( "name" );
		$aParam["parent"] 				= $this->request->getPost ( "parent" );
		$aParam["level"] 				= $this->request->getPost ( "level" );
		$aParam["link"] 				= $this->request->getPost ( "link" );
		$aParam["sorted"] 				= $this->request->getPost ( "sorted" );
		$aParam["numTwo"] 				= $this->request->getPost ( "numTwo" );
		$status 						= $this->request->getPost ( "status" );
		$aParam["status"] 				= ($status == '' || $status == null) ? ACTIVE : $status;
		$aParam["href"] 				= $this->request->getPost ( "href" );
		$aParam["local"] 				= $this->request->getPost ( "local" );
		$aParam["pos"] 					= $this->request->getPost ( "pos" );
		$aParam["comment"] 				= $this->request->getPost ( "comment" );
		
		/////////////////////////
		$aParam["full_name"] 			= $this->request->getPost ( "full_name" );
		$aParam["user_name"] 			= $this->request->getPost ( "user_name" );
		$aParam["email"] 				= $this->request->getPost ( "email" );
		$aParam["token"] 				= Utils::randomToken(20);
		$aParam["password"] 			= $this->request->getPost ( "password" );
		
		$aParam["owner_id"] 			= $this->request->getPost ( "owner_id" );
		$aParam["group_id"] 			= $this->request->getPost ( "group_id" );
		$aParam["select_all"] 			= $this->request->getPost ( "select_all" );
		$aParam["pw_current"] 			= $this->request->getPost ( "pw_current" );
		$aParam["pw_new"] 				= $this->request->getPost ( "pw_new" );
		$aParam["confirm_pw_new"] 		= $this->request->getPost ( "confirm_pw_new" );
		
		$aParam["logo"] 				= $this->request->getPost ( "logo" );
		$aParam["login_type"] 			= $this->request->getPost ( "login_type" );
		$aParam["value"] 				= $this->request->getPost ( "value" );
		$aParam["status_action"] 		= $this->request->getPost ( "status_action" );
		$aParam["comment"] 				= $this->request->getPost ( "comment" );
		$aParam["address"] 				= $this->request->getPost ( "address" );
		$aParam["group_id"] 			= $this->request->getPost ( "group_id" );
		$aParam["city_id"] 				= $this->request->getPost ( "city_id" );
		$aParam["category_id"] 			= $this->request->getPost ( "category_id" );
		$aParam["location_id"] 			= $this->request->getPost ( "location_id" );
		$aParam["ap_type_id"] 			= $this->request->getPost ( "ap_type_id" );
		$aParam["session_id"] 			= $this->request->getPost ( "session_id" );
		$aParam["login_type_id"] 		= $this->request->getPost ( "login_type_id" );
		$aParam["url_splashpage_id"] 	= $this->request->getPost ( "url_splashpage_id" );
		$aParam["pk_id"] 				= $this->request->getPost ( "pk_id" );
		$aParam["mac_ap"] 				= $this->request->getPost ( "mac_ap" );
		$aParam["agency_id"] 			= $this->request->getPost ( "agency_id" );
		$aParam["zone"] 				= $this->request->getPost ( "zone" );
		$aParam["skip_zone"] 			= $this->request->getPost ( "skip_zone" );
		$index			 				= $this->request->getPost ( "index" );
		$aParam["index"]        		= ($index == '' || $index <= 1) ? 1 : $index;
		$size							= $this->request->getPost ( "size" );
		$aParam["size"] 				= ($size == '' || $size <= 1) ? 10 : $size;
		$aParam["date_status"] 			= $this->request->getPost ("date_status");
		$aParam["view_report_by"]		= $this->request->getPost ("view_report_by");
		$aParam["filter_name"]			= $this->request->getPost ("filter_name");
		$start_date 					= $this->request->getPost ( "start_date" );
		$end_date						= $this->request->getPost ( "end_date" );
		$aParam["type_inventory"]		= $this->request->getPost ("type_inventory");
		$aParam["url_banner_default"]	= $this->request->getPost ("url_banner_default");
		$aParam["key"]					= $this->request->getPost ("key");
		$aParam["number"]				= $this->request->getPost ("number");
		$aParam["coordinates"]			= $this->request->getPost ("coordinates");
		
		if (!$this->isNull($start_date) && !$this->isNull($end_date)) {
			$aParam['start_date'] 		= $start_date;
			$aParam['end_date'] 		= $end_date;
		}else{
			$aParam['start_date'] 		= (new DateTime())->format('Y-m-d');
			$aParam['end_date'] 		= (new DateTime())->format('Y-m-d');
		}
		$aParam["booking_date"] 		= $this->request->getPost ( "booking_date" );
		$sort_field		 				= $this->request->getPost ( "sort_field" );
		$aParam["sort_field"]        	= ($sort_field == '' || $sort_field <= 1) ? 1 : $sort_field;
		//them o tren
		////////////////////////////////////////
		$aParam["editor"] 				= $userSession["full_name"];
		$aParam["update_date"] 			= (new DateTime())->format('Y-m-d');
		$aParam["id_openx"] 			= $this->request->getPost ( "id_openx" );
		$aParam = array_filter($aParam);
		$aParam["login"] 				= $this->request->getPost ( "login" );
		$aParam["ip_address"]			= $this->request->getPost ("ip_address");
		return $aParam;
	}
	//lay thong tin dang GET
	public function getParamQuery(){
		$aParam = array();
		$aParam["id"] 					= $this->request->getQuery ( "id" );
		$index			 				= $this->request->getQuery ( "index" );
		$aParam["index"]        		= ($index == '' || $index <= 1) ? 1 : $index;
		$size							= $this->request->getQuery ( "size" );
		$aParam["size"] 				= ($size == '' || $size <= 1) ? 10 : $size;
		$aParam["search"] 				= $this->request->getQuery ( "search" );
		$aParam["message"] 				= $this->request->getQuery ( "message" );
		$aParam["pk_id"] 				= $this->request->getQuery ( "pk_id" );
		//add at here
		return array_filter($aParam);
	}
	//truyen nhieu tham so de hien thi cho file.phtml (nhan vao dang mang nhieu tham so)
	public function setViewArray($aParam){
		foreach ($aParam as $k=>$v){
			$this->view->setVar($k, $v);
		}
	}
	//truyen 1 tham so de hien thi cho file.phtml
	public function setView($key, $value){
		$this->view->setVar($key, $value);
	}

	public function showMessage($staus, $nameModule) {
		switch ($staus) {
			case 0 : $this->setView('message', 'Faild');break;
			case 1 : $this->setView('message', 'Successful');break;
			case 2 : $this->setView('message', $nameModule.' already exists!');break;
			case 3 : $this->setView('message', "You don't have permission!");break;
			
		}
	}
	public function alertMessage($staus, $nameModule) {
		switch ($staus) {
			case 0 : return 'Faild';break;
			case 1 : return 'Successful';break;
			case 2 : return $nameModule.' already exists!';break;
			case 3 : return "You don't have permission!";break;
			case 4 : return "You may not delete ".$nameModule." are active";break;
			case 5 : return "you need to remove the previous subsets";break;
		}
	}
	public function isNull($data) {
		return (!isset($data) || trim($data)=='');
	}
	public function searchByStatus($string){
		$arrray = array();$i=0;
		if (preg_match("/".strtolower($string)."/", "active") == 1) $arrray[$i++] = 1;
		if (preg_match("/".strtolower($string)."/", "inactive") == 1) $arrray[$i++] = 2;
		if (preg_match("/".strtolower($string)."/", "trial") == 1) $arrray[$i++] = 5;
		return $arrray;
	}
	public function searchByStatusActionLocation($string){
		$arrray = array();$i=0;
		if (preg_match("/".strtolower($string)."/", "live") == 1 ) $arrray[$i++] = 1;
		if (preg_match("/".strtolower($string)."/", "sandbox") == 1 ) $arrray[$i++] = 2;
		return $arrray;
	}
	public function sizeAndPaging($array){
		$from=($array['index']-1)*$array['size'];
		$to=($from+$array['size'] <= $array['total']) ? ($from+$array['size']) : ($from+($array['total']%$array['size']));
		$result = array(
			'total'=>$array['total'],
			'total_page'=>ceil($array['total']/$array['size']),
			'from'=>$from+1,
			'to'=>$to,
			'size'=>$array['size']+0,
			'search'=>$array['search']
		);
		return array_filter($result);
	}
}
