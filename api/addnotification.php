<?php
//include connection file 
require_once('db.php');
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}
// error_reporting(0);
?>

<?php include("head.php");  ?>
<!-- On page head area-->
<title>Add New Notification</title>
<?php include("header.php");

?>

<div class="content">
    <?php
    echo "<center><h1>Welcome " . $_SESSION["username"] . "!</h1></center>";
    ?>
    <center><a href="logout.php" class="logout">Logout</a></center>
    <br>
    <h1>Add New Notification</h1>

    <?php

    //if form has been submitted process it
    if (isset($_POST['submit'])) {

        $targetDir = "images/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $error[] = "Please select a file to upload. Only JPG, JPEG, PNG, GIF files are allowed to upload.";
                }
            }
        }
        extract($_POST);
        $author = $_SESSION["username"];

        if ($Descrip == '') {
            $error[] = 'Please enter the description.';
        }

        if ($fileName==''){
            $error[] = "Please select a file to upload. Only JPG, JPEG, PNG, GIF files are allowed to upload.";
        }
        if (!isset($error)) {

            try {
                //insert into database
                $stmt = $db->prepare('INSERT INTO api_data (image,data,username,date) VALUES ( :featuredImg,:Descrip, :author,:date)');




                $stmt->execute(array(
                    ':Descrip' => $Descrip,
                    ':date' => date('Y-m-d H:i:s'),
                    ':featuredImg' => 'https://mrsahil.in/api/images/'.$fileName,
                    ':author' => $author,
                ));

                //redirect to index page
                header('Location: login_success.php');
                exit;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<p class="message">' . $error . '</p>';
        }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <h3><label>Upload featured image</label><br>
            <h3><label class="custom-file-upload">
                    <input type="file" name="file">Upload</h3></label>

            <h3><label>Short Description</label><br>
                <textarea name="Descrip" style="width:100%;" cols="120" rows="6"><?php if (isset($error)) {
                                                                                        echo $_POST['Descrip'];
                                                                                    } ?></textarea>
            </h3>

            <button name="submit" class="editbtn">Submit</button>


    </form>



</div>

<?php include("footer.php");  ?>