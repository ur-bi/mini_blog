<?php 

    require_once("../../db/connection.php");
    require_once("../helper/header.php");
    require_once("../product/source/categoryList.php");

?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">

                <div class="d-flex justify-content-end">
                    <a href="./list.php" class="m-3 btn bg-dark text-white rounded shadow-sm">Product List</a>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="my-2 d-flex justify-content-center">
                        <img src="" id="output" class="w-50">
                    </div>
                    <input type="file" name="image" class="form-control w-100 my-2" onchange="loadFile(event)">
                    <?php 
                        if( isset($_POST['create-btn']) ){
                            $imageStatus = $_FILES['image']['name'] == "" ? false : true;
                            echo $imageStatus ? "" : "<small class='text-danger'>Image is required!</small>";
                        }
                    ?>
                    <input type="text" name="productName" value="<?php echo $_POST['productName']??""; ?>" class="form-control w-100 my-2" placeholder="Enter Product Name...">
                    <?php 
                        if( isset($_POST['create-btn']) ){
                            $productStatus = $_POST['productName'] == "" ? false : true;
                            echo $productStatus ? "" : "<small class='text-danger'>Product name is required!</small>";
                        }
                    ?>
                    <input type="text" name="price" value="<?php echo $_POST['price']??""; ?>" class="form-control w-100 my-2" placeholder="Enter Product Price...">
                    <?php 
                        if( isset($_POST['create-btn']) ){
                            $priceStatus = $_POST['price'] == "" ? false : true;
                            echo $priceStatus ? "" : "<small class='text-danger'>Price Number is required!</small>";
                        }
                    ?>
                    <textarea name="description" rows="10" cols="10" class="form-control w-100 my-2" placeholder="Enter Product Description..."><?php echo $_POST['description'] ?? ""; ?></textarea>
                    <?php 
                        if( isset($_POST['create-btn']) ){
                            $descriptionStatus = $_POST['description'] == "" ? false : true;
                            echo $descriptionStatus ? "" : "<small class='text-danger'>Description is required!</small>";
                        }
                    ?>
                    <select name="categoryId" class="form-select" >
                        <option value="">Choose Category Name.</option>
                        <?php 
                            foreach( $categories as $item ){
                                //$item['id'];
                                // 1 2 3 4 -> 3
                                // $categoryName = $item['name'];
                                // $categoryId = $item['id'];
                                // echo "<option value='$categoryId'>$categoryName</option>";

                                echo '<option value="'.$item['id'].'" '.( isset($_POST["categoryId"]) && $_POST["categoryId"] == $item["id"] ? "selected" : "").' >'.$item['name'].'</option>';
                            }
                        ?>
                    </select>
                    <?php 
                        if( isset($_POST['create-btn']) ){
                            $categoryStatus = $_POST['categoryId'] == "" ? false : true;
                            echo $categoryStatus ? "" : "<small class='text-danger'>required!</small>";
                        }
                    ?>
                    <input type="submit" name="create-btn" value="Create" class="my-2 btn btn-primary w-100">
                </form>

                <?php 
                    if ( isset($_REQUEST['create-btn']) ){
                        echo "<pre>";

                        print_r($_REQUEST);
                        print_r($_FILES['image']['name']);

                        if($imageStatus && $productStatus && $priceStatus && $descriptionStatus && $categoryStatus){

                            $imageName = $_FILES['image']['name'];
                            $tmpName = $_FILES['image']['tmp_name'];

                            $targetFile = "../../images/" . $imageName;

                            move_uploaded_file($tmpName , $targetFile);

                            $productQuery = "insert into product (name, price, image, description, category_id) values(?,?,?,?,?)";
                            $productRes = $pdo->prepare($productQuery);
                            $productRes->execute([$_REQUEST['productName'], $_REQUEST['price'], $imageName, $_REQUEST['description'], $_REQUEST['categoryId']]);

                            header("Location:create.php");
                        }
                    }
                ?>

            </div>
        </div>
    </div>

<?php 
    require_once("../helper/footer.php");
?>