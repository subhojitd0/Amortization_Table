<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Loan Amortization</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/animate.min.css" rel="stylesheet"> 
	<link href="css/animate.css" rel="stylesheet" />
	<link href="css/prettyPhoto.css" rel="stylesheet"> 
	<link href="css/style.css" rel="stylesheet">
	
    <!-- =======================================================
        Theme Name: OnePage
        Theme URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>
  <body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="row">
					<?php
					if (isset($_POST['btn_cal_ubl']))
					{
						echo "<div class='site-logo'>
								<a href='index.php' class='brand'>Unsecured Business Loan</a>
							</div>";
					}
					elseif(isset($_POST['btn_cal_hl']))
					{
						echo "<div class='site-logo'>
								<a href='index.php' class='brand'>Home Loan</a>
							</div>";
					}
					elseif(isset($_POST['btn_cal_lap']))
					{
						echo "<div class='site-logo'>
								<a href='index.php' class='brand'>Loan Against Property</a>
							</div>";
					}
					else
					{
						header('Location: index.php');
					}
					?>
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
							<i class="fa fa-bars"></i>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="menu">
						<ul class="nav navbar-nav navbar-right">
							 			                                                                  								  
							 


							  <li><a href="#graph" style="color:#c92800;">Download The Table</a></li>
						</ul>
					</div>
					<!-- /.Navbar-collapse -->		 
			</div>
		</div>		
	</nav>
   

   </br></br>
	<section id="about">
		</br></br></br>
	
        <div class="container">
            <div class="row">
                <div class="col-sm-6 wow fadeInRight">
					


<?php

//$total_loan=100000;
//$downpayment=20000;
//$roi=10;
//$tenure=60;

if (isset($_POST['btn_cal_ubl']))
{

$ti=0;
$forclose=(float)($_POST["forper"]/100);


$dateElements = explode('-', $_POST["begin"]);
$month = $dateElements[1];
$date = $dateElements[2];
$year=$dateElements[0];

$dt=$_POST["begin"];
//$total_loan=$_POST["loanamt"];
//$downpayment=$_POST["downpayment"];
$roi=$_POST["roi"];

if($_POST["tentype"]=="Month")
{
	$tenure=$_POST["tenure"];
}
else
{
	if(strlen($_POST["tenure"])>5)
	{
		$full_tenure=explode('-',$_POST["tenure"]);
		$tenure_fl=((float)$full_tenure[1])*12;
		$tenure=(int)$tenure_fl;
	}
	else
	{	
		$full_tenure[0]=((float)$_POST["tenure"]);
		$full_tenure[1]=((float)$_POST["tenure"]);
		$tenure_fl=((float)$_POST["tenure"])*12;
		$tenure=(int)$tenure_fl;
	}
}

if($_POST["loanamtubl"]!="")
{
	$total_loan=$_POST["loanamtubl"];
}
elseif ($_POST["loanamthl"]!="") 
{
	$total_loan=$_POST["loanamthl"];
}
else{
	$total_loan=$_POST["loanamtlap"];
}

if($_POST["inspay"]==0)
{
	$total_loan=$total_loan+$_POST["loanins"];
}


if($_POST["downpaymenthl"]!="")
{
	$downpayment=$_POST["downpaymenthl"];
}
elseif ($_POST["downpaymentlap"]!="") 
{
	$downpayment=$_POST["downpaymentlap"];
}
else{
	$downpayment=0;
}

//prepayment info
$prepayment=$_POST["prepay"];

if($prepayment!=0)
{
	$prebegindate=$_POST["prebegin"];
	$preamount=$_POST["preamount"];
	$prepayopt=$_POST["prepayopt"];
	$prespan=$_POST["recur"];
}

$finp=$_POST["finprepay"];
if($finp!=0)
{
	$find=$_POST["findate"];
}


$principal=$total_loan-$downpayment;
$month_interest=($roi/12)/100;

if($prepayment)
{
	if($prepayopt=="ec")
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce tenure)</h3></br></br>";
	}
	elseif ($prepayopt=="tc") 
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce EMI)</h3></br></br>";
	}
}
else
{
	//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(Without Prepayment)</h3></br></br>";
}
$num_emi=pow((1+$month_interest),$tenure);
$den_emi=pow((1+$month_interest),($tenure))-1;

$emi=$principal*$month_interest*($num_emi/$den_emi);

//$emi=round($emi);

$newforamnt=0;
$html="<table class='table table-bordered' align='center'><thead class='thead-inverse' style='background: #e6e6e6;'><tr><th>Installment No.</th><th>Payment Date</th><th>Payment Amount</th><th>Interest Paid</th><th>Principal Paid</th><th>Principal Left</th></tr></thead>";



//[n][0]-date [n][1]-emi ; [n][2]-interest ; [n][3]-principal ; [n][4]-outstanding

$amortization[0][0]=$dt;
$amortization[0][1]=$emi;
$amortization[0][2]=$principal*$month_interest;
$amortization[0][3]=$emi-$amortization[0][2];
$amortization[0][4]=$principal-$amortization[0][3];
$amortization[0][5]=1;
$ti=$ti+$amortization[0][2];
$html=$html."<tr align='center'><td>".$amortization[0][5]."</td><td>".$amortization[0][0]."</td><td>&#8377;".number_format(round($amortization[0][1]))."</td><td>&#8377;".number_format(round($amortization[0][2]))."</td><td>&#8377;".number_format(round($amortization[0][3]))."</td><td>&#8377;".number_format(round($amortization[0][4]))."</td></tr>";

$actualemicounter=2;
$preflag=0;

