<?php
include "../forAll/nav.php";
include "../forAll/condigDataBase.php";

    $showData="SELECT * FROM `courses`";/* get all courses data to list */
    $s = mysqli_query($conn,$showData);


if(isset($_GET['delete'])){/*delete section */
    $delete=$_GET['delete'];
    $showData="DELETE FROM `courses` where courseid = $delete ";
    $ss = mysqli_query($conn,$showData);
    testmessage($ss,"record deleted");
    header("location: /amit/courses/list.php");
}
?>


<h1 class="text-center text-primary my-3">list courses</h1>

<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Cost</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($s as $data){ ?>
            <tr>
                <th scope="row"><?php echo $data['courseid'] ?></th>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['cost'] ?></td>
                <td><?php echo $data['description'] ?></td>
                <?php if(isset($_SESSION['Validity'])){ ?>
                    <?php if($_SESSION['Validity']=="full"){ ?>
                <td><a onclick="return confirm('are you want to delete thise record')" href="/amit/courses/list.php?delete='<?php echo $data['courseid'] ?>'" class="mr-2 btn btn-danger">Delete</a><a href="/amit/courses/add.php?Edit='<?php echo $data['courseid'] ?>'" class="btn btn-info">Edit</a></td>
                <?php }else{ ?>
                <td><button disabled class="mr-2 btn btn-danger">Delete</button><button disabled class="btn btn-info">Edit</button></td>
                <?php }} ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include "../forAll/footer.php";
?>