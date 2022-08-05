<?php
header('content-type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['user']))
{
    header("refresh:0,index.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['name']))
    {
        mkdir("/var/www/html/sources/" . $_SESSION["user"] . "/" . $_POST['name'], 0777, true);
        header("refresh:0,dashboard.php");
        die();
      
    }

}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php
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
    </div>
    <br>
    <div class="container">
        <form method="POST" action="createTheme.php" enctype="multipart/form-data">
            <h3 style="color: rgb(255, 255, 255);left: 0%;">Nome do tema</h3>
            <input type="text" name="name" placeholder="Nome do tema" class="form-control" required>
            <input type="submit" value="Criar" class="btn btn-primary">
        </form>
        
    </div>
</body>
</html>