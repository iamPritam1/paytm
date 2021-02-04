<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("./libs/config_paytm.php");
require_once("./libs/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);

if($isValidChecksum == "TRUE") {
    if ($_POST["STATUS"] == "TXN_SUCCESS") {
        echo "<script> function set(){window.AppInventor.setWebViewString('success');}</script>";
	} else {
		echo "<script> function set(){window.AppInventor.setWebViewString('failure');}</script>";
	}
} else {
	echo "<script> function set(){window.AppInventor.setWebViewString('failure');}</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><meta charset="windows-1252">
<title>Check Out Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    .text-danger strong {
    		color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 5px;
			margin-bottom: 5px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
</style>
</head>
<body style="margin:0px;">
	<div class="container">
	<div class="row">
        <div class="receipt-main">
            <div class="row">
    			<div class="receipt-header">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="receipt-left">
							<img class="img-responsive" alt="iamgurdeeposahan" src="/images/fvilla.png" style="width: 71px; border-radius: 43px;">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>Friendvilla Team</h5>
							<p>+91 0000000000 <i class="fa fa-phone"></i></p>
							<p>contact@friendvilla.in <i class="fa fa-envelope-o"></i></p>
							<p>WB, India <i class="fa fa-location-arrow"></i></p>
						</div>
					</div>
				</div>
            </div>
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-12 col-sm-12 col-md-12 text-left">
						<div class="receipt-right">
						    <?php
						         if($isValidChecksum == "TRUE") {
						             
						             if (isset($_POST) && count($_POST)>0 ) {
						                 foreach($_POST as $paramName => $paramValue) {
						                     if($paramName=="ORDERID") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="TXNID") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="TXNAMOUNT") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="PAYMENTMODE") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="STATUS") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="BANKTXNID") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="BANKNAME") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     } else if($paramName=="TXNDATE") {
						                         echo "<p><b>".$paramName." :</b>".$paramValue."</p>";
						                     }
						                 }
						             }
						         } else {
						             echo "<b>Checksum mismatched.</b>";
						             
						         }
						   ?>
					    </div>
					</div>
				</div>
            </div>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9">Item Charge</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?php $amt=$_POST["TXNAMOUNT"]; $ic=($amt-(($amt*18)/100)); echo $ic; ?>/-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">GST Charge</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?php $amt=$_POST["TXNAMOUNT"]; $ic=(($amt*18)/100); echo $ic; ?>/-</td>
                        </tr>
                        <tr>
                            <td class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> <?php $amt=$_POST["TXNAMOUNT"]; echo $amt; ?>/-</strong></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>Date :</b> <?php $today = date("F j, Y, g:i a"); echo $today;?></p>
							<h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h3 class="btn btn-primary" onclick="set()">CONTINUE</h3>
						</div>
					</div>
				</div>
            </div>
        </div>    
	</div>
</div>
</body>
</html>
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    
						    