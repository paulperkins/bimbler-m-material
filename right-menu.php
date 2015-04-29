<?php

	global $current_user;
	get_currentuserinfo();
	
	$avatar .= get_avatar ($current_user->ID, null, null, $current_user->user_login);
	$avatar_img = bimbler_get_avatar_img($avatar);
	$user_fmt = $current_user->user_firstname . ' ' . $current_user->user_lastname;  

 ?>
 
 	<nav class="menu menu-right" id="profile">
		<div class="menu-scroll">
			<div class="menu-wrap">
				<div class="menu-top">
					<div class="menu-top-img">
						<img alt="<?php echo $user_fmt; ?>" src="<?php echo $avatar_img; ?>">
					</div>
					<div class="menu-top-info">
						<a class="menu-top-user" href="javascript:void(0)"><span class="avatar pull-left"><img alt="<?php echo $user_fmt; ?>" src="<?php echo $avatar_img; ?>"></span><?php echo $user_fmt; ?></a>
					</div>
				</div>
				<div class="menu-content">
					<ul class="nav">
						<li>
							<a href="javascript:void(0)"><span class="icon icon-account-box"></span>Profile Settings</a>
						</li>
						<li>
							<a href="javascript:void(0)"><span class="icon icon-add-to-photos"></span>Upload Photo</a>
						</li>
						<li>
							<a href="page-login.html"><span class="icon icon-exit-to-app"></span>Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="menu menu-right menu-search" id="search">
		<div class="menu-scroll">
			<div class="menu-wrap">
				<div class="menu-top">
					<div class="menu-top-info">
						<form class="menu-top-form">
							<label class="access-hide" for="menu-search">Search</label>
							<input class="form-control form-control-inverse menu-search-focus" id="menu-search" placeholder="Search" type="search">
							<button class="access-hide" type="submit">Search</button>
						</form>
					</div>
				</div>
				<div class="menu-content">
					<div class="menu-content-inner">
						<p><strong>Saved Search Queries:</strong></p>
						<ul>
							<li><a href="javascript:void(0)">lorem ipsum dolor sit amet</a></li>
							<li><a href="javascript:void(0)">consectetur adipiscing elit</a></li>
							<li><a href="javascript:void(0)">sed ornare orci lorem</a></li>
							<li><a href="javascript:void(0)">vel eleifend elit tempor eleifend</a></li>
							<li><a href="javascript:void(0)">morbi feugiat aliquet justo</a></li>
						</ul>
						<hr>
						<p><strong>Popular Search Queries:</strong></p>
						<ul>
							<li><a href="javascript:void(0)">id ullamcorper tortor lobortis eu</a></li>
							<li><a href="javascript:void(0)">aliquam ut tellus arcu</a></li>
							<li><a href="javascript:void(0)">cestibulum tortor purus</a></li>
							<li><a href="javascript:void(0)">pretium ac dolor id</a></li>
							<li><a href="javascript:void(0)">gravida molestie libero</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
 
 <?php 
 ?>