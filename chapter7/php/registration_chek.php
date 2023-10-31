<?php 
if (empty($_SESSION["user_mail"])) {
    // ログインしてない
    echo '<div id="center" style="text-align:center">
        <h2>新規登録</h2>
        <!-- 新規登録フォームを作成 -->
        <form action="php/register.php" method="post">
            <label for="new_id">メールアドレス:</label>
            <input type="text" id="new_mail" name="new_mail" required><br>

            <label for="new_name">名前(性)</label>
            <input type="text" id="new_name" name="new_name" required><br>

            <label for="new_password">新しいパスワード:</label>
            <input type="password" id="new_pass" name="new_pass" required><br>

            <input type="submit" value="新規登録">
        </form>';
} else {
    // ログインしてる
    $name_family = $_SESSION['customer']['name_family'];
    $mail_address = $_SESSION['customer']['mail'];
    $password = $_SESSION['customer']['pass'];

    echo '<div id="center" style="text-align:center">
        <h2>新規登録</h2>
        <!-- 新規登録フォームを作成 -->
        <form action="php/register_up.php" method="post">
            <label for="new_id">メールアドレス:</label>
            <input type="text" id="new_mail" name="new_mail" value="' . $mail_address . '" required><br>

            <label for="new_name">名前(性)</label>
            <input type="text" id="new_name" name="new_name" value="' . $name_family . '" required><br>

            <label for="new_password">新しいパスワード:</label>
            <input type="password" id="new_pass" name="new_pass" value="' . $password . '" required><br>

            <input type="submit" value="新規登録">
        </form>';
}
?>
