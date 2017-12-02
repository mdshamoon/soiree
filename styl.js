$(document).ready(function()
{
$('#post').attr('enctype','multipart/form-data');


	$('#click').on('click',function()
   	{


   		$.ajax({
  	method: 'post',
  url: 'http://localhost/wordpress/wp-admin/admin-ajax.php',
  data: {
    'email' :  $('#email').val(),
    'name' : $('#name').val(),
'phone' :   $('#phone').val(),
    'action': 'add_guest_request'
  },
  success: function( result ) {
  	console.log(result);
   $('#myform').hide();
   		$('#congrat').html('thank you for registering '+result.data)
   		$('#congrat').show();
  }
  
});
   		
   	});
	console.log("working");
  
}



	)

