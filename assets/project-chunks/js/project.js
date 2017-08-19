// page-picker.html
	var $pickerLib = $('.ui-picker-lib'),
	    pickerMap,
	    pickerMarker;

	function initPickerMap () {
		pickerMap = new google.maps.Map(document.getElementById('ui_picker_map_wrap'), {
			center: {
				lat: 0,
				lng: 0
			},
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoom: 15
		});

		pickerMarker = new google.maps.Marker({
			map: pickerMap,
			position: {lat: 0, lng: 0}
		});
	};

	if ((typeof google != 'undefined') && $('.ui-picker-map-wrap').length) {
		initPickerMap();
	};

	if (typeof jQuery.ui != 'undefined') {
		// draggable
			$('.ui-picker-draggable-handler').draggable({
				addClasses: false,
				appendTo: 'body',
				cursor: 'move',
				cursorAt: {
					top: 0,
					left: 0 
				},
				delay: 100,
				helper: function () {
					return $('<div class="tile tile-brand-accent ui-draggable-helper"><div class="tile-side pull-left"><div class="avatar avatar-sm"><strong>' + $('.ui-picker-selected:first .ui-picker-draggable-avatar strong').html() + '</strong></div></div><div class="tile-inner text-overflow">' + $('.ui-picker-selected:first .ui-picker-info-title').html() + '</div></div>');
				},
				start: function (event, ui) {
					var draggableCount = $('.ui-picker-selected').length;

					if (draggableCount > 1) {
						$('.ui-draggable-helper').append('<div class="avatar avatar-brand avatar-sm ui-picker-draggable-count">' + draggableCount + '</div>');
					};
				},
				zIndex: 100
			});

		// droppable
			$('.ui-picker-nav .nav a').droppable({
				accept: '.ui-picker-draggable-handler',
				addClasses: false,
				drop: function(event, ui) {
					$('body').snackbar({
						content: 'Dropped on "' + $(this).html() + '"'
					});
				},
				hoverClass: 'ui-droppable-helper',
				tolerance: 'pointer'
			});

		// selectable
			$pickerLib.selectable({
				cancel: '.ui-picker-draggable-handler',
				filter: '.ui-picker-selectable-handler',
				selecting: function (event, ui) {
					var $selectingParent = $(ui.selecting).parent();

					$selectingParent.addClass('tile-brand-accent ui-picker-selected');

					$('.ui-picker-info').addClass('ui-picker-info-active').removeClass('ui-picker-info-null');
					$('.ui-picker-info-desc-wrap').html($selectingParent.find('.ui-picker-info-desc').html());
					$('.ui-picker-info-title-wrap').html($selectingParent.find('.ui-picker-info-title').html());

					var pickerMapLatLng = new google.maps.LatLng($selectingParent.find('.ui-picker-map-lat').html(), $selectingParent.find('.ui-picker-map-lng').html());

					pickerMap.setCenter(pickerMapLatLng);
					pickerMarker.setMap(pickerMap);
					pickerMarker.setPosition(pickerMapLatLng);
				},
				unselecting: function (event, ui) {
					var $unselectingParent = $(ui.unselecting).parent();

					$unselectingParent.removeClass('tile-brand-accent ui-picker-selected');

					if (!$('.ui-picker-selected').length) {
						$('.ui-picker-info').addClass('ui-picker-info-null');
						$('.ui-picker-info-desc-wrap').html('');
						$('.ui-picker-info-title-wrap').html('');
						pickerMarker.setMap(null);
					} else {
						var $first = $($('.ui-picker-selected')[0]);

						$('.ui-picker-info-desc-wrap').html($first.find('.ui-picker-info-desc').html());
						$('.ui-picker-info-title-wrap').html($first.find('.ui-picker-info-title').html());

						var firstLatLng = new google.maps.LatLng($first.find('.ui-picker-map-lat').html(), $first.find('.ui-picker-map-lng').html());

						pickerMap.setCenter(firstLatLng);
						pickerMarker.setMap(pickerMap);
						pickerMarker.setPosition(firstLatLng);
					};
				}
			});
	};

	$(document).on('click', '.ui-picker-info-close', function () {
		$('.ui-picker-info').removeClass('ui-picker-info-active');
	});

