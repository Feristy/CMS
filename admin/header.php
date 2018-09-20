<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="../include/plugins/font-awesome/css/font-awesome.min.css">
    	<link rel="stylesheet" href="../include/plugins/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="../include/plugins/codemirror/lib/codemirror.css">
		<link rel="stylesheet" href="../include/plugins/codemirror/addon/dialog/dialog.css">
		<link rel="stylesheet" href="../include/plugins/codemirror/addon/search/matchesonscrollbar.css">
		<link rel="stylesheet" href="css/tagit-stylish-yellow.css">
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    	<div class="top-bar">
    		<div class="container-fluid">
    			<div class="row">
	    			<div class="btn-burger burger pointer"><i class="fa fa-bars"></i></div>
	    			<div class="btn-burger burger1 pointer"><i class="fa fa-bars"></i></div>
	    			<div class="navbar-brand"><strong>Administrator</strong></div>
	    			<div class="dropdown">
				        <div class="dropdown-toggle top-bar-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				          	<?php if(!empty($user_admin['img'])){?>
				          	<img src="<?=$user_img?>" class="img img-circle">
							<?php }else{?>
							<div class="no-img"><i class="fa fa-user fa-fw"></i></div>
							<?php }?>
				          </div>
				          <ul class="dropdown-menu">
				            <li><a href="<?=$set->val('url')?>" target="blank"><i class="fa fa-desktop fa-fw"></i>&nbsp;&nbsp;Visit Site</a></li>
				            <li><a href="user-new.php?edit=<?=$user_admin['id']?>"><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;Edit User</a></li>
				            <li><a href="setting.php"><i class="fa fa-cog fa-fw"></i>&nbsp;&nbsp;Setting</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>&nbsp;&nbsp;Log out</a></li>
				          </ul>
				    </div>
	    		</div>
    		</div>
    	</div>
    	<div class="admin-menu">
    		<ul class="list-unstyled">
				<li id="home">
					<a href="index.php" class="admin-menu-first" data-id="#home">
						<i class="fa fa-tachometer fa-fw"></i>
						<span>Dashbord</span>
					</a>
				</li>
				<li id="post">
					<a class="admin-menu-first" data-id="#post">
						<i class="fa fa-thumb-tack fa-fw"></i>
						<span>Post</span>
					</a>
					<ul class="submenu">
						<li><a href="post.php">All Post</a></li>
						<li><a href="post-new.php">Add New</a></li>
					</ul>
				</li>
				<li id="category">
					<a class="admin-menu-first" data-id="#category">
						<i class="fa fa-tasks fa-fw"></i>
						<span>Categories</span>
					</a>
					<ul class="submenu">
						<li><a href="category.php">All Categories</a></li>
						<li><a href="tag-new.php?type=category">Add New</a></li>
					</ul>
				</li>
				<li id="tag">
					<a class="admin-menu-first" data-id="#tag">
						<i class="fa fa-tag fa-fw"></i>
						<span>Tags</span>
					</a>
					<ul class="submenu">
						<li><a href="tag.php">All Tags</a></li>
						<li><a href="tag-new.php?type=tag">Add New</a></li>
					</ul>
				</li>
				<li id="comment">
					<a href="comment.php" class="admin-menu-first" data-id="#comment">
						<i class="fa fa-comment fa-fw"></i>
						<span>Comment</span>
					</a>
				</li>
				<li id="page">
					<a class="admin-menu-first" data-id="#page">
						<i class="fa fa-file fa-fw"></i>
						<span>Page</span>
					</a>
					<ul class="submenu">
						<li><a href="page.php">All Page</a></li>
						<li><a href="page-new.php">Add New</a></li>
					</ul>
				</li>
				<li id="media">
					<a href="library.php" class="admin-menu-first" data-id="#Library">
						<i class="fa fa-image fa-fw"></i>
						<span>Library</span>
					</a>
				</li>
				<li id="tampilan">
					<a class="admin-menu-first" data-id="#tampilan">
						<i class="fa fa-desktop fa-fw"></i>
						<span>Appearance</span>
					</a>
					<ul class="submenu">
						<li><a href="theme.php">Theme</a></li>
						<li><a href="customize.php">Customize</a></li>
						<li><a href="component.php">Component</a></li>
						<li><a href="menu.php">Menu</a></li>
					</ul>
				</li>
				<li id="user">
					<a class="admin-menu-first" data-id="#user">
						<i class="fa fa-user fa-fw"></i>
						<span>User</span>
					</a>
					<ul class="submenu">
						<li><a href="user.php">All User</a></li>
						<li><a href="user-new.php">Add New</a></li>
					</ul>
				</li>
				<li id="setting">
					<a href="setting.php" class="admin-menu-first" data-id="#setting">
						<i class="fa fa-cog fa-fw"></i>
						<span>Setting</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="contents">