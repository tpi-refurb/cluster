var URL_AUTH ="includes/actions/auth.php?a=";
var Authentication = (function (){
	return {
		validate: function(form_id,button_id, action){
			
			var $serialize_data = $(form_id).serialize();	
			
			$.ajax({
				type: "POST",
				dataType: "json",
				url: URL_AUTH+action,
				data: $serialize_data,
				success: function(response){
					var response = $.parseJSON(JSON.stringify(response));	
					if(response.error){						
						var $errors='';
						if(typeof response.message =='undefined'){
							/* Remove class (form-group-red) which stands for error highlighting*/
							$(form_id+' .form-group').each(function(){
								$(this).removeClass('form-group-red');
							});							
							/* Then add (form-group-red) class in which input contains error */
							$.map(response, function(val, key) {														
								$('#'+key).parent().closest(".form-group").addClass('form-group-red');
								if(key!='error'){
									$errors += (val+'<br>');
								}
							});
						}else{
							$errors += (response.message+'<br>');
						}
						
						
						//showSpinner(button_id, true);
						MessageDialog.show($errors,'Login Error');
						//showErrorSnackbar($errors);
					}else{
						window.location="index.php";
					}
				},
				beforeSend:function(){
					//showSpinner(button_id, false);
				}
			});
			
			function showErrorSnackbar($content){
				$('body').snackbar({
					width: '600px',
					content: '<a data-dismiss="snackbar">Dismiss</a><div class="snackbar-text">' + snackbarText + ' '+ $content+'</div>',
					show: function () {
						snackbarText++;
					}
				});
			}
			
			function showSpinner($btn_id, $done){
				if($done===false){
					$($btn_id).html('<span class="icon icon-lg text-white signin-spin">sync</span>Signing...');
					$('.signin-spin').addClass('animated infinite rotateIn');
				}else{					
					$('.signin-spin').removeClass('animated infinite rotateIn');
					$($btn_id).html('Signing');
				}
			}
		}		
	};
}());


$(document).ready(function()
{	
	$("#signin_button").click(function(){		
		Authentication.validate('#signin_form',"#signin_button",'login')
		return false;
	});	
	
	$("#signup_button").click(function(){	
		Authentication.validate('#signup_form',"#signup_button",'register')
		return false;
	});
	
	
});