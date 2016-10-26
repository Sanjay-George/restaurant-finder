<?php 
error_reporting(0);
require('config.php'); 
require('login.php'); 

// redirect if no rest_id
if (!$_GET){
	header('location:index.php');
}

if ($_POST){
    print_r($_POST);
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="materialize/css/materialize.min.css">
	<link rel='stylesheet' href="css/materialize_red_black_theme.css">
	<link rel="stylesheet" href="css/details.css"> 
	<link rel="stylesheet" href="css/bootstrap-material-datetimepicker.css"> 
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="js/moment.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-material-datetimepicker.js"></script>
</head>

<body>
	<nav class='z-depth-3 col s12'>
		<div class="nav-wrapper"> <a href="index.php" class="brand-logo left hide-on-small-only">Restrofinder</a>
			<ul id="nav-mobile" class="right">
				<li><a id='log-option' class="waves-effect waves-light btn modal-trigger z-depth-2 red" href="#login-pop" name='log/reg'>Login / Register</a></li>
			</ul>
		</div>
	</nav>
	<?php

		if (array_key_exists("id",$_SESSION)){
			// display logout button 
	?>
	<script type="text/javascript">
		$('#log-option').removeClass('modal-trigger');
		$('#log-option').attr('href', 'index.php?logout=1');
		$('#log-option').text('Logout');
	</script>
	<?php
		}

	?>
	<!-- ************************ -->
	<!-- POPUP FOR LOGIN / SIGNUP -->
	<!-- ************************ -->
	<div id="login-pop" class="modal">
		<div class="modal-content">
			<!-- login or signup markup -->
			<div class="col s12 tabs-col">
				<ul class="tabs">
					<li class="tab col s6 z-depth-1"><a href="#login">Login</a></li>
					<li class="tab col s6 z-depth-1"><a class="active" href="#signup">Register</a></li>
				</ul>
			</div>
			<!-- LOGIN -->
			<div class="col s12 m12 l8 offset-l2">
				<div class="row">
					<form name='login' method='post' id='login' class="col s12">
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" name="email" class="validate" autocomplete="email">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name="password" class="validate">
								<label for="password">Password</label>
							</div>
						</div>
						<input type="hidden" name='login' value='1'>
						<div class='col s12 l12 center'>
							<button name='submit' id='submit login-btn' class="submit waves-effect waves-light btn z-depth-2 black-btn">Login</button>
						</div>
						<div class='col s12 l12 center'>
							<p class='form-error-1 form-error center'></p>
						</div>
					</form>
				</div>
			</div>
			<!-- SIGNUP -->
			<div class="col s12 l8 offset-l2">
				<div class="row">
					<form method="post" name='signup' id='signup' class="col s12">
						<!--                             do email validation in php-->
						<div class="row">
							<div class="input-field col s12">
								<input id="username" name='username' type="text" class="validate" autocomplete='name' required>
								<label for="username">Username</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" name="email" class="validate" autocomplete="email" required>
								<label for="email">Email</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name='password' class="validate" required>
								<label for="password">Password</label>
							</div>
						</div>
				        <div class="row">
                            <div class="input-field col s12">
                                <input id="cnf-password" type="password" name="cnf-password" class="validate">
                                <label for="cnf-password">Confirm Password</label>
                            </div>
                        </div>
						<input type="hidden" name='login' value='0'>
						<div class='col s12 l12 center'>
							<button name='submit' id='submit signup' class=" submit waves-effect waves-light btn z-depth-2 black-btn">Register</button>
						</div>
						<div class='col s12 l12 center'>
							<p class='form-error-2 form-error center'></p>
						</div>
					</form>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- START WORKING FROM HERE --> 
	<header>
		
	<?php
	// for restaurant details
	try {
 		$sql = $db->query("SELECT * FROM `restaurant` WHERE `r_id`='".$_GET['id']."'");
		$row = $sql->fetch();
 	} catch(PDOException $e){
 		echo 'connection failed: '.$e->getMessage();
 	}
		
/*        
		$query = "SELECT * FROM `restaurant` WHERE r_id = '".$_GET['id']."' LIMIT 1";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
//        print_r($row);
  */      
		
	?>
		 
	<div class='row jumbo'>
		<div class='col s12 parallax-container'>
			<div class='col s12 parallax'>
			   <!-- <img id='rest-img' src="images/rest1.jpg"> -->
				<img id='rest-img' src="<?php echo $row['r_pic'];?>">


				<div class='text valign-wrapper'>
					<div class='col l8 info-set-1'>
						<h2><?php echo $row['r_name']; ?></h2>
						<h5 class='valign-wrapper'><i class='material-icons'>location_on</i> <?php echo $row['r_add']; ?></h5>
						<h5 class='valign-wrapper'><i class='material-icons'>stay_current_portrait</i><?php echo $row['r_contact']; ?></h5>
					</div>
					<div class='col l4 info-set-2'>
						<h5 class='valign-wrapper center'> <span class='rating-disp z-depth-4 valign-wrapper'><span><?php echo $row['r_rat_avg']; ?> </span><span><i class='material-icons center'>&nbsp;star</i></span></span></h5>
						<h5><i class='material-icons'>&#8377; &nbsp;</i><span><?php echo $row['r_cost']; ?></span></h5>
						<h5 class='valign-wrapper'><i class='material-icons'>query_builder</i> <span><?php echo $row['r_time']; ?></span><span>&nbsp;-&nbsp; </span><span><?php echo $row['r_close']; ?></span></h5>
						<h5 class='valign-wrapper'><i class='material-icons'>done</i><?php echo $row['r_cuisine']; ?></h5>
						<h5 class='valign-wrapper'><i class='material-icons'>done</i> <?php echo $row['r_type']; ?></h5>
						
						
					</div>
				</div>
			   

				</div>   
			</div>
		</div> 
	</header>
	
	<main>
	    
	    <div class='container'>
		   
			<div class='row add-reservation add-reviews'>
                <h3>Enter reservation details</h3> 
                <div class='col s12 l10 offset-l1'>
                    <form method="post" name="reservation" id='reservation'>
                        <div class='row valign-wrapper'>
                            <div class='col s4'>
                                <clabel>Select Date</clabel>
                            </div>
                            <div class='col s8'>
                                <div class="form-control-wrapper">
                                    <input name='date' type="text" id="date" class="form-control floating-label" placeholder="Date" required>
                                </div>
                            </div>
                        </div>
                        <div class='row valign-wrapper'>
                            <div class='col s4'>
                                <clabel>Select Time</clabel>
                            </div>
                            <div class='col s8'>
                                <div class="form-control-wrapper">
                                    <input name="time" type="text" id="time" class="form-control floating-label" placeholder="Time" required>
                                </div>
                            </div>
                        </div>
                        <div class='row valign-wrapper'>
                            <div class='col s4'>
                                <clabel>Number of people</clabel>
                            </div>
                            <div class='col s8'>
                                <div class="form-control-wrapper">
                                    <input name="people" type="number" id="people"  placeholder="Number of people" required>
                                </div>
                            </div>
                        </div>
                        <div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 red">Make Reservation</button></div>

                    </form>
                </div>   
			</div>
			
		</div>
    

	    
	</main>
	
	<script src="materialize/js/materialize.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/typed.js"></script>
	<script>

        
        // WHEN DOC READY
		$(document).ready(function () {
			// FOR SELECTING TABS
			$('ul.tabs').tabs();
			$('.modal-trigger').leanModal();
			$('.parallax').parallax();
			$('#review').val();
			$('#review').trigger('autoresize');
            
            // TIME OR DATE PICKER
			$('#date').bootstrapMaterialDatePicker
			({
				time: false,
				clearButton: false,
                format : 'DD/MM/YYYY'
			});
            $('#date').bootstrapMaterialDatePicker('setDate', moment());
            $('#date').bootstrapMaterialDatePicker('setMinDate', moment());
			$('#time').bootstrapMaterialDatePicker
			({
				date: false,
				shortTime: true,
				format: 'HH:mm'
			});
            
            $.material.init()
            
		});
        
		 // LOGIN REQUEST AJAX
		$('#login button').click(function (e) {
			e.preventDefault();
			// ajax to validate
			$.ajax({
				method: "POST"
				, url: "loginValidate.php"
				, data: {
					email: $('#login #email').val()
					, password: $("#login #password").val()
				}
			}).done(function (msg) {
				if (msg != 'success') {
					$('.form-error-1').text(msg);
				}
				else {
					// refresh the page
					$('.form-error-1').text('Logged in successfully');
					location.reload();
				}
			});
		});
		// SIGNUP REQUEST AJAX
		$('#signup button').click(function (e) {
			e.preventDefault();
			// ajax to validate
			$.ajax({
				method: "POST"
				, url: "signupValidate.php"
				, data: {
					email: $('#signup #email').val()
					, password: $("#signup #password").val()
					, username: $("#signup #username").val()
				}
			}).done(function (msg) {
				if (msg != 'success') {
					$('.form-error-2').text(msg);
				}
				else {
					//refresh the page
					$('.form-error-2').text("Registered successfully");
					location.reload();
				}
			});
		});

		
		
		// STARS PART
		// hovering 
		$('.star-row').find('.star').hover(function () {
			var value = parseInt($(this).attr("data-value"));
			// check if clicked, then no hover effect
			if (!$('.star-row').hasClass('clicked') || value > parseInt($('#rating').val())) {
				//first remove color for all stars greater than hovered
				for (var i = 6; i >= value; i--) {
					$('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
				}
				//add color to all star below and equal to hovered 
				for (i = 1; i <= value; i++) {
					$('.star-row .star:nth-child(' + (i + 1) + ')').addClass('star-hover');
				}
			}
		}, function () {
			// on hoverout clear all stars
			// check if clicked, then don't clear, else clear
			var value = parseInt($(this).attr("data-value"));
			var clickedValue = parseInt($('#rating').val());
			console.log(clickedValue);
			if ($('.star-row').hasClass('clicked') && value > clickedValue) {
				for (i = 6; i > clickedValue + 1; i--) {
					$('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
				}
			}
			else if (!$('.star-row').hasClass('clicked')) {
				for (i = 6; i >= 1; i--) {
					$('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
				}
			}
		});
		// on click
		$('.star-row').find('.star').click(function () {
			var value = parseInt($(this).attr("data-value"));
			//first remove color for all stars greater than hovered
			for (var i = 6; i >= value; i--) {
				$('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
			}
			//add color to all star below and equal to hovered 
			for (var i = 1; i <= value; i++) {
				$('.star-row .star:nth-child(' + (i + 1) + ')').addClass('star-hover');
			}
			// also give selected value to hidden input rating
			$('#rating').val(value);
			$('.star-row').addClass('clicked');
		});
	</script>
</body>
</html>