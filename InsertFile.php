<html>
<head>
    <link rel = "stylesheet" href='usb.css'>
</head>

<body>
    <nav class='nav'>
            <a class='navbar' href='index.php'>Home</a>
            <a class='navbar' href='UsbReading.php'>Open Usb</a>
            <div class="nav"></div>
    </nav>
    <br>
    <div class='itemBox'style='align-items:center;width:30%;display: flex;'><br><br>
        <form action='TestFileInsert.php' method='POST' enctype="multipart/form-data"style='margin-left:50px'>
            <input class="fileForm" type="file" name="userFile" id="userFile" ><br><br><br>
            <input class='downloadButton' type='submit' name='submit' value="Upload"style='width:100%;'>
        </form>
    </div>
</body>

</html>