// ui-picker.html
	$('#ui_datepicker_example_1').pickdate();

	$('#ui_datepicker_example_2').pickdate({
		cancel: 'Clear',
		closeOnCancel: false,
		closeOnSelect: true,
		container: '',
		firstDay: 1,
		format: 'You selecte!d: dddd, d mm, yy',
		formatSubmit: 'dd/mmmm/yyyy',
		ok: 'Close',
		onClose: function () {
			$('body').snackbar({
				content: 'Datepicker closes'
			});
		},
		onOpen: function () {
			$('body').snackbar({
				content: 'Datepicker opens'
			});
		},
		selectMonths: true,
		selectYears: 10,
		today: ''
	});

	$('#ui_datepicker_example_3').pickdate({
		disable: [
			[2016,0,12],
			[2016,0,13],
			[2016,0,14]
		],
		today: ''
	});

	$('#ui_datepicker_example_4').pickdate({
		disable: [
			new Date(2016,0,12),
			new Date(2016,0,13),
			new Date(2016,0,14)
		],
		today: ''
	});

	$('#ui_datepicker_example_5').pickdate({
		disable: [
			2, 4, 6
		],
		today: ''
	});

	$('#ui_datepicker_example_6').pickdate({
		disable: [
			{
				from: [2016,0,12],
				to: 2
			}
		],
		today: ''
	});

	$('#ui_datepicker_example_7').pickdate({
		disable: [
			true,
			3,
			[2016,0,13],
			new Date(2016,0,14)
		],
		today: ''
	});

	$('#ui_datepicker_example_8').pickdate({
		disable: [
			{
				from: [2016,0,10],
				to: [2016,0,30]
			},
			[2016,0,13, 'inverted'],
			{
				from: [2016,0,19],
				to: [2016,0,21],
				inverted: true
			}
		],
		today: ''
	});

	$('#ui_datepicker_example_9').pickdate({
		max: [2016,0,30],
		min: [2016,0,10],
		today: ''
	});

	$('#ui_datepicker_example_10').pickdate({
		max: new Date(2016,0,30),
		min: new Date(2016,0,10),
		today: ''
	});

	$('#ui_datepicker_example_11').pickdate({
		max: true,
		min: -10,
		today: ''
	});

// ui-progress.html
	$('.finish-loading').on('click', function(e) {
		e.stopPropagation();
		$($(this).attr('data-target')).addClass('el-loading-done');
	});

	$('#ui_el_loading_example_wrap .tile-active-show').each(function (index) {
		var $this = $(this),
		    timer;

		$this.on('hide.bs.tile', function(e) {
			clearTimeout(timer);
		});

		$this.on('show.bs.tile', function(e) {
			if (!$('.el-loading', $this).hasClass('el-loading-done')) {
				timer = setTimeout(function() {
					$('.el-loading', $this).addClass('el-loading-done');
					$this.prepend('<div class="tile-sub"><p>Additional information<br><small>Aliquam in pharetra leo. In congue, massa sed elementum dictum, justo quam efficitur risus, in posuere mi orci ultrices diam.</small></p></div>');
				}, 6000);
			};
		});
	});

