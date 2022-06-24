<?php

	session_start();

	if(!isset($_SESSION['userID']))
	{
		header("Location: ../../../");
	}

	include('../../assets/php/database_connection.php');
	include('../../assets/php/functions.php');

	$title = $image = $subtitle = $text = "";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Write News</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">

					<!-- Logo -->
						<h1><a href="/backoffice">DDC - Backoffice</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="/backoffice">Panel</a></li>
								<li><a href="/backoffice/table/?sub=Users">Users</a></li>
								<li class="current">
									<a href="">News</a>
									<ul>
										<li><a href="/backoffice/table/?sub=News">Table</a></li>
										<li><a href="/backoffice/write/">Write</a></li>
									</ul>
								</li>
								<li><a href="/backoffice/table/?sub=Messages">Messages</a></li>
								<li>
									<?php
										$sql = "SELECT name FROM users WHERE id = " . $_SESSION['userID'];
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
									?>
									<a href=""><i class="icon solid alt fa-user"></i> <?php echo $row['name'];?></a>
									<ul>
										<li><a href="/backoffice/profile/">Profile</a></li>
										<li><a href="/assets/php/signout.php">Sign Out</a></li>
									</ul>
								</li>
							</ul>
						</nav>

				</section>

			<!-- Main -->
				<section id="main">
					<div class="container">

						<!-- Content -->
							<article class="box post">
								<form id="write_form" name="write_form" method="POST">
									<header>
										<h2>Write News</h2>
									</header>
									<label for="title">Title <span class="mandatory">*</span></label>
									<input type="text" id="title" name="title" placeholder="Title" required="">
									<hr>
									<header>
									<h2>Section</h2>
									</header>
									<table id="dynamic_field">
										<tr style="border: 0;">
											<td><label for="subtitle">Subtitle <span class="mandatory">*</span></label></td>
											<td><input type="text" id="subtitle" name="subtitle[]" placeholder="subtitle" required=""></td>
										</tr>
										<tr style="border: 0;">
											<td><label for="text">Text <span class="mandatory">*</span></label></td>
											<td><textarea id="text" name="text[]" placeholder="Section Text" style="height:200px" resize="vertical" maxlength="500" required=""></textarea></td>
											<td><button type="button" name="add" id="add" ><i class="icon solid fa-plus"></i></button></td>
										</tr>
									</table>
									<hr>
									<input type="submit" name="submit" id="submit" value="Send">
								</form>
							</article>
					</div>
				</section>

			<!-- Footer -->
			<section id="footer">
				<div class="col-12">
					<!-- Copyright -->
					<div id="copyright">
						<ul class="links">
							<li>Copyright &copy; 2022</li><li><a href="/">Rafael Amaral</a></li>
						</ul>
					</div>
				</div>
			</section>

		</div>

		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>

			<script>  
				$(document).ready(function(){  
					var i=1;  
					$('#add').click(function(){  
						i++;  
						$('#dynamic_field').append('<tr id="row'+i+'"><tr id="row'+i+'up" style="border: 0;"><td><label for="subtitle">Subtitle <span class="mandatory">*</span></label></td><td><input type="text" id="subtitle" name="subtitle[]" placeholder="subtitle" required=""></td></tr><tr id="row'+i+'down" style="border: 0;"><td><label for="text">Text <span class="mandatory">*</span></label></td><td><textarea id="text" name="text[]" placeholder="Section Text" style="height:200px" resize="vertical" maxlength="500" required=""></textarea></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="icon solid fa-minus"></i></button></td></tr>');  
					});  

					$(document).on('click', '.btn_remove', function(){  
						var button_id = $(this).attr("id"); 
						$('#row'+button_id+'up').remove(); 
						$('#row'+button_id+'down').remove();   
						$('#row'+button_id+'').remove();  
					});  

					$('#submit').click(function(){            
						$.ajax({  
								url:"../../assets/php/write_news.php",  
								method:"POST",  
								data:$('#write_form').serialize(),  
								success:function(data)  
								{  
									alert("News Posted Succesfully");
									$('#write_form')[0].reset();  
								}  
						});  
					});  
				});  
			</script>

	</body>
</html>