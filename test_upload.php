<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Upload Data</title>
</head>
<body>
	<h1>Upload data</h1>
	<p>
		Merci d'utiliser pour des fichiers : <br />
		<i>
			$fileUpload = new fileUpload();<br />
			$fileUpload->uploadFile();
		</i>
	</p>
	<p>
		Pour des images: <br />
		<i>
			$fileUpload = new fileUpload();<br />
			$fileUpload->uploadImage($widthOrHeight);
		</i>
	</p>
	<div>

		<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
		<form enctype="multipart/form-data" action="upload.php" method="post">

			<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
			Upload : <br /><br />
			<input name="userfile[]" type="file" multiple="multiple"/>


			<input type="submit" />
		</form>
	</div>

</body>
</html>