// ui-snackbar.html
	var snackbarText = 1;

	$('#ui_snackbar_toggle_1').on('click', function () {
		$('body').snackbar({
			content: 'Simple snackbar ' + snackbarText + ' with some text',
			show: function () {
				snackbarText++;
			}
		});
	});

	$('#ui_snackbar_toggle_2').on('click', function () {
		$('body').snackbar({
			content: '<a data-dismiss="snackbar">Dismiss</a><div class="snackbar-text">Simple snackbar ' + snackbarText + ' with some text and a simple <a href="javascript:void(0)">link</a>.</div>',
			show: function () {
				snackbarText++;
			}
		});
	});
	
	// Hide reason DIVs in updates.php
	$('.retrieved_reason').hide();	
	$('.remarks_reason').hide();
	$('#visited_div').hide();
	
	// Initialize all selector id as DatePicker
	//$('.mar_datepicker').pickdate({
	//	format: 'yyyy-mm-dd',
	//});
	
	function changeVisitedRange($min_date){
		$('.mar_datepicker').pickdate({
			format: 'yyyy-mm-dd',
			min: new Date($min_date)
		});
	}
	
	// When Datepicker value is change, then set selected value to hidden input
	$("#ui_datevisited").change(function(){		
		$('#ui_updates_datevisited').val(this.value);
	});
	
	
	// checkbox in maintenance
	$(".active-state").change(function(){		
		$('#active').val(this.checked?'1':'0');
	});
	
	var updates = {};
	// Order Number input change
	$("#ui_updates_ordno").on('change keydown paste input', function(){
		var loc = $('#l').val();
		var ord_no = $(this).val();
		
		console.log(ord_no);
		$.ajax({
			url: URL_CHECKER+loc+'&o='+ord_no,
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				if(data.exist==true){					
					$("#ordno_group").removeClass('form-group-red').addClass('form-group-green');
					$("#add_updates_button").disableFloatButton(false);
					$("#ui_updates_datedispatch").val(data.dispatch);
					$("#ui_updates_lastdatevisited").val(data.visited);
					$('#visited_div').show();
					changeVisitedRange(data.max_date);					
					updates.exist = true;
				}else{					
					$("#ordno_group").removeClass('form-group-green').addClass('form-group-red');
					$("#add_updates_button").disableFloatButton(true);
					$("#ui_updates_datedispatch").val('');
					$("#ui_updates_lastdatevisited").val('');
					$('#visited_div').hide();
					updates.exist = false;
				}				
			},
			beforeSend: function(){
				updates.exist = false;
			}
		});
	});
	
	
	
	// Add New Updates
	$("#add_updates_button").click(function(){
		if(updates.exist==true){
			var url = $('#r').val();
			var $serialize_data = $('#add_form_gmma').serialize();
			Maintenance.setUrl(URL_UPDATES);
			Maintenance.add('#add_form_gmma','#add_updates_button',url);
		}
		return false;
	});
	
	// Update Maintenance	
	$("#update_button").click(function(){
		var url = $('#r').val();
		Maintenance.execute({
			action :'Update',
			form_id :'#edit_form',
			button_id :'#update_button',
			redirect_url :url,
			ajax_url :URL_MAINTEN
		});
		
		return false;
	});
	
	// Delete Maintenance
	$("#delete_button").click(function(){
		var url = $('#r').val();
		Maintenance.execute({
			action :'Delete',
			form_id :'#delete_form',
			button_id :'#delete_button',
			redirect_url :url,
			ajax_url :URL_MAINTEN
		});
		
		return false;
	});
	
	// Delete Maintenance
	$("#add_button").click(function(){
		var url = $('#r').val();
		Maintenance.execute({
			action :'Add',
			form_id :'#add_form',
			button_id :'#add_button',
			redirect_url :url,
			ajax_url :URL_MAINTEN
		});
		
		return false;
	});
	
	
	
	
	// Change Item State Maintenance
	function changetState(s,t,i){
		var rurl = $('#r').val();
		var query='&t='+t+'&i='+i;
		$.ajax({
			type: 'POST',
			dataType: "json",
			url: URL_STATE+s+query,
			success: function (response) {
				var response = $.parseJSON(JSON.stringify(response));
				if(response.error){
					MessageDialog.show(response.message,'Active');
				}else{					
					window.location=rurl;
				}
			}
		});
	}
	
	function onSelectRemarks(value){
		$('#ui_updates_remarks').val(value);
		$('#ui_updates_remarks').focus();
		console.log(value);
		if(value.toUpperCase()=='RETRIEVED'){
			$('.retrieved_reason').show();
			$('.remarks_reason').hide();
		}else{
			$('.retrieved_reason').hide();
			$('.remarks_reason').show();			
		}
	}
	
	function onSelectBundles(value){
		$('#ui_updates_bundle').val(value);
		$('#ui_updates_bundle').focus();
		console.log(value);
		if(value.toUpperCase()=='RETRIEVED'){
			$('.retrieved_details').show();
		}else{
			$('.retrieved_details').hide();		
		}
	}
	
	function clearInputsInside(id){
		$(id).each(function(){
			
		});
	}
	
	function fileChange(){
		var file = $('#excel_file').val().replace('C:\\fakepath\\', '');
		if (file && typeof file != 'undefined') {
			var ext = file.substring(file.lastIndexOf(".") + 1, file.length);
			if (ext && (ext =='xls' || ext==='xlsx')){
				$('#ui_excel_file').val(file);
			}else{
				MessageDialog.show('Invalid file extension.','Error');
			}
		}
	}
	
