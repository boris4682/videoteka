<?
$content = $mv->pages->defineCurrentPage($mv->router);
$mv->display404($content);
$mv->seo->mergeParams($content, "name");

include $mv->views_path . "main-header.php";

//Подсчет активных записей (событий) в таблице (если не передавать массив
//с параметрами будут посчитаны все записи)
$total_active = $mv->video_elements->countRecords(array('active' => 1));
//Определение текущей страницы
$current_page = $mv->router->defineCurrentPage(1);

// $videos = $mv->video_elements->select(array('active' => 1));
$videos = $mv->db->getAll(
    "SELECT video_elements.name, link, video_elements.date_create, video_elements.code as el_code, video_sections.code as sec_code
                                FROM video_elements JOIN video_sections ON section_parent = video_sections.id
                                WHERE video_elements.active = 1"
);
// echo '<pre>';
// print_r($videos);
// echo '</pre>';
?>
<style>
    .news-list-param,
    .news-list-value {
        font-size: 13px;
        color: #a4a4a4;
        padding-left: 5px;
    }
</style>
<div class="row news-list">
    <div class="col">
        <div class="row d-flex flex-row row-eq-height">
            <? foreach ($videos as $video) : ?>
                <div class="col-12 col-lg-4">
                    <div class="card video-box mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?=$video['name'] ?>
                            </h5>
                            <div class="plyr__video-embed js-player">
                                <?=$video['link'] ?>
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
                                    <a class="btn btn-main btn-sm" href="<? echo '/'.$video["sec_code"].'/'.$video["el_code"] ?>">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>

<script>
    const players = Array.from(document.querySelectorAll('.js-player')).map(p => new Plyr(p, {
        disableContextMenu: true,
        ratio: '16:9',
    }));
    console.log(Array.from(document.querySelectorAll('.plyr__poster')));

    const poster = Array.from(document.querySelectorAll('.plyr__poster')).map((p) =>
        p.style.display = 'block'
    );
</script>

<?
include $mv->views_path . "main-footer.php";
?>