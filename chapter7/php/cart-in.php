<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 商品情報
    $itemID = $_POST["item_id"];
    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $itemPrice = $_POST["item_price"];
    $quantity = $_POST["quantity"];

    // カートがない時の新カート作成
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    // 商品情報をカートに追加
    $cartItem = array(
        "id" => $itemID,
        "name" => $itemName,
        "category" => $itemCategory,
        "price" => $itemPrice,
        "quantity" => $quantity
    );

    // カート追加部分
    $_SESSION["cart"][] = $cartItem;

    // 商品追加フラグ
    $_SESSION["item_added"] = true; 

    // 商品詳細
    header("Location: ../detail.php?id=$itemID");
}
?>
