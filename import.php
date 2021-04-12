<?php 

 include('./config/DbFunction.php');
 include('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
if(isset($_POST) && $_FILES['file']['size'] != 0 && $_FILES['file']['error'] == 0 ){
	

	$allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

     if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);
        $sheetData = $spreadSheet->getActiveSheet()->toArray(null, true, true, true);
        //echo "<pre>";
        //print_r($sheetData);die;
        $correct_header=['Rank','Keyword','product id','product name','price','registered date','Store name','product link','store link','image link'];
        $result=array_intersect($sheetData[1],$correct_header);
        $obj=new DbFunction();
		$insertId = $obj->import($sheetData);
        if (! empty($insertId)) {
            $type = "success";
            $message = "Excel Data Imported into the Database";
            header("Location: index.php?type=".$type."&msg=".$message);
        } else { 
            $type = "error";
            $message = "Problem in Importing Excel Data";
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
	
}else{
  header("Location: index.php?type=error&msg=Please upload the file.");
}
	

?>
