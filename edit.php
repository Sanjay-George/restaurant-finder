<?php include('config.php'); 

session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
   $name1= $_SESSION['name'];
  // echo $name1;
try{
		//$name1=$_SESSION['name'];
		$name=$_POST['rest'];
	$address=$_POST['address'];
	$cost=$_POST['cost'];
	$type=$_POST['type'];
	$cuisine=$_POST['cuisine'];
	$open=$_POST['open-time'];
	$close=$_POST['close-time'];
	$contact=$_POST['contact'];
	$pic=$_POST['pic'];
	$target= "images/";
	$menu=$_POST['menu'];
	$menu= $target.$menu;
	$pic= $target.$pic;
	
if(isset($_POST['submit']))
{
	
	$name=$_POST['rest'];
	$address=$_POST['address'];
	$cost=$_POST['cost'];
	$type=$_POST['type'];
	$cuisine=$_POST['cuisine'];
	$open=$_POST['open-time'];
	$close=$_POST['close-time'];
	$contact=$_POST['contact'];
	$pic=$_POST['pic'];
	$target= "images/";
	$menu=$_POST['menu'];
	$menu= $target.$menu;
	$pic= $target.$pic;
	//echo "hi";
	$sql=$db->prepare("INSERT INTO restaurant (r_name,r_type,r_add,r_cuisine,r_cost,r_contact,r_time,r_close,r_pic,r_menu) VALUES (:r_name, :r_type, :r_add, :r_cuisine,:r_cost, :r_contact, :r_time, :r_close, :r_pic, :r_menu)");
	$sql->execute(array(':r_name'=>$name, ':r_type'=>$type, ':r_add'=>$address, ':r_cuisine'=>$cuisine, ':r_cost'=>$cost, ':r_contact'=>$contact, ':r_time'=>$open, ':r_close'=>$close, ':r_pic'=>$pic, ':r_menu'=>$menu));
	header("Location: admin.php");
}

if(isset($_POST['update']))
{
	/*UPDATE `access_users`   
   SET `contact_first_name` = :firstname,
       `contact_surname` = :surname,
       `contact_email` = :email,
       `telephone` = :telephone 
 WHERE `user_id` = :user_id*/
    $name1=$_SESSION['name'];
	//echo "hi";
	echo $name1;
	$sql = $db->prepare("UPDATE `restaurant` SET `r_name` = :r_name, `r_type` = :r_type, `r_add` = :r_add, `r_cuisine` = :r_cuisine, `r_cost` = :r_cost, `r_contact` = :r_contact, `r_time` = :r_time, `r_close` = :r_close, `r_pic`= :r_pic, `r_menu`= :r_menu WHERE `r_name`='".$name1."'"); 
	$sql->execute(array(':r_name'=>$name, ':r_type'=>$type, ':r_add'=>$address, ':r_cuisine'=>$cuisine, ':r_cost'=>$cost, ':r_contact'=>$contact, ':r_time'=>$open, ':r_close'=>$close,  ':r_pic'=>$pic, ':r_menu'=>$menu));
	unset($_SESSION['name']);
	header("Location: admin.php");
}




}catch(PDOException $e){
									echo $e->getMessage();
									}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/admin.css">
    </head>

    <body>
       

       <nav class='z-depth-3 col s12'>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo left hide-on-small-only">Food Finder </a>
                
                <ul id="nav-mobile" class="right">
                    <li class='waves-effect waves-light'><a name='search-btn' class="waves-effect waves-light btn z-depth-2 red">Logout</a></li>
                </ul>
            </div>
        </nav>
     
       
        <main>
         
            <div class="container admin">
                 <div class="row">
                    <div class="col s12">
                      <ul class="tabs">
                        <li class="tab col s3 z-depth-1 hoverable"><a href="#add">add restaurants</a></li>
                        <li class="tab col s3 hoverable"><a  href="#reviews"  >verify reviews</a></li>
                        <li class="tab col s3 z-depth-1 hoverable"><a href="#suggestions">suggestions</a></li>
                        <li class="tab col s3 z-depth-1 hoverable" ><a href="#edit" class="active">edit restaurants</a></li>
                        <li class="tab col s3 hoverable"><a href="#delete">delete restaurants</a></li>
                      </ul>
                    </div>
                    
                    <div id="add" class="col s12">
												<div class="col s12 m12 l10 offset-l1">
														<div class="row">
																<form action="insert.php" name='add-rst' method='POST' id='add-rst' class="col s12">
																<div class="row">
																		<div class="input-field col s12">
																			<input id="name" type="text" name="name" class="validate">
																			<label for="name">Name of restaurant</label>
																		</div>
																</div>
																<div class="row">
																		<div class="input-field col s12">
																			<input id="address" type="text" name="address">
																			<label for="address">Address</label>
																		</div>
																</div>
																<div class="row">
																	 <div class='input-field col s4'>
																				<select id='type' name='type' class='material-select'>
																						<option default>Choose a food diet</option>

																						<option value="Veg">Veg</option>
																						<option value="Non-Veg">Non-Veg</option>
																				</select>
																		</div>
																		<div class="input-field col s4">
																			<select id='cuisine' name='cuisine' class='material-select'>
																						<option default>Choose a cuisine</option>
																						<?php 
																							$sql= $db->query('SELECT DISTINCT`r_cuisine` FROM `restaurant` '); 
																							while($row=$sql->fetch()){
																								echo '<option value="'.$row['r_cuisine'].'">'.$row['r_cuisine'].'</option>';
																							}
																						?>
																				</select>
																		</div>
																		<div class="input-field col s4">
																			<input type='text' id='cost' name="cost">
																			<label for="cost">Cost</label>
																						
																		</div>
																</div>
																<div class="row">
																	 <div class='input-field col s4'>
																				<input type='text' id='contact' name="contact">
																				<label for="contact">Contact Number</label>
																		</div>
																		<div class="input-field col s4">
																			<input id="open-time" name="open-time" type="time">
																		</div>
																		<div class="input-field col s4">
																			<input id="close-time" name="close-time" type="time">
																		</div>
																</div>
																<div class='row'>
																		<div class='file-field input-field col s6'>
																			 <div class='btn black-btn'>
																					 <span>Photo</span>
																					 <input type="file" name="pic">
																			 </div>
																				<!-- <div class='file-path-wrapper'>
																					 <input class='file-path-validate' type="text" name="pic">
																			 </div> -->

																		</div>
																		<div class='file-field input-field col s6'>
																			 <div class='btn black-btn'>
																					 <span>Menu</span>
																					 <input type="file" name="menu">
																			 </div>
																				<!-- <div class='file-path-wrapper'>
																					 <input class='file-path-validate' type="text" name="Filename">
																			 </div>  -->

																		</div>
																</div>
																
																<div class='col s12 l12 center'><button type='submit' name='submit' value="submit" class="waves-effect waves-light btn z-depth-2 black-btn">Add Restaurant</button></div>

				<!--                        <div class='col s12 l12 center'><p class='form-error center'><?php echo $error; ?></p></div>-->
																</form>
                            </div>    
                        </div>
                    </div>
                    
                    <!-- VERIFY REVIEWS -->
                    <div id="reviews" class="col s12">
                     <div class='col s12 l10 offset-l1'>
                         <h5> REVIEWS </h5>
                     
                         <form name='review-accept' method="post" id='review-accept'>
                           
                             <!-- repeat start here -->
                             <?php 
								try {
										$flag = 0;
										$sql = $db->query('SELECT * FROM `user`, `admin` WHERE `app`=0 AND `user`.`u_id`= `admin`.`a_uid`');
										while($row = $sql->fetch()){
													$flag=1;
													echo "<div class='col s12 l12 card-panel z-depth-1 hoverable review-card'>";
													echo "<div class='col l12'>";
													echo "<input type='checkbox' name=".$row['ar_id']." id='".$row['ar_id']."' value= 1 >";
													echo "<label for='".$row['ar_id']."'><span class='review-name'>".$row['u_id']."</span></label>";
													echo "<div class='review-content'>".$row['a_rev']."</div>                 ";
													echo "</div> ";
													echo "</div> ";
													}
													if($flag==0){
													echo "<h5>No new reviews</h5>";
																}

										} catch(PDOException $e){
												echo 'connection failed: '.$e->getMessage();
										}
																

									?>
                             <!-- repeat till here -->
                             
                             
                            <div class='col l12 center update-btn'><button name='submit' class="waves-effect waves-light btn z-depth-2 red">Accept Reviews</button></div>  
												</form>
													<?php 
														try{
															if(isset($_POST['submit'])){
																$sql = $db->query('SELECT * FROM  `admin` WHERE `app`=0 ');
																while($row = $sql->fetch()){
																	$cb = $row['ar_id'];
																	echo $cb;
																	if(isset($_POST[$cb])){
																		
																		if(isset($_POST[$cb]) && $_POST[$cb]==1){
																			echo $cb;
																			$sql1 = $db->query('SELECT * FROM `admin` WHERE `ar_id`='.$cb.'');
																			$restid = $row['a_restid'];
																			$a_rev = $row['a_rev'];
																			$uid = $row['a_uid'];
																			
																			$sql2 = $db->prepare('INSERT INTO `review` (rest_id, review, u_id) VALUES (:rest_id, :review, :u_id) ');
																			$sql2->execute(array(':review'=>$a_rev, ':rest_id'=>$restid, ':u_id'=>$uid));

																			$sql3 = $db->query('DELETE FROM `admin` WHERE `ar_id`='.$cb.'');
																		}
																	}
																	$_POST[$cb]=0; 
																}
															}
														}catch(PDOException $e){
																echo 'connection failed: '.$e->getMessage();
															}
													?>
										 </div>
										</div>
                    
                    <!-- SUGGESTIONS -->
                    <div id="suggestions" class="col s12">
												<div class='col s12 l10 offset-l1'>
												 <h5> SUGGESTIONS </h5>
										 
												 <form name='suggestion-accept' method="post" id='suggestion-accept'>
													 
														 <!-- repeat start here -->
														 <?php 
														 try{
															$flag= 0;
															$sql = $db->query('SELECT * FROM `suggestion`,`user` WHERE `user`.`u_id`=`suggestion`.`u_id`');
															while ($row= $sql->fetch()) {
																$flag = 1;
																echo "<div class='col s12 l12 card-panel z-depth-1 hoverable suggestion-card'>";
																	echo "<div class='col l12'>";
																		echo "<input type='checkbox' name=".$row['s_id']." id=".$row['s_id']." value=1 >";
																		echo "<label for=".$row['s_id']."><span class='review-name'>".$row['u_name']."</span></label>        ";
																		echo "<div class='review-content'>".$row['suggestion']."</div>";
																	echo "</div>";
																echo "</div>";
															}
														 if($flag==0){
															echo "<h5>No new suggestions</h5>";
																}
														 }catch(PDOException $e){
																echo 'connection failed: '.$e->getMessage();
															}
														 
														 ?>
                             <!-- repeat start here 
                             <div class='col s12 l12 card-panel z-depth-1 hoverable suggestion-card'>
                                 <div class='col l12'>
                                     <input type='checkbox' name='give-id-of-the-suggester-here' id='give-id-of-the-suggester-here'>
                                     <label for='give-id-of-the-suggester-here'><span class='review-name'>Name of the person from db</span></label>        
                                     <div class='review-content'>Review content here. This will be quite long. So get a cup of coffee and start reading what this idiot has written. Probably some shit about the restaurant</div>                 
                                 </div> 
                             </div> 
                             <!-- repeat till here -->
                             
                             
                            <div class='col l12 center update-btn'><button name='submit' class="waves-effect waves-light btn z-depth-2 red">CLEAR SUGGESTIONS</button></div>  
														 
												</form>
												<?php 
														try{
															if(isset($_POST['submit'])){
																$sql = $db->query('SELECT * FROM  `suggestion`');
																while($row = $sql->fetch()){
																	$cb = $row['s_id'];

																	if(isset($_POST[$cb])){
																	
																		if(isset($_POST[$cb]) && $_POST[$cb]==1){
																			
																			$sql1 = $db->query('SELECT * FROM `suggestion` WHERE `s_id`='.$cb.'');
																			$sql3 = $db->query('DELETE FROM `suggestion` WHERE `s_id`='.$cb.'');
																		}
																	}
																	$_POST[$cb]=0; 
																}
															}
														}catch(PDOException $e){
																echo 'connection failed: '.$e->getMessage();
															}
													?>
										 </div>
										</div>


