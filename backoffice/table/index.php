<?php

	session_start();

	if(!isset($_SESSION['userID']))
	{
		header("Location: ../../../");
	}

	if($_GET['sub'] != "Users" && $_GET['sub'] != "News" && $_GET['sub'] != "Messages" && $_GET['sub'] != "Sections")
	{
		header("Location: ../../../backoffice");
	}

	include('../../assets/php/database_connection.php');
	include('../../assets/php/functions.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - <?php echo $_GET["sub"];?> Table</title>
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
								<li <?php if($_GET["sub"] == "Users") {echo 'class="current"';}?>><a href="/backoffice/table/?sub=Users">Users</a></li>
								<li <?php if($_GET["sub"] == "News" || $_GET["sub"] == "Sections") {echo 'class="current"';}?>>
									<a href="">News</a>
									<ul>
										<li><a href="/backoffice/table/?sub=News">Table</a></li>
										<li><a href="/backoffice/write/">Write</a></li>
									</ul>
								</li>
								<li <?php if($_GET["sub"] == "Messages") {echo 'class="current"';}?>><a href="/backoffice/table/?sub=Messages">Messages</a></li>
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
								<header>
									<h2><?php echo $_GET["sub"];?></h2>
								</header>
								<table>
									<tr>
										<?php
									
											$sql = "DESCRIBE " . $_GET["sub"];
											$resultDesc = $conn->query($sql);

											$fields = array();

											if ($resultDesc->num_rows > 0) {
												while($col = $resultDesc->fetch_assoc()) {
													$skip = false;
													if($col['Field'] == "password") {
														$skip = true;
													}
													if($col['Field'] == "news_id") {
														$skip = true;
													}
													if(!$skip) {
														print "<th>" .  strtoupper($col['Field']) ."</th>";
														array_push($fields, $col['Field']);
													}
												}
											}

											if($_GET["sub"] == "News") {
												echo "<th>View Sections</th>";
												array_push($fields, "View");
											}

											echo "<th>Delete</th>";
											array_push($fields, "Delete");
										?>
									</tr>
									<?php
										
										$sql = "SELECT * FROM " . $_GET['sub'];
										if($_GET['sub'] == "Messages") {
											$sql = $sql . " ORDER BY date_sent DESC";
										} 
										if($_GET['sub'] == "Sections") {
											$sql = $sql . " WHERE news_id = " . $_GET['id'];
										} 
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												foreach($fields as $field) {
													$specialField = false;

													if($field == "birthday") {
														echo "<td>" . date("d-m-Y", strtotime($row[$field])) . "</td>";
														$specialField = true;
													}

													if($field == "country") {
														$sql = "SELECT name FROM countries WHERE countries.id = " . $row[$field];
														$resultCountry = $conn->query($sql);
														$country = $resultCountry->fetch_assoc();
														echo "<td>" . $country['name'] . "</td>";
														$specialField = true;
													}

													if($field == "perms") {
														if($row['id'] == $_SESSION['userID']) {
															echo "<td><i class='icon solid fa-toggle-on' style='color: green;'></i></td>";
														} else {
															if($row[$field]) {
																echo "<td><a href='/assets/php/toggle_perms.php?value=FALSE&id=" . $row['id'] . "'><i class='icon solid fa-toggle-on' style='color: green;'></i></td>";
															} else {
																echo "<td><a href='/assets/php/toggle_perms.php?value=TRUE&id=" . $row['id'] . "'><i class='icon solid fa-toggle-off'></i></td>";
															}
														}
														$specialField = true;
													}

													if($field == "View") {
														echo "<td><a href='/backoffice/table/?sub=Sections&id=" . $row['id'] . "'><i class='icon solid alt fa-eye' style='color: blue;'></i></td>";
														$specialField = true;
													}

													if($field == "Delete") {
														if($_GET['sub'] == "Users" && $row['id'] == $_SESSION['userID']) {
															echo "<td><i class='icon solid fa-user-lock''></i></td>";
														} else {
															echo "<td><a href='/assets/php/delete_row.php?table=" . $_GET['sub'] . "&id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want do delete?\")'><i class='icon solid alt fa-trash'></i></a></td>";
														}
														$specialField = true;
													}

													if(!$specialField) {
														echo "<td>" . $row[$field] . "</td>";
													}
												}
												echo "</tr>";
											}
										}

									?>
								</table>
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

	</body>
</html>