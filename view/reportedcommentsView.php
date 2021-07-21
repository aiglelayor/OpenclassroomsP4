<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0"/>
  	<link rel="stylesheet" type="text/css" href="public/css/style.css"/>
	<title>Commentaires <?=htmlspecialchars($post['title'])?></title>
</head>
<body>
	<h1>Commentaires signalés</h1>
	<a href="index.php?action=listPosts">Retour à la liste des billets</a>

	<section class="news">

		<?php
		foreach($reportedComments as $com) {
			if(isset($com['report']))
			{
		?>
			<p>
				<strong><?=htmlspecialchars($com['author'])?></strong> le <?=htmlspecialchars($com['comment_date_fr'])?> </br><?=htmlspecialchars($com['comment'])?>
			</p>

		<?php
			}
			if(!empty($_SESSION))
			{
			?>
				<!-- <a href="index.php?action=reportComment&id=<?=$com['id']; ?>"><input type="button" value="Supprimer"></a> -->
			<?php
			}
			?>
			
		
		<?php
		}
		?>
</body>
</html>