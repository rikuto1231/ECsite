<?php session_start();

include 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];
    
    try {
        $pdo = getDatabaseConnection(); 

        $sql = "SELECT mail_address, password, name_family FROM Customer WHERE mail_address = :mail";

        $row = sql_select($pdo, $sql, $mail);

        // $rowは配列の配列だから、最初の行を取得
        if (!empty($row) && password_verify($pass, $row[0]['password'])) {
            // パスワードが一致、ログイン成功
            $_SESSION["user_mail"] = $row[0]['mail_address'];
            $_SESSION["name_family"] = $row[0]['name_family'];
            $_SESSION["password"] = $row[0]['password'];

            $_SESSION['customer'] = [
                'name_family' => $row[0]['name_family'],
                'mail' => $row[0]['mail_address'],
                'pass' => $row[0]['password']
            ];

            header("Location: ../home.php"); // ログイン後のページにリダイレクト
            exit;
        } else {
            // パスワードが一致しない場合、ログイン失敗
            echo "ログインに失敗しました。";
        }

    } catch (PDOException $e) {
        // エラーメッセージを表示
        echo "エラー: " . $e->getMessage();
    }
}


?>
