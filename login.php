<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <?php if(isset($_SESSION['login_error'])): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($_SESSION['login_error']); ?>
        </div>
        <?php unset($_SESSION['login_error']); // メッセージを表示した後、セッション変数をクリアする ?>
    <?php endif; ?>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <div class="logoWrap loginPage">
        <a href="index.php"><h1 class="logo"><img src="https://www.google.com/intl/en_ALL/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="google"></h1></a>
        <h2 class="cat">BOOKS</h2>
    </div>
    <div class="inputContainer">
        <p class="fsize">LOGIN</p>
        <form name="form1" action="login_act.php" method="post">
            ID: <input type="text" name="lid" placeholder="Username" /><br>
            PW: <input type="password" name="lpw" placeholder="Password" />
            <input type="submit" value="LOGIN" class="inputLogin" />
        </form>
    </div>


</body>

</html>
