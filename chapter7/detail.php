<?php
session_start();
include 'php/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
</head>
<body>
    <header>
        <?php require 'php/menu.php'; ?>
    </header>

    <?php
    if (isset($_GET['id'])) {
        $pdo = getDatabaseConnection();
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM item WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch();

        if ($item) {
            echo '<form action="php/cart-in.php" method="post">';
            echo '<img src="img/test.jpeg" alt="商品画像" width="200px" height="200px">';
            echo '<p>商品番号: ' . $item['id'] . '</p>';
            echo '<p>商品名: ' . $item['name'] . '</p>';
            echo '<p>ジャンル: ' . $item['kubun'] . '</p>';
            echo '<p>価格: ' . $item['price'] . ' 円</p>';
            echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
            echo '<input type="hidden" name="item_name" value="' . $item['name'] . '">';
            echo '<input type="hidden" name="item_category" value="' . $item['kubun'] . '">';
            echo '<input type="hidden" name="item_price" value="' . $item['price'] . '">';
            echo '<label for="quantity">個数:</label>';
            echo '<select name="quantity" id="quantity">';
            
            // 1からNの数量を選択肢として表示
            for ($i = 1; $i <= 5; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            
            echo '</select><br>';
            echo '<input type="submit" value="カートに商品を追加">';
            echo '</form>';
        } else {
            echo '商品が見つかりませんでした。';
        }
    }
    ?>
</body>
</html>
