<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";

if(isset($_POST['send'])){/* INSERT in database courses table */
    $name=$_POST['name'];
    $cost=$_POST['cost'];
    $description=$_POST['description'];
    $insert="INSERT INTO `courses` VALUES (NULL,'$name',$cost,'$description')";
    $i = mysqli_query($conn,$insert);
    testmessage($i,"record added");
}


$name="";
$cost="";
$description="";
$editmode=false;
if(isset($_GET['Edit'])){/*edit mode in add.php file  */
    $id=$_GET['Edit'];
    $show="SELECT * FROM `courses` where courseid=$id";
    $s = mysqli_query($conn,$show);
    $row=mysqli_fetch_assoc($s);
    $name=$row['name'];
    $cost=$row['cost'];
    $description=$row['description'];
    $editmode=true;
    if(isset($_POST['sendEdit'])){
        $name=$_POST['name'];
        $cost=$_POST['cost'];
        $description=$_POST['description'];
        $update="UPDATE `courses` SET name='$name', cost=$cost, description='$description' WHERE courseid=$id";
        $u = mysqli_query($conn,$update);
        testmessage($u,"record modified");
        header("location: /amit/courses/list.php");
    }
}


?>
<?php if(isset($_SESSION['Validity'])){ ?>
    <?php if($_SESSION['Validity']=="full"){ ?>
<?php if($editmode){ ?>
    <h1 class="text-center text-primary \">Edit courses</h1>
<?php }else{ ?>
    <h1 class="text-center text-primary \">Add courses</h1>
<?php } ?>



<div class="container bg-dark p-5 text-center my-5">
    <form method="POST">
        <div class="form-group">
            <label for="namet">name</label>
            <input type="text" value="<?php echo $name ?>" name="name" class="form-control" id="namet"
                placeholder="courses name">
        </div>
        <div class="form-group">
            <label for="costt">cost</label>
            <input type="text" value="<?php echo $cost ?>" name="cost" class="form-control" id="costt"
                placeholder="cost">
        </div>
        <div class="form-group">
            <label for="descriptiont">description</label>
            <textarea name="description" class="w-100" id="descriptiont" cols="30"
                rows="10"><?php echo $description ?></textarea>
        </div>
        <div class="form-group">
            <?php if($editmode){ ?>
                <button name="sendEdit" class="btn btn-info w-50 mx-auto">Edit Courses</button>
            <?php }else{ ?>
                <button name="send" class="btn btn-primary w-50 mx-auto">Add Courses</button>
            <?php } ?>
        </div>
    </form>
</div>
<?php }} ?>

<?php
include "../forAll/footer.php";
?>