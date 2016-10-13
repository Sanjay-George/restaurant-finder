<?php include('config.php'); 
try{
		$name=$_POST['name'];
	$address=$_POST['address'];
	$cost=$_POST['cost'];
	$type=$_POST['type'];
	$cuisine=$_POST['cuisine'];
	$open=$_POST['open-time'];
	$close=$_POST['close-time'];
	$contact=$_POST['contact'];
	$pic=$_POST['pic'];
	$menu=$_POST['menu'];
	
//if($_POST['delete'])
//{
			$name=$_POST['name'];
echo '<script> var r= confirm("Are you sure you want to delete this restaurant?");
									if(!r){
										window.location.href="admin.php";}
										</script>';
	//echo "hi";
	$sql=$db->query("DELETE FROM `restaurant` WHERE `r_name`='".$name."'");
   // $pdoResult = $db->prepare($sql);

    //$pdoExec = $pdoResult->execute($sql);

	
	/*$sql=$db->prepare('INSERT INTO restaurant (r_id,r_name,r_type,r_add,r_cuisine,r_cost,r_rat_avg,r_rat_sum,r_rat_no,r_contact,r_time,r_close,r_pic,r_menu) VALUES (:r_id, :r_name, :r_type, :r_add, :r_cuisine,:r_cost, :r_rat_avg, :r_rat_sum, :r_rat_no, :r_contact, :r_time, :r_close, r_pic, :r_menu)');
	$sql->execute(array(':r_id'=>NULL, ':r_name'=>$name, ':r_type'=>$type, ':r_add'=>$address, ':r_cuisine'=>$cuisine, ':r_cost'=>$cost, ':r_rat_avg'=>NULL, ':r_rat_sum'=>NULL, ':r_rat_no'=>NULL, ':r_contact'=>$contact, ':r_time'=>$open, ':r_close'=>$close, ':r_pic'=>$pic, ':r_menu'=>$menu));*/
		header("Location: admin.php");

	
//}
/*if($_POST['submit'])
{
	

	
	$sql=$db->prepare('INSERT INTO restaurant (r_id,r_name,r_type,r_add,r_cuisine,r_cost,r_rat_avg,r_rat_sum,r_rat_no,r_contact,r_time,r_close,r_pic,r_menu) VALUES (:r_id, :r_name, :r_type, :r_add, :r_cuisine,:r_cost, :r_rat_avg, :r_rat_sum, :r_rat_no, :r_contact, :r_time, :r_close, r_pic, :r_menu)');
	$sql->execute(array(':r_id'=>NULL, ':r_name'=>$name, ':r_type'=>$type, ':r_add'=>$address, ':r_cuisine'=>$cuisine, ':r_cost'=>$cost, ':r_rat_avg'=>NULL, ':r_rat_sum'=>NULL, ':r_rat_no'=>NULL, ':r_contact'=>$contact, ':r_time'=>$open, ':r_close'=>$close, ':r_pic'=>$pic, ':r_menu'=>$menu));
}*/

/*if($_POST['update'])
{
	$sql = $db->prepare('UPDATE restaurant SET r_name = :r_name, r_type = :r_type, r_add = :r_add, r_cuisine = :r_cuisine, r_cost = :r_cost, r_contact = :r_contact, r_time = :r_time, r_close = :r_close, r_pic = r_pic, r_menu = :r_menu'); 
	$sql->execute(array(':r_name'=>$name, ':r_type'=>$type, ':r_add'=>$address, ':r_cuisine'=>$cuisine, ':r_cost'=>$cost, ':r_contact'=>$contact, ':r_time'=>$open, ':r_close'=>$close, ':r_pic'=>$pic, ':r_menu'=>$menu));
	header("Location: admin.php");
}*/




}catch(PDOException $e){
									echo $e->getMessage();
									}



?>
