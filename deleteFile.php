<?php
    session_start();
    if (!isset($_SESSION['user']))
    {
        header("refresh:0,index.php");
        die();
    }
    echo "<link href='style/". $_SESSION['user'] .".css' rel='stylesheet'>";


    if (isset($_GET["file"]))
    {
        if(unlink($_GET['file']))
        {
            echo "<script>alert('O ficheiro " . $_GET['file'] . " foi eliminado com sucesso!');</script>";
        }
        else
        {
            echo "<script>alert('Não foi possivel eliminar o ficheiro " . $_GET['file'] . "');</script>";
        }

        header("refresh:0;dashboard.php");
        die();
    }
?>