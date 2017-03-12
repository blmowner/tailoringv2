<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php 
	  $file = 'downloads/seluar.docx';
	  header('Content-Description: File Transfer');
	  header("Content-Type: application/vnd.openxmlformats");
	  header('Content-Disposition: attachment; filename='.  basename($file));
	  header('Expires: 0');
	  header('Cache-Control: must-revalidate');
	  header('Pragma: public');
	  header('Content-Length: ' . filesize($file));
	  readfile($file);
      exit;
   ?>
  
</head>
</html>
