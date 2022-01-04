<?php
 $db_host = "localhost";
 $db_name = "ksu_database";
 $db_table = "ksu_std_table";
 $db_user = "root";
 $db_password = "";
 // check connection
 $dept=str_replace("'","''",$_REQUEST['dept']);//抓取前端資料

 $conn = mysqli_connect($db_host, $db_user, $db_password);
 if(empty($conn)){
	print  mysqli_error ($conn);
    die ("Unable to connect to DB！" );
	exit;
 }  
 if(!mysqli_select_db( $conn, $db_name)){
	die("DB is not existed");
	exit;
 }  

 mysqli_set_charset($conn,'utf8');

 echo "ksu_std_table: the number of students as follows:". "<br/><br/>";

 $sql = "SELECT ksu_std_department,ksu_std_name,ksu_std_grade 
 		 FROM ksu_std_table 
		 where ksu_std_department = '$dept' order by ksu_std_grade";

 $result = mysqli_query($conn,$sql);
 //$num = mysqli_num_rows($result);//計算取得資料的筆數
 echo "<table border='1'>
 <tr>
    <th> Name </th> <th> Grade </th> <th> Memo </th> 
 </tr>";

$row_num = 0;
while ($row = mysqli_fetch_array($result))
{
	$grade = $row['ksu_std_grade'];
	if (empty($row['ksu_std_department'] )!=true){
		echo "<tr>";
		echo "<td>".$row['ksu_std_name'] . "</td>";
		echo "<td >".$row['ksu_std_grade'] . "</td>";
		if($grade<60){
			echo "<td bgcolor=yellow>"."make up"."</td>";
		}
		else{
			echo "<td>".""."</td>";
		}
		
		
		echo "</tr>";
		$row_num +=1;
   }
 


}

echo "</table>";
echo $row_num." records found!"."<br/>";

?> 
<form enctype="multipart/form-data" method="post" action="ksu_select3en-bug.html"  >
<input type="submit" name="sub" value="Back"/>
</form>