<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
</head>
<body>
    <?php require 'php/menu.php' ;?>

    <div id="center" style="text-align:center">
        <?php


        if (!empty($_SESSION["user_mail"])) {
            echo '<h2>ログアウトしますか？</h2>';
            echo '<form action="php/logout.php" method="post">';
            echo '<input type="submit" value="ログアウト">';
            echo '</form>';
        } else {
            echo "<h2>現在はログインされていません</h2>";
        }
        ?>
    </div>
</body>
</html>
