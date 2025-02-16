<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['download'])) {
        $filePath = $_POST['download'];
        
        if(file_exists($filePath) && is_readable($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            ob_clean();
            flush();
            readfile($filePath);
            exit;
        } else {
            echo 'Error: File not found.';
        }
    }
}
?>
