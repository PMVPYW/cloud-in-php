<?php
		session_start();
		if (!isset($_SESSION['user']))
		{
			header("refresh:0,index.php");
			die();
		}
        
		if (isset($_FILES['fundo']))
		{
            
            $name = explode(".", $_FILES["fundo"]["name"]);
            $size = count($name)-1;
            if (strtolower($name[$size]) == "jpg")
            {
                move_uploaded_file($_FILES['fundo']['tmp_name'], "images/".$_SESSION['user'].".jpg");
                echo $_FILES['fundo']['tmp_name']. "<br>images/".$_SESSION['user'].".jpg";
            }
		
		}

        if (isset($_POST["transparencia"]))
        {
            $trasparencia = 0.7;
        }
        else{
            $trasparencia = 1;
        }
        
        $css = "
            body{background: url('../images/" . $_SESSION['user']. ".jpg');
                background-size: cover;
                background-repeat: no-repeat;
            }

            .card{
                background-color: " . $_POST["cor_cartao"] . "
            ; opacity: ". $trasparencia .";}
        ";

        file_put_contents("style/". $_SESSION["user"] . ".css", $css);
        header("refresh:0,dashboard.php");
			die();
	?>