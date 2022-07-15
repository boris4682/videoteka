<?
$content = $mv->pages->defineCurrentPage($mv->router);
$mv->display404($content);
$mv->seo->mergeParams($content, "name");

include $mv->views_path . "main-header.php";

//Подсчет активных записей (событий) в таблице (если не передавать массив
//с параметрами будут посчитаны все записи)
$total_active = $mv->video_elements->countRecords(array('active' => 1));
//Определение текущей страницы
$current_page = $mv->router->defineCurrentPage('page');
$mv->video_elements->runPager($total_active, 15, $current_page);
// $videos = $mv->video_elements->select(array('active' => 1));

$videos = $mv->video_elements->getVideosByPagination();

?>
<style>
    .news-list-param,
    .news-list-value {
        font-size: 13px;
        color: #a4a4a4;
        padding-left: 5px;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $mv->root_path; ?>">Главная</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
    </ol>
</nav>

<div class="row news-list">
    <div class="col">
        <div class="row d-flex flex-row row-eq-height">
            <? foreach ($videos as $video) : ?>
                <div class="col-12 col-lg-4">
                    <div class="card video-box mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $video['name'] ?>
                            </h5>
                            <div class="plyr__video-embed js-player">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video['link'] ?>?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <? $date = new DateTime($video['date_create']); ?>
                            <div class="d-flex justify-content-between">
                                <div class="news-list-view news-list-post-params">
                                    <span class="news-list-icon news-list-icon-calendar"><i class="fas fa-calendar-day"></i></span>
                                    <span class="news-list-param">Дата создания: <?= $date->format('d.m.Y') ?></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="news-list-more mt-4">
                                    <a class="btn btn-main btn-sm" href="<? echo '/videos/'.$video["sec_code"] . '/' . $video["el_code"] . '/' ?>">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
<?
$path = $mv->root_path . "videos/";
if ($mv->video_elements->pager->hasPages()) {
    echo "<nav aria-label=\"Список видеороликов\">
    <ul class=\"pagination justify-content-center\">\n";
    echo $mv->video_elements->pager->displayPrevLink("предыдущая", $path);
    echo $mv->video_elements->pager->display($path, false);
    echo $mv->video_elements->pager->displayNextLink("следующая", $path);
    echo "</ul>
        </nav>\n";
}

?>


<script>
    const players = Array.from(document.querySelectorAll('.js-player')).map(p => new Plyr(p, {
        disableContextMenu: true,
        ratio: '16:9',
    }));
    // console.log(Array.from(document.querySelectorAll('.plyr__poster')));

    const poster = Array.from(document.querySelectorAll('.plyr__poster')).map((p) =>
        p.style.display = 'block'
    );
</script>

<?
include $mv->views_path . "main-footer.php";
?>