<?php
	global $current_user;
	get_currentuserinfo();
	
	$avatar .= get_avatar ($current_user->ID, null, null, $current_user->user_login);
	$avatar_img = bimbler_get_avatar_img($avatar);
	$user_fmt = $current_user->user_firstname . ' ' . $current_user->user_lastname;
?>

<nav class="menu" id="menu">
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
					<li><a href="index.php"><span class="icon icon-home"></span>Up-coming events</a></li>
					<li><a href="index.php?past=1"><span class="icon icon-access-time"></span>Past events</a></li>
					<li><a href="index.php?newest=1"><span class="icon icon-star"></span>Recently-added</a></li>
<!--  					<li><a href="ui-modal.html">Modals &amp; Toasts</a></li>
					<li><a href="ui-nav.html">Navs</a></li>
					<li><a href="ui-progress.html">Progress Bars</a></li>
					<li><a href="ui-tab.html">Tabs</a></li>
					<li><a href="ui-tile.html">Tiles</a></li> ->
				</ul>
				<hr>
<!--				<ul class="nav">
					<li><a href="ui-button.html">Buttons</a></li>
					<li><a href="ui-form.html">Form Elements</a> <span
						class="menu-collapse-toggle collapsed"
						data-target="#form-elements" data-toggle="collapse"><i
							class="icon icon-close menu-collapse-toggle-close"></i><i
							class="icon icon-add menu-collapse-toggle-default"></i></span>
						<ul class="menu-collapse collapse" id="form-elements">
							<li><a href="ui-form-adv.html">Form Elements <small>(materialised)</small></a>
							</li>
						</ul></li>
					<li><a href="ui-icon.html">Icons</a></li>
					<li><a href="ui-table.html">Tables</a></li>
				</ul>
				<hr>
				<ul class="nav">
					<li><a href="page-affix.html">Full-Width Page <small>(with fixed
								LHC/RHC)</small></a></li>
					<li><a href="page-palette.html">Page Palettes</a> <span
						class="menu-collapse-toggle collapsed"
						data-target="#page-palettes" data-toggle="collapse"><i
							class="icon icon-close menu-collapse-toggle-close"></i><i
							class="icon icon-add menu-collapse-toggle-default"></i></span>
						<ul class="menu-collapse collapse" id="page-palettes">
							<li><a href="page-palette-blue.html">Blue Palette</a></li>
							<li><a href="page-palette-green.html">Green Palette</a></li>
							<li><a href="page-palette-purple.html">Purple Palette</a></li>
							<li><a href="page-palette-red.html">Red Palette</a></li>
							<li><a href="page-palette-yellow.html">Yellow Palette</a></li>
						</ul></li>
				</ul> -->
			</div>
		</div>
	</div>
</nav>

<?php 
?>

