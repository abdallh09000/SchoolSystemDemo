<?php
include "forAll/nav.php";
include "forAll/condigDataBase.php";
if(isset($_SESSION["userid"])){
    $userid=$_SESSION["userid"];
    $type=$_SESSION["type"];
    if($_SESSION["type"]=="student"){/* home page for student */
        $showData="SELECT * FROM `students`where studentid=$userid";
        $showDataUser="SELECT * FROM `user`where id=$userid and type='$type'";
        $ss = mysqli_query($conn,$showDataUser);
        $userrow=mysqli_fetch_assoc($ss);
    }else if($_SESSION["type"]=="teacher"){/* home page for teacher */
        $showData="SELECT * FROM `teacher`where id=$userid"; 
        $showDataUser="SELECT * FROM `user`where id=$userid and type='$type'";
        $ss = mysqli_query($conn,$showDataUser);
        $userrow=mysqli_fetch_assoc($ss);
    }else{/* home page for admin */
        $showDataUser="SELECT * FROM `user`where id=$userid and type='$type'";
        $ss = mysqli_query($conn,$showDataUser);
        $userrow=mysqli_fetch_assoc($ss);
    }
    if($type=="student"||$type=="teacher"){
    $s = mysqli_query($conn,$showData);
    $row=mysqli_fetch_assoc($s);
    }
}
if(isset($_POST['send'])){/*edit username and password */
    $editid=$_GET['edit'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $showDataUser="UPDATE `user` SET name='$username',password='$password' where id=$userid";
    $ss = mysqli_query($conn,$showDataUser);
    header("location: /amit/home.php");
}

?>
<h1 class="text-center text-primary my-5">HOME</h1>
<?php if(isset($_SESSION["type"])){ ?>
<?php if($_SESSION["type"]=="student"){ ?><!--home page profile for student-->
    <div class="page-content page-container" id="page-content">
    <div class="">
        <div class="row container">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="students/uploads/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?> image" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $row['name'] ?></h6>
                                <p><?php echo $_SESSION["type"] ?></p>
 
                                <a href="/amit/home.php?edit='<?php echo $_SESSION["userid"] ?>'" name="send" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>                              
                                   
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">name</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['name'] ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">level</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['level'] ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">teacherid</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['teacherid'] ?></h6>
                                    </div>
                                    </div>
                                    <form method="POST">
                                    <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">userName</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['name'] ?></h6>
                                      <?php if(isset($_GET['edit'])){?><!--start edit mode-->
                                        <input class="input-group" type="text" name="username" value="<?php echo $userrow['name'] ?>" placeholder="New username">
                                        <a href="/amit/home.php" class="mt-1 btn btn-outline-danger" href="">cancel</a>
                                      <?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">password</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['password'] ?></h6>
                                        <?php if(isset($_GET['edit'])){?><!--start edit mode-->
                                        <input class="input-group" type="text" name="password" value="<?php echo $userrow['password'] ?>" placeholder="New password">
                                        <input name="send" class="mt-1 btn btn-outline-primary" type="submit" value="confirm edit">
                                        <?php } ?>
                                    </div>
                                    </form>
                                
                                <h6 class="col-12 m-b-20 m-t-40 p-b-5 b-b-default f-w-600">teacher</h6>
                                <div class="row">
                                <?php
                                    $id=$row['teacherid'];
                                    $showData="SELECT * FROM `teacher`where id=$id"; 
                                    $s = mysqli_query($conn,$showData);
                                    $row=mysqli_fetch_assoc($s);
                                ?>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">name teacher</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['name'] ?></h6>
                                    </div>
                                    <?php
                                    $id=$row['courseid'];
                                    $showData="SELECT * FROM `courses`where courseid=$id"; 
                                    $s = mysqli_query($conn,$showData);
                                    $row=mysqli_fetch_assoc($s);
                                    ?>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">course name</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['name'] ?></h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">course description</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['description'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end-->
<?php }elseif($_SESSION["type"]=="teacher"){ ?><!--home page profile for teacher-->
    <div class="page-content page-container" id="page-content">
    <div class="">
        <div class="row container">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="teachers/uploads/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?> image" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $row['name'] ?></h6>
                                <p><?php echo $_SESSION["type"] ?></p>
 
                                <a href="/amit/home.php?edit='<?php echo $_SESSION["userid"] ?>'" name="send" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>                                     
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">name</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['name'] ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">current salary</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['salary'] ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">courseid</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['courseid'] ?></h6>
                                    </div>
                                    <form method="POST">
                                    <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">userName</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['name'] ?></h6>
                                      <?php if(isset($_GET['edit'])){?><!--start edit mode-->
                                        <input class="input-group" type="text" name="username" value="<?php echo $userrow['name'] ?>" placeholder="New username">
                                        <a href="/amit/home.php" class="mt-1 btn btn-outline-danger" href="">cancel</a>
                                      <?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">password</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['password'] ?></h6>
                                        <?php if(isset($_GET['edit'])){?><!--start edit mode-->
                                        <input class="input-group" type="text" name="password" value="<?php echo $userrow['password'] ?>" placeholder="New password">
                                        <input name="send" class="mt-1 btn btn-outline-primary" type="submit" value="confirm edit">
                                        <?php } ?>
                                    </div>
                                    </form>
                                
                                 <h6 class="col-12 m-b-20 m-t-40 p-b-5 b-b-default f-w-600">course</h6>
                                 <?php
                                    $id=$row['courseid'];
                                    $showData="SELECT * FROM `courses`where courseid=$id"; 
                                    $s = mysqli_query($conn,$showData);
                                    $row=mysqli_fetch_assoc($s);
                                    ?>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">course name</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['name'] ?></h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">course description</p>
                                        <h6 class="text-muted f-w-400"><?php echo $row['description'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end-->
<?php }else{ ?><!--home page profile for admin-->
    <div class="page-content page-container" id="page-content">
    <div class="">
        <div class="row container">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">  </div>
                                <h6 class="f-w-600"><?php echo $userrow['name'] ?></h6>
                                <p><?php echo $_SESSION["type"] ?></p>
 
                                <a href="/amit/home.php?edit='<?php echo $_SESSION["userid"] ?>'" name="send" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>                                     
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <form method="POST">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">userName</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['name'] ?></h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">password</p>
                                        <h6 class="text-muted f-w-400"><?php echo $userrow['password'] ?></h6>
                                        <?php if(isset($_GET['edit'])){?><!--start edit mode-->
                                        <input class="input-group" type="text" name="password" value="<?php echo $userrow['password'] ?>" placeholder="New password">
                                        <input name="send" class="mt-1 btn btn-outline-primary" type="submit" value="confirm edit">
                                        <a href="/amit/home.php" class="mt-1 btn btn-outline-danger" href="">cancel</a>
                                        <?php } ?>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end-->
<?php }} ?>
<?php
include "forAll/footer.php";
?>