<?php

require_once('config.php');
require_once('functions.php');

session_start();

if (isset($_POST["send"])) {
	
	$name = $_POST['name'];
	$naiyo = $_POST['naiyo'];
	
	if ($name === "") {
		$errMsg['name'] = "お名前を入力してください";
	}
	
	if ($naiyo === "") {
		$errMsg['naiyo'] = "内容を入力してください";
	}

	if (count($errMsg) === 0) {
		$_SESSION['name'] = $name;
		$_SESSION['naiyo'] = $naiyo;
		header('Location: '.SITE_URL.'check.php');
	}
}
	
	$postedAt = date('Y/m/d(D) H:i');

	$dbh = connectDb();

	$toiawase = array();

if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])) {
	$page = (int)$_GET['page'];
} else {
	$page = 1;
}


	$offset = COMMENTS_PER_PAGE * ($page - 1);
	$sql = "select * from toiawase limit ".$offset.",".COMMENTS_PER_PAGE;

foreach ($dbh->query($sql) as $row) {
 array_unshift($toiawase, $row);
}
	$total = $dbh->query("select count(*) from toiawase")->fetchColumn();
	$totalPages = ceil($total / COMMENTS_PER_PAGE);
	
	$from = $offset + 1;
	$to = ($offset + COMMENT_PER_PAGE) < $total ? ($offset + COMMENTS_PER_PAGE) : $total;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>入力</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<h1><a href="index.php">掲示板</a></h1>
	<form action="" method="post">
    	<table>
        	<tr>
            <th>名前</th>
            <td>
            	<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>">
                <?php if($errMsg) { echo $errMsg['name']; } ?>
            </td>
            </tr>
        	<tr>
            <th>内容</th>
            <td>
            	<textarea name="naiyo" rows="5" cols="30"><?php echo $_SESSION['naiyo']; ?></textarea>
                <?php if($errMsg) { echo $errMsg['naiyo']; } ?>
            </td>
            </tr>
		</table>
        <input type="submit" name="send" value="送信">
    </form>
    
<hr>

<h2>投稿一覧</h2>
<p>全<?php echo $total; ?>件中、<?php echo $from; ?>件～<?php echo $to; ?>件</p>
<?php if ($page > 1) : ?>
<a href="?page=<?php echo $page-1; ?>">前</a>
<?php endif; ?>
<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
	<?php if ($page == $i) : ?>
	<strong><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></strong>
	<?php else: ?>
	<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>
<?php if ($page < $totalPages) : ?>
<a href="?page=<?php echo $page+1; ?>">次</a>
<?php endif; ?>
<hr>

<?php foreach ($toiawase as $toiawase1) : ?>
<p id="entry_<?php echo h($toiawase1['id']); ?>">
<?php echo h($toiawase1['id']); ?> 名前 : <?php echo h($toiawase1['name']); ?>　　　　　<?php echo h($toiawase1['created']); ?>
<br><br><br>
<?php echo h($toiawase1['naiyo']); ?><br><br>
</p>
<hr>
<?php endforeach; ?>

<?php if ($page > 1) : ?>
<a href="?page=<?php echo $page-1; ?>">前</a>
<?php endif; ?>
<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
	<?php if ($page == $i) : ?>
	<strong><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></strong>
	<?php else: ?>
	<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>
<?php if ($page < $totalPages) : ?>
<a href="?page=<?php echo $page+1; ?>">次</a>
<?php endif; ?>

<style>

</style>

</body>
</html>