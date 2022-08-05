<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Personalizar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style>
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
	</style>
</head>
<body>
	<?php
		session_start();
		if (!isset($_SESSION['user']))
		{
			header("refresh:0,index.php");
			die();
		}
		echo "<link href='style/". $_SESSION['user'] .".css' rel='stylesheet'>";
		if (isset($_POST['css']))
		{
			file_put_contents("style/". $_SESSION['user'] .".css", $_POST['css']);
		}
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
    <script
src="https://www.gstatic.com/charts/loader.js">
</script>

	<div class="container text-center" style="width:90%; height:90%">
        <div id="myChart" style="width:90%; height:90%"></div>
    </div>

    <script>

     
    var indice = 1;
    var max = 10;

    setInterval(() => {
        
    
    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    // Set Data

    var data = google.visualization.arrayToDataTable([
        ['Temperature', 'Size'],
        [0,0],[1,0],[2,0],[3,0],[4,0],
        [5,0],[6,0],[7,0],
        [8,0],[9,0],[10,0]
        ]);
    var url = "http://192.168.1.15/api/stats/thermal.php";
    var HTTP = new XMLHttpRequest();
    HTTP.open( "GET", url); // false for synchronous request
    HTTP.send();
    HTTP.onload =function()
    {
        if (HTTP.status == 200)
        {
            console.log(data[0]);
            var temp = HTTP.responseText.replace("<h2>", "").replace("</h2>", "");
            data[indice][1] = temp;
            indice+=1;
            if (indice > max)
            {
                indice=1;
            }
            
        }
        
    }
    // Set Options


    var options = {
    title: 'Temperatura vs. Tempo',
    hAxis: {title: 'Tempo'},
    vAxis: {title: 'Temperatura'},
    legend: 'none'
    };
    // Draw
    var chart = new google.visualization.LineChart(document.getElementById('myChart'));
    chart.draw(data, options);
    }
}, 1000);
</script>

</body>
</html>