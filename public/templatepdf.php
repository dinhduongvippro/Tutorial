<page style="font-family: freeserif" backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; font-size:16px; ">
            <tr>
                <td style="text-align: left;    width: 33%">Booking</td>
                <td style="text-align: center;    width: 34%">Campaign brief</td>
                <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
            </tr>
        </table>
    </page_header>
     
    <span style="font-size: 20px; font-weight: bold"><img height="130px;" src="image001.png" alt="Logo"></span><br>
    <br>
    <br>
    <table style="width: 95%;border: solid 1px; border-collapse: collapse" align="center">
        <thead>
            <tr>
                <th style="width: 30%; text-align: left; border: solid 1px ; background: #F79646">Booking ID: <br></th>
                <th style="width: 60%; text-align: left; border: solid 1px ; background: #F79646"><?php echo $data['booking_id'];?><br></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px  ">Client name:<br></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['advertiser_id'];?><br></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Brief day:<br></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['brief_day'];?><br></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Account contact: </td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['account_contact_id'];?><br></td>
            </tr>
            <tr>
                <td colspan='2' style="border: 1px solid black; background: #F79646">Information in details</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Campaign name:</td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['campaign_name'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Start date:</td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['start_date'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">End date:</td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['end_date'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Charge:</td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['charge_type'];?></td>
            </tr>
            <tr>
                <td colspan='2' style="border: 1px solid black; background: #F79646">Location</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Venue:</td>
                <td style="width: 60%; text-align: left; border: solid 1px ">
                 
                <?php $flag = 1; foreach ($data['listCity'] as $key => $listcity) {
                    if($listcity['listLocation'] != null){
                        echo '<span>'.$listcity['name'].' </span><br>';
                        foreach ($listcity['listLocation'] as $key => $value) {
                            echo '<span>'.$flag.'. '.$value['name'].'</span><br>';
                            $flag ++;
                        }
                    }
                    
                    # code...
                }
                ?> 
                </td>
            </tr>
             <tr>
                <td style="width: 30%; text-align: left; border: solid 1px "><ins>Total:</ins></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $flag - 1; ?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Location APs:</td>
                <td style="width: 60%; text-align: left; border: solid 1px ">
                 
                <?php $count = 0; $flag = 1; foreach ($data['listCity'] as $key => $listcity) {
                    if($listcity['listLocation'] != null){
                        echo '<span>'.$listcity['name'].' </span><br>';
                        foreach ($listcity['listLocation'] as $key => $value) {
                            echo '<span>'.$flag.'. '.$value['name'].': '.$value['count_ap'].' APs</span><br>';
                            $flag ++;
                            $count += $value['count_ap'];
                        }
                    }
                    
                    # code...
                }
                ?> 
                </td>
            </tr>

            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px "><ins>Total:</ins></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $count; ?> APs</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">
                    <span>Campaign type</span><br>
                    <span><i>(CPC/CPV/CPA/CPI/dedicated APs)</i></span>
                </td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['campaign_type'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">
                    <span>Banner type</span><br>
                        <ul>
                            <li><span>Standard (jpg, png, gif)</span></li>
                            <li><span>Web banner(1024x768)</span></li>
                            <li><span>Mobile banner(640x960)</span></li>
                            <li><span>Interactive banner (html)(1024x768)</span></li>
                        </ul>
                        
                </td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['banner_id'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px ">Number of banner:</td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['number_banner'];?></td>
            </tr>
             
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px "><ins>Operation system:</ins></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['operation_system'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px "><ins>Report (by day/week/month):</ins></td>
                <td style="width: 60%; text-align: left; border: solid 1px "><?php echo $data['report_type'];?></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left; border: solid 1px "><ins>Lading page:</ins></td>
                <td style="width: 60%; text-align: left; border: solid 1px ">
                    <span><b><?php echo $data['landing_page'];?></b></span><br>
                    
                </td>
            </tr>

            <tr>
                <td colspan="2" style="border: 1px solid black; background: #F79646">
                    <span>KPIs:</span>
                    <span><?php echo $data['kpi']; ?> </span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black;">
                    <span>Notes: <?php echo $data['note'];?></span>
                </td>
            </tr>
            


        </tbody>
        
    </table>
    <br><br>
    <?php  if($flag > 3) echo '<br><br><br><br><br><br><br><br><br><br><br><br>'; ?>

    <table style="width: 100%;" align="center">
         
        <tbody>
            
            <tr>
                <td style="width: 35%; text-align: center; ">
                    <span>TPHCM, ngày .... tháng .... năm ......</span>
                </td>
                <td style="width: 35%; text-align: center; ">
                    <span>TPHCM, ngày .... tháng .... năm ......</span>
                </td>
                <td style="width: 35%; text-align: center; ">

                </td>
            </tr>
            <tr>
                <td style="width: 35%; text-align: center; ">
                    <span>GĐ Điều hành</span>
                </td>
                <td style="width: 35%; text-align: center; ">
                    <span>Support Sale</span>
                </td>
                <td style="width: 35%; text-align: center; ">
                    <span>Người đề xuất</span>
                </td>
            </tr>
            <tr style="height:100px">
                <td style="height:150px; text-align: center; ">
                    
                </td >
                <td style="height:150px; text-align: center; ">
                    
                </td>
                <td style="height:150px; text-align: center; ">
                    
                </td>
            </tr>
            <tr>
                <td style="width: 35%; text-align: center; ">
                    <span>Nguyễn Bảo Toàn</span>
                </td>
                <td style="width: 35%; text-align: center; ">
                    <span>Đinh Thị Ngọc Trâm</span>
                </td>
                <td style="width: 35%; text-align: center; ">
                    <span><?php echo $data['account_contact_id'];?></span>
                </td>
            </tr>
            


        </tbody>
        
    </table>

    <br>
     
    </page>
 