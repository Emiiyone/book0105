<?php

session_start();
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

require_once('funcs.php');
$pdo = db_conn();

// gs_user_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare(' SELECT * FROM book_user_table WHERE lid = :lid AND lpw = :lpw; ');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false) {
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
if($val['id'] != '') {
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    //var_dump($_SESSION);
    header('Location: index.php');
} else {
    //Login失敗時(Logout経由)
    $_SESSION['login_error'] = 'IDまたはパスワードが間違っています。';
    header('Location: login.php');
}
exit();