var URL_CHECKER		="includes/actions/checker.php?l=";	
var URL_STATE		="includes/actions/state.php?s=";
var URL_MAINTEN		="includes/actions/maintenance.php";
var URL_UPDATES		="includes/actions/updates.php";

var Maintenance = (function (){	
	"use strict";

    var $this = {};
	
	$this.execute = function(options) {
		$this.url = options.ajax_url; 
		switch (options.action){
			case 'Add':
				$this.add(options.form_id,options.button_id,options.redirect_url);
				break;
			case 'Update':
				$this.update(options.form_id,options.button_id,options.redirect_url);
				break;
			case 'Delete':
				$this.delete(options.form_id,options.button_id,options.redirect_url);
				break;
            
            default:
				break;
		}
    };
	
	$this.setUrl = function(url) {
		$this.url = url;    
    };
	
	$this.update = function(form_id,button_id,redirect_url) {
		$this.action(form_id,button_id,redirect_url,'Update');    
    };
	
	$this.add = function(form_id,button_id,redirect_url) {
		$this.action(form_id,button_id,redirect_url,'Add');    
    };

	$this.delete = function(form_id,button_id,redirect_url) {
		$this.action(form_id,button_id,redirect_url,'Delete');    
    };

	$this.action = function(form_id,button_id, redirect_url, state){
		// Get all serialized input inside form id
		var $serialize_data = $(form_id).serialize();
		$.ajax({
			type: "POST",
			dataType: "json",
			url: $this.url,
			data: $serialize_data,
			success: function(response){
				var response = $.parseJSON(JSON.stringify(response));
				if(response.error){						
					var $errors='';
					if(typeof response.message =='undefined'){
											
						/* Then add (form-group-red) class in which input contains error */
						$.map(response, function(val, key) {														
							$('#'+key).parent().closest(".form-group").addClass('form-group-red');
							if(key!='error'){
								//console.log(val+'     '+key);
								$errors += (val+'<br>');
							}
						});
					}else{
						$errors += (response.message+'<br>');
					}
					//console.log($errors);
					MessageDialog.show($errors,state+' Error');
				}else{
					if(response.message !=''){
						MessageDialog.show(response.message,state);
					}
					setTimeout(function(){
						window.location=redirect_url;
					}, 2000);
					
				}
			},
			beforeSend:function(){
				//showSpinner(button_id, false);
				/* Remove class (form-group-red) which stands for error highlighting*/
				$(form_id+' .form-group').each(function(){
					$(this).removeClass('form-group-red');
				});		
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
	};
	
	return $this;
	
}());


	
	/* Check LOCAL cookies every 1 second */	
	setInterval(checkCookie, 1000);  	
	function checkCookie(){
		username = getCookie('Username'); 
		userid = getCookie('UserId'); 
		//console.log(username+' '+ userid);
		if (userid == "" || username == ""){
			location.reload();
		}
	}
	
	
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length,c.length);
			}
		}
		return "";
	}
	
	
