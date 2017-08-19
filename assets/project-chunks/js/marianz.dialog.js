var MessageDialog = (function() {
    "use strict";

    var $elem,
		$showConfirm,
        $hideHandler,
        that = {};

    that.init = function(modal_id){
		$elem = $(modal_id);
		$showConfirm = false;
	};
	
	
    that.pop = function(message,title) {
        clearTimeout($hideHandler);
		$($elem).find("#confirm_button").hide();
		if($showConfirm==true){
			$($elem).find("#confirm_button").show();
		}else{
			$($elem).find("#confirm_button").hide();
		}
		//console.log($showConfirm+'  '+message);
		
		$($elem).find("#message_title").html(title);
		$($elem).find("#message_body").html(message);		
        $($elem).modal('show');       
    };

	
    that.confirm = function(message,title) {
		$showConfirm = true;
		that.pop(message,title);
		
	};

    that.show = function(message,title) {
       $showConfirm = false;
		that.pop(message,title);    
    };

    return that;
}());

MessageDialog.init('#ui_dialog_message');
/*
MessageDialog.show('<ul class="nav">'+
					'<li>'+
						'<a class="margin-bottom-sm waves-attach" data-dismiss="modal" href="javascript:void(0)">'+
							'<div class="avatar avatar-inline margin-left-sm margin-right-sm">'+
								'<img alt="alt text for username avatar" src="images/users/avatar-001.jpg">'+
							'</div>'+
							'<span class="margin-right-sm text-black">username</span>'+
						'</a>'+
					'</li>'+
					'<li>'+
						'<a class="margin-bottom-sm waves-attach" data-dismiss="modal" href="javascript:void(0)">'+
							'<div class="avatar avatar-inline margin-left-sm margin-right-sm">'+
								'<img alt="alt text for another_account avatar" src="images/users/avatar-001.jpg">'+
							'</div>'+
							'<span class="margin-right-sm text-black">another_account</span>'+
						'</a>'+
					'</li>'+
					'<li>'+
						'<a class="margin-bottom-sm waves-attach" data-dismiss="modal" href="javascript:void(0)">'+
							'<div class="avatar avatar-inline margin-left-sm margin-right-sm">'+
								'<span class="icon icon-lg text-black">add</span>'+
							'</div>'+
							'<span class="margin-right-sm text-black">add account</span>'+
						'</a>'+
					'</li>'+
				'</ul>','Title');
				
*/