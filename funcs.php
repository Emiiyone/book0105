<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
    try {
        $db_name = 'gs_db231216';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if( !isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id() ) {
        exit('LOGIN ERROR');
    } else {
        // ログイン済み処理
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

//   例えて言うと、
// 関数は材料を投入すれば自動で調理してくれるマシーン
// 引数（関数名後ろにつける（）の部分）は材料
// 戻り値（返り値）は受け取った材料を調理した後の料理
// みたいな感じです。

// Function curry(meat,vegetable)　という関数名・引数だったとき、
// 実行するときにcurry(beef,onion)と実行すると、
// 牛肉と玉ねぎで作ったカレーが出てくるみたいな🍛

// 引数：生こめ
// 関数：炊飯器
// 戻り値：ほかほかごはん
