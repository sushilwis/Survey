//hiding upload section
$('#upload-section').hide();

//hiding upload section
$('#loading').hide();

//hiding delete all button 1
$("#delete-selected-1").hide();

//hiding delete all button 2
$("#delete-selected-2").hide();

//message hide after 4 sec
setTimeout(function(){
    // console.log("Hiding message");
    $('#msg-box').hide();        
}, 4000);


// $(document).ready(function(){
    $("#checkall").click(function () {
            if ($("#checkall").is(':checked')) {
                $("#mytable input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });
    
            } else {
                $("#mytable input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });
        
        $("[data-toggle=tooltip]").tooltip();

// });



// $(document).ready(function(){
    $("#checkall-2").click(function () {
            if ($("#checkall-2").is(':checked')) {
                $("#mytable-2 input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });
    
            } else {
                $("#mytable-2 input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });
        
        $("[data-toggle=tooltip]").tooltip();

// });





//display and hide promo code section and upload section
$('#upload-menu').click(function(){
    $('#upload-section').show();
    $('#code-table-section').hide();
});
// dash-menu

$('#dash-menu').click(function(){
    $('#upload-section').hide();
    $('#code-table-section').show();
});





//delete single row table 1
function deleteSingleRow(id) {
    var conf = confirm("Are you sure want to delete this ?");
    // console.log(conf);
    // console.log(id);
    
    $.ajax({type: "POST",
            url: "deleteSingleRow.php",
            data: {id: id},
            success: function(data){
                if(data == 'true'){
                    // console.log('process done successfully');
                    $('#'+id).hide();
                    alert('Row deleted successfully.');
                }
        }
    });
     
}




//delete single row table 2
function deleteSingleRow2(id) {
    var conf = confirm("Are you sure want to delete this ?");
    // console.log(conf);
    // console.log(id);
    
    $.ajax({type: "POST",
            url: "deletesinglerow-2.php",
            data: {id: id},
            success: function(data){
                if(data == 'true'){
                    // console.log('process done successfully');
                    $('#'+id).hide();
                    alert('Row deleted successfully.');
                }
        }
    });
     
}





//delete multi rows

$("#delete-selected-1").on("click", function () {
    // $('#mytable tr').has('input[name="vehicle"]:checked').remove()
    var ids = $("#mytable input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    // console.log(ids);

    $.ajax({type: "POST",
            url: "deleteMultiRow.php",
            data: {ids: ids},
            success: function(data){
                // console.log(data);
                if(data == 'success'){
                    // console.log(ids);
                    ids.forEach(function(id){
                        $('#'+id).hide();                    
                    });

                    alert('Rows deleted successfully.');
                }                               
        }
    });
})





//delete multi rows 2

$("#delete-selected-2").on("click", function () {
    // $('#mytable tr').has('input[name="vehicle"]:checked').remove()
    var ids = $("#mytable-2 input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    // console.log(ids);

    $.ajax({type: "POST",
            url: "deletemultirow-2.php",
            data: {ids: ids},
            success: function(data){
                // console.log(data);
                if(data == 'success'){
                    // console.log(ids);
                    ids.forEach(function(id){
                        $('#'+id).hide();                    
                    });

                    alert('Rows deleted successfully.');
                }                               
        }
    });
})





//show delete all btn when selecting more than one row
$("#mytable input.checkthis[type=checkbox]").change(function() {
    // console.log('click on check box.');
    var ids = $("#mytable input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    console.log(ids);
    console.log(ids.length);

    if(ids.length >= 2){
        $("#delete-selected-1").show();
    }else{
        $("#delete-selected-1").hide();
    }
});




//show delete all btn when selecting more than one row 2
$("#mytable-2 input.checkthis[type=checkbox]").change(function() {
    // console.log('click on check box.');
    var ids = $("#mytable-2 input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    console.log(ids);
    console.log(ids.length);

    if(ids.length >= 2){
        $("#delete-selected-2").show();
    }else{
        $("#delete-selected-2").hide();
    }
});





//show delete all btn when click on check all btn
$("#checkall").change(function () {
    var ids = $("#mytable input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    if(ids.length >= 2){
        $("#delete-selected-1").show();
    }else{
        $("#delete-selected-1").hide();
    }
});





//show delete all btn when click on check all btn 2
$("#checkall-2").change(function () {
    var ids = $("#mytable-2 input.checkthis[type=checkbox]:checked").map(function () {
        return $(this).val();
    }).get();

    if(ids.length >= 2){
        $("#delete-selected-2").show();
    }else{
        $("#delete-selected-2").hide();
    }
});




//validate email

// $('#email-validation-form').on('submit', function(e){
//     e.preventDefault();
//     var email = $('#emailToValidate').val().trim();
//     // console.log(email);

//     $.ajax({type: "POST",
//             url: "validateEmail.php",
//             data: {email: email},
//             success: function(data){

//                 var responce = JSON.parse(data);

//                 if(responce.code == '1'){
//                     setTimeout(function () { 
//                         $('#loading-text').text('Generating  Promo Code .... Please Wait');
//                         // console.log(loadText);
//                         $('.progress-bar').attr('aria-valuenow', 100);
//                         // console.log(progressbarValue);
//                         $('.progress-bar').css('width', 100+'%');
//                         // console.log(progressbarWidth);
//                         $('.progress-bar').text('100%');
//                         // console.log(progressbarWidth);
    
//                         $('#outputMsg').text(responce.msg);
//                         // $('#loading').hide();
//                         $('#emailToValidate').val("");
//                     }, 1500);
//                 }


//                 if(responce.code == '2'){
//                     setTimeout(function () { 
//                         // $('#loading-text').text('Generating  Promo Code .... Please Wait');
//                         // console.log(loadText);
//                         $('.progress-bar').attr('aria-valuenow', 100);
//                         // console.log(progressbarValue);
//                         $('.progress-bar').css('width', 100+'%');
//                         // console.log(progressbarWidth);
//                         $('.progress-bar').text('100%');
//                         // console.log(progressbarWidth);
    
//                         $('#outputMsg').text(responce.msg);

//                         // $('#loading').hide();
//                         $('#emailToValidate').val("");
//                     }, 1000);
//                 }



//                 if(responce.code == '3'){
//                     setTimeout(function () { 
//                         // $('#loading-text').text('Generating  Promo Code .... Please Wait');
//                         // console.log(loadText);
//                         $('.progress-bar').attr('aria-valuenow', 100);
//                         // console.log(progressbarValue);
//                         $('.progress-bar').css('width', 100+'%');
//                         // console.log(progressbarWidth);
//                         $('.progress-bar').text('100%');
//                         // console.log(progressbarWidth);
    
//                         $('#outputMsg').text(responce.msg);

//                         // $('#loading').hide(); 
//                         $('#emailToValidate').val("");                       
//                     }, 1000);
//                 }



//                 if(responce.code == '4'){
//                     setTimeout(function () { 
//                         // $('#loading-text').text('Generating  Promo Code .... Please Wait');
//                         // console.log(loadText);
//                         $('.progress-bar').attr('aria-valuenow', 100);
//                         // console.log(progressbarValue);
//                         $('.progress-bar').css('width', 100+'%');
//                         // console.log(progressbarWidth);
//                         $('.progress-bar').text('100%');
//                         // console.log(progressbarWidth);
    
//                         $('#outputMsg').text(responce.msg);

//                         // $('#loading').hide();
//                         $('#emailToValidate').val("");
//                     }, 1000);
//                 }



//                 // $('#loading').hide();

//                 // $('#loading-text').text('Validating .... Please Wait');
//                 // // console.log(loadText);
//                 // $('.progress-bar').attr('aria-valuenow', 25);
//                 // // console.log(progressbarValue);
//                 // $('.progress-bar').css('width', 25+'%');
//                 // // console.log(progressbarWidth);
//                 // $('.progress-bar').text('25%');


//                 // if(data == '1'){
//                 //     $outputText = ;
//                 // }
//                 // $('#outputMsg').text(data);
//                 // if(data == 'true'){
//                 //     console.log('process done successfully');
//                 // }
                
//                 // $('#outputMsg').text(data);
//         }
//     });
// });






// $('#loading').show();   

// setTimeout(function(){
//     // $('#loading').hide();  
//     $('#loading-text').text('Generating  Promo Code .... Please Wait');                      
//     $('.progress-bar').attr('aria-valuenow', 100);                         
//     $('.progress-bar').css('width', 100+'%');                        
//      $('.progress-bar').text('100%');   
// }, 2000);

// setTimeout(function(){
//     $('#loading').hide();    
// }, 3000);










