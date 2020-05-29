		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="categories.php"><!-- <span class="glyphicon glyphicon-plus-sign"></span>--> doughboys</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php if ($usuarioid > 0) { ?>
					<ul class="nav navbar-nav">
						<li><a href="categories.php">Categories</a></li>
						<li><a href="products.php">Products</a></li>
						<!-- <li><a href="ingredients.php">Ingredients</a></li> -->
					</ul>
					<?php } ?>
					<?php if ($usuarioid > 0) { ?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">admin <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="logout.php">Close session</a></li>
							</ul>
						</li>
					</ul>
					<?php } ?>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>