for($i=1;$actualemicounter<=$tenure;$i++)
{	
	
	$j=$i-1;

	$dateElements = explode('-', $amortization[$j][0]);
	$month = $dateElements[1];
	$date = $dateElements[2];
	$year=$dateElements[0];
	$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date, $year))	;

	if($date==29 && $month==1 && $year%4!=0)
	{
		$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date-1, $year))	;
	}

		if($prepayment)
		{
			
			if($prebegindate>=$amortization[$j][0] && $prebegindate<=$newdt && $preamount<$amortization[$j][4])
			{	
				$diff= round(abs(strtotime($amortization[$j][0])-strtotime($prebegindate))/86400);
				
				if($prepayopt=="ec")
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/30);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}


					$i=$i+1;
					$j=$i-1;
				}
				elseif ($prepayopt=="tc") 
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					if($amortization[$j][4]*(($month_interest*$diff)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/$bs);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					
					$modtenure=$tenure-$actualemicounter+1;
					$num_emi=pow((1+$month_interest),$modtenure);
					$den_emi=pow((1+$month_interest),($modtenure))-1;

					$emi=$amortization[$i][4]*$month_interest*($num_emi/$den_emi);
					//$emi=round($emi);

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}

					$i=$i+1;
					$j=$i-1;
				}
				
				//$prebegindate=$dt;
				$preflag=1;

			}


		}

		if(($preflag==1 && $amortization[$j][4]>1)||$preflag==0)
		{
						if($preflag==1)
						{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$bd=date('Y-m-d',mktime(0, 0, 0, $premonth-$prespan  , $predate, $preyear))	;
						$d=round(abs(strtotime($newdt)-strtotime($bd))/86400);
						}
						else
						{
							$d=100;
						}

						//echo $d."-";
				if($d<29)
				{
					//echo "**".$d."*".$amortization[$j][4]*(($month_interest*$d)/30)."**";
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				if($amortization[$j][4]*(($month_interest*$d)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
				$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$d)/$bs);
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}
				else
				{
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				$amortization[$i][2]=$amortization[$j][4]*$month_interest;
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}

			if($amortization[$i][4]<0)
			{
					$amortization[$i][1]=($amortization[$j][4]*$month_interest)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*$month_interest;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$ti=$ti+$amortization[$i][2];
			}

					

			$html=$html."<tr align='center'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

			$preflag=0;

			
			if($finp!=0 && round(abs(strtotime($find)-strtotime($amortization[$i][0]))/86400)<=31)
			{
				$i=$i+1;
				$j=$i-1;
				$dtcal=round(abs(strtotime($find)-strtotime($amortization[$j][0]))/86400);

					$amortization[$i][1]=($amortization[$j][4]*($month_interest/31)*$dtcal)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*($month_interest/31)*$dtcal;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$amortization[$i][0]=$find;
					$amortization[$i][5]="Final Prepayment";
					
					if($forclose!=0)
					{

						$newforamnt=$amortization[$j][4]*$forclose;
						
						$amortization[$i][1]=$amortization[$i][1]+$newforamnt;
						
					}

					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";
			}

			
		}

		$actualemicounter++;

		if($amortization[$i][4]<=0)
		{
			$actualemicounter=$tenure+10;
		}
}

//print_r($amortization);

$html=$html."</table>";

if($forclose!=0 && $finp!=0)
{
$html=$html."<p style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>* Foreclosure Amount of &#8377;".round($newforamnt)." have been added with the Final Prepayment</p>";
}

echo $html;

//echo $actualemicounter;

}

//--------------------------------------------HOMELOAN-------------------------------------------------------------------

if (isset($_POST['btn_cal_hl']))
{

$ti=0;
$forclose=(float)($_POST["forper"]/100);

$dateElements = explode('-', $_POST["begin"]);
$month = $dateElements[1];
$date = $dateElements[2];
$year=$dateElements[0];

$dt=$_POST["begin"];
//$total_loan=$_POST["loanamt"];
//$downpayment=$_POST["downpayment"];
$roi=$_POST["roi"];

if($_POST["tentype"]=="Month")
{
	$tenure=$_POST["tenure"];
}
else
{
	if(strlen($_POST["tenure"])>5)
	{
		$full_tenure=explode('-',$_POST["tenure"]);
		$tenure_fl=((float)$full_tenure[1])*12;
		$tenure=(int)$tenure_fl;
	}
	else
	{	
		$full_tenure[0]=((float)$_POST["tenure"]);
		$full_tenure[1]=((float)$_POST["tenure"]);
		$tenure_fl=((float)$_POST["tenure"])*12;
		$tenure=(int)$tenure_fl;
	}
}


if($_POST["loanamtubl"]!="")
{
	$total_loan=$_POST["loanamtubl"];
}
elseif ($_POST["loanamthl"]!="") 
{
	$total_loan=$_POST["loanamthl"];
}
else{
	$total_loan=$_POST["loanamtlap"];
}

if($_POST["inspay"]==0)
{
	$total_loan=$total_loan+$_POST["loanins"];
}

$temp=$_POST["downpaymenthl"];

if($_POST["downpaymenthl"]!="")
{	
	if($_POST["dpopt"]=="Amount")
	{
		$downpayment=$_POST["downpaymenthl"];
	}
	else
	{
		$downpayment=(($_POST["downpaymenthl"]/100)*$_POST["loanamthl"]);
	}
}
else{
	$downpayment=0;
}

//prepayment info
$prepayment=$_POST["prepay"];

if($prepayment!=0)
{
	$prebegindate=$_POST["prebegin"];
	$preamount=$_POST["preamount"];
	$prepayopt=$_POST["prepayopt"];
	$prespan=$_POST["recur"];
}

$finp=$_POST["finprepay"];
if($finp!=0)
{
	$find=$_POST["findate"];
}


$principal=$total_loan-$downpayment;
$month_interest=($roi/12)/100;

if($prepayment)
{
	if($prepayopt=="ec")
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce tenure)</h3></br></br>";
	}
	elseif ($prepayopt=="tc") 
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce EMI)</h3></br></br>";
	}
}
else
{
	//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(Without Prepayment)</h3></br></br>";
}
$num_emi=pow((1+$month_interest),$tenure);
$den_emi=pow((1+$month_interest),($tenure))-1;

$emi=$principal*$month_interest*($num_emi/$den_emi);

//$emi=round($emi);
$newforamnt=0;

$html="<table class='table table-bordered' align='center'><thead class='thead-inverse' style='background: #e6e6e6;'><tr><th>Installment No.</th><th>Payment Date</th><th>Payment Amount</th><th>Interest Paid</th><th>Principal Paid</th><th>Principal Left</th></tr></thead>";



