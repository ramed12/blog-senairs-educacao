<?php
$menu_name = 'primary';
if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
	$menu = wp_get_nav_menu_object($locations[$menu_name]);
	$menu_items = wp_get_nav_menu_items($menu->term_id);
}
?>

<?php
$menu_name = 'primary';
if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
	$menu = wp_get_nav_menu_object($locations[$menu_name]);
	$menu_items = wp_get_nav_menu_items($menu->term_id);
}

?>

<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container py-3">

		<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png'; ?>" alt="Logo SESI">
		</a>

		<div class="col-sm-4 col-12 d-none d-sm-block" style="margin-left: 50px;">
			<form action="/" method="get" class="d-sm-flex">
				<input type="text" name="s" class="search-input searchIndexMain w-75" placeholder="Qual conteúdo você procura?" value="<?php the_search_query(); ?>" />
				<button class="btnsearchIndexMain text-end w-25" style="border: solid 1px white;border-left: none; padding: 7px 38px 9px 0px;"> <i class="fa-solid fa-magnifying-glass iconSearchss"></i></button>
			</form>
		</div>

		<button class="d-block d-sm-none btn btn-search" style="margin-left: 30px;">
			<i class="fas fa-search fa-2x"></i>
		</button>
		<button class="navbar-toggler border-0" style="color:#212529;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars fa-2x"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-sm-auto">
				<?php
				foreach ($menu_items as  $menu_item) {
					if ($menu_item->menu_item_parent == 0) {
						$parent = $menu_item->ID;
				?>
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
						</li>
				<?php
					}
				}
				?>

				<li class="nav-item"><a class="nav-link" href="https://www.senairs.org.br/contato"><i class="fas fa-comment-dots"></i></a></li>
			</ul>
		</div>
	</div>
</nav>

<div id="search" class="bg-light search py-2 px-1" style="margin-top:-2px;display:none">
<form action="/" method="get">
    <input type="text" name="s" class="form-control search-mobile" style="border-radius:0;border:none" placeholder="Digite sua busca..."  value="<?php the_search_query(); ?>" />
</form>
</div>