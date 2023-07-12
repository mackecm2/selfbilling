<form action="./uploadfile" method="POST" enctype="multipart/form-data">
<input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
<table border=1 cellpadding=10 cellspacing=1 width=100%>
    <tr>
        <td style="text-align: left; padding: 15px;">
            <h3>Proof of ID</h3>
            <p>In order for us to be able to process this agreement, please provide proof of ID such as a copy of your passport, 
                driving licence or ID card. Please upload a scanned copy (pdf, jpg, png, etc.)</p>
            <p><b>Please ensure that your proof of ID is valid and all parts of it are fully visible.</b></p>
                Upload your Proof of ID here<br /><br />
<input id="doc_name" name="doc_name" type="file"/>
            <p style="color:red; font-weight: bold;">&nbsp;
                @if ($errors->has('doc_name')) 
                    @foreach ($errors->all() as $error)
                        @if ($error == "The doc name field is required.") 
                            <span >Please choose a file to upload</span>
                        @else
                            <span>{{ $error }}</span>
                        @endif
                    @endforeach
                @endif
            </p>
        </td>
    </tr>
    <tr>
        <td style="text-align: right; background-color: rgb(102, 102, 102);">
<span style="color:#FFFFFF;"><label for="confirm_agree"> I confirm that I agree to the terms of this agreement&nbsp;&nbsp;&nbsp;</label>
    <input id="confirm_agree" type="checkbox" name="confirm_agree"/>&nbsp;&nbsp;&nbsp;</span> 
<input type="hidden" id="doc_name0" value="" name="doc_name0"/>
<input type="hidden" id="vatnumber0" value="" name="vatnumber0"/>
<input type="hidden" id="newstartdate" value="{{$startdate}}" name="newstartdate"/>
<input type="hidden" id="newexpirydate" value="{{$expirydate}}" name="newexpirydate"/>
       </td>    </tr>
    </table>

</br><button id="btncheck" type="submit">Submit</button>

</form>
