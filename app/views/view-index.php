<?
$content = $mv->pages->defineCurrentPage($mv->router);
$mv->display404($content);
$mv->seo->mergeParams($content, "name");

include $mv->views_path . "main-header.php";
?>
<div class="content text-center">
	<p>
		Добро пожаловать к нам!
	</p>
	<p>
		У нас обширная <a href="/videos/">Видеотека</a>, которая может стать вам лучшим специалистом.
	</p>
</div>
<?
include $mv->views_path . "main-footer.php";
?>