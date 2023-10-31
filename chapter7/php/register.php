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

        // 既存のユーザー情報を検索
        $stmt = $pdo->prepare("SELECT * FROM Customer WHERE mail_address = :mail");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $existingUser = $stmt->fetch();

        if (!$existingUser) {
            // ユーザーが存在しない場合のみ新規登録
            $stmt = $pdo->prepare("INSERT INTO Customer (name_family_kana, name_personal_kana, name_family, name_personal, post_code, prefectures, city_address, street_address, building, tel, mail_address, password)
                            VALUES ('カナ姓', 'カナ名', :name, '名', 1234567, '都道府県', '市区町村', '番地', '建物名', 1234567890, :mail, :pass)");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $hashed_password, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['customer'] = [
                'name_family' => $name,
                'mail' => $mail,
                'pass' => $pass
            ];

            // 登録成功メッセージを表示
            echo "登録完了しました。";
            echo '<a href="../login.php">ログイン</a>';
        } else {
            // ユーザーが既に存在する場合はエラーメッセージを表示
            echo "ユーザーが既に存在します。";
            echo '<a href="../registration.php">もう一度入力</a>';
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>
