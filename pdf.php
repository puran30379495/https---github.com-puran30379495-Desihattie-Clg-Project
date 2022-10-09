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
 select * from orderhistory;
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
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table>
 <tr>
    <th>Order Id</th>
    <th>Customer Name</th>
    <th>Order Details</th>
    <th>Total Amount</th>
    <th>Email</th>
    <th>Delivery</th>
    <th>Address</th>
    <th>Time</th>
 </tr>
";

while($row = mysqli_fetch_array($result))
{
 $output .= '
  <tr>
   <td>'.$row["orderid"].'</td>
   <td>'.$row["name"].'</td>
   <td>'.$row["orderDet"].'</td>
   <td>$'.$row["totalamt"].'</td>
   <td>'.$row["email"].'</td>
   <td>'.$row["delivery"].'</td>
   <td>'.$row["address"].'</td>
   <td>'.$row["time"].'</td>
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