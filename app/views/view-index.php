<?
$content = $mv -> pages -> defineCurrentPage($mv -> router);
$mv -> display404($content);
$mv -> seo -> mergeParams($content, "name");

include $mv -> views_path."main-header.php";
?>
<div class="content">
	<h1><? echo $content -> name; ?></h1>
	<p><img src="<? echo $mv -> root_path; ?>adminpanel/interface/images/logo.png" alt="" /></p>
	<p>Version <? echo $mv -> registry -> getVersion()." ".$mv -> registry -> getSetting("DbEngine"); ?><br />
	Project folder <? echo $mv -> root_path; ?><br />
	Media files folder <? echo $mv -> media_path; ?><br />
	Views folder <? echo $mv -> views_path; ?><br />
	<a href="<? echo $mv -> registry -> getSetting("AdminPanelPath"); ?>" target="_blank">Admin Panel</a>,
	login root, password root
	</p>
	<? echo $content -> content; ?>
</div>
<?
include $mv -> views_path."main-footer.php";
?>