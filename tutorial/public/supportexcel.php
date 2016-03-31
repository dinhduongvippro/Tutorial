<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

function export($alldata){
	
	//print_r($data);
	/** Error reporting */
	error_reporting(E_ALL);
	 
	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


	$objPHPExcel = new PHPExcel();
	//echo (count($alldata[1][1])); exit; 
	// Set document properties
	//echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("CRM")
								 ->setLastModifiedBy("R&D")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Report");


	// Create a first sheet, representing sales data
	$char = '';
	for($j = 0 ; $j < count($alldata) ; $j++ ){
		//Create new sheet
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($j);


		$data = $alldata[$j];
 
		$k = 3;
		 
		//echo $k . '-' . $flagcss ;
		//print_r($data[2]);

		foreach ($data[2] as $key2 => $value2) {
			 
			$count_cell = count($value2);
			for ($l=0; $l < $count_cell; $l++) { 
				$A = 65;
				if($count_cell == 3) $A = 66;
				$objPHPExcel->getActiveSheet()->setCellValue(chr($A+$l).$k, $value2[$l]);
				
			}

			//echo $k;
			//echo count($data[2]);
			//echo '<br>';
			
			//echo $value2[0];
			$k++;
 		} 
			//echo date('H:i:s') , " Add some data" , EOL;
		 
		//exit;
		 
			 
 		//if(count($data[2]) > 1)
			$i = 7; 
		//else
		//	$i = 5;
		$flag = 0;
		

		foreach ($data[1] as $key => $value) {
			$count_value = count($value);
			$l = 0;
			foreach ($value as $key) {
				 
				$objPHPExcel->getActiveSheet()->setCellValue(chr(65+$l).$i, $key);

				if( $i== 7 ){
					//if($flag == 0)
					{
						$flag = 1;
						$objPHPExcel->getActiveSheet()->getStyle(chr(65+$l).$i)->getFont()->setName('Candara');
						$objPHPExcel->getActiveSheet()->getStyle(chr(65+$l).$i)->getFont()->setSize(16);
						$objPHPExcel->getActiveSheet()->getStyle(chr(65+$l).$i)->getFont()->setBold(true);
					}
					
				}
				$l ++;
			}
			$char = chr(64+$l);
			$i ++;
			# code...
		}
		

		 


		// Set cell number formats
		//echo date('H:i:s') , " Set cell number formats" , EOL;
		//$objPHPExcel->getActiveSheet()->getStyle('E4:E13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

		// Set column widths
		//echo date('H:i:s') , " Set column widths" , EOL;
  		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		// Set fonts
		//echo date('H:i:s') , " Set fonts" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		 

		// Set thin black border outline around column
		//echo date('H:i:s') , " Set thin black border outline around column" , EOL;
		//$styleThinBlackBorderOutline = array(
		//	'borders' => array(
		//		'outline' => array(
		//			'style' => PHPExcel_Style_Border::BORDER_THIN,
		//			'color' => array('argb' => 'FF000000'),
		//		),
		//	),
		//);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:E6')->applyFromArray($styleThinBlackBorderOutline);

		 
		// Set fills
		//echo date('H:i:s') , " Set fills" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3:E3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B3:E3')->getFill()->getStartColor()->setARGB('000');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:E3');

		if(count($data[2]) > 1){
			$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->getStartColor()->setARGB('0000FF');

			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->getStartColor()->setARGB('0000FF');
		} 
		

		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->getStartColor()->setARGB('0000FF');


		// Add a drawing to the worksheet
		//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('images/logo-small.png');
		$objDrawing->setHeight(44);
		$objDrawing->setWidth(50);
		$objDrawing->setCoordinates('A1');

		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		  


		// Rename first worksheet
		//echo date('H:i:s') , " Rename first worksheet" , EOL;
		$objPHPExcel->getActiveSheet()->setTitle($data[0]);

		//echo $data[0];
		// Create a new worksheet, after the default sheet
		//echo date('H:i:s') , " Create a second Worksheet object" , EOL;


	}
	

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	 
	$BStyle = array(
	  'borders' => array(
	    'allborders' => array(
	      'style' => PHPExcel_Style_Border::BORDER_THIN
	    )
	  )
	);

	$objPHPExcel->getActiveSheet()->getStyle('A7:'.$char.$i)->applyFromArray($BStyle);

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="report-'.$data[0].'-'.gmdate('D, d M Y H:i:s').'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}

function exportfinal($alldata){
	
	//print_r($data);
	/** Error reporting */
	error_reporting(E_ALL);
	 
	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


	$objPHPExcel = new PHPExcel();
	//echo (count($alldata[1][1])); exit; 
	// Set document properties
	//echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("CRM")
								 ->setLastModifiedBy("R&D")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Report");


	// Create a first sheet, representing sales data
	$char = '';
	for($j = 0 ; $j < count($alldata) ; $j++ ){
		//Create new sheet
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($j);


		$data = $alldata[$j];
 
		$k = 3;
		 
		//echo $k . '-' . $flagcss ;
		//print_r($data[2]);

		foreach ($data[2] as $key2 => $value2) {
			 
			$count_cell = count($value2);
			for ($l=0; $l < $count_cell; $l++) { 
				$A = 66;
				if($count_cell == 3) $A = 66;
				$objPHPExcel->getActiveSheet()->setCellValue(chr($A+$l).$k, $value2[$l]);
				
			}

			//echo $k;
			//echo count($data[2]);
			//echo '<br>';
			
			//echo $value2[0];
			$k++;
 		} 
			//echo date('H:i:s') , " Add some data" , EOL;
		 
		//exit;
		 
			 
 		//if(count($data[2]) > 1)
			$i = 7; 
		//else
		//	$i = 5;
		$flag = 0;
		

		foreach ($data[1] as $key => $value) {
			$count_value = count($value);
			$l = 0;
			foreach ($value as $key) {
				 
				$objPHPExcel->getActiveSheet()->setCellValue(chr(66+$l).$i, $key);

				if( $i== 7 ){
					//if($flag == 0)
					{
						$flag = 1;
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setName('Candara');
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setSize(14);
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setBold(true);
					}
					
				}
				$l ++;
			}
			$char = chr(65+$l);
			$i ++;
			# code...
		}
		$char = chr(65+$l);

		 


		// Set cell number formats
		//echo date('H:i:s') , " Set cell number formats" , EOL;
		//$objPHPExcel->getActiveSheet()->getStyle('E4:E13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

		// Set column widths
		//echo date('H:i:s') , " Set column widths" , EOL;
  		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		// Set fonts
		//echo date('H:i:s') , " Set fonts" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		 

		// Set thin black border outline around column
		//echo date('H:i:s') , " Set thin black border outline around column" , EOL;
		//$styleThinBlackBorderOutline = array(
		//	'borders' => array(
		//		'outline' => array(
		//			'style' => PHPExcel_Style_Border::BORDER_THIN,
		//			'color' => array('argb' => 'FF000000'),
		//		),
		//	),
		//);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:E6')->applyFromArray($styleThinBlackBorderOutline);

		 
		// Set fills
		//echo date('H:i:s') , " Set fills" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('3C8DBC');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');

		if(count($data[2]) > 1){
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->getStartColor()->setARGB('0000FF');

			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->getStartColor()->setARGB('0000FF');
		} 
		

		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->getStartColor()->setARGB('0000FF');


		// Add a drawing to the worksheet
		//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo'); 
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('images/logo-small.png');
		$objDrawing->setHeight(44);
		$objDrawing->setWidth(50);
		$objDrawing->setCoordinates('A1');

		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		$BStyle = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		$objPHPExcel->getActiveSheet()->getStyle('B7:'.$char.$i)->applyFromArray($BStyle);


		// Rename first worksheet
		//echo date('H:i:s') , " Rename first worksheet" , EOL;
		$objPHPExcel->getActiveSheet()->setTitle($data[0]);

		//echo $data[0];
		// Create a new worksheet, after the default sheet
		//echo date('H:i:s') , " Create a second Worksheet object" , EOL;


	}
	

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save('/home/nghianh/test/apps/frontend/file/reportfinal.xlsx');
	//echo 'hi'; exit;

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="report-'.$data[0].'-'.gmdate('D, d M Y H:i:s').'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
	$objWriter->save('php://output');
	exit;
}

function exportAuto($alldata){
	
	//print_r($data);
	/** Error reporting */
	error_reporting(E_ALL);
	 
	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


	$objPHPExcel = new PHPExcel();
	//echo (count($alldata[1][1])); exit; 
	// Set document properties
	//echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("CRM")
								 ->setLastModifiedBy("R&D")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Report");


	// Create a first sheet, representing sales data
	$char = '';
	for($j = 0 ; $j < count($alldata) ; $j++ ){
		//Create new sheet
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($j);


		$data = $alldata[$j];
 
		$k = 3;
		 
		//echo $k . '-' . $flagcss ;
		//print_r($data[2]);

		foreach ($data[2] as $key2 => $value2) {
			 
			$count_cell = count($value2);
			for ($l=0; $l < $count_cell; $l++) { 
				$A = 66;
				if($count_cell == 3) $A = 66;
				$objPHPExcel->getActiveSheet()->setCellValue(chr($A+$l).$k, $value2[$l]);
				
			}

			//echo $k;
			//echo count($data[2]);
			//echo '<br>';
			
			//echo $value2[0];
			$k++;
 		} 
			//echo date('H:i:s') , " Add some data" , EOL;
		 
		//exit;
		 
			 
 		//if(count($data[2]) > 1)
			$i = 7; 
		//else
		//	$i = 5;
		$flag = 0;
		

		foreach ($data[1] as $key => $value) {
			$count_value = count($value);
			$l = 0;
			foreach ($value as $key) {
				 
				$objPHPExcel->getActiveSheet()->setCellValue(chr(66+$l).$i, $key);

				if( $i== 7 ){
					//if($flag == 0)
					{
						$flag = 1;
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setName('Candara');
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setSize(14);
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setBold(true);
					}
					
				}
				$l ++;
			}
			$char = chr(65+$l);
			$i ++;
			# code...
		}
		$char = chr(65+$l);

		 


		// Set cell number formats
		//echo date('H:i:s') , " Set cell number formats" , EOL;
		//$objPHPExcel->getActiveSheet()->getStyle('E4:E13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

		// Set column widths
		//echo date('H:i:s') , " Set column widths" , EOL;
  		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		// Set fonts
		//echo date('H:i:s') , " Set fonts" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		 

		// Set thin black border outline around column
		//echo date('H:i:s') , " Set thin black border outline around column" , EOL;
		//$styleThinBlackBorderOutline = array(
		//	'borders' => array(
		//		'outline' => array(
		//			'style' => PHPExcel_Style_Border::BORDER_THIN,
		//			'color' => array('argb' => 'FF000000'),
		//		),
		//	),
		//);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:E6')->applyFromArray($styleThinBlackBorderOutline);

		 
		// Set fills
		//echo date('H:i:s') , " Set fills" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('3C8DBC');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');

		if(count($data[2]) > 1){
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->getStartColor()->setARGB('0000FF');

			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->getStartColor()->setARGB('0000FF');
		} 
		

		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->getStartColor()->setARGB('0000FF');


		// Add a drawing to the worksheet
		//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('Logo'); 
		// $objDrawing->setDescription('Logo');
		// $objDrawing->setPath(__DIR__.'/../../images/logo-small.png');
		// $objDrawing->setHeight(44);
		// $objDrawing->setWidth(50);
		// $objDrawing->setCoordinates('A1');

		// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		$BStyle = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		$objPHPExcel->getActiveSheet()->getStyle('B7:'.$char.$i)->applyFromArray($BStyle);


		// Rename first worksheet
		//echo date('H:i:s') , " Rename first worksheet" , EOL;
		$objPHPExcel->getActiveSheet()->setTitle($data[0]);

		//echo $data[0];
		// Create a new worksheet, after the default sheet
		//echo date('H:i:s') , " Create a second Worksheet object" , EOL;


	}
	

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(PATH_FILE_REPORT);
	 
	// exit;
}

function exportv2($alldata){
	
	//print_r($data);
	/** Error reporting */
	error_reporting(E_ALL);
	 
	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


	$objPHPExcel = new PHPExcel();
	//echo (count($alldata[1][1])); exit; 
	// Set document properties
	//echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("CRM")
								 ->setLastModifiedBy("R&D")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Report");


	// Create a first sheet, representing sales data
	$char = '';
	for($j = 0 ; $j < count($alldata) ; $j++ ){
		//Create new sheet
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($j);


		$data = $alldata[$j];
 
		$k = 3;
		 
		//echo $k . '-' . $flagcss ;
		//print_r($data[2]);

		foreach ($data[2] as $key2 => $value2) {
			 
			$count_cell = count($value2);
			for ($l=0; $l < $count_cell; $l++) { 
				$A = 66;
				if($count_cell == 3) $A = 66;
				$objPHPExcel->getActiveSheet()->setCellValue(chr($A+$l).$k, $value2[$l]);
				
			}

			//echo $k;
			//echo count($data[2]);
			//echo '<br>';
			
			//echo $value2[0];
			$k++;
 		} 
			//echo date('H:i:s') , " Add some data" , EOL;
		 
		//exit;
		 
			 
 		//if(count($data[2]) > 1)
			$i = 11; 
		//else
		//	$i = 5;
		$flag = 0;
		

		foreach ($data[1] as $key => $value) {
			$count_value = count($value);
			$l = 0;
			foreach ($value as $key) {
				 
				$objPHPExcel->getActiveSheet()->setCellValue(chr(66+$l).$i, $key);

				if( $i== 11 ){
					//if($flag == 0)
					{
						$flag = 1;
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setName('Candara');
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setSize(14);
						$objPHPExcel->getActiveSheet()->getStyle(chr(66+$l).$i)->getFont()->setBold(true);
					}
					
				}
				$l ++;
			}
			$char = chr(65+$l);
			$i ++;
			# code...
		}
		$char = chr(65+$l);

		 


		// Set cell number formats
		//echo date('H:i:s') , " Set cell number formats" , EOL;
		//$objPHPExcel->getActiveSheet()->getStyle('E4:E13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

		// Set column widths
		//echo date('H:i:s') , " Set column widths" , EOL;
  		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		// Set fonts
		//echo date('H:i:s') , " Set fonts" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		 

		// Set thin black border outline around column
		//echo date('H:i:s') , " Set thin black border outline around column" , EOL;
		//$styleThinBlackBorderOutline = array(
		//	'borders' => array(
		//		'outline' => array(
		//			'style' => PHPExcel_Style_Border::BORDER_THIN,
		//			'color' => array('argb' => 'FF000000'),
		//		),
		//	),
		//);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:E6')->applyFromArray($styleThinBlackBorderOutline);

		 
		// Set fills
		//echo date('H:i:s') , " Set fills" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('3C8DBC');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');

		if(count($data[2]) > 1){
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->getStartColor()->setARGB('0000FF');

			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getFill()->getStartColor()->setARGB('0000FF');
		} 
		

		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		//$objPHPExcel->getActiveSheet()->getStyle('A13:F13')->getFill()->getStartColor()->setARGB('0000FF');


		// Add a drawing to the worksheet
		//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo'); 
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('images/logo-small.png');
		$objDrawing->setHeight(44);
		$objDrawing->setWidth(50);
		$objDrawing->setCoordinates('A1');

		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		$BStyle = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		$objPHPExcel->getActiveSheet()->getStyle('B11:'.$char.$i)->applyFromArray($BStyle);


		// Rename first worksheet
		//echo date('H:i:s') , " Rename first worksheet" , EOL;
		$objPHPExcel->getActiveSheet()->setTitle($data[0]);

		//echo $data[0];
		// Create a new worksheet, after the default sheet
		//echo date('H:i:s') , " Create a second Worksheet object" , EOL;


	}
	

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	 
	

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="report-'.$data[0].'-'.gmdate('D, d M Y H:i:s').'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	exit;
}
function exportv3($alldata){
	error_reporting(E_ALL);
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("CRM")
								 ->setLastModifiedBy("R&D")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Report");
	$char = '';
	for($j = 0 ; $j < count($alldata) ; $j++ ){
		//Create new sheet
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($j);
		$data = $alldata[$j];
		
		$k = 3;
		foreach ($data[2] as $key2 => $value2) {
			$count_cell = count($value2);
			for ($l=0; $l < $count_cell; $l++) { 
				$A = 66;
				if($count_cell == 3) $A = 66;
				$objPHPExcel->getActiveSheet()->setCellValue(chr($A+$l).$k, $value2[$l]);
			}
			$k++;
 		}
		
		$i = 11; 
		foreach ($data[1] as $key => $value) {
			$q = -1;
			$l = 0;
			foreach ($value as $key) {
				if ($q>=0){
					$objPHPExcel->getActiveSheet()->setCellValue(chr(65+$q).chr(65+$l).$i, $key);
				}else{
					$objPHPExcel->getActiveSheet()->setCellValue(chr(65+$l).$i, $key);
				}
				$l ++;
				if ($l==26){
					$l=0;
					$q++;
				}
			}
			$char = chr(65+$l);
			$i ++;
		}
		$char = chr(65+$l);
  		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		// Set fonts
		//echo date('H:i:s') , " Set fonts" , EOL;
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('3C8DBC');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');

		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo'); 
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('images/logo-small.png');
		$objDrawing->setHeight(44);
		$objDrawing->setWidth(50);
		$objDrawing->setCoordinates('A1');

		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		$BStyle = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		$objPHPExcel->getActiveSheet()->getStyle('B11:'.$char.$i)->applyFromArray($BStyle);
		$objPHPExcel->getActiveSheet()->setTitle($data[0]);
	}
	

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	 
	

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="report-'.$data[0].'-'.gmdate('D, d M Y H:i:s').'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');

	exit;
}
