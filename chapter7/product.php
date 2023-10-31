<?php
    include 'php/DB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
        <?php require 'php/menu.php'; ?>
        <form method="get" action="">
            <p>商品検索<input type="text" name="search" value="">
                <button type="submit">送信</button>
            </p>
            
        </form>

    </header>

    <?php
        if(isset($_GET['search'])){
            echo '<table border="0">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>ジャンル</th>
                <th>価格</th>
            </tr>';

            $pdo = getDatabaseConnection(); 
            $search = $_GET['search'];
            $result = sql_search($pdo, $search);
            

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" .$row['id'] . "</td>";
                echo '<td><a href="detail.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
                echo "<td>" .$row['kubun'].  "</td>";
                echo "<td>" .$row['price'].  "</td>";
                echo "</tr>";
            }
            echo '</table>';
        }
    ?>
    
</body>
</html>

