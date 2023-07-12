@extends('layouts.print')
@section('content')

    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
    <table border="0" cellpadding="1" cellspacing="1" width="100%">
	<tbody>
		<tr>
            <td>&nbsp;
			</td>
		</tr>
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
						<td><b>{{ config('global.selfBiller') }}</b></td>
                        <td align="right">VAT Number&nbsp; </td>
                        <td align="left"><b>{{ config('global.vatNumber') }}</b></td>
                    </tr>
                    </tbody>
                </table><br />
			<p>and</p>
			<p>
                <b>{{$name}}</b>&nbsp; trading as &nbsp;<b>{{$legalname}}</b></p>
 			</td>
		</tr>
		<tr>
			<td><br/>
                <table border="0" cellpadding="15" cellspacing="10" width="90%">
                    <tbody>
					<tr>
                        <td align="left" width="23%"></td>
                        <td align="left" width="27%"></td>
                        <td align="right" width="25%">VAT Number <sup>(if applicable)</sup>:&nbsp;</td>
                        <td align="left" width="25%">
                            @if ($vatnumber)
                               <b> {{$vatnumber}}</b>
                            @else
                                ...... N/A ..........
                            @endif
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td align="left" width="23%">Agreement Start Date:</td>
                        <td align="left" width="27%"><b>{{date('d/m/Y', strtotime($startdate))}}</b></td>
                        <td align="right" width="25%">Agreement End Date:&nbsp;</td>
                        <td align="left" width="25%"><b>{{date('d/m/Y', strtotime($expirydate))}}</b></td>
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
				<li>To issue self-billed invoices for all supplies made to them by the self-billee (supplier) until the expiry date of this agreement.</li>
				<li>To complete self-billed invoices showing the supplier&rsquo;s name, address and VAT registration number (if appropriate), together with all other details that constitute a valid VAT invoice.</li>
				<li>To make a new self-billing agreement in the event that their VAT registration number or status changes.</li>
				<li>To inform the supplier if the issue of self-billed invoices will be outsourced to a third party.</li>
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
            <a href="http://www.k-international.com/" target="_blank">
                <img alt="K International" src="images/Klogo_black.png" style="float: right;" />
            </a>
        </div>
    </div>
</div>
@endsection