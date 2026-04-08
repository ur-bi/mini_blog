<?php 

require_once("../../db/connection.php");
require_once("../helper/header.php");

$productQuery = "
                    select product.id,product.name as product_name, product.price, product.description, product.image, product.category_id, category.name as category_name
                    from product
                    left join category
                    on product.category_id = category.id
                    order by product.created_at desc
                ";
$res = $pdo->prepare($productQuery);
$res->execute();

$products = $res->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($products);

?>

    <div class="container">
        <div class="row">
            <div class="col-11">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="col-3">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($products as $item){
                                $image = $item['image'];
                                $name = $item['product_name'];
                                $price = $item['price'];
                                $description = $item['description'];
                                $category_id = $item['category_name'];
                                echo "<tr>
                                        <td scope='col'><img class='w-50' src='../../images/'.$image ></td>
                                        <td scope='col'>$name</td>
                                        <td scope='col'>$price</td>
                                        <td scope='col'>$description</td>
                                        <td scope='col'>$category_id</td>
                                        <td scope='col'>
                                            <a href='update.php?id=".$item['id']."' class='btn btn-sm rounded btn-secondary'><i class='fa-solid fa-pen-to-square'></i></a>
                                            <a href='delete.php?id=".$item['id']."' class='btn btn-sm rounded btn-danger'><i class='fa-solid fa-trash'></i></a>
                                        </td>
                                    </tr>"  ;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php 
require_once("../helper/footer.php");
?> 