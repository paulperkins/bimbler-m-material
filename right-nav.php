<?php

	global $current_user;
	get_currentuserinfo();
	
	$avatar .= get_avatar ($current_user->ID, null, null, $current_user->user_login);
	$avatar_img = bimbler_get_avatar_img($avatar);
	$user_fmt = $current_user->user_firstname . ' ' . $current_user->user_lastname;
?>

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
					<span class="access-hide"><?php echo $user_fmt ?></span>
					<span class="avatar avatar-sm"><img alt="<?php echo $user_fmt ?>" src="<?php echo $avatar_img; ?>"></span>
					<span class="header-close icon icon-close"></span>
				</a>
			</li>
		</ul>
	</header>
