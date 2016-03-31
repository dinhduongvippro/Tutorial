<?php
namespace Modules\Frontend\Services;
use DateTime;
use DateInterval;

class Utils{

	public static function getJson($url) {
		$curl = curl_init ();
		curl_setopt_array ( $curl, array (
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT => 300,
			CURLOPT_TIMEOUT => 300,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$json = curl_exec ( $curl );
		curl_close ( $curl );
		return json_decode ( $json, true );
	}
	public static function getJsonPost($url, $data_post) {
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec ($ch);
	    $response = json_decode($response,true);
	    curl_close ($ch);
	    return $response;
		
	}
	public static function randomToken($n){
		$string = implode(range('A','Z')).implode(range('a','z')).implode(range(0,9));
		for ($i = 0; $i < $n; $i++) {
			$randomKey = mt_rand(0, strlen($string)-1);
			$token .= $string[$randomKey];
		}
		return $token."!";
	}
	public static function status_booking($status) {
		$result = '';
		switch ($status){
			case APPROVED: $result = "APPROVED";break;
			case WFA: $result = "WFA";break;
			case DRAFF: $result = "DRAFF";break;
			case REJECT: $result = "REJECT";break;
			case RUNNING: $result = "RUNNING";break;
			case CANCELED: $result = "CANCELED";break;
			case DONE: $result = "DONE";break;
            case WFA_2: $result = "WFA 2";break;
            case APPROVED_2: $result = "APPROVED 2";break;
		}
		return $result;
	}
    public static function status_ads($status) {
        $result = '';
        switch ($status){
            case RUNNING_ADS: $result = "Running";break;
            case COMPLETED_ADS: $result = "Completed";break;
            case INACTIVE_ADS: $result = "Inactive";break;
        }
        return $result;
    }
	public static function Charge($id) {
		$result = '';
		switch ($id){
			case FREE: $result = "Free";break;
			case FEE: $result = "Fee";break;
		}
		return $result;
	}
	
	public static function campaign_type($id) {
		$result = '';
		switch ($id){
			case CPC: $result = "CPC";break;
			case CPA: $result = "CPA";break;
			case CPV: $result = "CPV";break;
			case CPO: $result = "CPO";break;
			case DEDICATED: $result = "DEDICATED";break;
		}
		return $result;
	}
	
	public static function banner_type($id) {
		$result = '';
		switch ($id){
			case STANDARD: $result = "Standard";break;
			case SURVEY: $result = "Survey";break;
			case HTML: $result = "Html";break;
			case VIDEO: $result = "Video";break;
		}
		return $result;
	}
	
	public static function tracking3rd($id) {
		$result = '';
		switch ($id){
			case MEDIAMIND: $result = "Mediamind";break;
			case GOOGLE_SORTLINK: $result = "Google Sortlink";break;
			case BITLY: $result = "Bit.ly";break;
			case ORTHER: $result = "Other";break;
		}
		return $result;
	}
	
	public static function export_report_type($id) {
		$result = '';
		switch ($id){
			case DAILY: $result = "Daily";break;
			case WEEKLY: $result = "Weekly";break;
			case MONTHLY: $result = "Monthly";break;
		}
		return $result;
	}
	public static function sendMail($data_send_mail){

        $owner_email=$data_send_mail['mail']; 
         
       
        $host = 'mail.s-wifi.vn';
        $port = '25';//"587";
        $username = 'crm@s-wifi.vn';
        $password = 'h3tf9dzNyA';

        $subject= $data_send_mail['title'];
        $user_email= $data_send_mail['name_from'].';crm@s-wifi.vn';    
        $message_body='';
        $message_type='html';

        $max_file_size=52428800; // MB
        $file_types='/(doc|docx|txt|pdf|zip|rar)$/';
        $error_text_filesize='file size must be less than';
        $error_text_filetype='wrong file type';


        $error_text='something goes wrong';
        $use_smtp=($host=='' or $username=='' or $password=='');
        $message_body = $data_send_mail['content'];
        try{
            $m= new Libmail("utf-8");
            $m->From($user_email);
            $m->To($owner_email);
            $m->Subject($subject);
            $m->Body($message_body,$message_type);
            $m->log_on(true);
            $m->Attach($data_send_mail['path_file'],$data_send_mail['rename_file'],'','attachment');
            //$_FILES['attachment'] = '/home/nghianh/test/apps/frontend/file/reportfinal.xlsx';
            if(isset($_FILES['attachment'])){
                if($_FILES['attachment']['size']>$max_file_size){
                    $error_text=$error_text_filesize . ' ' . $max_file_size . 'MB';
                    throw new Exception($error_text);
                }else{          
                    if(preg_match($file_types,$_FILES['attachment']['name'])){
                        $m->Attach($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name'],'','attachment');
                    }else{
                        $error_text=$error_text_filetype;
                        throw new Exception($error_text);
                    }
                }       
            }
            if(!$use_smtp){
                $m->smtp_on( $host, $username, $password, $port);
            }
            $m->Send();
            return 'success';
        }catch(Exception $mail){
            return $error_text;
        }   
    }
    public static function setColorLabel($status,$idOpenx){
        switch ($status){
            case APPROVED:
                if($idOpenx != ""){
                    return '<span class="label label-primary">Imported to Ads</span>';
                }else{
                    return '<span class="label label-info">Aproved 1</span>';
                }
            case APPROVED_2:
                return '<span class="label label-primary">Aproved 2</span>';
            case CANCELED:
                return '<span class="label label-cancel">Canceled</span>';
            case REJECT:
                return '<span class="label label-danger">Reject</span>';
            case DONE:
                return '<span class="label label-done">Done</span>';
            case WFA:
                return '<span class="label label-warning">WFA 1</span>';
            case WFA_2:
                return '<span class="label label-warning">WFA 2</span>';
            case RUNNING:
                return '<span class="label label-success">Running</span>';
            default:
                return '<span class="label label-default">Draff</span>';
        }
    }
    public static function setColor($status, $idOpenx){
    	switch ($status){
    		case APPROVED:
    			if($idOpenx != ""){
    				return 'status-import';
    			}else{
    				return 'status-approve';
    			}
    		case CANCELED:
    			return 'status-cancel';
    		case REJECT:
    			return 'status-reject';
    		case DONE:
    			return 'status-done';
    		case WFA:
    			return 'status-wfa';
    		case RUNNING:
    			return 'status-running';
    		default:
    			return 'status-draff';
    	}
    }
    
    public static function getCheckDone($endDate){
    	$now = (new DateTime())->format('Y-m-d');
    	if(strtotime($endDate) < strtotime($now)){
    		$result = true;
    	}else{
    		$result =false;
    	}
    	return $result;
    }
    
    public static function getRunningDate($startDate,$endDate){
    	$now = (new DateTime())->format('Y-m-d');
    	$start = Utils::getDate($startDate);
    	$end = Utils::getDate($endDate);
    	$totalDate = Utils::getTotalDay($startDate,$endDate);   	
    	$aPiece = 100/$totalDate;
    	if(strtotime($startDate) == strtotime($now) || strtotime($endDate) == strtotime($now)){
    		$diff = date_diff($start,new DateTime($now));
    		$run = $diff->format("%a")+1;
    	}else{
    		$run = $totalDate - Utils::getLeftDate($startDate,$endDate);
    	}
    	return $result = $aPiece*$run;
		
    }
    
    public static function getLeftDate($startDate,$endDate){
    	$now = (new DateTime())->format('Y-m-d');
    	$start = Utils::getDate($startDate);
    	$end = Utils::getDate($endDate);
    	if(strtotime($endDate) < strtotime($now)){
    		$dateLeft = 0;
    	}else if(strtotime($startDate) < strtotime($now)){
    		$diff = date_diff($end,new DateTime($now));
    		$dateLeft = $diff->format("%a")+1;
    	}else{
    		$dateLeft = Utils::getTotalDay($startDate,$endDate);
    	}
    	return $dateLeft;
    }

    public static function getPacing($kpi,$realClick,$startDate,$endDate){
    	$result = array();
    	$now = (new DateTime())->format('Y-m-d');
    	$totalDate = Utils::getTotalDay($startDate,$endDate);
    	$start = Utils::getDate($startDate);
    	$end = Utils::getDate($endDate);
    	if($realClick == 0){
    		$result['pacing'] = 0;
    		$result['perPacing'] = 0;
    	}else{
    		if(strtotime($startDate) == strtotime($now) || strtotime($endDate) == strtotime($now)){
    			$diff = date_diff($start,new DateTime($now));
    			$run = $diff->format("%a")+1;  
    		}else if(strtotime($endDate) < strtotime($now)){				
    			//$diff = date_diff(new DateTime($now),$start);
				$diff = date_diff($end,$start);
    			$run = $diff->format("%a")+1;
    		}else if(strtotime($startDate) < strtotime($now)){    			
    			$diff = date_diff($end,new DateTime($now));
    			$dateLeft = $diff->format("%a")+1;
    			$run = $totalDate - $dateLeft;
    		}
    		$pacing = round((($realClick * $totalDate)/($kpi*$run))*100,2);
    		$perPacing = ($realClick/$kpi)*100;
    		$result['pacing'] = $pacing;
    		$result['perPacing'] = ($perPacing >= 100) ? 100 : $perPacing; 
    		$result['color'] = Utils::getColor($pacing);
    	}    	
    	return $result;
    }
    
    private static function getColor($num){
    	if($num >= 100 and $num <= 130){
    		return 'green';
    	}else if($num > 70 and $num < 100){
    		return 'orange';
    	}else{
    		return 'red';
    	}
    }
    
    private static function getTotalDay($startDate,$endDate){
    	$start = Utils::getDate($startDate);
    	$end = Utils::getDate($endDate);
    	$total = date_diff($start,$end);
    	return $total->format("%a")+1;
    }
    
    public static function getDate($date){
    	$result = new DateTime($date);
    	return $result;
    }
    
    public static function dateRange($from,$to){
    	$start_date 		= new DateTime($from);
    	$end_date 			= new DateTime($to);
    	$dateArray 			= array($start_date->format("Y-m-d"));
    	while( $start_date < $end_date ) {
    		$diff 			= new DateInterval('P1D');
    		$day 			= $start_date->add($diff);
    		array_push($dateArray, $day->format("Y-m-d"));
    	}
    	return $dateArray;
    }
    public static function status($status) {
    	$result = '';
    	switch ($status){
    		case 1: $result = "ACTIVE";break;
    		case 2: $result = "INACTIVE";break;
    		case 3: $result = "DELETED";break;
    		case 4: $result = "LOCKED";break;
    	}
    	return $result;
    }
    
    
}