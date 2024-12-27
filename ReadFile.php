<html>
<head>
    <link rel = "stylesheet" href='usb.css'>
</head>

<body>
<nav class='nav'>
        <a class='navbar' href='index.php'>Home</a>
        <a class='navbar' href='InsertFile.php'>Insert File</a>
        <a class='navbar' href='UsbReading.php'>Open Usb</a>
        <div class="nav"></div>
</nav>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['read'])){
        $filePath = $_POST['read']; // The path to the file on the server's USB drive.
        
        echo "<h1>Reading File From: $filePath </h1>";
        echo "<div style='text-align:center;>";
        // Check if file exists and is readable
        if(isset($_POST['imgdata']) && file_exists($filePath) && is_readable($filePath)){
            echo "<p style='display:none'></p>"; //for some reason the image only loads after running this echo statement
            $imageData = base64_encode(file_get_contents($filePath));
            echo '<img src="data:image/'.$_POST['imgdata'].';base64,' . $imageData . '">';
        }
        else if(isset($_POST['vdodata'])&&file_exists($filePath)&& is_readable($filePath)){
            echo "<p style='display:none'></p>";
            echo"
                <video width='320' height='240' controls autoplay>
                <source src='".$filePath."' type='video/".$_POST['vdodata']."'>
                Your browser does not support the video tag.
            </video>
            ";
            exit;
        }
        else if(isset($_POST['audiodata'])&&file_exists($filePath)&& is_readable($filePath)){
            echo "<p style='display:none'></p>";
            echo"
                <audio controls>
                <source src='".$filePath."' type='audio/mpeg'>
            </video>
            ";
            exit;
        }
        else if(file_exists($filePath) && is_readable($filePath)){
            $output = file_get_contents($filePath);
            echo "<p style='color:white'>$output</p>";
            exit;
        } 
        else{
            echo 'Error: File not found.';
        }
        echo "</div>";
    }
}
?>

</body>
</html>