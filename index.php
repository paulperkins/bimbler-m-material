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
	
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
	
<script type="text/javascript">
		(function(document,navigator,standalone) {
			// prevents links from apps from oppening in mobile safari
			// this javascript must be the first script in your <head>
			if ((standalone in navigator) && navigator[standalone]) {
				var curnode, location=document.location, stop=/^(a|html)$/i;
				document.addEventListener('click', function(e) {
					curnode=e.target;
					while (!(stop).test(curnode.nodeName)) {
						curnode=curnode.parentNode;
					}
					// Condidions to do this only on links to your own app
					// if you want all links, use if('href' in curnode) instead.
					if(
						'href' in curnode && // is a link
						(chref=curnode.href).replace(location.href,'').indexOf('#') && // is not an anchor
						(	!(/^[a-z\+\.\-]+:/i).test(chref) ||                       // either does not have a proper scheme (relative links)
							chref.indexOf(location.protocol+'//'+location.host)===0 ) // or is in the same protocol and domain
					) {
						e.preventDefault();
						location.href = curnode.href;
					}
				},false);
			}
		})(document,window.navigator,'standalone');
</script>

	
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

	if (isset ($_GET['newest'])) {
		$which = 'newest';
	
		$posts = bimbler_mobile_get_added_events ();
		
		$page_title = 'Recently added events';
			
	} else if (isset ($_GET['past'])) {
		$which = 'past';
	
		$posts = bimbler_mobile_get_past_events ();
		
		$page_title = 'Past events';
		
	} else {
		$which = 'upcoming';
	
		$posts = bimbler_mobile_get_upcoming_events ();
		
		$page_title = 'Up-coming events';
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


	foreach ($posts as $post) {

		//$post = $posts[0];

		$addr = get_venue_address($post->ID);
		$event_date = $post->EventStartDate;
		$rwgps_id = Bimbler_RSVP::get_instance()->get_rwgps_id ($post->ID);
		$event_month = date ($month_str, strtotime($event_date));
	
		if ($first && ('upcoming' == $which)) {					
?>						
	
				<h2 class="content-sub-heading">Next event:</h2>
											
<?php
		} else if ($first && ('newest' == $which)) {
?>
				<h2 class="content-sub-heading">Recently added:</h2>
<?php 
		} else {

			
			// Don't bother with a divider if we're rendering recently updated rides.
			if (('newest' != $which) && ($divider != $event_month)) {

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

				<a href="event.php?event=<?php echo $post->ID; ?>">
					<div class="tile">
						<div class="pull-left tile-side">
							<div class="avatar avatar-blue avatar-sm">
								<span class="icon icon-alarm"></span>
							</div>
						</div>
						<div class="tile-inner">
							<span><strong><?php echo $post->post_title; ?></strong></span><br>
							<span><?php echo date ($bimbler_mobile_time_str, strtotime($event_date)); ?></span>

							<div class="pull-right tile-side">
								<span class="icon icon-chevron-right" style="font-size: 2em; vertical-align: middle;"></span>
								<!--  <div class="avatar avatar-blue avatar-sm">
								<span class="icon chevron-right"></span> 
							</div> -->
						</div>
							
						</div>
					</div>
				</a>


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
