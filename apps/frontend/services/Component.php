<?php
namespace Modules\Frontend\Services;

// use Modules\Frontend\Models\ClientLog;
// use Modules\Frontend\Models\ClientProfile;
// use Modules\Frontend\Models\AccessPoints;
use DateTime;
class Component{
	public static function newvisitor($array,$myThis){
		$arr_where						= array('created_at_s'=>array('$lte'=>$array['end_date']));
		
		if($array['key'] == "ap_id"){
			$arr_where['ap_id'] = array('$in'=>$array['select_all']);$project['ap_id'] = '$ap.id';
		}else if($array['key'] == "location_id" || $array['key'] == "category_id" || $array['key'] == "city_id"){
			$arr_where['location_id'] = array('$in'=>$array['select_all']);$project['location_id'] = '$ap.location_id';
		}else if($array['key'] == "campaign_id") 		{
			$arr_where['campaign_id'] = array('$in'=>$array['select_all']);$project['campaign_id'] = 1;
		}
		$a = array(
			array('$match'=>$arr_where),
			array('$group'=>array('_id'=>array('client_id'=>'$client_id','created_at_d'=>'$created_at_d'))),
			array('$sort'=>array('_id.created_at_d'=>1)),
			array('$group'=>array('_id'=>'$_id.client_id','created_at_d'=>array('$first'=>'$_id.created_at_d'))),
			array('$match'=>array('created_at_d'=>array(
				'$gte'=>(new DateTime($array['start_date']))->format('Y-m-d'),
				'$lte'=>(new DateTime($array['end_date']))->format('Y-m-d')
			))),
			array('$group'=>array('_id'=>null,'total'=>array('$sum'=>1)))
		);
		$query = 'db.runCommand({aggregate: "client_log",pipeline:'.json_encode($a).',allowDiskUse: true})';
		$result = $myThis->bigdata->execute($query);
		return ($result['retval']['result'] != null) ? $result['retval']['result'][0]['total'] : 0;
	}
}