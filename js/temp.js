setInterval(function name() {
    var url = "http://192.168.1.15/api/stats/thermal.php";
    var HTTP = new XMLHttpRequest();
    HTTP.open( "GET", url); // false for synchronous request
    HTTP.send();
    HTTP.onload =function()
    {
        if (HTTP.status == 200)
        {
            document.getElementById("temp").innerHTML = HTTP.responseText + "<h3>" + new Date().toLocaleString("pt", {timeZone: "Europe/Lisbon"}) + "</h3>";
            console.log( HTTP.responseText + "<br><h3>" + new Date().toLocaleString("pt", {timeZone: "Europe/Lisbon"}) + "</h3>");
        }
        else
        {
            document.getElementById("temp").innerHTML = "Erro: " + HTTP.status;
            console.log("Erro: " + HTTP.status);
        }
        
    }
}, 1000);