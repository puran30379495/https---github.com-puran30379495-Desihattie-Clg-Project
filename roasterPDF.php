<?php
include("connection.php");
include("function.php");
require 'vendor/autoload.php';



// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();


//$document->loadHtml($html);
$page = file_get_contents("pdf.php");

//$document->loadHtml($page);


$query = "
 select * from roaster;
";
$result = mysqli_query($con, $query);

$output = "
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 60%;
}

td, th {
    border: 1px solid #000000;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
    
}
</style>
<table>
 <tr>
    <th></th>
    <th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
 </tr>
";

while($row = mysqli_fetch_array($result))
{
 $output .= '
  <tr>
   <td>8am - 12pm</td>
   <td>'.$row['roaster1'].'</td>
   <td>'.$row['roaster2'].'</td>
   <td>'.$row['roaster3'].'</td>
   <td>'.$row['roaster4'].'</td>
   <td>'.$row['roaster5'].'</td>
   <td>'.$row['roaster6'].'</td>
   <td>'.$row['roaster7'].'</td>
  </tr>
  <tr>
   <td>12am - 2pm</td>
   <td>'.$row['roaster8'].'</td>
   <td>'.$row['roaster9'].'</td>
   <td>'.$row['roaster10'].'</td>
   <td>'.$row['roaster11'].'</td>
   <td>'.$row['roaster12'].'</td>
   <td>'.$row['roaster13'].'</td>
   <td>'.$row['roaster14'].'</td>
  </tr>
  <tr>
   <td>2am - 5pm</td>
   <td>'.$row['roaster15'].'</td>
   <td>'.$row['roaster16'].'</td>
   <td>'.$row['roaster17'].'</td>
   <td>'.$row['roaster18'].'</td>
   <td>'.$row['roaster19'].'</td>
   <td>'.$row['roaster20'].'</td>
   <td>'.$row['roaster21'].'</td>
  </tr>
  <tr>
   <td>5am - 8pm</td>
   <td>'.$row['roaster22'].'</td>
   <td>'.$row['roaster23'].'</td>
   <td>'.$row['roaster24'].'</td>
   <td>'.$row['roaster25'].'</td>
   <td>'.$row['roaster26'].'</td>
   <td>'.$row['roaster27'].'</td>
   <td>'.$row['roaster28'].'</td>
  </tr>
  <tr>
   <td>8am - 10pm</td>
   <td>'.$row['roaster29'].'</td>
   <td>'.$row['roaster30'].'</td>
   <td>'.$row['roaster31'].'</td>
   <td>'.$row['roaster32'].'</td>
   <td>'.$row['roaster33'].'</td>
   <td>'.$row['roaster34'].'</td>
   <td>'.$row['roaster35'].'</td>
  </tr>
 ';
}

$output .= '</table>';

//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Invoice", array("Attachment"=>0));
//1  = Download
//0 = Preview


?>



