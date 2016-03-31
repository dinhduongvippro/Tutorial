<?php
namespace Modules\Backend\Controllers;
use Modules\Backend\Models\User;
use Modules\Backend\Models\Group;

class LoginController extends BaseController {
	public function initialize() {
		$this->view->setTemplateAfter('login_backend');
	}
	public function indexAction() {
		if ($this->request->isPost ()) {
			$aParam = $this->getParamPost();
			$ajax = $this->request->getPost ( "v" );
			$user = $this->query(DB,"SELECT * FROM user WHERE user_name='".$aParam["user_name"]."'")[0];
			
			if ($user == true) {
				
				if ($user['status'] == ACTIVE){
					if ($user['password'] == sha1($user['token'].$aParam['password'])){
						$group = Group::findFirst("status=".ACTIVE." AND id='".$user["group_id"]."'");
						if ($group == true) $user["group"] = $group->toArray();
						$this->session->set ('userSession', $user);
						$url = $this->session->get('url_current_admin');
						if ($url != null && $url != "/" && $ajax != 'ajax'){
							$this->response->redirect ($url);
						}else{
							$this->response->redirect ("/admin");
						}
						
					}else{
						unset($aParam['password']);
						$this->setViewArray($aParam);
						$this->setView('error', 'Password Invalid!');
					}
				}else{
					$this->setView('error', 'Your account are locked!');
				}
			}else{
				unset($aParam['user_name']);
				$this->setViewArray($aParam);
				$this->setView('error', 'Username Invalid!');
			}
		}
		$ajax = $this->request->getQuery ( "v" );
		$this->setView('ajax', $ajax);
	}
	
	public function logoutAction() {
		$this->session->remove ( 'userSession');
		$this->session->remove ('url_current_admin');
		$this->response->redirect ( '/admin/login' );
	}
}