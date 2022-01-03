<?php include "head.php"; ?>
     <title>API | MrSahil.in</title>
<?php include "header.php"; ?>    

<body>
     <div class="wrapper">
          <div class="logo"> <img src="apple-touch-icon.png" alt="mrsahil.in"> </div>
          <div class="text-center mt-4 name">API admin</div>
          <form class="p-3 mt-3" method="post" action="login_process.php">
               <div class="form-field d-flex align-items-center"> </span> <input type="text" name="username" id="userName" placeholder="Username"> </div>
               <div class="form-field d-flex align-items-center"> </span> <input type="password" name="password" id="pwd" placeholder="Password"> </div>
               <!-- <div class="text-danger" id="validation"></div> -->
               <?php if (isset($_GET['errorcode']) && $_GET['errorcode'] == "loginFailed") : ?>
                    <div class="text-danger" id="validation">Username or Password is Incorrect</div>
               <?php endif; ?>
               <?php if (isset($_GET['errorcode']) && $_GET['errorcode'] == "empty") : ?>
                    <div class="text-danger" id="validation">All fiels are required</div>
               <?php endif; ?>
               <input class="btn mt-3" type="submit" name="login" value="submit">
          </form>
     </div>
     <?php include("footer.php");  ?>