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
    
    
    if(isset($_FILES['file']) && isset($_POST['tema']))
    {
        $total_count = count($_FILES['file']['name']);
        for( $i=0 ; $i < $total_count ; $i++ ) {

            if (file_exists("sources/".$_SESSION["user"] . "/" . $_POST['tema']."/". $_FILES['file']['name'][$i]))
            {
                echo "<script>alert('Já existe um ficheiro com esse nome nesse tema');</script>";
            }
            else
            {
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $_POST['tema']."/".$_FILES["file"]['name'][$i]);
            }
         }
        /*if (file_exists("sources/".$_SESSION["user"] . "/" . $_POST['tema']."/".$_POST['name'])) 
        {
            echo "<script>alert('Já existe um ficheiro com esse nome nesse tema');</script>";
        }
        else
        {
            //echo "<script>alert('".$_FILES['file']['tmp_name']." --> ".$_POST['tema']."/".$_POST['name'] ."');</script>";
            move_uploaded_file($_FILES['file']['tmp_name'], $_POST['tema']."/".$_FILES["file"]['name']);
        }*/
        header("refresh:0;dashboard.php");
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
    <br>
    <div class="container">
        <form method="POST" action="upload.php" enctype="multipart/form-data">
            <input type="file" name="file[]" class="form-control" required multiple>
            <br>
            <!--
            <h3 style="color: rgb(255, 255, 255);left: 0%;">Nome de destino</h3>
            <input type="text" name="name" placeholder="Nome de destino" class="form-control" required>
            <br>
-->
            <h3 style="color: rgb(255, 255, 255);left: 0%;">Tema</h3>
            <select class="form-control" name="tema" style="width: 75%; display: inline;">
                <?php
                    foreach (glob("sources/" . $_SESSION["user"] . "/" . "*") as $theme => $value) 
                    {
                        echo "<option value='" . $value . "''>" . str_replace("sources/" . $_SESSION["user"] . "/", "", $value) ."</option>";
                    }
                ?>
            </select>
            <a href="createTheme.php" class="btn btn-success">Criar Tema</a>
            <input type="submit" value="Carregar" class="btn btn-primary">
        </form>
        
    </div>
</body>
</html>