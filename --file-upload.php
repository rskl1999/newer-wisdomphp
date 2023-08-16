<?php
require_once('connection.php');

if (isset($_POST['submit'])) {
    // Count total files
// Get total files count
$countFiles = count($_FILES['file']['name']);
    
// Loop through all files
for ($i = 0; $i < $countFiles; $i++) {
    // Get the file name and type
    $filename = $_FILES['file']['name'][$i];
    $filetype = $_FILES['file']['type'][$i];

    // Upload file if it's a PDF or MP4
    if ($filetype == 'application/pdf' || $filetype == 'video/mp4') {
        if (move_uploaded_file($_FILES['file']['tmp_name'][$i], 'uploads/'.$filename)) {
            echo $filename.' uploaded successfully.<br>';

            // Insert file name into database
            $sql = "UPDATE uploadfiletbl SET documentType = '$filename' WHERE studentID = 1";
            if ($con->query($sql) === TRUE) {
                echo "File name added to database.<br>";
            } else {
                echo "Error adding file name to database: " . $con->error."<br>";
            }
        } else {
            echo 'Error uploading '.$filename.'<br>';
        }
    } else {
        echo 'Invalid file type for '.$filename.'<br>';
    }
}
} else {
echo 'No files submitted.<br>';
}
$con->close();
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file[]" multiple>
    <button type="submit" name="submit">Upload</button>
</form>
