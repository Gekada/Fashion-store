<div class="panel panel-default sidebar-menu">
	<div class="panel-heading">
		<h3 class="panel-title">Products categories</h3>
	</div>
	<div class="panel-body scroll-menu">
		<ul id="p_cat" class="nav nav-pills nav-stacked category-menu">
		<?php
			getPCats();
		?>
		</ul>
	</div>
</div>

<div class="panel panel-default sidebar-menu">
	<div class="panel-heading">
		<h3 class="panel-title">Categories</h3>
	</div>
	<div class="panel-body scroll-menu">
		<ul id="cat1" class="nav nav-pills nav-stacked category-menu">
			<?php
				getCats();
			?>
		</ul>
	</div>
</div>

