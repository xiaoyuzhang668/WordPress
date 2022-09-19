<form role="search" method="get" class="d-none d-lg-block search-form" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">		
		<input required type="text" class="search-field form-control" name="s" aria-describedby="search-form" id="s" placeholder="Search whole site......." value="<?php echo get_search_query() ?>" title="Search" />
		<div class="input-group-append">
	    	<span class="input-group-text bg-green">
	    		<button type="submit" class="search-submit bg-green border-0 shadow-0 fas fa-search">
				<?php 
				echo esc_attr_x( '', 'submit button' ) 
				?>
				</button>
	    	</span>	    
	  </div>		
	</div>
</form>

<style>
.overlay {
  height: 100%;
  width: 100%;
  display: none;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
}
.overlay-content {
  position: relative;
  top: 46%;
  width: 80%;
  text-align: center;
  margin-top: 30px;
  margin: auto;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  cursor: pointer;
  color: white;
}
.overlay .closebtn:hover {
  color: #ccc;
}
.overlay input[type=text] {
  padding: 15px;
  font-size: 17px;
  border: none;
  float: left;
  width: 80%;
  background: white;
}
.overlay input[type=text]:hover {
  background: #f1f1f1;
}

</style>
<!--full screen search box on mobile-->
<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
  <div class="overlay-content">
    <form role="search" method="get" class="search-form" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="input-group">	
				<input required type="text" autofocus class="rounded" name="s" aria-describedby="search-form" id="s"  value="<?php echo get_search_query() ?>" title="Search" />
				<div class="input-group-append">
						<span class="input-group-text bg-green">
							<button type="submit" class="search-submit bg-transparent border-0 shadow-0 fas fa-search">
						<?php 
						echo esc_attr_x( '', 'submit button' ) 
						?>
						</button>
						</span>	    
				</div>		
			</div>
		</form>
  </div>
</div>

<div class="openBtn d-block d-lg-none input-group-append">
		<span class="input-group-text bg-green">
			<button type="submit" class="search-submit bg-green border-0 shadow-0 fas fa-search" onclick="openSearch()">
		<?php 
		echo esc_attr_x( '', 'submit button' ) 
		?>
		</button>
		</span>	    
</div>

<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}
function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>