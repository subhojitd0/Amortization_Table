<?php

if (isset($_POST['dwnxls']))
{
	$amortization = unserialize($_POST['amortize']);

	require_once "PHPExcel/Classes/PHPExcel/IOFactory.php";
	$objTpl = PHPExcel_IOFactory::load("template.xls");
	$objTpl->setActiveSheetIndex(0);  //set first sheet as active

	//$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
	//$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified

	

	$i=0;
	$j=2;
	while($amortization[$i][4]!="0")
	{		

			$serial="A".$j;
			$dte="B".$j;
			$emi="C".$j;
			$int="D".$j;
			$paid="E".$j;
			$left="F".$j;

			$objTpl->getActiveSheet()->setCellValue($serial,$amortization[$i][5]);
			$objTpl->getActiveSheet()->setCellValue($dte,$amortization[$i][0] );
			$objTpl->getActiveSheet()->setCellValue($emi,number_format(round($amortization[$i][1])) );
			$objTpl->getActiveSheet()->setCellValue($int,number_format(round($amortization[$i][2])) );
			$objTpl->getActiveSheet()->setCellValue($paid,number_format(round($amortization[$i][3])) );
			$objTpl->getActiveSheet()->setCellValue($left,number_format(round($amortization[$i][4])) );

			$i=$i+1;
			$j=$j+1;

	}

			$serial="A".$j;
			$dte="B".$j;
			$emi="C".$j;
			$int="D".$j;
			$paid="E".$j;
			$left="F".$j;

			$objTpl->getActiveSheet()->setCellValue($serial,$amortization[$i][5] );
			$objTpl->getActiveSheet()->setCellValue($dte,$amortization[$i][0] );
			$objTpl->getActiveSheet()->setCellValue($emi,number_format(round($amortization[$i][1])) );
			$objTpl->getActiveSheet()->setCellValue($int,number_format(round($amortization[$i][2])) );
			$objTpl->getActiveSheet()->setCellValue($paid,number_format(round($amortization[$i][3])) );
			$objTpl->getActiveSheet()->setCellValue($left,number_format(round($amortization[$i][4])) );

$objTpl->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);  //set wrapped for some long text message
$objTpl->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
$objTpl->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
$objTpl->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
$objTpl->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
$objTpl->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);


//$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
//$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
//$objTpl->getActiveSheet()->getStyle('A0:F0')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned

//prepare download
$filename='MoneyPartner_'.mt_rand(1,100000).'.xls'; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!




}


?>