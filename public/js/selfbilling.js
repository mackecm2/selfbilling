$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // A P P R O V E   /   R E J E C T   -  O N   C L I C K   F U N C T I O N    

    $("[id^=approvethis]").click(function() {
        userID = $(this).attr('user');
        now = (new Date()).toISOString().substring(0, 19).replace('T', ' ');
        if ( 1 === 1 ) {
            $.ajax({
                type: "POST",
                url: './approve',
                data: {"id" : userID, "approved" : now},
                success: function() {
                    console.log("approving id " + userID + " at " + now);
                    $("#approvethis" + userID).attr("src","images/spacer.png");
                    $("#approvethis" + userID).attr("title","");
                    $("#approvethis" + userID).off("click");
                    $("#apprej_result" + userID).attr("src","images/green_tick.png");
                    $("#apprej_result" + userID).attr("title","approved");
  //                  $("#apprej_result" + userID).attr('onClick','window.open("showprint?id=") + userID');
  //                  $("#apprej_result" + userID).attr("href", "showprint?id=" + userID);
  //                  $("#apprej_result" + userID).attr('target', '_blank');
                    $("#rejectthis" + userID).attr("src","images/spacer.png");
                    $("#rejectthis" + userID).attr("title","");
                    $("#rejectthis" + userID).off("click");
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            })
       } else {
           // console.log("trying to copy all text " + txt + " to the notepad ");
        }
    });

    $("[id^=rejectthis]").click(function() {
        userID = $(this).attr('user');
        now = (new Date()).toISOString().substring(0, 19).replace('T', ' ');
        if ( 1 === 1 ) {
            $.ajax({
                type: "POST",
                url: './reject',
                data: {"id" : userID, "rejected" : now},
                success: function() {
                    console.log("rejecting id " + userID + " at " + now);
                    $("#approvethis" + userID).attr("src","images/spacer.png");
                    $("#approvethis" + userID).attr("title","");
                    $("#approvethis" + userID).off("click");
                    $("#apprej_result" + userID).attr("src","images/red_cross.png");
                    $("#apprej_result" + userID).attr("title","rejected");
                    $("#rejectthis" + userID).attr("src","images/spacer.png");
                    $("#rejectthis" + userID).attr("title","");
                    $("#rejectthis" + userID).off("click");
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            })
       } else {
           // console.log("trying to copy all text " + txt + " to the notepad ");
        }
    });
    
    $("[id^=apprej_result]").click(function() {
        userID = $(this).attr('user');
        now = (new Date()).toISOString().substring(0, 19).replace('T', ' ');
        if ( 1 === 1 ) {
            console.log("viewing agreement for id " + userID + " at " + now);
            window.open("https://selfbilling.tracklingualex.com/showprint?id=" + userID, "Self-Billing Agreement");
        }
    });
    
    $('#btnHelp').on('click', function() {
        $('#openModal').show();
    });
    
    $('.close').on('click', function() {
        $('#openModal').hide();
    });
    
    $("#vatnumber").on("change paste keyup", function() {
        var vatno = ($("#vatnumber").val()); 
        $("#vatnumber0").val(vatno);
     });
    
    $("#doc_name").on("change paste keyup", function() {
        var docname = ($("#doc_name").val()); 
        $("#doc_name0").val(docname);
     });
    
    $(function() {
        var chk = $('#confirm_agree');
        var btn = $('#btncheck');

        chk.on('change', function() {
          btn.prop("disabled", !this.checked);//true: disabled, false: enabled
        }).trigger('change'); //page load trigger event
    });

    // A D D   D I A L O G   B O X 
/*    
    $("[id^=noteAddDialogContent]").dialog({
        autoOpen: false,
        modal: true,
        width     : 750,
        buttons: {
            Request: function() {
                commentNew = $("#noteAddInput" + termid).val();
                if ($("#noteAddInput" + termid).val()) {
                    $( "#confirmCommentAddDialog" ).dialog( "open" );
                    $.ajax({
                        type: "POST",
                        url: './commentreview',
                        data: {"id" : termid, "comments" : commentNew },
                        success: function() {
                            $("#review" + termid).html('<img src=images/under_review_small.png>');
                        },
                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    })
                } else {
                    console.log("comment review sent but i dont know what it is");
                }
                $( this ).dialog( "close" );
            },        
            Cancel: function() {
                console.log("comment add cancelled");
                $( this ).dialog( "close" );
            }
        }
    });

*/
        
    // T H E   " S E L E C T   A L L "   B U T T O N 
        
    $(function () {
           $('#btnHelp2').on('click', function () {
console.log("help me");
alert("help me");
           });
          });

    // T H E   " C L E A R   A L L "   B U T T O N 

    $(function () {
           $('#clearall').click(function () {
            $('.clsTargetLanguage').prop('checked', false);
            $('.clsLangBox').css('background-color', 'white'); 
            $('.source_select').val("7");
            $('#chkCount').val("0");
           });
          });
          





 
    
});

function toTimestamp(strDate){
   var datum = Date.parse(strDate);
   return datum/1000;
}