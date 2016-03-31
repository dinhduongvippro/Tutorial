<?php
include __DIR__."/../apps/common/define/var.php";
	//Set content type format by xml
	header ("Content-Type:text/xml");
	
	//Get hostname ads
	$host = isset($_GET['server_source'])?$_GET['server_source']:VAST_VIDEO;
	
	//Get zoneid
	$zoneid = isset($_GET['zone_id'])?$_GET['zone_id']:"1";
	
	//Retrive url for ads vast xml
	$vastURL = "http://".$host."/www/delivery/fc.php?script=bannerTypeHtml:vastInlineBannerTypeHtml:vastInlineHtml&source=&format=vast&charset=UTF_8&nz=1&zones=z1=".$zoneid;
	
	//Get content
	$vastContent = file_get_contents($vastURL);
	
	//write content xml
	echo $vastContent;