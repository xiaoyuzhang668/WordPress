<form role="search" method="get" class="search-form" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<div class="input-group-prepend">
	    	<span class="input-group-text">
	    		<button type="submit" class="search-submit border border-0 shadow-0 fas fa-search">
				<?php 
				echo esc_attr_x( '', 'submit button' ) 
				?>
				</button>
	    	</span>
	  	</div>		
		<input required type="text" class="search-field form-control" name="s" aria-describedby="search-form" id="s" placeholder="Search" value="<?php echo get_search_query() ?>" title="Search" />
		<span class="input-group-btn"></span>
	</div>		
</form>