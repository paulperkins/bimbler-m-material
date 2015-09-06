<?php 
	// Material implementation.
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
	$bimbler_mobile_time_str = 'j M g:ia';
	$bimbler_mobile_day_time_str = 'D j M g:ia';
	$bimbler_mobile_date_str = 'D j M';
	 

	define('WP_USE_THEMES', false);	 
	 
	require('../wp-blog-header.php');
//	require('../wp-load.php');
	
	if (!is_user_logged_in()) {
		echo '<script type="text/javascript">window.location.replace(\'login.php\');</script>';
	}

?>

	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<title><?php bloginfo ('name'); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php bloginfo ('description'); ?>" />
	<meta name="author" content="" />
		
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<meta name="mobile-web-app-capable" content="yes">
	
	<meta name="apple-mobile-web-app-capable" content="yes" />
<!--  	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> --> 
	<meta name="apple-mobile-web-app-status-bar-style" content="white" /> 
	<link rel="apple-touch-startup-image" href="bimbler_ilogo.png">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" sizes="16x16 32x32 64x64" href="favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="favicon-196.png">
	<link rel="icon" type="image/png" sizes="160x160" href="favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon-152.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon-144.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon-120.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon-114.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon-76.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon-72.png">
	<link rel="apple-touch-icon" href="favicon-57.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="favicon-144.png">
	<meta name="msapplication-config" content="browserconfig.xml">	
	
	

	<!-- css -->
<!--  	<link href="css/base.min.css" rel="stylesheet"> -->
	<link href="css/base.css" rel="stylesheet">
	<link href="css/project.min.css" rel="stylesheet">
	
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
 
	//require_once ('../m/events.php');

	if (isset ($_GET['event']) && is_numeric ($_GET['event']) && !empty ($post_object = get_post ($_GET['event']))) {
		
		$event_id = $_GET['event'];
	
		$page_title = $post_object->post_title;
		
		$show_page = true;
			
	} else {
		
		$page_title = 'Bah-Bow!';
		$show_page = false;
	}

	function bimbler_get_avatar_img ($avatar) {
		
		preg_match( '#src=["|\'](.+)["|\']#Uuis', $avatar, $matches );
	
		return ( isset( $matches[1] ) && ! empty( $matches[1]) ) ?
		(string) $matches[1] : '';
	}
	
	/*
	 *
	*/
	function get_venue_address ($event_id) {
			
		$locationMetaSuffixes = array( 'address', 'city', 'region', 'zip', 'country' );
		$address = "";
			
		$address .= tribe_get_address ($event_id);
		$address .= ' ' . tribe_get_city ($event_id);
		$address .= ' ' . tribe_get_region ($event_id);
		$address .= ' ' . tribe_get_zip ($event_id);
		$address .= ' ' . tribe_get_country ($event_id);
	
		return trim($address);
	}


	function bimbler_mobile_render_summary ($post_object) {

		$event_id = $post_object->ID;

		$addr = get_venue_address($post_object->ID);
		$event_date = $post_object->EventStartDate;
		$rwgps_id = Bimbler_RSVP::get_instance()->get_rwgps_id ($post_object->ID);
		$event_month = date ($month_str, strtotime($event_date));
		$featured_img = wp_get_attachment_url (get_post_thumbnail_id ($post_object->ID));
		
		$start_date = tribe_get_start_date($post_object->ID, false, $bimbler_mobile_day_time_str);
		$end_date = tribe_get_end_date($post_object->ID, false, $bimbler_mobile_day_time_str);

		$venue = tribe_get_venue($event_id);
		$venue_address = get_venue_address($event_id);

		$map_content = '';
		
		if (!empty ($venue_address)) {

			$map_style = 'height: 250px; width: 100%; margin-bottom: 15px;';
			
			//$map_content = '			<p><strong>Map:</strong></p>' . PHP_EOL;
			
			//$map_div = 'tribe-events-gmap-' . $event_id;
			$map_div = 'bimbler-venue-map';
			
			$map_content .= '			<div id="' . $map_div . '" style="'. $map_style . '" class="bimbler_event_map" data-venue-address="' . urlencode($venue_address) . '" data-bimbler-event-id="' . $event_id . '"></div>' . PHP_EOL;
			
			// Fake clicking the first tab.
			//$map_content .= '<script type="text/javascript">$(\'a[data-toggle="pill"]:first\').trigger("shown.bs.tab");</script>' . PHP_EOL;
			//$map_content .= '<script type="text/javascript">showVenueMap(document.getElementById(\'' . $map_div . '\'));</script>' . PHP_EOL;
		} 

		

?>
		<div class="card-wrap">
	
			<!-- Event Summary -->
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card">
					<div class="card-main">
						<div class="card-header">
	<!--						<div class="card-header-side pull-left">
								<div class="avatar">
									<img alt="John Smith Avatar" src="images/users/avatar-001.jpg">
								</div>
							</div> -->
							<div class="card-inner">
								<p class="card-heading"><?php echo 'About'; //$post_object->post_title; ?></p>
							</div>
						</div>
<?php			
						if (!empty ($featured_img)) {
?>						
						<div class="card-img">
							<img alt="alt text" src="<?php echo $featured_img; ?>">
						</div>
<?php
						}
?>						
						<div class="card-inner">
							<!--<p>-->
<?php							$content .= apply_filters( 'the_content', $post_object->post_content);
								echo $content;
?>
							<!--</p>-->
						</div>
<!--						<div class="card-action">
							<div class="card-action-btn pull-left">
								<a class="btn btn-flat waves-attach waves-effect" href="javascript:void(0)"><span class="icon text-blue">check</span>&nbsp;<span class="text-blue">Button</span></a>
							</div>
							<ul class="nav nav-list pull-right">
								<li class="dropdown">
									<a class="dropdown-toggle waves-attach waves-effect" data-toggle="dropdown"><span class="icon">keyboard_arrow_down</span></a>
									<ul class="dropdown-menu">
										<li>
											<a class="waves-attach waves-effect" href="javascript:void(0)"><span class="icon margin-right-sm">filter_1</span>&nbsp;Lorem Ipsum</a>
										</li>
										<li>
											<a class="waves-attach waves-effect" href="javascript:void(0)"><span class="icon margin-right-sm">filter_2</span>&nbsp;Consectetur Adipiscing</a>
										</li>
										<li>
											<a class="waves-attach waves-effect" href="javascript:void(0)"><span class="icon margin-right-sm">filter_3</span>&nbsp;Sed Ornare</a>
										</li>
									</ul>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
			<!-- /Event Summary -->
			
			<!-- Event When -->
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card">
					<div class="card-main">
						<div class="card-header">
							<div class="card-inner">
								<p class="card-heading">When</p>
							</div>
						</div>
						<div class="card-inner">
							<p><strong>Start:</strong> <?php echo $start_date; ?></p>
							<p><strong>End:</strong> <?php echo $end_date; ?></p>
						</div>
					</div>
				</div>
			</div>
			<!-- /Event When -->			

			<!-- Event Where -->
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card">
					<div class="card-main">
						<div class="card-header">
							<div class="card-inner">
								<p class="card-heading">Where</p>
							</div>
						</div>
<?php			
						if (!empty ($map_content)) {
?>						
						<div class="card-img">
							<?php echo $map_content; ?>
						</div>
<?php
						}
?>						

						<div class="card-inner">
							<p><strong>Venue:</strong> <?php echo $venue; ?></p>
							<p><strong>Address:</strong> <?php echo $venue_address; ?></p>
						</div>
					</div>
				</div>
			</div>
			<!-- /Event Where -->			
			
		</div> <!-- /Card wrap -->
<?php		
	}
	
