
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

function JoinFilePath($fileName, $usbDrivePath){
    return $usbDrivePath . $fileName;
}
function UploadFile($fileName,$joinedPath){
    if(move_uploaded_file($fileName, $joinedPath)){
        echo 'File uploaded successfully!';
    }
    else{
        echo 'Error uploading the file.';
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['submit'])){
        $file = $_FILES['userFile']['name'];
        
        $path = JoinFilePath($file,$_SESSION['usbDrivePath']);
        echo $path;
        echo $_FILES['userFile']['error'];
        UploadFile($_FILES['userFile']['tmp_name'],$path);
    }
}
?>
<script>
    setTimeout(function() {window.location.href = 'UsbReading.php';}, 3000);
</script>
<html>
<head>
    <link rel = "stylesheet" href='usb.css'>
</html>