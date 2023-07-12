@extends('layouts.show')
@section('content')
@php $showtelnos = 0; @endphp
<input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
    <div class="container" style="font-size: smaller;">
        <table border="0" cellpadding="1" cellspacing="1" width="120%">
        <tbody>
        <tr>
            <td>@sortablelink('xtrf_id', 'XTRF ID')</td>
            <td>@sortablelink('name', 'Name')</td>
            <td>@sortablelink('legalname', 'Legal Name')</td>
            <td>@sortablelink('email')</td>
            @if ($showtelnos == 1)
                <td>Phone</td>
                <td>Mobile</td>
            @endif
            <td>@sortablelink('expirydate', 'Expiry Date')</td>
            <td>@sortablelink('uploaded', ' Uploaded ')</td>
            <td>Approve  /  Reject</td>
            <td></td>
        </tr>
    @foreach ($alluserdocs as $userdoc)
        @if (!$userdoc->approved)
            <tr>
            <td>{{$userdoc->xtrf_id}}</td>
            <td>{{$userdoc->name}}</td>
            <td>{{$userdoc->legalname}}</td>
            <td>{{$userdoc->email}}</td>
            @if ($showtelnos == 1)
                <td>{{$userdoc->phone}}</td>
                <td>{{$userdoc->mobile}}</td>
            @endif
            <td>{{$userdoc->expirydate}}</td>
            <td>
                @if ($userdoc->uploaded)  
                <?php   $doc = str_replace("public/","",$userdoc->doc_name); 
                        $ext = pathinfo($userdoc->doc_name, PATHINFO_EXTENSION);
                ?>
                    <a href="https://selfbilling.tracklingualex.com/storage/{{ $doc }}" target="_blank">
                    <img title="View This Document" style="cursor: pointer;" src="images/green_tick.png" /></a>
                @else
                    <img title="Not uploaded yet" src="images/red_cross.png" />
                @endif

            </td>
            <td>
                @if ($userdoc->uploaded && !$userdoc->rejected)
                <div id="thumbs">
                    <div id="innerthumbs">
                        <div class="thumbclass">
                            <img id="approvethis{{$userdoc->id}}" user="{{$userdoc->id}}" style="cursor: pointer;" 
                                 title="Approve the document" src="images/thumbs_up.png" />
                        </div>
                        <div class="thumbclass">
                            <img id="apprej_result{{$userdoc->id}}" src="images/spacer.png" user="{{$userdoc->id}}" 
                                 title=""/>
                        </div>
                        <div class="thumbclass">
                            <img id="rejectthis{{$userdoc->id}}" user="{{$userdoc->id}}" style="cursor: pointer;" 
                                 title="Reject the document" src="images/thumbs_down.png" />
                        </div>
                    </div>
                </div>
                @elseif ($userdoc->uploaded && $userdoc->rejected)
                    <div id="thumbs">
                        <div id="innerthumbs">
                            <div class="thumbclass">
                                <img title="" src="images/spacer.png" />
                            </div>
                            <div class="thumbclass">
                                <img src="images/red_cross.png" 
                                     title="rejected"/>
                            </div>
                            <div class="thumbclass">
                                <img title="" src="images/spacer.png" />
                            </div>
                        </div>
                    </div>
                @endif

            </td>
            <td>
                @if ($userdoc->uploaded)  
                    <div class="thumbclass">
                        <a download="{{$userdoc->xtrf_id}}_{{$userdoc->legalname}}_Proof_of_ID_{{$userdoc->newstartdate}}.{{ $ext }}" 
                           href="https://selfbilling.tracklingualex.com/storage/{{ $doc }}">
                            <img title="download this" src="images/green_download.jpg" />
                        </a>
                    </div>
                @endif
            </td>
        </tr>
        @endif
    @endforeach
        </tbody>
        </table>
    <a href="showapproved">Show approved</a>
</div>
@endsection