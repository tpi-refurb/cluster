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
	
	
	// Hide DIVs in home.php
	$('.el-loading').hide();	
	$('.remarks_reason').hide();
	$('#visited_div').hide();
	$('#home_import').hide();  //Hide import button in home.php
	
	// Initialize all selector id as DatePicker
	$('.ui_datepicker').pickdate({
		format: 'yyyy-mm-dd',
	});
	
	// Initialize select input adding tech 'technician.php' 
	$(".select2").select2({
		templateResult: formatState
	});
	
	function formatState (state) {
		if (!state.id) { return state.text; }
		var $state = $('<span><span class="avatar avatar-inline avatar-brand margin-right"><span class="icon">person</span></span>' + state.text + '</span>');
		return $state;
	};
	
	/*
	function changeVisitedRange($min_date){
		$('.mar_datepicker').pickdate({
			format: 'yyyy-mm-dd',
			min: new Date($min_date)
		});
	}
	*/
	
	// When Datepicker value is change, then set selected value to hidden input
	$("#date_dispatch").change(function(){		
		$(UI.ui_date_dispatch).val(this.value);
		Cluster.execute({
			action : 'Change Date',
			form_id: FORM.id_excel,
			showMessage: false,
			reload: true,
			ajax_url: URL.change_date+this.value
		});		
	});
	
	/* Start Importing browsed file */
	$('#import_button').click(function(){
		var $this =$(FORM.id_excel_file);
		var $form_data = new FormData($this[0]);
		$.ajax({
			url: URL.upload_url,
			dataType: "json",
			type: "POST",             // Type of request to be send, called as method
			data: $form_data,			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        
			success: function(response){
				if(response.error){
					MessageDialog.show({message:response.message, title: TITLE.import_error});
					$('.el-loading').hide();
					$(UI.id_import_button).disableFloatButton(false);
				}else{
					$.ajax({
						url: URL.import_url+'?f='+response.file, 
						dataType: 'json',
						success: function(response){
							if(response.error){
								MessageDialog.show({message:response.message, title: TITLE.import_error});
							}else{
								MessageDialog.show({message:response.message, title: TITLE.import_success});
								$(UI.id_ui_excel_file).val('Choose file...');
								$(UI.id_excel_file).val('');
								$(UI.id_home_import).hide();
								$(UI.id_home_mainten).show();
							}
							$('.el-loading').hide();
							$(UI.id_import_button).disableFloatButton(false);
						},
						beforeSend: function(){
							// @TODO
						}
					});
				}
			},
			beforeSend: function(){
				$('.el-loading').show();				
				$(UI.id_import_button).disableFloatButton(true);
			}
		});
		
	});
	// checkbox in maintenance
	$(".active-state").change(function(){		
		$('#active').val(this.checked?'1':'0');
	});
	
	// checkbox in update remarks
	$('input[type="checkbox"]').change(function() {
		var ischecked = ($(this).is(":checked"));
		$(this).val(ischecked);
	}); 
	
	/* Add new tech pair */
	$('#add_tech_button').click(function(){
		var $this = $($(FORM.id_add_tech));		
		var $rurl =$this.find('#r').val();
		
		Cluster.execute({
			action : 'Add Technician',
			form_id: FORM.id_add_tech,
			ajax_url: URL.dispatch_url,
			redirect_url:$rurl
		});
	});
	
	function deleteTechnician(opts){
		var $r		= $('#r').val();
		var $d		= $('#d').val();
		var $s		= $('#s').val();
		var $params = {'s':$s,'i':opts.id,'d':$d,'at':opts.at,'ap':opts.ap};
		
		$.confirm({
			text: MSG.confirm_delete_tech,
			confirm: function() {				
				Cluster.execute({
					action		: 'Delete Technician',
					form_id		: FORM.id_add_tech,
					params		: $params,
					ajax_url	: URL.dispatch_url,
					redirect_url:$r
				});
			},
			cancel: function() {
				// @TODO
			}
		});
	}
	
	/* Create a search */
	$('#ui_search').keyup(function(e){
		e.preventDefault(); e.stopPropagation();		
		if(e.keyCode == 13){
			$("#ui_search_button").click();
		}
	});

	$('#ui_search_button').click(function(e){
		e.preventDefault(); e.stopPropagation();	
		var $rurl =$('#r').val();
		var $q =('#ui_search').val();
		showToast('Search',$q);
		
		if($q && typeof $q !=='undefined'){
			//window.location = $rurl+'&q='+$q;
		}else{
			//window.location = $rurl;
		}
		
	});
	
	
	function assignedTo(opts){
		var $dialog = $($(MODAL.tech))
		$dialog.find('.modal-title').html('Select Technician for <strong class="text-brand">'+ opts.ord_no+'</strong>');
		$dialog.find('.modal-inner input[id="i"]').val(opts.id);
		$dialog.find('.modal-inner input[id="o"]').val(opts.ord_no);
		$dialog.modal('show');
	}
	
	function onAssignTech(opts){
		var $form	= $($(FORM.id_assign_tech))
		var $dt		= $form.find('.modal-inner input[id="d"]').val();
		var $params	= {'s':'a','ins1': opts.ins1, 'ins2': opts.ins2};
		var $query	= $.param({'s':'a','d': $dt});
		var $r		= $('#r').val();
		$.confirm({
			text: MSG.confirm_assign_to,
			confirm: function() {				
				Cluster.execute({
					action : 'Assign',
					form_id:FORM.id_assign_tech,
					ajax_url: URL.assign_url+'?'+$query,
					params: $params,
					redirect_url:$r,
					showMessage: false
				});
			},
			cancel: function() {
				// nothing to do
			}
		});
	}
	
	/* Add new assignment to tech pair */
	$('#add_dispatch_button').click(function(){
		var $form	= $($(FORM.id_new_assignment));		
		var $rurl	= $form.find('input[id="r"]').val();
		var $dt		= $form.find('input[id="d"]').val();
		var $query	= $.param({'s':'n','d': $dt});
		Cluster.execute({
			action : 'Add New Assignment',
			form_id: FORM.id_new_assignment,
			ajax_url: URL.assign_url+'?'+$query,
			redirect_url:$rurl
		});
	});
	
	/* Update OK# */
	$('#update_okno_button').click(function(){
		var $form	= $($(FORM.id_updates_ok));		
		var $rurl	= $form.find('input[id="r"]').val();
		var $dt		= $form.find('input[id="d"]').val();
		var $query	= $.param({'s':'u','d': $dt});
		Cluster.execute({
			action : 'Update OK#',
			form_id: FORM.id_updates_ok,
			ajax_url: URL.assign_url+'?'+$query,
			redirect_url:$rurl
		});
	});
	
	
	function confirmActivate(s,t,i){
		$.confirm({
			text: MSG.confirm_activate,
			confirm: function() {
				changetState('Activate',s,t,i);
			},
			cancel: function() {}
		});
	}
	
	function confirmDeactivate(s,t,i){
		$.confirm({
			text: MSG.confirm_delete,
			confirm: function() {
				changetState('Delete',s,t,i);
			},
			cancel: function() {}
		});
	}
	
	// Change Item State
	function changetState(a,s,t,i){
		var $query	= $.param({'s':s,'t': t,'i':i});
		var $r		= $('#r').val();		
		Cluster.execute({
			action : a,
			form_id: FORM.id_excel,
			ajax_url: URL.state_url+'?'+$query,
			redirect_url:$r
		});
	}
	
	function fileChange(){
		var file = $(UI.id_excel_file).val().replace('C:\\fakepath\\', '');
		if (file && typeof file != 'undefined') {
			var ext = file.substring(file.lastIndexOf(".") + 1, file.length);
			if (ext && (ext =='xls' || ext==='xlsx')){				
				$(UI.id_ui_excel_file).val(file);
				$(UI.id_home_mainten).hide();
				$(UI.id_home_import).show();
			}else{
				MessageDialog.show({message:MSG.invalid_extension, title: ' Error'});
			}
		}else{}
	}
	
	function showToast(title,content){
		$.toast({
			heading: title,
            text: content,
            position: 'top-right',
            loaderBg:'#ff4081',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
        });
	}
	
	$('#change_pwd_button').click(function(){
		//$.confirm({
		//	text: MSG.confirm_change_pwd,
		//	confirm: function() {
				Cluster.execute({
					action : 'Change Password',
					form_id: FORM.id_profile,
					ajax_url: URL.change_pwd,
					reload: true
				});
		//	},
		//	cancel: function() {}
		//});
	});

	$('#save_settings_button').click(function(){	
		Cluster.execute({
			action : 'Update Settings',
			form_id: FORM.id_settings,
			ajax_url: URL.settings
			//reload: true
		});
	});