//[n][0]-date [n][1]-emi ; [n][2]-interest ; [n][3]-principal ; [n][4]-outstanding

$amortization[0][0]=$dt;
$amortization[0][1]=$emi;
$amortization[0][2]=$principal*$month_interest;
$amortization[0][3]=$emi-$amortization[0][2];
$amortization[0][4]=$principal-$amortization[0][3];
$amortization[0][5]=1;
$ti=$ti+$amortization[0][2];
$html=$html."<tr align='center'><td>".$amortization[0][5]."</td><td>".$amortization[0][0]."</td><td>&#8377;".number_format(round($amortization[0][1]))."</td><td>&#8377;".number_format(round($amortization[0][2]))."</td><td>&#8377;".number_format(round($amortization[0][3]))."</td><td>&#8377;".number_format(round($amortization[0][4]))."</td></tr>";

$actualemicounter=2;
$preflag=0;

for($i=1;$actualemicounter<=$tenure;$i++)
{	
	
	$j=$i-1;

	$dateElements = explode('-', $amortization[$j][0]);
	$month = $dateElements[1];
	$date = $dateElements[2];
	$year=$dateElements[0];
	$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date, $year))	;

	if($date==29 && $month==1 && $year%4!=0)
	{
		$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date-1, $year))	;
	}

		if($prepayment)
		{
			
			if($prebegindate>=$amortization[$j][0] && $prebegindate<=$newdt && $preamount<$amortization[$j][4])
			{	
				$diff= round(abs(strtotime($amortization[$j][0])-strtotime($prebegindate))/86400);
				
				if($prepayopt=="ec")
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/30);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}


					$i=$i+1;
					$j=$i-1;
				}
				elseif ($prepayopt=="tc") 
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					if($amortization[$j][4]*(($month_interest*$diff)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/$bs);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					
					$modtenure=$tenure-$actualemicounter+1;
					$num_emi=pow((1+$month_interest),$modtenure);
					$den_emi=pow((1+$month_interest),($modtenure))-1;

					$emi=$amortization[$i][4]*$month_interest*($num_emi/$den_emi);
					//$emi=round($emi);

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}

					$i=$i+1;
					$j=$i-1;
				}
				
				//$prebegindate=$dt;
				$preflag=1;

			}


		}

		if(($preflag==1 && $amortization[$j][4]>1)||$preflag==0)
		{
						if($preflag==1)
						{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$bd=date('Y-m-d',mktime(0, 0, 0, $premonth-$prespan  , $predate, $preyear))	;
						$d=round(abs(strtotime($newdt)-strtotime($bd))/86400);
						}
						else
						{
							$d=100;
						}

						//echo $d."-";
				if($d<29)
				{
					//echo "**".$d."*".$amortization[$j][4]*(($month_interest*$d)/30)."**";
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				if($amortization[$j][4]*(($month_interest*$d)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
				$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$d)/$bs);
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}
				else
				{
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				$amortization[$i][2]=$amortization[$j][4]*$month_interest;
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}

			if($amortization[$i][4]<0)
			{
					$amortization[$i][1]=($amortization[$j][4]*$month_interest)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*$month_interest;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$ti=$ti+$amortization[$i][2];
			}

					

			$html=$html."<tr align='center'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

			$preflag=0;

			
			if($finp!=0 && round(abs(strtotime($find)-strtotime($amortization[$i][0]))/86400)<=31)
			{
				$i=$i+1;
				$j=$i-1;
				$dtcal=round(abs(strtotime($find)-strtotime($amortization[$j][0]))/86400);

					$amortization[$i][1]=($amortization[$j][4]*($month_interest/31)*$dtcal)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*($month_interest/31)*$dtcal;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$amortization[$i][0]=$find;
					$amortization[$i][5]="Final Prepayment";
					
					if($forclose!=0)
					{

						$newforamnt=$amortization[$j][4]*$forclose;
						
						$amortization[$i][1]=$amortization[$i][1]+$newforamnt;
						
					}

					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";
			}

			
		}

		$actualemicounter++;

		if($amortization[$i][4]<=0)
		{
			$actualemicounter=$tenure+10;
		}
}

//print_r($amortization);

$html=$html."</table>";

if($forclose!=0 && $finp!=0)
{
$html=$html."<p style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>* Foreclosure Amount of &#8377;".round($newforamnt)." have been added with the Final Prepayment</p>";
}

echo $html;



//echo $actualemicounter;

}


//-----------------------------------------------------LOAN_AGAINST_PROPERTY--------------------------------------------------------



if (isset($_POST['btn_cal_lap']))
{

$ti=0;
$forclose=(float)($_POST["forper"]/100);

$dateElements = explode('-', $_POST["begin"]);
$month = $dateElements[1];
$date = $dateElements[2];
$year=$dateElements[0];

$dt=$_POST["begin"];
//$total_loan=$_POST["loanamt"];
//$downpayment=$_POST["downpayment"];
$roi=$_POST["roi"];

if($_POST["tentype"]=="Month")
{
	$tenure=$_POST["tenure"];
}
else
{
	if(strlen($_POST["tenure"])>5)
	{
		$full_tenure=explode('-',$_POST["tenure"]);
		$tenure_fl=((float)$full_tenure[1])*12;
		$tenure=(int)$tenure_fl;
	}
	else
	{	
		$full_tenure[0]=((float)$_POST["tenure"]);
		$full_tenure[1]=((float)$_POST["tenure"]);
		$tenure_fl=((float)$_POST["tenure"])*12;
		$tenure=(int)$tenure_fl;
	}
}




	$total_loan=0;




if($_POST["downpaymentlap"]!="")
{	
	if($_POST["dpoptlap"]=="Amount")
	{
		$downpayment=$_POST["downpaymentlap"];
	}
	else
	{
		$downpayment=(($_POST["downpaymentlap"]/100)*$_POST["loanamtlap"]);
	}
}
else
{
	$downpayment=0;
}


$principal=$total_loan-$downpayment;


if($_POST["inspay"]==0)
{
	$total_loan=$_POST["loanins"];
}

$principal=$downpayment+$total_loan;

//prepayment info
$prepayment=$_POST["prepay"];

if($prepayment!=0)
{
	$prebegindate=$_POST["prebegin"];
	$preamount=$_POST["preamount"];
	$prepayopt=$_POST["prepayopt"];
	$prespan=$_POST["recur"];
}

$finp=$_POST["finprepay"];
if($finp!=0)
{
	$find=$_POST["findate"];
}



$month_interest=($roi/12)/100;

if($prepayment)
{
	if($prepayopt=="ec")
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce tenure)</h3></br></br>";
	}
	elseif ($prepayopt=="tc") 
	{
		//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(With Prepayment, Reduce EMI)</h3></br></br>";
	}
}
else
{
	//$html="<h3 align='center'>For a loan amount of ".$principal." at an Interest rate of ".$roi." percent for ".$tenure." months, following are the calculation(Without Prepayment)</h3></br></br>";
}
$num_emi=pow((1+$month_interest),$tenure);
$den_emi=pow((1+$month_interest),($tenure))-1;

