<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
</head>
<body>
    <?php require 'php/menu.php' ;?>

    <div id="center" style="text-align:center">
        <?php
        if (empty($_SESSION["user_mail"])) {
            echo '<h2>ログイン</h2>';
            echo '<form action="php/login.php" method="post">';
            echo '<label for="id">メールアドレス：</label>';
            echo '<input type="text" id="mail" name="mail" required><br>';
            echo '<label for="password">パスワード:</label>';
            echo '<input type="password" id="password" name="pass" required><br>';
            echo '<input type="submit" value="ログイン">';
            echo '</form>';
            echo '<p>新規登録はまだですか？ <a href="registration.php">こちら</a></p>';
        } else {
            echo 'こんにちは' . $_SESSION['customer']['name_family'] . "様";
        }
        ?>
    </div>
</body>
</html>
