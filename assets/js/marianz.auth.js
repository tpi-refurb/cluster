var URL_AUTH ="includes/actions/auth.php?a=";
var Authentication = (function (){
	return {
		validate: function(options){
			var $this = {};
			if(options.action && typeof options.action !=='undefined'){
				$this.action = options.action;
			}
			
			$this.title = ($this.action ==='login') ? 'Login' : 'Register';
			
			if(options.button_id && typeof options.button_id !=='undefined'){
				$this.button_id = options.button_id;
			}
			
			if(options.form_id && typeof options.form_id !=='undefined'){
				if(options.form_id.indexOf('#')===0){
					$this.form_id = options.form_id;
				}else{
					$this.form_id = "#"+options.form_id;
				}
			}else{
				$this.form_id = "#dummy_form";
			}

			var $serialize_data = $($this.form_id).serialize();
			
			$.ajax({
				type: "POST",
				dataType: "json",
				url: URL_AUTH+$this.action,
				data: $serialize_data,
				success: function(response){
					//var response = $.parseJSON(JSON.stringify(response));	
					if(response.error){						
						var $errors='';
						if(typeof response.message =='undefined'){
							/* Remove class (form-group-red) which stands for error highlighting*/
							$($this.form_id+' .form-group').each(function(){
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
						MessageDialog.show({message:$errors,title: $this.title+ " Error"});
					}else{
						//window.location="index.php";
						location.reload();
					}
				},
				beforeSend:function(){
					
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
		}		
	};
}());


$(document).ready(function()
{	
	$("#signin_button").click(function(){
		Authentication.validate({
			form_id: 'signin_form',
			action : 'login'
		});
		return false;
	});	
	
	$("#signup_button").click(function(){	
		Authentication.validate({
			form_id: 'signup_form',
			action : 'register'
		});
		return false;
	});
	
	
});