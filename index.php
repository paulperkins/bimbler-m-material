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
 
	include_once ('../m/events.php');

?>

<body>
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
			
						<h2 class="content-sub-heading">Next event:</h2>
						
<?php

	global $bimbler_mobile_day_time_str;

	$posts = bimbler_mobile_get_upcoming_events ();

	$post = $posts[0];

	$addr = get_venue_address($post->ID);
	$event_date = $post->EventStartDate;
	$rwgps_id = Bimbler_RSVP::get_instance()->get_rwgps_id ($post->ID);

						// First event - card format (with map).
?>						
						
						<div class="card-wrap">
							<div class="row">
					
								<div class="col-lg-3 col-md-4 col-sm-6">
									<a href="">
									<div class="card">
										<div class="card-main">
											<div class="card-img">
											
<?php

	// Show start point in preference to the map.											
	if (!empty ($addr)) {

		echo '				<div class="tribe-events-venue-map">' . PHP_EOL;
		echo tribe_get_embedded_map ($post->ID, '100%', '150px', true) . PHP_EOL;
		echo '				</div>' . PHP_EOL;

	} /*elseif (!empty ($rwgps_id)) {

		echo bimbler_mobile_render_map_iframe ($post->ID, $rwgps_id);

	}*/ else {

		// Do something...

	}
?>
							
												<!--  <img alt="alt text" src="images/samples/landscape.jpg"> -->
												<p class="card-img-heading"><?php echo $post->post_title; ?></p>
											</div>
											<div class="card-inner">
												<p><?php echo date ($bimbler_mobile_day_time_str, strtotime($event_date)) ?></p>
												<p><?php echo $post->excerpt; ?></p>
											</div>
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
									</a>
								</div>
				
							</div>
						</div>			
<?php

						// End first event card.

	//}
?>


					
<!--  					</div>
				</div> -->			
		
			
				<h2 class="content-sub-heading">Simple Tiles</h2>
				<div class="tile-wrap tile-wrap-animation">
					<div class="tile">
						<div class="pull-left tile-side">
							<div class="avatar avatar-blue avatar-sm">
								<span class="icon icon-alarm"></span>
							</div>
						</div>
						<div class="tile-inner">
							<span>lorem ipsum dolor sit amet</span>
						</div>
					</div>
					<div class="tile">
						<div class="pull-left tile-side">
							<div class="avatar avatar-green avatar-sm">
								<span class="icon icon-backup"></span>
							</div>
						</div>
						<div class="tile-inner">
							<span>consectetur adipiscing elit</span>
						</div>
					</div>
					<div class="tile">
						<div class="pull-left tile-side">
							<div class="avatar avatar-red avatar-sm">
								<span class="icon icon-launch"></span>
							</div>
						</div>
						<div class="tile-inner">
							<span>sed ornare orci lorem</span>
						</div>
					</div>
				</div>			
			
			
			
			
				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						<p>Material is an HTML5 UI design based on Google Material.</p>
						<blockquote>
							<p>A visual language for our users that synthesizes the classic principles of good design with the innovation and possibility of technology and science. This is material design.</p>
							<p><a class="text-break" href="http://www.google.com/design/spec/material-design/introduction.html">http://www.google.com/design/spec/material-design/introduction.html</a></p>
						</blockquote>
						<p>Have a play with a <a href="http://daemonite.github.io/material/">working prototype of Material</a>, let us know what you think at the <a href="http://labs.daemon.com.au">Daemon Labs</a> forum.</p>
						<h2 class="content-sub-heading">Components</h2>
						<div class="tile-wrap tile-wrap-animation">
							<a class="tile" href="ui-card.html">
								<div class="tile-inner">
									<span>Cards</span>
								</div>
							</a>
							<a class="tile" href="ui-collapse.html">
								<div class="tile-inner">
									<span>Collapsible Regions</span>
								</div>
							</a>
							<a class="tile" href="ui-dropdown.html">
								<div class="tile-inner">
									<span>Dropdowns</span>
								</div>
							</a>
							<a class="tile" href="ui-modal.html">
								<div class="tile-inner">
									<span>Modal &amp; Toasts</span>
								</div>
							</a>
							<a class="tile" href="ui-nav.html">
								<div class="tile-inner">
									<span>Navs</span>
								</div>
							</a>
							<a class="tile" href="ui-progress.html">
								<div class="tile-inner">
									<span>Progress Bars</span>
								</div>
							</a>
							<a class="tile" href="ui-tab.html">
								<div class="tile-inner">
									<span>Tabs</span>
								</div>
							</a>
							<a class="tile" href="ui-tile.html">
								<div class="tile-inner">
									<span>Tiles</span>
								</div>
							</a>
						</div>
						<h2 class="content-sub-heading">Elements</h2>
						<div class="tile-wrap tile-wrap-animation">
							<a class="tile" href="ui-button.html">
								<div class="tile-inner">
									<span>Button</span>
								</div>
							</a>
							<a class="tile" href="ui-form.html">
								<div class="tile-inner">
									<span>Form Elements <small>(basic)</small></span>
								</div>
							</a>
							<a class="tile" href="ui-form-adv.html">
								<div class="tile-inner">
									<span>Form Elements <small>(materialised)</small></span>
								</div>
							</a>
							<a class="tile" href="ui-icon.html">
								<div class="tile-inner">
									<span>Icons</span>
								</div>
							</a>
							<a class="tile" href="ui-table.html">
								<div class="tile-inner">
									<span>Tables</span>
								</div>
							</a>
						</div>
						<h2 class="content-sub-heading">Sample Pages</h2>
						<div class="tile-wrap tile-wrap-animation">
							<a class="tile" href="page-404.html">
								<div class="tile-inner">
									<span>404 Error Page</span>
								</div>
							</a>
							<a class="tile" href="page-500.html">
								<div class="tile-inner">
									<span>500 Error Page</span>
								</div>
							</a>
							<a class="tile" href="page-affix.html">
								<div class="tile-inner">
									<span>Full-Width Page <small>(with fixed LHC/RHC)</small></span>
								</div>
							</a>
							<a class="tile" href="page-login.html">
								<div class="tile-inner">
									<span>Login Page</span>
								</div>
							</a>
							<a class="tile" href="page-palette.html">
								<div class="tile-inner">
									<span>Page Palettes</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
			<p>Material</p>
		</div>
	</footer>
	<div class="fbtn-container">
		<div class="fbtn-inner">
			<a class="fbtn fbtn-red" href="https://github.com/Daemonite/material"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
		</div>
	</div>

	<script src="js/base.min.js" type="text/javascript"></script>
	
	<script src="../m/bimbler-bs.js"></script> 
	
</body>
</html>