$('#ui_view_filter_date').click(function(){
    var $form	= $($(FORM.id_filter_date));
    var $dt     = $form.find('input[id="date_filter"]').val();
    if($dt && typeof  $dt !=='undefined'){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: URL.generate_u+$dt,
            success: function(res) {
                if (res.error) {
                    MessageDialog.show({message:res.error,title: res.title});
                }else{
                    window.location= res.url;
                }
            }
        });
    }

});
	/*
	$("#ui_dispatch_ordno").on('change keydown paste input', function(){
		var ord_no = $(this).val();
		
		$.ajax({
			url: URL.checker+ord_no,
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				if(data.exist ===true){
					$(UI.id_ui_subsname).val(data.SubsName);
					$(UI.id_ui_address).val(data.InstAddress);
					$(UI.id_ui_serviceno).val(data.ServiceNo);
					$(UI.id_ui_contactno).val(data.ContactNo);
					$(UI.id_ui_cabinetno).val(data.CabinetNo);
				}else{
					//$(FORM.id_new_assignment+' input:not([id="ui_dispatch_ordno"])').each(function(){
					$(FORM.id_new_assignment+' *').filter(':input').not('input[id=ui_dispatch_ordno]').not('input[type=hidden]').each(function(){
						$(this).val('');
					});
				}
			},
			beforeSend: function(){
				
			}
		});
	});
	*/

