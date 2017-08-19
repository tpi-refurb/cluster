var URL = {};
URL.upload_url	="includes/actions/upload.php";
URL.import_url	="includes/libraries/PHPExcel/Import/import.php";	
URL.checker_url	="includes/actions/checker.php?l=";	
URL.state_url	="includes/actions/state.php";
URL.mainten_url	="includes/actions/maintenance.php";
URL.updates_url	="includes/actions/updates.php";
URL.dispatch_url="includes/actions/dispatch.php";
URL.assign_url	="includes/actions/assign.php";
URL.change_date	="includes/actions/change_date.php?d=";
URL.change_pwd	="includes/actions/changepwd.php";
URL.settings	="includes/actions/settings.php";
URL.checker     ="includes/actions/checker.php?o=";
URL.generate_u	="includes/actions/generate_url.php?dt=";
Object.freeze(URL);

var UI = {};
UI.id_import_button		= '#import_button';
UI.ui_date_dispatch		= '#ui_date_dispatch';
UI.id_browse_button		= '#ui_browse_excel';
UI.id_ui_excel_file		= '#ui_excel_file';
UI.id_excel_file		= '#excel_file';
UI.id_home_import		= '#home_import';
UI.id_home_mainten		= '#home_mainten';
UI.id_ui_subsname		= '#ui_dispatch_subsname';
UI.id_ui_address		= '#ui_dispatch_address';
UI.id_ui_serviceno		= '#ui_dispatch_serviceno';
UI.id_ui_contactno		= '#ui_dispatch_contactno';
UI.id_ui_cabinetno		= '#ui_dispatch_cabinetno';
Object.freeze(UI);

var MODAL = {};
MODAL.tech	 			= '#ui_dialog_tech';
Object.freeze(MODAL);

var TITLE = {};
TITLE.import_error		= 'Import Error';
TITLE.import_success	= "Import Success";
TITLE.default_title		= 'Cluster Action';
Object.freeze(TITLE);

var MSG ={};
MSG.confirm_delete		="Are you sure you want to delete selected item?";
MSG.confirm_activate	="Are you sure you want to activate selected item?";
MSG.confirm_delete_tech ="Are you sure you want to delete selected technician pair?",
MSG.confirm_assign_to	="Are you sure you want to assign selected order# ?";
MSG.confirm_change_pwd	="Change Password?.";
MSG.invalid_extension	="Invalid file extension.";
Object.freeze(MSG);

var FORM = {};
FORM.id_add_tech		="#add_tech_form";
FORM.id_assign_tech		="#assigned_tech_form";
FORM.id_excel_file		="#excel_form";
FORM.id_new_assignment	='#new_assignment_form';
FORM.id_updates_ok		='#okno_update_form';
FORM.id_profile			='#profile_form';
FORM.id_settings		='#settings_form';
FORM.id_filter_date		='#selectdt_form';
Object.freeze(FORM);

