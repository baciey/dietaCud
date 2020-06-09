<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
	<title>Dieta Niskowęglowodanowa, artykuły</title>
	<?php require 'template/head.php'; ?>
	<link rel="stylesheet" href="style/stylearticle.css" type="text/css" />
</head>

<body>

	<!---NAVBAR-->
	<header>
		<?php require 'template/navbar.php'; ?>
	</header>

	<!---TOPBAR-->
	<section>
		<div class="bibliotekaZdjecie"></div>
	</section>


	<!---GŁÓWNA TREŚĆ-->
	<article>
		<!-- <div id="pojemnik"> -->

		<div class="pojemnikFormularz">
			<h1><span>Artykuły</span></h1>

			<?php
			require_once "database/databaseconnect.php";

			$sql = "SELECT * FROM articles";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = mysqli_fetch_array($result)) { ?>
					<div class='gallery'>
						<a href=<?php echo "public.php?id={$row['id']}"; ?>>
							<img src=<?php echo "images/{$row['img']} alt='{$row["name"]}' class='ss' "; ?>></a>
						<div class='data'>
							<i class="material-icons">access_time</i> <?php echo "{$row['date']}"; ?>
						</div>
						<div class='desc'>
							<?php echo "{$row['description']}"; ?>
						</div>
					</div>
					<!--MOBILE-->
					<a class="aMobile" href=<?php echo "public.php?id={$row['id']}"; ?>>

						<div class='galleryMobile'>
							<div class="data_descWrapper">
								<div class='dataMobile'>
									<i class="material-icons">access_time</i> <?php echo "{$row['date']}"; ?>
								</div>
								<div class='descMobile'>
									<?php echo "{$row['description']}"; ?>
								</div>
							</div>
							<div class="divImgMobile">
								<img src=<?php echo "images/{$row['img']} alt='{$row["name"]}' class='ss' "; ?>>
							</div>
						</div>
					</a>




			<?php
				}
			} ?>
		</div>
		<!-- </div> -->
	</article>
	<div style="clear:both"></div>


	<!---STOPKA-->
	<footer>
		<?php require 'template/footer.php'; ?>
	</footer>


</body>





</html>