?>

<body class="page-yellow">

<?php require_once ('right-nav.php'); ?>
	
<?php require_once ('main-menu.php'); ?>

<?php require_once ('right-menu.php'); ?>

	<div class="content">
  		<div class="content-heading">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						<h1 class="heading"><?php echo $page_title; ?></h1>
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
	
	if ($show_page) {

		$addr = get_venue_address($post_object->ID);
		$event_date = $post_object->EventStartDate;
		$rwgps_id = Bimbler_RSVP::get_instance()->get_rwgps_id ($post_object->ID);
		$event_month = date ($month_str, strtotime($event_date));


		bimbler_mobile_render_summary ($post_object);
?>



<?php
	} // If show_page.
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
	
	<div class="fbtn-container">
		<div class="fbtn-inner">
			<a class="fbtn fbtn-red fbtn-lg" data-toggle="dropdown" aria-expanded="false"><span class="fbtn-text">RSVP</span><span class="fbtn-ori fa fa-plus"></span><span class="fbtn-sub fa fa-minus"></span></a>
			<div class="fbtn-dropdown">
				<a class="fbtn" href="https://github.com/Daemonite/material" target="_blank"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
				<a class="fbtn fbtn-blue" href="https://twitter.com/daemonites" target="_blank"><span class="fbtn-text">Follow Daemon on Twitter</span><span class="fa fa-twitter"></span></a>
				<a class="fbtn fbtn-alt" href="http://www.daemon.com.au/" target="_blank"><span class="fbtn-text">Visit Daemon Website</span><span class="icon">link</span></a>
			</div>
		</div>
	</div>
	
<!--  	<div class="fbtn-container">
		<div class="fbtn-inner">
			<a class="fbtn fbtn-red" href="https://github.com/Daemonite/material"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
		</div>
	</div> -->

	<script src="js/base.min.js" type="text/javascript"></script>
	
	<script src="js/bimbler-material.js"></script> 
	
</body>
</html>
