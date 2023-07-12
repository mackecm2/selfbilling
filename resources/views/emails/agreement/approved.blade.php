<html>
    <head>
    <link href="https://selfbilling.tracklingualex.com/public/css/app.css" rel="stylesheet">
    <link href="https://selfbilling.tracklingualex.com/public/css/app_local.css" rel="stylesheet"> 
    </head>
    <body> 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
<p>Dear {{$user->name}},</p>
<p>&nbsp;</p>
<p>Thank you for submitting your proof of ID for your Self-Billing Agreement renewal. I&#39;m happy to inform you that your submission has been approved, and a copy of your renewed Self-Billing Agreement is attached below for your reference.</p>
<p>&nbsp;</p>
<p>Kind Regards</p>
<p>K International</p>
            <a href="http://www.k-international.com/" target="_blank">
                <img alt="K International" src="https://selfbilling.tracklingualex.com/public/images/Klogo_black.png" style="float: right;" />
            </a>
        </div>
<br /> <br />
        <div class="col-md-8 col-md-offset-2">
        

<table border="0" cellpadding="1" cellspacing="1" width="90%" align="center"  style="background-color:white">
	<tbody>

		<tr>
			<td>
			<h3>Self-Billing Agreement</h3>
			<p>This is an agreement to a self-billing procedure between:</p>
			</td>
		</tr>
		<tr>
			<td>
                <table border="0" cellpadding="5" cellspacing="20" width="90%">
                    <tbody>
					<tr>
						<td><b>K International Ltd</b></td>
                        <td align="right">VAT Number&nbsp; </td>
                        <td align="left"><b>600413800</b></td>
                    </tr>
                    </tbody>
                </table><br />
			<p>and</p>
			<p><b>{{$user->name}}</b>&nbsp;trading as <b>{{$user->legalname}}</b>
            @if($user->vatnumber)
                &nbsp;&nbsp;&nbsp;&nbsp; VAT Number (if applicable)&nbsp;&nbsp;
                <b>{{$user->vatnumber}}" </b>
            @endif
            </p>
			</td>
		</tr>
		<tr>
			<td><br/>
                <table border="0" cellpadding="0" cellspacing="10" width="90%">
                    <tbody>
					<tr>
                        <td align="right" width="23%">Agreement Start Date:</td>
                        <td align="left" width="27%"><b>{{date('d/m/Y', strtotime($user->newstartdate))}}</b></td>
                        <td align="right" width="25%">Agreement End Date:&nbsp;</td>
                        <td align="left" width="25%"><b>{{date('d/m/Y', strtotime($user->newexpirydate))}}</b></td>
                    </tr>
                    </tbody>
                </table>     
			</td>
		</tr>
		<tr>
			<td>
                <br/><br/>
			<p><strong>Terms of Agreement</strong></p>
			<p>The self-biller (K International Ltd) agrees:</p>
			<ol>
				<li value="1">To issue self-billed invoices for all supplies made to them by the self-billee (supplier) until the expiry date of this agreement.</li>
				<li value="2">To complete self-billed invoices showing the supplier&rsquo;s name, address and VAT registration number (if appropriate), together with all other details that constitute a valid VAT invoice.</li>
				<li value="3">To make a new self-billing agreement in the event that their VAT registration number or status changes.</li>
				<li value="4">To inform the supplier if the issue of self-billed invoices will be outsourced to a third party.</li>
			</ol>
			<p>&nbsp;</p>
			<p>The self-billee agrees:</p>
			<ol>
				<li value="5">To accept invoices raised by the self-biller on their behalf until the expiry date of this contract.</li>
				<li value="6">Not to raise sales invoices for the transactions covered by this agreement.</li>
				<li value="7">To notify the customer immediately if they:
				<ol style="list-style-type:lower-alpha;">
					<li>Cease/Become VAT registered</li>
					<li>Change their VAT registration number;</li>
					<li>Sell their business, or part of their business.</li>
				</ol>
				</li>
			</ol>
			</td>
		</tr>
    </tbody>
    </table>
        
       </div> 
        
       </div>
</div>
</body>
</html>