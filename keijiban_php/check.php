<?php

session_start();

$name = $_POST['name'];
$naiyo = $_POST['naiyo'];


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>確認</title>
</head>
<body>
<h1>確認ページ</h1>
	<form action="send.php" method="post">
    	<table border="1">
        	<tr>
            <th>名前</th>
            <td>
            	<?php echo $_SESSION['name']; ?>
            </td>
            </tr>
        	
        	<tr>
            <th>内容</th>
            <td>
            	<?php echo $_SESSION['naiyo']; ?>
            </td>
            </tr>
		</table>
        <p>入力内容はこちらでよろしいでしょうか？</p>
        <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
        <input type="hidden" name="naiyo" value="<?php echo $_SESSION['naiyo']; ?>">
        <input type="submit" name="send" value="送信">
        
        <input type="hidden" name="send" value="$name">
        <input type="hidden" name="send" value="$naiyo">
	</form>
    
	<form action="index.php" method="post">
        <input type="submit" name="back" value="戻る">
        <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
        <input type="hidden" name="naiyo" value="<?php echo $_SESSION['naiyo']; ?>">
    </form>
</body>
</html>