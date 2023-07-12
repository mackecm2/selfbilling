@extends('layouts.app')
@section('content')

    
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    <table border="0" cellpadding="1" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td style="text-align: right;">
                <span style="font-size: smaller;">
			<table border="0" cellpadding="5" cellspacing="20" width="100%">
				<tbody>
					<tr>
						<td align="left">User <b>{{\Auth::user()->legalname}}</b> logged in, contact email address <b>{{\Auth::user()->email}}</b>&nbsp;&nbsp;&nbsp;</td>
   
        <td>                 
          <!-- Trigger/Open The Modal -->
          <input type="button" id="btnHelp" value="Help"/>
        </td>

<!-- The Modal -->
<div id="openModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">close X</span>
    <p align="left"> 
        <p align="left">If you need assistance completing this form please contact</p>
		<p align="left">K International Helpline &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+44 (0) 1908 557937</p>
		<p align="left">Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+44 (0) 1908 810 214</p>
        <p align="left">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="enquiries@K-International.com">enquiries@K-International.com</a></p>
        <p align="right"><a href="https://kinternational.supportsystem.com/index.php" target="_blank">K International Support Ticket System</a></p>
  </div>

</div>                     
						<td><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <input type="button" value="Sign Out" />
                                        </a>                 
                        </td>
					</tr>
                    <tr><td colspan="3"><hr /></td></tr>
				</tbody>
			</table>
                </span>
			</td>
		</tr>
		<tr>
			<td>
                @if ($errors->has('doc_name')) 
                    @foreach ($errors->all() as $error)
                        @if ($error == "The doc name field is required.") 
                            <span style="color:red; font-weight: bold;">
                                Please choose a file to upload below, then tick the confirm box, before submitting</span>
                        @else
                            <span style="color:red; font-weight: bold;">{{ str_replace("doc name", "proof of ID", $error) }}</span>
                        @endif
                    @endforeach
                @endif
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
			<p><b>{{\Auth::user()->name}}</b>&nbsp;trading as &nbsp;
			<b>{{\Auth::user()->legalname}}</b>&nbsp;&nbsp;&nbsp;&nbsp; VAT Number (if applicable)&nbsp;&nbsp;
            <input size="20" type="text" id="vatnumber" value="{{\Auth::user()->vatnumber}}" /></p>
			</td>
		</tr>
		<tr>
			<td><br/>
                <table border="0" cellpadding="0" cellspacing="10" width="90%">
                    <tbody>
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
        @if (!$uploaded)            				
			@include('newupload_form')
        @else
            <div class="confirm-hidden"> 
                <table border="0" cellpadding="1" cellspacing="1" width="100%">
                    <tr>
                        <td style="text-align: left;">
                        <h4>{{$message}}</h4>
                        <p>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <input type="button" value="Sign Out" />
                        </a>
                        </p>
                        </td>
                    </tr>
                </table>
            </div>
        @endif
        </div>
            </div>
            <a href="http://www.k-international.com/" target="_blank">
                <img alt="K International" src="images/Klogo_black.png" style="float: right;" />
            </a>
        </div>
    </div>
</div>
@endsection