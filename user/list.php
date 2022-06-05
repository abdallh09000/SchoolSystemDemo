<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";

    $showData="SELECT * FROM `user`";/* get all user data to list */
    $s = mysqli_query($conn,$showData);


if(isset($_GET['delete'])){/*delete section */
    $delete=$_GET['delete'];
    $type =$_GET['type'];
    $id=$_GET['id'];
    $deleteData="DELETE FROM `user` where userid = $delete ";
    $ss = mysqli_query($conn,$deleteData);
    if($type=="'teacher'"){
    $deleteDatas="DELETE FROM `teacher` where id = $id ";
    $sss = mysqli_query($conn,$deleteDatas);
    }else{
    $deleteDatas="DELETE FROM `students` where studentid = $id ";
    $sss = mysqli_query($conn,$deleteDatas);
    }
    testmessage($ss,"record deleted");
    header("location: /amit/user/list.php");
}
if(isset($_POST['send'])){
    $id=$_GET['Edit'];
    $select = $_POST['select'];
    $update="UPDATE `user` SET Validity='$select' WHERE userid=$id";
    $u = mysqli_query($conn,$update);
    testmessage($u,"modified mode");
    header("location: /amit/user/list.php");
}
?>
<?php if(isset($_SESSION['Validity'])): ?>
<?php if($_SESSION['Validity']=="full"): ?>

    <h1 class="text-center text-primary my-3">list studebts</h1>

<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">type</th>
                <th scope="col">Validity</th>
                <th scope="col">Password</th>
                <th scope="col">userid</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($s as $data){ ?>
            <tr>
                <th scope="row"><?php echo $data['userid'] ?></th>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['type'] ?></td>
                <td><?php echo $data['Validity'] ?></td>
                <td><?php echo $data['password'] ?></td>
                <td><?php echo $data['id'] ?></td>
                <?php if($data['type']!="admin"): ?>
                    <?php if(!isset($_GET['Edit'])): ?>
                <td><a onclick="return confirm('are you want to delete thise record the user will delete in all database')"
                        href="/amit/user/list.php?delete='<?php echo $data['userid'] ?>'&type='<?php echo $data['type'] ?>'&id='<?php echo $data['id'] ?>'"
                        class="mr-2 btn btn-danger">Delete</a>
                        <a
                        href="/amit/user/list.php?Edit='<?php echo $data['userid'] ?>'"
                        class="btn btn-info">Edit</a></td>
                <?php endif; ?>
                <?php endif; ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(isset($_GET['Edit'])): ?>
        <form method="POST">
        <button name="send" class="btn btn-info w-50 mx-auto">Add student</button>
        <select name="select" class="mt-3 w-75 btn btn-outline-primary form-select form-select-lg mb-3" aria-label=".form-select-lg example" >
                      <option value="full" >full</option>
                      <option value="tlist">tlist</option>
                      <option value="slist">slist</option>
        </select>
        <a href="/amit/user/list.php" class="btn btn-outline-danger w-25 mx-auto">cancel</a>
        </form>
    <?php endif; ?>
</div>

    <?php else: ?><!-- authorized validation -->
    <h1 class="text-center text-primary my-3">not authorized</h1>
<?php endif; ?>
<?php endif; ?>



<?php
include "../forAll/footer.php";
?>