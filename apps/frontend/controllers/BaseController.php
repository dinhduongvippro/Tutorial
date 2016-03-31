<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\Frontend\Services\Utils;
use DateTime;

class BaseController extends Controller{

	public function initialize() {
		global $userSession;
		// $userSession = $this->checkLogin();
		$this->setView ( 'menuTop', $this->getMenuTop());
		$this->view->setTemplateAfter('main_frontend');
	}
	//kiem tra dang nhap
	private function getMenuTop(){
		$strQuery = "SELECT * FROM menuTop WHERE status = ".ACTIVE." AND level = 1 ORDER BY sorted ASC";
		$data = $this->query(DB,$strQuery);
		return $data;
	}
	public function checkLogin(){
		$this->session->set('url_current', $this->request->getUri());
		$userSession = $this->session->get("userSession");
		if (isset($userSession)){
			return $userSession;
		}
		$this->response->redirect ( "login" );
	}
	//kiem tra module
	public function checkModule($module){
		global $userSession;
		if (preg_match("/,".$module.",/", $userSession["module"]) == 0){
			$this->response->redirect ("/login" );
		}
	}
	public function query($db, $sql){
		$result = $this->$db->query($sql)->fetchAll(\Phalcon\Db::FETCH_ASSOC);
		return $result;
	}
	//kiem tra module
	public static function checkModuleLayout($module){
		global $userSession;
		if (preg_match("/,".$module.",/", $userSession["module"]) == 0){
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
		$aParam["receive_report_auto"] 	= $this->request->getPost ( "receive_report_auto" );
		return $aParam;
	}
	//lay thong tin dang GET
	public function getParamQuery(){
		$aParam = array();
		$aParam["id"] 					= $this->request->getQuery ( "id" );
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
	public function isNull($data) {
		return (!isset($data) || trim($data)=='');
	}
	public function checkNullNumber($data) {
		return (!isset($data) || ($data==null && $data == 0));
	}
}
