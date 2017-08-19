<?php
	/* Clear saved session to prevent showing success dialog */
	$error = array();
	$error['error'] = true;
	if(is_array($_FILES)) {		
		$excelfile ='';
		if(isset($_FILES['excel_file'])){
			$excelfile=$_FILES['excel_file']['tmp_name'];
		}else{
			$error['message']='ERROR: System error, excel has invalid variable index.';
		}	
		$error['excel'] =$excelfile;
		if(is_uploaded_file($excelfile)) {
			$sourcePath = $excelfile;
			$detinationFilename =$_FILES['excel_file']['name'];
			$targetPath = "../../uploads/".$detinationFilename;			
			$info = new SplFileInfo($detinationFilename);
			if($info->getExtension()!=='xlsx' and $info->getExtension()!=='xls'){		
				$error['message'] ='Invalid file  <strong class="text-brand">'.$detinationFilename.'</strong>.<br>Please provide only excel file. (<strong class="text-brand">*.xlsx/*.xls </strong>)';	
			}else{
				if(move_uploaded_file($sourcePath,$targetPath)) {
					$error['error'] = false;
					$error['file'] = $detinationFilename;
					$error['message']='Uploading excel file <strong class="text-brand">'.$detinationFilename.'</strong> was successfully completed.';
					
				}else{
					$error['message']='Uploading excel file was not success.';
				}
			}
		}else{
			$error['message']='Excel file was not uploaded.';
		}		
	}else{
		$error['message']='No excel file.';
	}
	echo json_encode($error);
?>