<?php



//echo $json = json_decode($_POST['data']);




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>spinner demo</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>

    $(function () {
    var artItems = ["Art 1", "Art 2", "Art 3", "Art 4", "Art 5", "Art 6"];
    var vidItems = ["Video 1", "Video 2", "Video 3", "Video 4", "Video 5", "Video 6"];
    var total ;
    var product_list = '';
    
    
    // callback is attached to an  event lister !!!
    
    
    $('#SelectBox').change(function () {
        var str = "",  
            inHTML = "",
            items;
        items = $(this).val() == 'art' ? artItems : vidItems;
        $.each(items, function (i, ob) {
            inHTML += '<option value="' + i + '">' + ob + '</option>';
        });
      $("#SelectBox2").empty().append(inHTML);
    });

    $('#SelectBox2').change(function () {
        //$("#selectedValues").text($(this).val() + ';' + $("#SelectBox").val());
        //$('#hidden1').val($(this).val());
    });

    $('#add').click(function () {
        inHTML = "";
        $("#SelectBox2 option:selected").each(function () {
            inHTML += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        });
        $("#SelectedItems").append(inHTML);
    });
    
    $('#add_order').click(function () {
        inHTML = "";
        $("#SelectedItems option").each(function () {
            inHTML += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        });
        
        
    }); 
    
  $("#SelectBox2").dblclick(function () {
    inHTML = "";
    total= 0 ;
    
    $("#SelectBox2 option:selected").each(function () {
        inHTML += '<option value="' + $(this).val() + '">' + $(this).text() + ' - ' + $(this).val() + '</option>';
        
    });
  
    $("#SelectedItems").append(inHTML);
    
    
    $("#SelectedItems option").each(function () {

           curr = Number($(this).val()) ;
           total += curr ;        
           
    });

    $("#selectedValues").text('Totali: ' + total);

});

    
    $("#SelectedItems").dblclick(function () {
        $("#SelectedItems option:selected").each(function () {
        }).remove();
        
        total= 0 ;
        
        $("#SelectedItems option").each(function () {

           curr = Number($(this).val()) ;
           total += curr ;   
                  
        });

    $("#selectedValues").text('Totali: ' + total);
    
    
    
    });
    
    
    
    //build prod list
    var data_arr = [];
    var emp_name = 'flamur statovci';
    
        
    var emp = JSON.stringify({"name" : emp_name});
    var tot_price = JSON.stringify({"total" : total});
    

    
    $("#add_order").click(function () {  
        
        var data_obj = {} ;
        var prod_list = [] ;
        
        $("#SelectedItems option").each(function () {       
           
           var name = $(this).text() ;
           var price = $(this).val() ; 
           
           prod_list.push({"name" : name }) ;
           
           
        });
        
        //list of orders - list of asscoative arrays from db
        
         

        //object
      data_obj = {"emp": emp_name, "prod_list" : prod_list, "total" : total}
      
      var send_data = JSON.stringify(data_obj);
      
      var test = 'test'
      
       var request =  $.ajax({
            type: 'POST',
            url: 'rene_response.php',
            data: data_obj,
            dataType: "text" 
                
        });
        
           request.done(function(msg){
                alert(msg);         
            });
        
            request.fail(function(jqXHR, textStatus) {
                alert('failure');  
            });
      
      
      console.log();
      
      prod_list = [] ;
      
            
        
    });
    
    

        
});
      

</script>
  
  
</head>

<body>
 
<div style="float: left">
    <select name="drop1" id="SelectBox" size="4" style="width:200px;height : 200px">
        <option value="art">Art</option>
        <option value="video">Video</option>
    </select>
</div>
    
<div style="float: left;">    
<select name="drop1" id="SelectBox2" size="4" multiple="multiple" style="width:200px;height : 200px">
    <option value="1.5">Cola</option>
    <option value="3.5">Coffe</option>
    <option value="2.5">Beer</option>

</select>


</div>

<div style="float: left">    
    <select id="SelectedItems" size="4" multiple="multiple" style="width:200px;height : 200px"></select>
</div>
    


<input type="hidden" id="hidden1" />


<p id="selectedValues"></p>

<input type="button" id="add_order" value="Regjistro"/>


<div style="">
     <table>
        <tr> 
            <td>Kategoria
                 
            <td>
                <select name="drop1" id="SelectBox" style="">
                    <option value="">-----------</option>
                    <option value="art">Pije</option>
                    <option value="video">Video</option>
                </select>
    
        <tr>
            <td><label>Emri i produktit:</label>
            <td><input type="text" id="prod_name">
        <tr>
            <td>Cmimi:<td><input type="text" id="price">
        <tr><td><td><input type="button" id="sub" value="Shto Produktin">

    </table>

</div>
 
</body>
</html>