$emi=$principal*$month_interest*($num_emi/$den_emi);

//$emi=round($emi);
$newforamnt=0;

$html="<table class='table table-bordered' align='center'><thead class='thead-inverse' style='background: #e6e6e6;'><tr><th>Installment No.</th><th>Payment Date</th><th>Payment Amount</th><th>Interest Paid</th><th>Principal Paid</th><th>Principal Left</th></tr></thead>";


//[n][0]-date [n][1]-emi ; [n][2]-interest ; [n][3]-principal ; [n][4]-outstanding

$amortization[0][0]=$dt;
$amortization[0][1]=$emi;
$amortization[0][2]=$principal*$month_interest;
$amortization[0][3]=$emi-$amortization[0][2];
$amortization[0][4]=$principal-$amortization[0][3];
$amortization[0][5]=1;
$ti=$ti+$amortization[0][2];
$html=$html."<tr align='center'><td>".$amortization[0][5]."</td><td>".$amortization[0][0]."</td><td>&#8377;".number_format(round($amortization[0][1]))."</td><td>&#8377;".number_format(round($amortization[0][2]))."</td><td>&#8377;".number_format(round($amortization[0][3]))."</td><td>&#8377;".number_format(round($amortization[0][4]))."</td></tr>";

$actualemicounter=2;
$preflag=0;

for($i=1;$actualemicounter<=$tenure;$i++)
{	
	
	$j=$i-1;

	$dateElements = explode('-', $amortization[$j][0]);
	$month = $dateElements[1];
	$date = $dateElements[2];
	$year=$dateElements[0];
	$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date, $year))	;

	if($date==29 && $month==1 && $year%4!=0)
	{
		$newdt=date('Y-m-d',mktime(0, 0, 0, $month+1  , $date-1, $year))	;
	}

		if($prepayment)
		{
			
			if($prebegindate>=$amortization[$j][0] && $prebegindate<=$newdt && $preamount<$amortization[$j][4])
			{	
				$diff= round(abs(strtotime($amortization[$j][0])-strtotime($prebegindate))/86400);
				
				if($prepayopt=="ec")
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/30);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}


					$i=$i+1;
					$j=$i-1;
				}
				elseif ($prepayopt=="tc") 
				{
					$amortization[$i][0]=$prebegindate;
					$amortization[$i][1]=$preamount;
					if($amortization[$j][4]*(($month_interest*$diff)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
					$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$diff)/$bs);
					$amortization[$i][3]=$preamount-$amortization[$i][2];
					$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
					$amortization[$i][5]="Prepayment";
					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

					
					$modtenure=$tenure-$actualemicounter+1;
					$num_emi=pow((1+$month_interest),$modtenure);
					$den_emi=pow((1+$month_interest),($modtenure))-1;

					$emi=$amortization[$i][4]*$month_interest*($num_emi/$den_emi);
					//$emi=round($emi);

					if($preamount<$amortization[$i][4])
					{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$prebegindate=date('Y-m-d',mktime(0, 0, 0, $premonth+$prespan  , $predate, $preyear))	;
						
					}

					$i=$i+1;
					$j=$i-1;
				}
				
				//$prebegindate=$dt;
				$preflag=1;

			}


		}

		if(($preflag==1 && $amortization[$j][4]>1)||$preflag==0)
		{
						if($preflag==1)
						{
						$predateElements = explode('-', $prebegindate);
						$premonth = $predateElements[1];
						$predate = $predateElements[2];
						$preyear=$predateElements[0];
						$bd=date('Y-m-d',mktime(0, 0, 0, $premonth-$prespan  , $predate, $preyear))	;
						$d=round(abs(strtotime($newdt)-strtotime($bd))/86400);
						}
						else
						{
							$d=100;
						}

						//echo $d."-";
				if($d<29)
				{
					//echo "**".$d."*".$amortization[$j][4]*(($month_interest*$d)/30)."**";
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				if($amortization[$j][4]*(($month_interest*$d)/30)>$amortization[$j][2])
					{
						$bs=31;
					}
					else
					{
						$bs=30;
					}
				$amortization[$i][2]=$amortization[$j][4]*(($month_interest*$d)/$bs);
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}
				else
				{
				$amortization[$i][0]=$newdt;
				$amortization[$i][1]=$emi;
				$amortization[$i][2]=$amortization[$j][4]*$month_interest;
				$amortization[$i][3]=$emi-$amortization[$i][2];
				$amortization[$i][4]=$amortization[$j][4]-$amortization[$i][3];
				$amortization[$i][5]=$actualemicounter;
				$ti=$ti+$amortization[$i][2];
				}

			if($amortization[$i][4]<0)
			{
					$amortization[$i][1]=($amortization[$j][4]*$month_interest)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*$month_interest;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$ti=$ti+$amortization[$i][2];
			}

					

			$html=$html."<tr align='center'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";

			$preflag=0;

			
			if($finp!=0 && round(abs(strtotime($find)-strtotime($amortization[$i][0]))/86400)<=31)
			{
				$i=$i+1;
				$j=$i-1;
				$dtcal=round(abs(strtotime($find)-strtotime($amortization[$j][0]))/86400);

					$amortization[$i][1]=($amortization[$j][4]*($month_interest/31)*$dtcal)+$amortization[$j][4];
					$amortization[$i][2]=$amortization[$j][4]*($month_interest/31)*$dtcal;
					$amortization[$i][3]=$amortization[$j][4];
					$amortization[$i][4]=-($amortization[$j][4]-$amortization[$i][3]);
					$amortization[$i][0]=$find;
					$amortization[$i][5]="Final Prepayment";
					
					if($forclose!=0)
					{

						$newforamnt=$amortization[$j][4]*$forclose;
						
						$amortization[$i][1]=$amortization[$i][1]+$newforamnt;
						
					}

					$ti=$ti+$amortization[$i][2];
					$html=$html."<tr align='center' style='background: #e6e6e6;'><td>".$amortization[$i][5]."</td><td>".$amortization[$i][0]."</td><td>&#8377;".number_format(round($amortization[$i][1]))."</td><td>&#8377;".number_format(round($amortization[$i][2]))."</td><td>&#8377;".number_format(round($amortization[$i][3]))."</td><td>&#8377;".number_format(round($amortization[$i][4]))."</td></tr>";
			}

			
		}

		$actualemicounter++;

		if($amortization[$i][4]<=0)
		{
			$actualemicounter=$tenure+10;
		}
}

