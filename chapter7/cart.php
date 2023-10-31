<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カート内の商品</title>
</head>
<body>
    <header>
        <?php require 'php/menu.php'; ?>
    </header>

    <h1>カート内の商品</h1>

    <?php
    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
        // カートに商品がある
        if (isset($_SESSION["item_added"]) && $_SESSION["item_added"] === true) {
            // 商品を追加の通知
            echo '<p>商品をカートに追加しました。</p>';
            unset($_SESSION["item_added"]); // フラグリセット
        }

        // 商品情報
        echo '<table>';
        echo '<tr><th>商品番号</th><th>商品名</th><th>ジャンル</th><th>価格</th><th>個数</th><th>小計</th><th>    </th></tr>';

        $totalPrice = 0; // 合計金額の初期値

        foreach ($_SESSION["cart"] as $key => $cartItem) {
            $quantity = $cartItem['quantity'];
            $subtotal = $cartItem['price'] * $quantity;
            $totalPrice += $subtotal; // 合計金額を計算
            echo '<tr>';
            echo '<td>' . $cartItem['id'] . '</td>';
            echo '<td><a href="detail.php?id=' . $cartItem['id'] . '">' . $cartItem['name'] . '</a></td>';
            echo '<td>' . $cartItem['category'] . '</td>';
            echo '<td>' . $cartItem['price'] . ' 円</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>' . $subtotal . ' 円</td>';
            echo '<td><a href="php/cart-remove.php?id=' . $key . '">削除</a></td>'; 
            echo '</tr>';
        }

        echo '<tr>';
        echo '<td colspan="5">合計金額</td>';
        echo '<td>' . $totalPrice . ' 円</td>';
        echo '<td></td>'; 
        echo '</tr>';
        echo '</table>';
    } else {
        echo '<p>カートは空です。</p>';
    }
    ?>
</body>
</html>
