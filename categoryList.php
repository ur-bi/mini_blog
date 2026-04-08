<?php 

    $quary = "select * from category";
    $res = $pdo->prepare($quary);
    $res->execute();

    $categories = $res->fetchAll(PDO::FETCH_ASSOC);
