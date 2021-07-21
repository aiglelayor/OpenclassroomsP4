
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.tiny.cloud/1/cjyum6e3ja0scdlceon58esyob6icmcnnw21llwrcjot2pnu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 	<script>tinymce.init({selector:'#post_content'});</script>
	<title>Rédiger un article</title>
</head>
<body>
	<div align="center">
		<h1>Rédiger un nouvel article</h1>
		<a href="index.php">Retour à la liste des billets</a>
		<?php
		if(!empty($showErrors))
		{
			if($showErrors == true){ ?>
				<div>
					<p>Certains champs requièrent votre attention.</p>
					<ol>
						<?php foreach ($errors as $kerrors) { ?>
						<li><?=$kerrors;?></li>
						<?php } ?>	
					</ol>
				</div>
			<?php
			}
		}
		?>

		<form action="index.php?action=saveNewPost" method="post">
			<table>
				<tr>
					<td>
						<label for="title">Titre :
					</td>
					<td>
						<input type="text" name="title" id="title" value="<?php if(isset($_POST['title'])) {
								echo $_POST['title'];
							}
							?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<textarea id="post_content" name="content" cols="70" rows="30" placeholder="Rédigez ici..."required><?php
							if(isset($_POST['content'])) {
								echo $_POST['content'];
							}
							?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td id="submit_button">
						<input type="submit" name="formnewpost" value="Enregistrer">
					</td>					
				</tr>	
			</table>
		</form>
	</div>
</body>
</html>