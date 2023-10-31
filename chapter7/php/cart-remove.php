<?php
session_start();

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    if (isset($_SESSION["cart"][$itemId])) {
        // 指定された商品をカートから削除
        unset($_SESSION["cart"][$itemId]);

        //削除後はカートに戻る
        header("Location: ../cart.php"); 
    }
}
?>
