<?
$count_records = $mv->news->countRecords(array("active" => 1));
$current_page = $mv->router->defineCurrentPage("page");
$mv->news->runPager($count_records, 7, $current_page);

$path = $mv->root_path . "news/";

$mv->seo->mergeParams("Новости");
include $mv->views_path . "main-header.php";
?>
<div class="wrapper">
    <div id="content">
        <div class="breadcrumbs">
            <a href="<? echo $mv->root_path; ?>">Главная</a>
        </div>
        <h1>Новости</h1>
        <div class="news-list">
            <?
            // echo $mv->news->display();

            if ($mv->news->pager->hasPages()) {
                // echo "<div class=\"pager\">\n<span>Страница</span>\n";
                // echo $mv->news->pager->displayPrevLink("предыдущая", $path);
                // echo $mv->news->pager->display($path, false);
                // echo $mv->news->pager->displayNextLink("следующая", $path);
                // echo "</div>\n";
            }
            ?>
        </div>
    </div>
</div>
<?
include $mv->views_path . "main-footer.php";
?>