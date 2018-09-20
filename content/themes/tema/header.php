<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="<?=$set->val('url')?>include/plugins/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="<?=$set->val('url')?>include/plugins/font-awesome/css/font-awesome.min.css">
    	<link rel="stylesheet" href="<?=$set->val('url').$path?>style.css">
    </head>
    <body>
    	<nav class="navbar blog-nav">
			<div class="container">
			    <div class="navbar-header">
			      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					    <span class="sr-only">Toggle navigation</span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
			      	</button>
			    	<a class="navbar-brand" href="#">Brand</a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  	<ul class="nav navbar-nav"><?=get_menu('menu')?></ul>
					<form method="post" class="nav navbar-form navbar-right">
					<input type="text" class="form-control" name="search" value="<?=@$search?>" placeholder="Search">
					</form>
			    </div>
			</div>
		</nav>
    