<?php 
	// Material implementation.
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php 
	require('../wp-blog-header.php');
	
	if (!is_user_logged_in()) {
		echo '<script type="text/javascript">window.location.replace(\'login.php\');</script>';
	}

?>

	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title><?php bloginfo ('name'); ?></title>

	<!-- css -->
	<link href="css/base.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
	
	<!-- favicon -->
	<!-- ... -->

	<!-- ie -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js" type="text/javascript"></script>
			<script src="js/respond.js" type="text/javascript"></script>
		<![endif]-->
</head>

<?php
 
	require_once ('../m/events.php');

?>

<body class="page-yellow">
	<header class="header">
		<ul class="nav nav-list pull-left">
			<li>
				<a class="menu-toggle" href="#menu">
					<span class="access-hide">Menu</span>
					<span class="icon icon-menu"></span>
					<span class="header-close icon icon-close"></span>
				</a>
			</li>
		</ul>
		<a class="header-logo" href="/"><?php bloginfo ('name'); ?></a>
		<ul class="nav nav-list pull-right">
			<li>
				<a class="menu-toggle" href="#search">
					<span class="access-hide">Search</span>
					<span class="icon icon-search"></span>
					<span class="header-close icon icon-close"></span>
				</a>
			</li>
			<li>
				<a class="menu-toggle" href="#profile">
					<span class="access-hide">John Smith</span>
					<span class="avatar avatar-sm"><img alt="alt text for John Smith avatar" src="images/users/avatar-001.jpg"></span>
					<span class="header-close icon icon-close"></span>
				</a>
			</li>
		</ul>
	</header>

<?php require_once ('main-menu.php'); ?>

<?php require_once ('right-menu.php'); ?>

	<div class="content">
  		<div class="content-heading">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						<h1 class="heading">Up-coming events</h1>
					</div>
				</div>
			</div>
		</div> 
		<div class="content-inner">
			<div class="container">

<!--  				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1"> -->
			
						
<?php

	global $bimbler_mobile_day_time_str;
	$month_str = 'F';


	$first = true;
	$divider = '';

	$posts = bimbler_mobile_get_upcoming_events ();

	foreach ($posts as $post) {

		//$post = $posts[0];

		$addr = get_venue_address($post->ID);
		$event_date = $post->EventStartDate;
		$rwgps_id = Bimbler_RSVP::get_instance()->get_rwgps_id ($post->ID);
		$event_month = date ($month_str, strtotime($event_date));
	
		if ($first) {					
?>						
	
				<h2 class="content-sub-heading">Next event:</h2>
											
<?php
		} else {

			// Show a new divider if the month is now different.
 			if ($divider != $event_month) {

				// If we have a divider, then end the animation.
				if (!empty ($divider)) {
					echo '</div>' . PHP_EOL;
				}

						
				$divider = $event_month;
?>
				<h2 class="content-sub-heading"><?php echo $divider; ?></h2>
<?php		
				// Start a new animation.
				echo '<div class="tile-wrap tile-wrap-animation">' . PHP_EOL;
			}
		}


		// First event - card format (with map).
		if ($first && (!empty ($addr))) { 
?>
						<div class="card-wrap">
							<div class="row">
					
								<div class="col-lg-3 col-md-4 col-sm-6">
									<div class="card">
										<div class="card-main">
											<div class="card-img">
												<!--  <img alt="alt text" src="images/samples/landscape.jpg"> -->
												
												<div class="tribe-events-venue-map">
													<?php echo tribe_get_embedded_map ($post->ID, '100%', '150px', true); ?>
												</div>
												
												<p class="card-img-heading"><?php echo $post->post_title; ?></p>
											</div>
											<a href="">
											<div class="card-inner">
												<p><?php echo date ($bimbler_mobile_day_time_str, strtotime($event_date)) ?></p>
												<p><?php echo $post->excerpt; ?></p>
											</div>
											</a>
		<!--  									<div class="card-action">
												<ul class="nav nav-list pull-left">
													<li>
														<a href="javascript:void(0)"><span class="icon icon-check text-blue"></span>&nbsp;<span class="text-blue">OK</span></a>
													</li>
													<li>
														<a data-dismiss="tile" href="javascript:void(0)"><span class="icon icon-close"></span>&nbsp;Cancel</a>
													</li>
												</ul>
											</div> -->
										</div>
									</div>
								</div>
				
							</div>
						</div>			
<?php
					
		} else { // End first event card.
?>

					<div class="tile">
						<div class="pull-left tile-side">
							<div class="avatar avatar-blue avatar-sm">
								<span class="icon icon-alarm"></span>
							</div>
						</div>
						<div class="tile-inner">
							<span><strong><?php echo $post->post_title; ?></strong></span><br>
							<span><?php echo date ($bimbler_mobile_time_str, strtotime($event_date)); ?></span>
						</div>
					</div>


<?php
		} // Remaining events.
	



		if ($first) {
			$first = false;
		}
	}
?>


					
<!--  					</div>
				</div> -->			
		

			</div> <!-- /container-inner -->
		</div> <!-- /container -->
	</div> <!-- /content -->
	<footer class="footer">
		<div class="container">
			<p>Bimblers</p>
		</div>
	</footer>
<!--  	<div class="fbtn-container">
		<div class="fbtn-inner">
			<a class="fbtn fbtn-red" href="https://github.com/Daemonite/material"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
		</div>
	</div> -->

	<script src="js/base.min.js" type="text/javascript"></script>
	
	<script src="../m/bimbler-bs.js"></script> 
	
</body>
</html>