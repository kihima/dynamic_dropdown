<!DOCTYPE html>
<html>
 <head>
    <title>JSON - Dynamic Dependent Dropdown List using Jquery and Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
    <br /><br />
    <div class="container" style="width:600px;">
      <h2 align="center">Kenya Counties, Constituencies and Wards Dynamic Dependent Dropdown List</h2><br /><br />
      <select name="county" id="County" class="form-control input-lg">
        <option value="">Select County</option>
      </select>
      <br />
      <select name="constituency" id="Constituency" class="form-control input-lg">
        <option value="">Select Constituency</option>
      </select>
      <br />
      <select name="ward" id="Ward" class="form-control input-lg">
        <option value="">Select Ward</option>
      </select>
      <br/>
      <select name="polingstation" id="Polling" class="form-control input-lg">
       <option value="">Select Polling Station</option>
      </select>
    </div>
 </body>
</html>

<script>
$(document).ready(function(){

 load_json_data('County');

 function load_json_data(id, parent_id)
 {
  var html_code = '';
  $.getJSON('constituencies.json', function(data){

   html_code += '<option value="">Select '+id+'</option>';
   $.each(data, function(key, value){
    if(id == 'County')
    {
     if(value.parent_id == '0')
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
    else
    {
     if(value.parent_id == parent_id)
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
   });
   $('#'+id).html(html_code);
  });

 }

 $(document).on('change', '#County', function(){
  var county_id = $(this).val();
  if(county_id != '')
  {
   load_json_data('Constituency', county_id);
  }
  else
  {
   $('#Constituency').html('<option value="">Select Constituency</option>');
   $('#Ward').html('<option value="">Select Ward</option>');
   $('#Polling').html('<option value="">Select Polling Station</option>');
  }
 });
 $(document).on('change', '#Constituency', function(){
  var constituency_id = $(this).val();
  if(constituency_id != '')
  {
   load_json_data('Ward', constituency_id);
  }
  else
  {
   $('#Ward').html('<option value="">Select Ward</option>');
   $('#Polling').html('<option value="">Select Polling Station</option>');
  }
 });
 $(document).on('change', '#Ward', function(){
  var ward_id = $(this).val();
  if(ward_id != '')
  {
   load_json_data('Polling', ward_id);
  }
  else
  {
   $('#Polling').html('<option value="">Select Polling Station</option>');
  }
 });
});
</script>
