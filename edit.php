<?php 

    require_once("../../db/connection.php");
    require_once("../helper/header.php");

    $query = "select * from category where id=?";
    $res = $pdo->prepare($query);
    $res->execute([$_GET['id']]);

    $data = $res->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($data);

?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <input type="text" name="categoryName" value=" <?php echo $_POST['categoryName'] ??  '' ?> " class="form-control">
                <?php 
                    if( isset($_POST['update-btn']) ){
                        $categoryStatus = $_POST['categoryName'] == "" ? false : true;
                        echo $categoryStatus ? "" : "<small class='text-danger'>required!</small>";
                    }
                ?>
                <br>
                <input type="submit" value="update" name="update-btn" class="btn btn-secondary w-25 m-2 rounded shadow-sm">
            </form>
        </div>
    </div>
</div>

<?php

    if( isset($_POST['update-btn']) ){
        $categoryName = $_POST['categoryName'];

            if($categoryStatus){
                $categoryQuery = "update category set name=? where id=?";
                $categoryRes = $pdo->prepare($categoryQuery);
                $categoryRes->execute([$categoryName, $_GET['id']]);

                header("Location: create.php");
            }
    }

    require_once("../helper/footer.php");

 ?>