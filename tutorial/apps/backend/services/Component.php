<?php
namespace Modules\Backend\Services;
// use Modules\Backend\Models\ClientLog;
use DateTime;
use DateInterval;
use DatePeriod;
class Component{
	
	//////////////// GET LIST INFO USER /////////////////
	public static function getListInfoUser($array){
		// $arr_where	= array('created_at_s'=>array('$gte'=>$array['start_date'], '$lte'=>$array['end_date']),'host_name'=>$array['host_name']);
		
		// if($array['key'] == "ap_id"){
			// $arr_where['ap_idopenx'] 		= $array['id'];
		// }else if($array['key'] == "location_id"){
			// $arr_where['location_idopenx'] 	= $array['id'];
		// }else if($array['key'] == "campaign_id"){
			// $arr_where['campaign_id'] 	= $array['id'];
		// }else if($array['key'] == "banner_id"){
			// $arr_where['banner_id'] 	= $array['id'];
		// }
		// $result = ClientLog::aggregate(array(
			// array('$match'=>$arr_where),
			// array('$group'=>array('_id'=>'$client_id',"profile"=>array('$first'=>'$profile')))
		// ));
		// return $result['result'];
	}
}