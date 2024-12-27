<?php session_start();?>
<html>
<head>
    <link rel = "stylesheet" href='usb.css'>
</head>

<body>
<nav class='nav'>
        <a class='navbar' href='index.php'>Home</a>
        <a class='navbar' href='InsertFile.php'>Upload File</a>
        <div class="nav"></div>
</nav>
<br>
<?php
//$usbDrivePath = 'D:/'; // windows mount path
$usbDrivePath = '/mnt/usbdrive/'; //linux mount path (the usb must be manually mounted to this directory)
$_SESSION['usbDrivePath'] = $usbDrivePath;

function GetWidthFromIndex($folderIndex){
    if($folderIndex > 0){
        return 95;
    }
    else{
        return 40;
    }
}

//due to small differences between how each file is represented, the similar emitted html cannot be placed into separate functions
function GenerateTextButtonCommand($fullPath,$file,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file </p><img src='images/text.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}
function GenerateCodeButtonCommand($fullPath,$file,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file </p><img src='images/code.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}
function GenerateDataButtonCommand($fullPath,$file,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file </p><img src='images/data.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}
function GenerateImageButtonCommand($fullPath,$file,$imageData,$extension,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file</p><img src='images/image.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <input name='imgdata' value='$extension' style='display:none;'></input>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}

//embedded videos may be blocked in some browsers due to file permissions
function GenerateVideoButtonCommand($fullPath,$file,$extension,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file</p><img src='images/video.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <input name='vdodata' value='$extension' style='display:none;'></input>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}

//embedded audio may be block for similar reasons to the video
function GenerateAudioButtonCommand($fullPath,$file,$extension,$folderIndex){
    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='width:".$width."%'>
            <form action='DownloadFile.php' method='POST'>
                <p style='float:left'class='itemBoxText'>$file</p><img src='images/audio.png' style='float:left;max-width:30px;margin-top:5px;'>
                <button style='float:right;margin-right:10px'class='downloadButton' type='submit' name='download' value='$fullPath'>Download</button>
            </form>
            <form action='ReadFile.php' method='POST'>
                <input name='audiodata' value='$extension' style='display:none;'></input>
                <button style='float:right;margin-right:10px;margin-top:-17'id='$file'class = 'readButton' type='submit' name='read' value='$fullPath'>Read File</button>
            </form>
        </div><br><br>
        ";
}
function GenerateFolderButton($fullPath,$folderIndex){
    $fullPath = $fullPath . '/';
    $folderCols = ['#FED840','#FE9540','#FE5440'];
    $id = max(0, min(count($folderCols)-1,$folderIndex));
    $idCol = $folderCols[$id];

    $width = GetWidthFromIndex($folderIndex);
    echo"<div class='itemBox'style='background-color:".$idCol."; width:".$width."%'>
            <p style='float:centre'class='itemBoxText'>$fullPath</p>
            <br><br>
        ";
    ReadPath($fullPath,$folderIndex);

    echo "</div><br><br>";
}


function CheckExtension($extension, $filePath,$file,$folderIndex){
    //how an extension is handled is based on the array, to support more file types they must be included here
    $imageExtensions = array('png','jpeg','gif','img');
    $codeExtensions = array('css','php','js','java','sh','cs','cpp','h','py','ipynb','lua','pl','sql','ts','go');
    $dataExtensions = array('xml','json','csv','dat','db','xlsx','mdb','sav','accdb');
    $textExtensions = array('txt','docx');
    $folderExtensions = array('fold','folder');
    $videoExtensions = array('mp4');
    $audioExtensions = array('mp3','wav');

    if(in_array($extension,$folderExtensions)){
        GenerateFolderButton($filePath,$folderIndex);

    }
    else if(in_array($extension,$imageExtensions)){
        $imageData = base64_encode(file_get_contents($filePath));
        GenerateImageButtonCommand($filePath,$file,$imageData,$extension,$folderIndex);
    }
    else if(in_array($extension,$textExtensions)){
        GenerateTextButtonCommand($filePath,$file,$folderIndex);
    }
    else if(in_array($extension,$videoExtensions)){
        GenerateVideoButtonCommand($filePath,$file,$extension,$folderIndex);
    }
    else if(in_array($extension,$audioExtensions)){
        GenerateAudioButtonCommand($filePath,$file,$extension,$folderIndex);
    }
    else if(in_array($extension,$codeExtensions)){
        GenerateCodeButtonCommand($filePath,$file,$folderIndex);
    }
    else if(in_array($extension,$dataExtensions)){
        GenerateDataButtonCommand($filePath,$file,$folderIndex);
    }
    
    else{
        echo "<br><div class='errorBar'>no applicable extensions for $file</div> <br>";
    }
}

function ReadPath($path,$folderIndex){
    $folderIndex += 1;
    if(!is_readable($path)){return;}
    
    $files = scandir($path);

    foreach($files as $file){
        // Skip the current and parent directory entries
        if($file !== "." && $file !== ".."){
            $fullPath = $path . $file;
            $fileInfo = pathinfo($fullPath);
            if (isset($fileInfo['extension'])) {
                $fileExtension = $fileInfo['extension'];
                CheckExtension($fileExtension,$fullPath,$file,$folderIndex);
            }
        }
    }
}

ReadPath($usbDrivePath,-1);

?>

</body>
</html>