var Cluster = (function (){	
	"use strict";

    var $this = {};
	
	$this.setUrl = function(url) {
		$this.url = '';
		if(url && typeof url !=='undefined'){
			$this.url = url; 
		}
    };
	
	$this.execute = function(options) {
		$this.setUrl(options.ajax_url);
		
		$this.action =TITLE.default_title;
		if(options.action && typeof options.action !=='undefined'){
			$this.action = options.action;
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
		$this.params ='';
		if(options.params && typeof options.params !=='undefined'){
			$this.params = '&' + $.param(options.params);
		}
		
		// Get all serialized input inside form id
		var $serialize_data = $($this.form_id).serialize()+$this.params;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: $this.url,
			data: $serialize_data,
			success: function(response){
				//var response = $.parseJSON(JSON.stringify(response));
				if(response.error){						
					var $errors='';
					if(typeof response.message ==='undefined'){											
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
					MessageDialog.show({message: $errors, title: $this.action+' Error'});
				}else{
					
					if(response.message){
						if(typeof options.showMessage !=='undefined' && options.showMessage ===false){
						}else{
							MessageDialog.show({message: response.message, title: $this.action});
						}
					}
					if(options.redirect_url && typeof options.redirect_url !=='undefined'){
						setTimeout(function(){
							window.location=options.redirect_url;
						}, 2000);
					}else{
						if(typeof options.reload !=='undefined' && options.reload ===true){
							location.reload();
						}
					}
				}
			},
			beforeSend:function(){
				//showSpinner(button_id, false);
				/* Remove class (form-group-red) which stands for error highlighting*/
				$($this.form_id+' .form-group').each(function(){
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

var Cookies = (function (){	
	"use strict";

    var $coo = {};
	
	$coo.checkCookie = function() {	
		var username	= $coo.getCookie('Username');
		var userid		= $coo.getCookie('UserId'); 
		var authID		= $coo.getCookie('authID'); 
		//console.log(username+' '+ userid);
		if (authID ==="" || userid ==="" || username ===""){
			//$coo.clearAllcookies();
			//location.reload();
			window.location ='SkRRMU83NVh3MFRpdURxNW4reW8zZz09.php';
		}
	};
	
	$coo.getCookie = function(cookie_name) {		
		if(cookie_name && typeof cookie_name !=='undefined'){
			var name = cookie_name + "=";
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
		}
		return "";
    };	
	$coo.deleteCookie = function (cookie_name){
		if(cookie_name && typeof cookie_name !=='undefined'){
			var d = new Date();
			d.setDate(d.getDate() - 1);
			var expires = ";expires="+d;
			var name=cookie_name;
			var value="";
			document.cookie = name + "=" + value + expires + "; path=/acc/html";
		}		
    }
	$coo.clearAllcookies = function(){
		var cookies = document.cookie.split(";");
		for (var i = 0; i < cookies.length; i++){
			var spcook =  cookies[i].split("=");
			$coo.deleteCookie(spcook[0]);
		}
	}
	return $coo;	
}());	


/* Check LOCAL cookies every 1 second */	
setInterval(Cookies.checkCookie, 1000);