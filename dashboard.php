<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style type="text/css">
		a
		{
			font-size: 24px;
		}
		#bar
		{
			background-color: rgba(0, 0, 0, 0.3);
			border-radius: 12px;
			max-height: 120px;
		}
		#logout
		{
			top: 50%;
		}
		#container{
			overflow-y: auto;
		}

		.card-body-content{
			overflow-y: auto;
			height: 300px;
		}
	</style>
</head>
<body>
	<?php
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		session_start();
		if (!isset($_SESSION['user']))
		{
			header("refresh:0,index.php");
			die();
		}
		echo "<link href='style/". $_SESSION['user'] .".css' rel='stylesheet'>";
	?>
	<br>
    <div class="container text-center">
        <form action="dashboard.php" method="POST">
            <div class="row" id="bar">
                <div class="col-sm-3">
                <input type="text" name="search" class="form-control" placeholder="pesquisa">
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="Pesquisar" class="btn btn-primary">
                </div>
                <div class="col-sm-3">
                    
                </div>
				<div class="col-sm-2">
                    <a href="newUser.php">
                    <div class="btn btn-warning" id="style">
                        
                            Criar Utilizador
                        
                    </div>
                    </a>
                </div>
                <div class="col-sm-1">
                    <a href="upload.php">
                    <div class="btn btn-info" id="style">
                        
                            carregar
                        
                    </div>
                    </a>
                </div>
                <div class="col-sm-1">
                    <a href="editstyle.php">
                    <div class="btn btn-success" id="style">
                        
                            Personalizar
                        
                    </div>
                    </a>
                </div>
                <div class="col-sm-1">
                    <a href="logout.php">
                    <div class="btn btn-danger" id="logout">
                        
                            Logout
                        
                    </div>
                    </a>
                </div>
            </div>
            
        </form>
    </div>
	
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 text-center">
				<a href="tempGraph.php" style="text-decoration: none; color:#000">
					<div class="card">
						<div class="card-header">
							<h1>Temperatura</h1>
						</div>
						<div class="card-body" id="div_temp">
							<h2 id="temp">A ler</h2>
						</div>
					</div>
					</a>
			</div>
			
			<div class="col-sm-6 text-center">
				<div class="card">
					<div class="card-header" id="div_arm">
						<h1>Armazenamento</h1>
					</div>
					<div class="card-body">
						<h2 id="disk_usage"><?php 
						$used = round((disk_total_space("/")-disk_free_space("/"))/1024/1024/1024, 2);
						$total = round(disk_total_space("/")/1024/1024/1024, 2);
						echo $used . "Gb/" . $total . "Gb";?></h2>
						<?php
							$percent = round(($used/$total)*100, 2);
							echo '<h3>';
							echo $percent . '%</h3>';
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="container" id="container">
		<div class="row">
			<?php
				$search = "";
				$path = "sources/" . $_SESSION["user"] . "/";
				if (isset($_POST['search']))
				{
					$search = $_POST['search'];
				} 		
				foreach (glob($path . "*") as $theme => $value) {
					echo "<div class='col-sm-4'>
						<div class='card'>
							<div class='card-header'>
								<h1>" . str_replace($path, "", $value) . "</h1>
							</div>
							<div class='card-body card-body-content'>
							";
				
					foreach (glob(glob($path . "*")[$theme] . "/*") as $file => $value2) {
						if ($search == "")
						{
							echo "<div><a class='float-left' href='deleteFile.php?file=" . $value2 . "'><img src='images/common/delete.png' alt='delete_icon'></a>&nbsp;&nbsp;&nbsp;";
							echo "<a href='" . $value2 . "' target='_blank'>" . str_replace(glob(glob($path."*")[$theme] . "/"), "", $value2) . "</a></div>";
						}
						else
						{
							if(stristr($value2, $search))
							{
								echo "<div><a href='deleteFile.php'><img src='images/common/delete.png?file=" . $value2 . "' alt='delete_icon'></a>";
								echo "<a href='" . $value2 . "' target='_blank'>" . str_replace(glob(glob($path."*")[$theme] . "/"), "", $value2) . "</a></div>";
							}
						}
						
					}

					echo "		
							</div>
						</div>					
			</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
				}
			?>
			
		</div>
	</div>
	<script>document.getElementById("div_temp").style.height = document.getElementById("div_arm").style.height;
	console.log(document.getElementById("div_temp").style.height-document.getElementById("div_arm").style.height);
</script>
	<script src="js/temp.js"></script>
	<script>document.getElementById("container").style.maxHeight=""+0.6*window.innerHeight+"px";
</script>
</body>
</html>
