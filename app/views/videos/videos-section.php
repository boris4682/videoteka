<?
$content = $mv->pages->defineCurrentPage($mv->router);
// $mv->display404($content);
$mv->seo->mergeParams($content, "name");

include $mv->views_path . "main-header.php";

$sectionCode = $mv->router->getUrlPart(1);
if ($sectionCode) {
    $section = $mv->video_sections->findRecord(['code' => $sectionCode, 'active' => 1]);
} else {
    $section = $mv->video_sections->findRecord(['active' => 1]);
    $sectionCode = $section->code;
}
$videos = $mv->video_elements->getVideosSectionByPagination($sectionCode);
$viewedVideos = $mv->video_elements->getViewedVideos();
// echo '<pre>';
// print_r($viewedVideos);
// echo '</pre>';
$total_active = count($videos);
//Определение текущей страницы
$current_page = $mv->router->defineCurrentPage('page');

$mv->video_elements->runPager($total_active, 10, $current_page);
$videos = $mv->video_elements->getVideosSectionByPagination($sectionCode);


?>
<style>
    .news-list-param,
    .news-list-value {
        font-size: 13px;
        color: #a4a4a4;
        padding-left: 5px;
    }

    .show-video {
        color: #00c55d;
    }

    div.card-body {
        min-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .thumb {
        width: -webkit-fill-available;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $mv->root_path; ?>">Главная</a></li>
        <li class="breadcrumb-item"><a href="/videos/">Видеотека</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $section->name ?></li>
    </ol>
</nav>

<div class="row news-list">
    <div class="col-lg-2 col-sm-10 mb-3">
        <? require_once($mv->views_path . '/includes/sections-menu.php') ?>
    </div>

    <div class="col-lg-10 col-sm-12">
        <div class="row d-flex flex-row row-eq-height">
            <? foreach ($videos as $video) : ?>
                <div class="col-12 col-lg-4">
                    <div class="card video-box mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $video['name'] ?>
                            </h5>
                            <div class="plyr__video-embed js-player">
                                <a href="<? echo '/videos/' . $video["sec_code"] . '/' . $video["el_code"] . '/' ?>">
                                    <img src="/<?= $video['thumbnail'] ?>" alt="<?= $video['name'] ?>" class="thumb">
                                </a>
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
                                    <a class="btn btn-main btn-sm" href="<? echo '/videos/' . $video["sec_code"] . '/' . $video["el_code"] . '/' ?>">Подробнее</a>
                                </div>
                                <? if (in_array($video['id'], $viewedVideos)) : ?>
                                    <i class="fas fa-eye fa-2x mt-3 show-video" data-toggle="tooltip" data-placement="left" title="Просмотрено"></i>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
<?
$path = $mv->root_path . "videos/$sectionCode/";
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

    const poster = Array.from(document.querySelectorAll('.plyr__poster')).map((p) =>
        p.style.display = 'block'
    );
</script>

<?
include $mv->views_path . "main-footer.php";
?>