<div id="edit" class="col s12">
<?php //if(isset($_POST['edit']))
						//{
							$name1=$_SESSION['name'];
							$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_name`="'.$name1.'"');
							$row=$sql->fetch();
						?>
						<div class="col s12 m12 l10 offset-l1">
                            <div class="row">
                                <form action="" name='add-rst' method='post' id='add-rst' class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                      <input id="name" type="text" name="rest" class="validate" value="<?php echo $row['r_name']; ?>"></input>
                                      <label for="name"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
						<input id="address" type="text" name="address" value="<?php echo $row['r_add']; ?>"></input>
                                      <label for="address"></label>
                                    </div>
                                </div>
                                <div class="row">
								<div class='input-field col s4'>
                                        <input type='text' id='cost' name="cost" value="<?php echo $row['r_cost'];?>"></input>
                                        <label for="contact">Cost</label>
                                    </div>
                                   <div class='input-field col s4'>
                                        <select id='type' name='type' class='material-select'>
                                            <option default><?php echo $row['r_type'];?></option>
                                            <option value="veg">Veg</option>
                                            <option value="non-veg">Non-veg</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s4">
                                      <select id='cuisine' name='cuisine' class='material-select'>
						<option default><?php echo $row['r_cuisine']; ?></option>
											<?php 
														$sql= $db->query('SELECT DISTINCT`r_cuisine` FROM `restaurant` '); 
														while($row=$sql->fetch()){
															echo '<option value="'.$row['r_cuisine'].'">'.$row['r_cuisine'].'</option>';
														}
													?>
                                            <!--<option value="mexican">Mexican</option>
                                            <option value="italian">Italian</option>
											<option value="chinese">Chinese</option>
											<option value="lebanese">Lebanese</option>
											<option value="mediterranean">Mediterranean</option>
											<option value="continental">Continental</option>-->
											
                                        </select>
                                    </div>
                                </div>
								<?php 							$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_name`="'.$name1.'"');
																$row=$sql->fetch();?>
                                <div class="row">
                                   <div class='input-field col s4'>
                                        <input type='text' id='contact' name="contact" value="<?php echo $row['r_contact'];?>" ></input>
                                        <label for="contact">Contact Number</label>
                                    </div>
									
                                    <div class="input-field col s4">
                                      <input id="open-time" name="open-time" type="time" value="<?php echo $row['r_time'];?>" ></input>
                                    </div>
                                    <div class="input-field col s4">
						<input id="close-time" name="close-time" type="time" value="<?php echo $row['r_close']; ?>" ></input>
                                    </div>
                                </div>
								
                                <div class='row'>
                                    <div class='file-field input-field col s6'>
                                       <div class='btn black-btn'>
                                           <span>Photo</span>
                                           <input type="file" name='pic'  value="<?php echo $row['r_pic'];?>"></input>
                                       </div>
                                       <!--<div class='file-path-wrapper'>
                                           <input class='file-path-validate' type="text">
                                       </div>-->
                                    </div>
                                
                                    <div class='file-field input-field col s6'>
                                       <div class='btn black-btn'>
                                           <span>Menu</span>
                                           <input type="file" name='menu'  value="<?php echo $row['r_menu'];?>"></input>
                                       </div>
                                       <!--<div class='file-path-wrapper'>
                                           <input class='file-path-validate' type="text">
                                       </div>-->
                                    </div>
                                </div>
                                
                                <div class='col s12 l12 center'><input type='submit' id='update' name='update' value='edit' class="waves-effect waves-light btn z-depth-2 btn black-btn"></input></div>
								</form>
							</div>
							</div>
						</div>
						<div id="delete" class="col s12">
					<div class="col s12 m12 l10 offset-l1">
                            <div class="row">
                                <form action="delete.php" name='edit-rst' method='post' id='add-rst' class="col s12">
                                <div class="input-field col s4">
																			<select id='name' name='name' class='material-select'>
																						<option default>Choose a restaurant to delete</option>
																						<?php 
																							$sql= $db->query('SELECT `r_name` FROM `restaurant` '); 
																							while($row=$sql->fetch()){
																								echo '<option value="'.$row['r_name'].'">'.$row['r_name'].'</option>';
																							}
																						?>
																				</select>
																		</div>
							</div>
						</div>
						<div class='col s12 l12 center'><button name='delete' class="waves-effect waves-light btn z-depth-2 black-btn">Submit</button></div>
						</form>
					</div>
			<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
        <script src="materialize/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
         
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
                $('.modal-trigger').leanModal();
                $('.parallax').parallax();
                $('#review').val();
                $('#review').trigger('autoresize');
                $('select').material_select();
             
            });
            
            // TABS SHADOW ON CLICK
            $('.admin .tabs').find('li').click(function(){
                $('.admin .tabs').find('li').removeClass('z-depth-2');
                $(this).addClass('z-depth-2');
            })
           
           
            
           
                

      </script>
     
    </body>
</html>