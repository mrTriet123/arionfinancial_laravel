<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ledger Report</title>
	<link rel="stylesheet" type="text/css" href="{!! URL('css/Invoice/style.css') !!}" media="all" />
</head>
<body>
<div class="container">
	<div class="head">
		<div class="head-left">
			<div class="logo">
				<img src="{!! URL('public/uploads/user.png') !!}" alt="logo" width="80" height="80" />
			</div>
			<div class="company-name">
				<h4>{{ $Dealer->UserName }}</h4>
			</div>		
		</div>
	</div>
	<div class="bill-statement">
		<div class="bill">
			<h1>Bill To: {{ $Customer->UserName }}</h1>
			<p class="left-padding">{{ $Customer->Address }}</p>
			<p class="left-padding">{{ $Customer->City }},{{ $Customer->State }},{{ $Customer->Zip }}</p>
			<p class="left-padding">{{ $Customer->Phone }}</p>
		</div>
		
		<div class="statement">
			<table align="right">
				<tr>
					<td> Date </td><td><input type="text" value="<?= date('Y-m-d') ?>"></td>
				</tr>
				<tr>
					<td>Customer ID </td><td><input type="text" value="[Customer#{{ $Customer->UserID }}]"></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="remi-acct-name">
		<div class="remittance-name"><h1>Remittance</h1></div>
		<div class="account-name"><h1>Account Summary</h1></div>
	</div>

	<div class="remittance-account">
		<div class="remittence">
			<p>To ensure proper credit, please enclose a copy</p>
			<p>of this statement  with your check and remit to:</p>
			<p class="left-padding">Company Name</p>
			<p class="left-padding">[Street Address]</p>
			<p class="left-padding">[City, ST  ZIP]</p>
			<p>Please write your Customer ID on your check.</p>
		</div>

		<div class="account">
			<h2>Balance Due &nbsp; &nbsp; $250</h2>
			<p>Payment Due Date</p>
			<hr />
			<h2>Amount Enclosed $ <input type="text"></h2>
			<p>Make all checks payable to</p>
			<p>[Company Name]</p>
		</div>
	</div>


	<div class="mainBody">
		<h2>Account Activity</h2>
		<table border="1" align="center" cellpadding="3" cellspacing="3">
			<tr style="background-color: #3B4E7E; color: #ffffff">
				<th style="width: 10%;">DATE</th>
				<th style="width: 10%;">TYPE</th>
				<th style="width: 10%;">INVOICE</th>
				<th style="width: 40%;">DESCRIPTION</th>
				<th style="width: 10%;">PAYMENT</th>
				<th style="width: 10%;">AMOUNT</th>
				<th style="width: 10%;">BALANCE</th>
			</tr>
			<tr>
				<td colspan="3">1/1/12</td>
				<td colspan="3">Balance Forward</td>
				<td style="background-color: #E7EAF0">$ 250</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="6">&nbsp;</td>
			<td style="background-color: #E7EAF0">&nbsp;</td>
		</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr><tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr><tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
				<td style="background-color: #E7EAF0">&nbsp;</td>
			</tr>
			<tr style="font-weight: bold">
				<td colspan="6" align="right">Current Balance:</td>
				<td style="background-color: #ADC2F7; ">$250</td>
			</tr>
		</table>
	</div>

	<div class="footer">
		<p align="center">If you have any questions about this invoice, please contact</p>
		<p align="center">[Name], [Street Address], [City, ST  Zip]</p>
		<p align="center">Phone [000-000-0000], Fax [000-000-0000], [Email]</p>
		<h2 align="center">Thank You For Your Business!</h2>
	</div>

</div>
</body>
</html>