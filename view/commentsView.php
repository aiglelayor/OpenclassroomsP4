<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0"/>
  	<link rel="stylesheet" type="text/css" href="public/css/style.css"/>
	<title>Commentaires <?=htmlspecialchars($post['title'])?></title>
</head>
<body>
	<h1>Mon Super Blog !</h1>
	<a href="index.php?action=listPosts">Retour à la liste des billets</a>

	<section class="news">
		<h3>
			<?=htmlspecialchars($post['title'])?>	
		</h3>

		<h3>
			<?=htmlspecialchars($post['content'])?>		
		</h3>

		<h2>
			<strong>Commentaires</strong>
		</h2>

		<?php
		foreach($comments as $com) {
		?>
			<p>
				<strong><?=htmlspecialchars($com['author'])?></strong> le <?=htmlspecialchars($com['comment_date_fr'])?> </br><?=htmlspecialchars($com['comment'])?>
			</p>
			<?php
			if(!empty($_SESSION))
			{
			?>
				<a href="index.php?action=reportComment&id=<?=$com['id']; ?>"><input type="button" value="Signaler"></a>
			<?php
			}else {
			?>
				<a href="index.php?action=login"><input type="button" value="Se connecter pour signaler"></a>
			<?php
			}
			?>
			
		
		<?php
		}
		?>

		<h2>Laissez un commentaire :</h2>
		
		<form action="index.php?action=addComment&amp;id=<?=$post['id']; ?>" method="post">
			<p>
				<?php
				if(empty($_SESSION))
				{
				?>
					<label>Votre nom : <input type="text" name="pseudo"></label>
				<?php
				}
				?>
				<label>Commentaire : <input type="text" name="comment"></label>
			</p>
		</form>

</body>
</html>