//print_r($amortization);

$html=$html."</table>";


if($forclose!=0 && $finp!=0)
{ 
$html=$html."<p style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>* Foreclosure Amount of &#8377;".round($newforamnt)." have been added with the Final Prepayment</p>";
}
echo $html;

//echo $actualemicounter;

}



?>




					



                </div><!--/1st half with the table-->

                <div class="col-sm-6 wow fadeInDown">

               

                <?php

				if (isset($_POST['btn_cal_ubl']))
				{
					
						$formmod= "<form method='post' name='loancal_ubl' action='' >
									             <div class='row'>
                				        	<div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Value :</label>
								                  	<input type='number' name='loanamtubl' placeholder='Enter Your Amount Here' class='form-control' min='10000' step='100' value='".$_POST["loanamtubl"]."' required/> 
									               </div>
								                 <div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Rate of Interest :</label>
								                  <input type='number' name='roi' placeholder='Rate of Interest' class='form-control' min='5' step='.01'  value='".$_POST["roi"]."' required/>
									               </div>
									             </div>
									
									             <div class='row'>
                				      	<div class='col-md-6'>
										              <label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Total Tenure </label>";


										     if($_POST["tentype"]=="Year")
										     {
    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' checked='checked' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='1' value='".round((float)($tenure/12))."' required/>
    											</div>";
    										}
    										else
    										{

    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' checked='checked' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='.5' value='".$tenure."' required/>
    											</div>";
    										}
    											
                                       				

                                    	
  
           									
                                  
                                  
								        $formmod=$formmod."</div>
									                <div class='col-md-6' ><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Start Date:</label>
								                	   <input type='date' name='begin' class='form-control' value='".$_POST["begin"]."' required/>
							               	   	</div>
									
								          	   </div>
                             <br>
                
                              <div class='row'>
                                 <div class='col-md-1'></div>
                                 <input type='hidden' name='prepay' value='0' />
                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Regular Prepay ?</label>";

                                 if($_POST["prepay"]!=0)
                               	{
                               		$formmod=$formmod."<input type='checkbox' name='prepay' value='1' class='form-control' checked/></div>";
                           		}
                           		else
                           		{

                           			$formmod=$formmod."<input type='checkbox' name='prepay' value='1' class='form-control'/></div>";
                           		}


                                 

                               	$formmod=$formmod."<div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Prepayment Date :</label><input type='date' name='prebegin' class='form-control' value='".$_POST["prebegin"]."'/></div>

                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'> Amount:</label><input type='text' name='preamount' class='form-control' placeholder='Amount' value='".$_POST["preamount"]."'/></div>

                              </div>

                              <div class='row'>
                                 <div class='col-md-4'></div>
                                 <div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Frequency:</label>
                                     <select name='recur' class='form-control'>";


                                    if($_POST["recur"]==0)
                                    {
                                     	$formmod=$formmod."<option value='0' selected>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>";
                                    }
                                    elseif($_POST["recur"]==4)
                                    {
                                    	$formmod=$formmod."<option value='0'>One Time</option>
                                        <option value='4' selected>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>";

                                    }
                                    elseif($_POST["recur"]==6)
                                    {
                                    	$formmod=$formmod."<option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6' selected>Semi Anually</option>
                                        <option value='12'>Anually</option>";

                                    }
                                    else
                                    {
                                    	$formmod=$formmod."<option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12' selected>Anually</option>";

                                    }

                                     $formmod=$formmod."</select>

                                 </div>
                      
                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>EMI/tenure:</label>
                                   <select name='prepayopt' class='form-control'>";


                                   
                                   	if($_POST["prepayopt"]=="tc")
                                   	{
                                   		$formmod=$formmod."<option value='tc' selected>Tenure Fix</option>
                                     	<option value='ec'>EMI Fix</option>";
                                 	}
                                 	else
                                 	{
                                 		$formmod=$formmod."<option value='tc' selected>Tenure Fix</option>
                                     	<option value='ec' selected>EMI Fix</option>";
                                 	}




                                  $formmod=$formmod."</select>

                                </div>

                            </div>

                            <div class='row'>
                               <div class='col-md-1'></div>
                                  <input type='hidden' name='finprepay' value='0' />
                               <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Full Prepay ?</label> ";

                               	if($_POST["finprepay"]!=0)
                               	{
                               		$formmod=$formmod."<input type='checkbox' name='finprepay' value='1' class='form-control' checked /></div>";
                           		}
                           		else
                           		{

                           			$formmod=$formmod."<input type='checkbox' name='finprepay' value='1' class='form-control'/></div>";
                           		}

                                $formmod=$formmod."<div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Final Prepayment Date :</label>
                                   <input type='date' name='findate' class='form-control' value='".$_POST["findate"]."'/></div>

                                   <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Foreclosure % :</label>
                                   <input type='number' name='forper' class='form-control' min='0' step='.01'  value='".$_POST["forper"]."'/></div>

                            </div>
                  
                            <div class='row'>
                              
                              <div class='col-md-7'><a href='index.php' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Change Loan Type</a> </div>

                              <div class='col-md-5'><button type='submit' value='submit' name='btn_cal_ubl' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Modify Loan Details</button></div>
                              
                              <input type='hidden' name='inspay' value='100' />
                               <input type='hidden' name='downpaymenthl' value='' />
                                <input type='hidden' name='downpaymentlap' value='' />
                            </div>

								
                            </form>";




                            echo $formmod;

				}
















				if (isset($_POST['btn_cal_hl']))
				{
					
						$formmod= "<form method='post' name='loancal_hl' action='loancalculation.php'>
                               <div class='row'>
                                  <div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Agreement Value :</label>
                                    <input type='number' name='loanamthl' placeholder='Enter Your Amount Here' class='form-control' min='10000' step='100'   value='".$_POST["loanamthl"]."' required/> 
                                    <input type='hidden' name='loanamtubl' value='' />
                                 </div>
                                 <div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Rate of Interest :</label>
                                  <input type='number' name='roi' placeholder='Rate of Interest' class='form-control' min='5' step='.01'  value='".$_POST["roi"]."' required/>
                                 </div>
                               </div>

                              <div class='row'>
                               <div class='col-md-6'>";

                                if($_POST["dpopt"]=="Percentage")
                                {
                               		$formmod=$formmod."<label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;''>Margin Money :</label>  
                                  		<div class='input-group'>
                                    	<span class='input-group-addon'>
                                      		<input type='radio' value='Percentage' name='dpopt' checked='checked' class='downrd2'>Percent</input>&nbsp;&nbsp;
                                      		<input type='radio' value='Amount' name='dpopt' class='downrd2'>Amount</input>
                                    	</span>
                                	  		<input type='number' name='downpaymenthl' id='down2' class='form-control' min='1' step='.01' value='".$_POST["downpaymenthl"]."' required/>
                                		</div>";
                                }
                                else
                                {
                                
                               		$formmod=$formmod."<label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;''>Margin Money :</label>  
                                  		<div class='input-group'>
                                    	<span class='input-group-addon'>
                                      		<input type='radio' value='Percentage' name='dpopt' class='downrd2'>Percentage</input>&nbsp;&nbsp;
                                      		<input type='radio' value='Amount' name='dpopt' checked='checked'  class='downrd2'>Amount</input>
                                    	</span>
                                	  		<input type='number' name='downpaymenthl' id='down2' class='form-control' min='1' step='.01' value='".$_POST["downpaymenthl"]."' required/>
                                		</div>";
                                }


                                 $formmod=$formmod."</div>


                                <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Insurance</label>  
                                <input type='text' name='loanins' class='form-control' placeholder='Amount'  value='".$_POST["loanins"]."' required/>
                                </div>

                                <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Insurance Pay</label> ";


                                if($_POST["inspay"]==0)
                                {
                                  $formmod=$formmod."<select name='inspay' class='form-control'>
                                        <option value='0' selected>With Loan</option>
                                        <option value='1'>Separate</option>
                                  </select>";
                              	}
                              	else
                              	{
                              		$formmod=$formmod."<select name='inspay' class='form-control'>
                                        <option value='0'>With Loan</option>
                                        <option value='1' selected>Separate</option>
                                  </select>";
                              	}



                                $formmod=$formmod."</div>


                              </div>


                  
                                <div class='row'>
                				      	<div class='col-md-6'>
										              <label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Total Tenure </label>";


										     if($_POST["tentype"]=="Year")
										     {
    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' checked='checked' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='1' value='".round((float)($tenure/12))."' required/>
    											</div>";
    										}
    										else
    										{

    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' checked='checked' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='.5' value='".$tenure."' required/>
    											</div>";
    										}
    											
                                       				

                                    	
  
           									
                                  
                                  
								        $formmod=$formmod."</div>
									                <div class='col-md-6' ><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Start Date:</label>
								                	   <input type='date' name='begin' class='form-control' value='".$_POST["begin"]."' required/>
							               	   	</div>
									
								          	   </div>
                             <br>
                
                              <div class='row'>
                                 <div class='col-md-1'></div>
                                 <input type='hidden' name='prepay' value='0' />";

                                if($_POST["prepay"]==1)
                                {
                                 $formmod=$formmod.
                                 "<div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Regular Prepay ?</label><input type='checkbox' name='prepay' value='1' class='form-control' checked/></div>";
                             	}
                             	else
                             	{
                             		$formmod=$formmod.
                                 "<div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Regular Prepay ?</label><input type='checkbox' name='prepay' value='1' class='form-control'/></div>";
                             	}


                                $formmod=$formmod."<div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Prepayment Date :</label><input type='date' name='prebegin' class='form-control'  value='".$_POST["prebegin"]."'/></div>

                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'> Amount:</label><input type='text' name='preamount' class='form-control' placeholder='Amount' value='".$_POST["preamount"]."'/></div>

                              </div>

                              <div class='row'>
                                 <div class='col-md-4'></div>
                                 <div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Frequency:</label>";

                                 if($_POST["recur"]==0)
                                 {
                                 $formmod=$formmod.
                                     "<select name='recur' class='form-control'>
                                        <option value='0' selected>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";
                                 }
                                 elseif($_POST["recur"]==4)
                                 {
                                 	$formmod=$formmod.
                                 	"<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4' selected>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";

                                 }
                                 elseif($_POST["recur"]==6)
                                 {
                                 	$formmod=$formmod.
                                 	"<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6' selected>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";
                                 	
                                 }
                                 else{
                                 	$formmod=$formmod.
                                 	"<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12' selected>Anually</option>
                                     </select>";
                                 }


                                 $formmod=$formmod."</div>
                      
                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>EMI/tenure:</label>
                                   <select name='prepayopt' class='form-control'>";

                                   if($_POST["prepayopt"]=="tc")
                                   {
                                   	$formmod=$formmod."
                                    <option value='tc' selected>Tenure Fix</option>
                                     <option value='ec'>EMI Fix</option>";
                                   }
                                   else
                                   {
                                   	$formmod=$formmod."
                                    <option value='tc'>Tenure Fix</option>
                                     <option value='ec' selected>EMI Fix</option>";
                                   }


                                  $formmod=$formmod."</select>

                                </div>

                            </div>

                            <div class='row'>
                               <div class='col-md-1'></div>
                                  <input type='hidden' name='finprepay' value='0' />
                               <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Full Prepay ?</label>   ";

                               if($_POST["finprepay"]==1)
                               {
                               $formmod=$formmod.
                                    "<input type='checkbox' name='finprepay' value='1' class='form-control' checked/></div>";
                               }
                               else
                               {
                               	$formmod=$formmod.
                                    "<input type='checkbox' name='finprepay' value='1' class='form-control' /></div>";
                               }

                                $formmod=$formmod."<div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Final Prepayment Date :</label>
                                   <input type='date' name='findate' class='form-control' value='".$_POST["findate"]."'/></div>

                                    <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Foreclosure % :</label>
                                   <input type='number' name='forper' class='form-control' min='0' step='.01' value='".$_POST["forper"]."'/></div>
                            </div>
                  
                            <div class='row'>
                              <div class='col-md-7'><a href='index.php' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Change Loan Type</a> </div>

                              <div class='col-md-5'><button type='submit' value='submit' name='btn_cal_hl' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Modify Loan Details</button></div>
                         
                            </div>

                
                            </form>";




                            echo $formmod;

				}












				if (isset($_POST['btn_cal_lap']))
				{
					
						$formmod="<form method='post' name='loancal_lap' action='loancalculation.php'>
                               <div class='row'>
                                  <div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Market Value :</label>
                                    <input type='number' name='loanamtlap' placeholder='Enter Your Amount Here' class='form-control' min='10000' step='100' value='".$_POST["loanamtlap"]."' required/> 
                                     <input type='hidden' name='loanamtubl' value='' />
                                      <input type='hidden' name='loanamthl' value='' />
                                 </div>
                                 <div class='col-md-6'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Rate of Interest :</label>
                                  <input type='number' name='roi' placeholder='Rate of Interest' class='form-control' min='5' step='.01' value='".$_POST["roi"]."' required/>
                                 </div>
                               </div>

                               <div class='row'>
                               
                                <div class='col-md-6'>";

                                if($_POST["dpoptlap"]=="Percentage")
                                {
                               		$formmod=$formmod."<label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;''>Loan To Amount :</label>  
                                  		<div class='input-group'>
                                    	<span class='input-group-addon'>
                                      		<input type='radio' value='Percentage' name='dpoptlap' checked='checked' class='downrd3'>Percent</input>&nbsp;&nbsp;
                                      		<input type='radio' value='Amount' name='dpoptlap' class='downrd3'>Amount</input>
                                    	</span>
                                	  		<input type='number' name='downpaymentlap' id='down3' class='form-control' min='1' step='.01' value='".$_POST["downpaymentlap"]."' required/>
                                		</div>";
                                }
                                else
                                {
                                
                               		$formmod=$formmod."<label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;''>Loan To Amount :</label>  
                                  		<div class='input-group'>
                                    	<span class='input-group-addon'>
                                      		<input type='radio' value='Percentage' name='dpoptlap' class='downrd3'>Percentage</input>&nbsp;&nbsp;
                                      		<input type='radio' value='Amount' name='dpoptlap' checked='checked'  class='downrd3'>Amount</input>
                                    	</span>
                                	  		<input type='number' name='downpaymentlap' id='down3' class='form-control' min='1' step='.01' value='".$_POST["downpaymentlap"]."' required/>
                                		</div>";
                                }


                                 $formmod=$formmod."</div>




                           

                                <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Insurance</label>  
                                <input type='text' name='loanins' class='form-control' placeholder='Amount' value='".$_POST["loanins"]."' required/>
                                </div>

                                <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Insurance Pay</label>";

                                if($_POST["inspay"]==0)
                                {
                                	$formmod=$formmod.
                                	" <select name='inspay' class='form-control'>
                                        <option value='0' selected>With Loan</option>
                                        <option value='1'>Separate</option>
                                	  </select>";
                              	}
                              	else
                              	{
                              		$formmod=$formmod.
                                	" <select name='inspay' class='form-control'>
                                        <option value='0'>With Loan</option>
                                        <option value='1' selected>Separate</option>
                                	  </select>";
                              	}
                              	


                                  $formmod=$formmod."
                                </div>


                              </div>


                  
                                <div class='row'>
                				      	<div class='col-md-6'>
										              <label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Total Tenure </label>";


										     if($_POST["tentype"]=="Year")
										     {
    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' checked='checked' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='1' value='".round((float)($tenure/12))."' required/>
    											</div>";
    										}
    										else
    										{

    						$formmod=$formmod."<div class='input-group'>
     										 <span class='input-group-addon'>
       										 <input type='radio' value='Year' name='tentype' class='radiogr'>Year</input>&nbsp;&nbsp;
       										 <input type='radio' value='Month' name='tentype' checked='checked' class='radiogr'>Month</input>
      											</span>
      												<input type='number' name='tenure' id='amount' class='form-control' min='1' step='.5' value='".$tenure."' required/>
    											</div>";
    										}
    											
                                       				

                                    	
  
           									
                                  
                                  
								        $formmod=$formmod."</div>
									                <div class='col-md-6' ><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Loan Start Date:</label>
								                	   <input type='date' name='begin' class='form-control' value='".$_POST["begin"]."' required/>
							               	   	</div>
									
								          	   </div>
                             <br>
                
                              <div class='row'>
                                 <div class='col-md-1'></div>
                                 <input type='hidden' name='prepay' value='0' />
                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>";

                                if($_POST["prepay"]==1)
                                {
                                 	$formmod=$formmod."Regular Prepay ?</label><input type='checkbox' name='prepay' value='1' class='form-control' checked/></div>";
                             	}
                             	else
                             	{
                             		$formmod=$formmod."Regular Prepay ?</label><input type='checkbox' name='prepay' value='1' class='form-control'/></div>";
                             	}

                                 $formmod=$formmod."
                                 <div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Prepayment Date :</label><input type='date' name='prebegin' class='form-control' value='".$_POST["prebegin"]."'/></div>

                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'> Amount:</label><input type='text' name='preamount' class='form-control' placeholder='Amount' value='".$_POST["preamount"]."'/></div>

                              </div>

                              <div class='row'>
                                 <div class='col-md-4'></div>
                                 <div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Frequency:</label>";

                                 if($_POST["recur"]==0)
                                 {
                                 $formmod=$formmod.
                                     "<select name='recur' class='form-control'>
                                        <option value='0' selected>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";
                                 }
                                 elseif($_POST["recur"]==4)
                                 {
                                 	$formmod=$formmod.
                                     "<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4' selected>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";
                                 }
                                 elseif($_POST["recur"]==6)
                                 {
                                 	$formmod=$formmod.
                                     "<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6' selected>Semi Anually</option>
                                        <option value='12'>Anually</option>
                                     </select>";
                                 }
                                 else
                                 {
                                 	$formmod=$formmod.
                                     "<select name='recur' class='form-control'>
                                        <option value='0'>One Time</option>
                                        <option value='4'>Quaterly</option>
                                        <option value='6'>Semi Anually</option>
                                        <option value='12' selected>Anually</option>
                                     </select>";
                                 }

                                     $formmod=$formmod."
                                 </div>
                      
                                 <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>EMI/tenure:</label>
                                   <select name='prepayopt' class='form-control'>";

                                   if($_POST["prepayopt"]=="tc")
                                   {
                                   		$formmod=$formmod.
                                    	"<option value='tc' selected>Tenure Fix</option>
                                     	<option value='ec'>EMI Fix</option>";
                                   }
                                   else
                                   {
                                   		$formmod=$formmod.
                                    	"<option value='tc'>Tenure Fix</option>
                                     	<option value='ec' selected>EMI Fix</option>";
                                   }


                                     $formmod=$formmod.
                                  "</select>

                                </div>

                            </div>

                            <div class='row'>
                               <div class='col-md-1'></div>
                                  <input type='hidden' name='finprepay' value='0' />
                               <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Full Prepay ?</label>";
                               	
                               	
                               	if($_POST["finprepay"]==1)
                               	{
                               		$formmod=$formmod.   
                                  "<input type='checkbox' name='finprepay' value='1' class='form-control' checked/></div>";
                                }
                                else{
                                	$formmod=$formmod.   
                                  "<input type='checkbox' name='finprepay' value='1' class='form-control' /></div>";
                                }

                                $formmod=$formmod."<div class='col-md-4'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Final Prepayment Date :</label>
                                   <input type='date' name='findate' class='form-control' value='".$_POST["findate"]."'/></div>

                                    <div class='col-md-3'><label style='display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;'>Foreclosure % :</label>
                                   <input type='number' name='forper' class='form-control' min='0' step='.01' value='".$_POST["forper"]."'/></div>
                            </div>
                  
                            <div class='row'>
                              <div class='col-md-7'><a href='index.php' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Change Loan Type</a> </div>

                              <div class='col-md-5'><button type='submit' value='submit' name='btn_cal_lap' style='margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 18px;'>Modify Loan Details</button></div>
                              <input type='hidden' name='downpaymenthl' value='' />
                            </div>

                
                            </form>";


						 echo $formmod;



				}






				?>
				
                   <div class='row'>
                               <div class='col-md-12'>
					<section id="graph">
					</br></br>
                    <div id="piechart"></div>

                    <form method="post" name="dx" action="downloaddata.php">
						<input type='hidden' name='amortize' value="<?php echo htmlentities(serialize($amortization)); ?>" />

						<button type="submit" name="dwnxls" style="margin-top: 0px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 26px;text-align: center;text-decoration: none;display: inline-block;font-size: 20px; width:100%;">Download The Table in Excel</button>
					</form>
                    </section>
                    </div>
                    </div>


                     
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

						<script type="text/javascript">
						// Load google charts
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawChart);

						// Draw the chart and set the chart values
						function drawChart() {
  							var data = google.visualization.arrayToDataTable([
  							['Task', 'Hours per Day'],
  							['Interest', <?php echo round($ti); ?>],
  							['Principal', <?php echo round($principal); ?>]
  							
							]);

  						// Optional; add a title and set the width and height of the chart
  						var options = {'title':'Amortization Breakup - Total Sum of INR. <?php $s=round($ti)+round($principal); echo number_format($s); ?>', 'width':650, 'height':500};

  						// Display the chart inside the <div> element with id="piechart"
  						var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  						chart.draw(data, options);
						}
						</script>




					
         
                    
                </div>




            </div><!--/.row-->


               
        </div><!--/.container-->
    
    
    </section><!--/#about-->

    <section id="portfolio">
       <div class="container">
       <?php
        if (isset($_POST['btn_cal']))
        { 
          echo $_POST["loanamtubl"];
          echo $_POST["roi"];
          echo $_POST["test"];


        }

       ?>
       </div>

    </section>
	
	
	<footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
					<div class="text-center">
						<a href="#home" class="scrollup" style="color:#c92800;"><i class="fa fa-angle-up fa-3x"></i></a>
					</div>
                    &copy; Company Name. All Rights Reserved.
                    <div class="credits">
                       
                        <a href="#">Company Calculator</a> by <a href="#">CompanyMade</a>
                    </div>
                </div>
				
                <div class="top-bar">			
					<div class="col-lg-12">
					   <div class="social">
							<ul class="social-share">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-skype"></i></a></li>
							</ul>
					   </div>
					</div>
				</div>
			</div>
		</div>
    </footer><!--/#footer-->
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script> 
	<script src="js/wow.min.js"></script>
	
	<script src="js/jquery.easing.min.js"></script>	
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="js/main.js"></script>
    <script src="contactform/contactform.js"></script>
    <script>
$('.radiogr').change(function(e){
    var selectedValue = $(this).val();
    var amt=$('#amount').val();
    if(selectedValue=="Year")
    $('#amount').val(Math.round(amt/12))
    if(selectedValue=="Month")
    $('#amount').val(Math.round(amt*12))
});
</script>
    
</body>
</html>






























