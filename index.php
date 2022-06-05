<?php
include "forAll/condigDataBase.php";
include "forAll/nav.php";
if(isset($_GET['logout'])){
  session_destroy();
  header("location: /amit/index.php");
}
if(!isset($_SESSION['Validity'])){
/* cheack password and username */
if(isset($_POST['login'])){
  $name=$_POST['name'];
  $password = $_POST['password'];
  $showData="SELECT * FROM `user` where name ='$name' and password='$password' ";
  $s = mysqli_query($conn,$showData);
  $numrows= mysqli_num_rows($s);
  $row = mysqli_fetch_assoc($s);
  if($numrows > 0){
    /* make SESSION for authorization */
    $_SESSION["Validity"] = $row['Validity'];
    $_SESSION["userid"] = $row['id'];
    $_SESSION["type"] = $row['type'];
    header("location: /amit/home.php");
  }else{echo "<div class='alert alert-info text-center'>username or password wrong</div>";}
}
?>
<div class="container p-5 border my-5 bg-dark ">
<h1 class="text-center text-primary my-3">login</h1>
<form  method="POST">
  <div class="form-group">
    <label class="text-center" for="exampleInputEmail1">Username</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label class="text-center" for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button  type="submit" name="login" class="btn btn-primary">login</button>
  <a  href="/amit/students/add.php" class="btn btn-link">register now</a>
</form>
</div>








<?php
}else if (isset($_SESSION['Validity'])){/* cheack if there is login user befor or not */
  header("location: /amit/home.php");
}
include "forAll/footer.php";
?>