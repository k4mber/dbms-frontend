<?php

include("phpbook-vars.inc");

include("displayDBQueryField.inc");

$database="Team1";

$connect=mysqli_connect($hostname, $user, $password);

mysqli_select_db($connect, $database);
?>
<Html>
<Head>
<Title>Terminate Employee</Title>
<link href="style.css" rel="stylesheet" Type="text/css">
</Head>
<Body>

<Table Border=0 cellPadding=10 Width=100%>

<Tr>

<Td BGColor="FFFF00" Align=Center VAlign=top Width=17%> </Td>

<Td BGColor="000000" Align=Left VAlign=Top Width=83%>

<?php
$store_employeeLoc = $_POST['employeeLoc'];

$query = "Create or Replace View employeeTable as Select Distinct S.Name, S.SID, Position, EName, EID From Stores S,
	Employees E Where S.SID = E.SID AND S.Name = '$store_employeeLoc';";
$query1 = "Select * from employeeTable;";

echo "<h1>The following displays all employees of $store_employeeLoc</h1>";


echo "<br>";
mysqli_query($connect, $query);
display_db_query($query1, $connect,True,2);

echo "<br>";
echo "Select who you wish to terminate and click 'Terminate'";
?>

<?php
    $resultSet = mysqli_query($connect, "Select EName from employeeTable;");
     ?>
     <Form Method="post" Action="terminationHandler.php">
     <select name="EmployeeName">
       <?php
       while($rows = $resultSet->fetch_assoc())
       {
         $employee_name = $rows['EName'];
         echo "<option value='$employee_name'>$employee_name</option>";
       }

        ?>
     </select>
     <input type="submit" name="Click to Terminate!" value="Terminate">
<?php
       mysqli_close($connect);
        ?>


</Table>
</Body>
</Html>