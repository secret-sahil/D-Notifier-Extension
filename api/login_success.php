<?php
//login_success.php  
//include connection file 
require_once('db.php');
session_start();
if (!isset($_SESSION["username"])) {
     header("location:login.php");
}
?>


<?php
if (isset($_GET['delpost'])) {

     $stmt = $db->prepare('DELETE FROM api_data WHERE id = :id');
     $stmt->execute(array(':id' => $_GET['delpost']));
     header('Location: login_success.php');
     exit;
}
?>

<?php include("head.php");  ?>

<title>NOTIFIER API ADMIN</title>
<script language="JavaScript" type="text/javascript">
     function delpost(id) {
          if (confirm("Are you sure you want to delete")) {
               window.location.href = 'login_success.php?delpost='+id;
          }
     }
</script>
<?php include("header.php");  ?>

<div class="content">
     <?php
     //show message from add / edit page
     if (isset($_GET['action'])) {
          echo '<h3>Post ' . $_GET['action'] . '.</h3>';
     }
     ?>

     <table>
          <tr>
               <th>ID</th>
               <th>Date of post</th>
               <th>Notification Data</th>
               <th>Image</th>
               <th>Published By</th>
               <?php if ($_SESSION['username'] == "admin") { ?>
                    <th>Delete</th>
               <?php } ?>
          </tr>
          <?php
          echo "<center><h1>Welcome " . $_SESSION["username"] . "!</h1></center>";
          ?>
          <center><a href="logout.php" class="logout">Logout</a></center>
          <br>
          <?php
          try {

               $stmt = $db->query('SELECT * FROM api_data ORDER BY id DESC');
               while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . date('jS M Y', strtotime($row['date'])) . '</td>';
                    echo '<td>' . $row['data'] . '</td>';
                    echo '<td>'.'<img src="'.$row['image'].'">'.'</td>';
                    echo '<td>' . $row['username'] . '</td>';
          ?>
                    <?php if ($_SESSION['username'] == "admin") { ?>
                         <td>
                              <button class="delbtn"> <a href="javascript:delpost('<?php echo $row['id']; ?>')">Delete </a> </button>
                         </td>
                    <?php } ?>
          <?php
                    echo '</tr>';
               }
          } catch (PDOException $e) {
               echo $e->getMessage();
          }
          ?>
     </table>
     <br>
     <p> <button class="addbtn"><a href='addnotification.php'>Add New Notification</a></button></p>
     </p>
</div>

<?php include("footer.php");  ?>