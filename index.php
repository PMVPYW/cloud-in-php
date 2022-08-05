<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Repositório</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<?php
	$images = glob("images/common/rpd-wallpaper/*.jpg");
	$indice = random_int(0, count($images)-1);
	?>
	
	<style type="text/css">
		body
		{
			background: url("<?php echo $images[$indice]; ?>");
			background-size: cover;
			background-repeat: no-repeat;
			overflow-y: auto;
			max-height: 100vh;
		}
		.centered
		{
			 position: fixed;
			  top: 42%;
			  left: 42%;
		}
		h6
		{
			font-size: 25px;
			color:  rgb(75, 75, 75);
		}
		.col-sm-3
		{
			opacity: 0.7;
			background-color: rgb(255,255,255);
			border-radius: 12px;
			padding: 20px;
		}
	</style>
</head>
<body id="body" class="bg-image">

	<?php
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		session_start();
		if (isset($_SESSION['user']))
		{
			header("refresh:0;dashboard.php");
		}
		if (isset($_POST['user']) && isset($_POST['password']))
		{
			if (file_exists("users/" . $_POST['user'] . ".txt")) {
				
				$passwd = file_get_contents("users/" . $_POST['user'] . ".txt");
				if (hash("sha256", $_POST['password']) == $passwd)
				{
					$_SESSION['user'] = $_POST['user'];
					header("refresh:0;dashboard.php");
				}
				else
				{
					echo "<script>alert('Password Errada')</script>";
					
				}
			}
			else
			{
				echo "<script>alert('Utilizador não existe".$_POST['user']."')</script>";
				
			}
			
		}
	?>




	<div class="text-center container centered">
		<div class="row">
			<div class="col-sm-3">
				<form method="POST" action="index.php">
					<div class="col-mb-3">
						<label class="form-label"><h6><b>Utilizador</b></h6></label><br>
						<input type="text" name="user" class="form-control" placeholder="utilizador" required><br>
					</div>
					<div class="col-mb-3">
						<label class="form-label"><h6><b>Password</b></h6></label><br>
						<input type="password" name="password" class="form-control" placeholder="password" required><br><br>
					</div>
					<div class="col-mb-3">
						<input type="submit" value="Login" class="btn btn-primary">
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
	<script>

		setInterval(() => {
			<?php
				echo "var lst = [";
				foreach($images as $image)
				{
					if ($image != $images[count($images)-1])
					{
						echo "'" . $image . "', ";
					}
					else
					{
						echo "'" . $image . "'];";
					}
				}	

				echo "\nvar n = " . count($images) . ";\n";
			?>
			document.getElementById("body").style.backgroundImage = "url('" + lst[Math.floor(Math.random() * n)] + "')";
			console.log(document.getElementById("body").style.backgroundImage);
		}, 5000);

	</script>
</body>
</html>
