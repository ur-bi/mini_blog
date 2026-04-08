<?php
    require_once("../../db/connection.php");

    if (!isset($_GET['id'])) {
        echo "Invalid ID";
        exit();
    }

    $productId = $_GET['id'];

    $query = "select image from product where id=?";
    $res = $pdo->prepare($query);
    $res->execute([$productId]);

    $data = $res->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "No product found";
        exit();
    }

    $imageName = $data['image'];
    echo $imageName;

    $deleteQuery = "delete from product where id=?";
    $Res = $pdo->prepare($deleteQuery);
    $Res->execute([$productId]);

    unLink("../../images/$imageName");

    header("Location:list.php");

?>

