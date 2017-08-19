	<footer class="ui-footer">
		<div class="container">
			<p>&copy; 2016 Telcomtrix <?php echo $page.' '.$ms;?></p>
		</div>
	</footer>
	
	
	
	<div class="fbtn-container">

	<?php if($page==='10'){ ?>
		<?php if($sp==='t'){ ?>
			<?php if($ms==='v'){ ?>
				<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('a');?>"><span class="fbtn-text fbtn-text-left">Add Technician</span><span class="fbtn-ori icon">add</span></a>
			<?php } elseif($ms==='a') { ?>
				<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="add_tech_button"><span class="fbtn-text fbtn-text-left">Add Technician</span><span class="fbtn-ori icon">check</span></a>
			<?php } elseif($ms==='s') { ?>
				<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="print_dispatch_button" href="<?php echo 'includes/exports/print.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&at='.encode_url($at).'&ap='.encode_url($ap).'&dt='.encode_url($pdt); ?>" target="_blank"><span class="fbtn-text fbtn-text-left">Print Dispatch</span><span class="fbtn-ori icon">print</span></a>
			<?php } elseif($ms==='p') { ?>
				<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="print_dispatch_button" href="<?php echo 'includes/exports/excel.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&at='.encode_url($at).'&ap='.encode_url($ap).'&dt='.encode_url($pdt); ?>" target="_blank"><span class="fbtn-text fbtn-text-left">Export Dispatch</span><span class="fbtn-ori icon">save</span></a>
			<?php } else { ?>
				<!-- TODO -->
			<?php } ?>
		<?php } else { ?>
            <?php if($sp==='yd'){ ?>
            <?php } else { ?>
		<div class="fbtn-inner" id="home_mainten">
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" data-toggle="dropdown"><span class="fbtn-text fbtn-text-left">Add</span><span class="fbtn-ori icon">add</span><span class="fbtn-sub icon">close</span></a>
			<div class="fbtn-dropup">
				<!--
				<a class="fbtn waves-attach waves-circle" href="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('a').'&m='.encode_url('tlr_technicians').'&c='.encode_url('firstname'); ?>"><span class="fbtn-text fbtn-text-left">Add new Technician</span><span class="icon">person</span></a>
				<a class="fbtn fbtn-orange waves-attach waves-circle" href="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('a').'&m='.encode_url('tlr_modems').'&c='.encode_url('modem_name'); ?>"><span class="fbtn-text fbtn-text-left">Add new Modem</span><span class="icon">settings_input_antenna</span></a>
				<a class="fbtn fbtn-brand waves-attach waves-circle waves-light" href="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('a').'&m='.encode_url('tlr_antennas').'&c='.encode_url('antenna_name'); ?>"><span class="fbtn-text fbtn-text-left">Add new Antenna</span><span class="icon">portable_wifi_off</span></a>
				<a class="fbtn fbtn-green waves-attach waves-circle" href="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('a').'&m='.encode_url('tlr_telephones').'&c='.encode_url('telephone_name'); ?>"><span class="fbtn-text fbtn-text-left">Add new Telephone</span><span class="icon">phone</span></a>
				<a class="fbtn fbtn-red waves-attach waves-circle" href="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('a').'&m='.encode_url('tlr_remarks').'&c='.encode_url('remarks_name'); ?>"><span class="fbtn-text fbtn-text-left">Add new Remark</span><span class="icon">book</span></a>
				-->
				<a class="fbtn fbtn-red waves-attach waves-circle" id="alert1"><span class="fbtn-text fbtn-text-left">Add new technician</span><span class="icon">person</span></a>
				
			</div>
		</div>		
		<div id="home_import">
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="import_button"><span class="fbtn-text fbtn-text-left">Import</span><span class="fbtn-ori icon">file_upload</span></a>
		</div>
            <?php } ?>
		<?php } ?>
	<?php } elseif($page==='12'){ ?>
		<?php if($ms==='a'){ ?>
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="add_dispatch_button"><span class="fbtn-text fbtn-text-left">Add New Assignment</span><span class="fbtn-ori icon">check</span></a>
		<?php } elseif($ms==='u'){ ?>
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="update_okno_button"><span class="fbtn-text fbtn-text-left">Update OK Number</span><span class="fbtn-ori icon">check</span></a>
		<?php }else{ ?>
			<!-- @TODO -->
		<?php } ?>
	<?php } elseif($page==='13'){ ?>		
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="save_settings_button"><span class="fbtn-text fbtn-text-left">Save Settings</span><span class="fbtn-ori icon">save</span></a>
	<?php } elseif($page==='14'){ ?>
			<a class="fbtn fbtn-lg fbtn-brand-accent waves-attach waves-circle waves-light" id="change_pwd_button"><span class="fbtn-text fbtn-text-left">Update Password</span><span class="fbtn-ori icon">check</span></a>
	<?php }else{ ?>
			<!-- @TODO -->
	<?php } ?>
	
	</div>
	<div aria-hidden="true" class="modal modal-va-middle fade" id="ui_dialog_message" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-xs">
			<div class="modal-content">
				<div class="modal-heading">
					<p class="modal-title"></p>
				</div>
				<div class="modal-inner">
					<p class="h5 margin-top-sm text-black-hint modal-body"></p>
				</div>
				<div class="modal-footer">
					<p class="text-right">
						<a class="btn btn-flat btn-brand waves-attach" data-dismiss="modal" id="confirm-button">Confirm</a>
						<a class="btn btn-flat btn-brand-accent waves-attach" data-dismiss="modal">Cancel</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	<!-- js -->
	<script src="assets/js/jquery-3.1.0.min.js"></script>
	
	<script src="assets/plugins/select2/js/select2.min.js"></script>
	
	<script src="assets/js/marianz.varia.js"></script>
	<script src="assets/js/marianz.avatar.min.js"></script>
	<script src="assets/js/marianz.dialog.min.js"></script>
	
	<script src="assets/js/base.js"></script>
	<script src="assets/js/project.js"></script>
	<script src="assets/plugins/jquery-confirm/jquery.confirm.js"></script>
	<script src="assets/plugins/jquery-toast/js/jquery.toast.js"></script>
	
</body>
</html>