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
    </tbody>
    </table>
                    <br />
                    <br />
            <div class="confirm-hidden"> 
                <table border="1" cellpadding="1" cellspacing="1" width="100%">
                    <tr>
                        <td style="text-align: left;">
                        <h4>{{$message}}</h4>
                        <p align="right">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <input type="button" value="Sign Out" />&nbsp;&nbsp;
                        </a>
                        </p>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
            </div>
            <a href="http://www.k-international.com/" target="_blank">
                <img alt="K International" src="images/Klogo_black.png" style="float: right;" />
            </a>
        </div>
    </div>
</div>
@endsection