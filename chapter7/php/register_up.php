<?php
session_start();

include 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["new_mail"];
    $pass = $_POST["new_pass"];
    $name = $_POST["new_name"];

    // パスワードのハッシュ化
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    try {
        $pdo = getDatabaseConnection();

        // 既存のユーザー情報を更新
        $stmt = $pdo->prepare("UPDATE Customer SET name_family = :name, password = :pass WHERE mail_address = :mail");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $hashed_password, PDO::PARAM_STR);
        $stmt->execute();
        
                // セッション情報を更新
                $_SESSION['customer'] = [
                    'name_family' => $name,
                    'mail' => $mail,
                    'pass' => $pass
                ];

        // 更新成功メッセージを表示
        echo "登録情報を変更しました.";
        echo '<a href="../login.php">ホームに戻る</a>';


    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
    
