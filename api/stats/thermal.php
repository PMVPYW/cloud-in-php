<?php

exec("cat /sys/class/thermal/thermal_zone*/temp", $out, $ret);
$temp = $out[0];
$float = $temp[strlen($temp)-3] . $temp[strlen($temp)-2] . $temp[strlen($temp)-1];
$int = "";
foreach (range(0, strlen($temp)-4) as $number) {
    $int = $int . $temp[$number];
}
if ($int <= 60)
{
    echo "<h2 style='color: green'>";
}
else if ($int < 70)
{
    echo "<h2 style='color: orange'>";
}
else
{
    echo "<h2 style='color: red'>";
}

echo $int. "." . $float;
echo " ºC</h2>";


?>