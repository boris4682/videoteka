<?
$res = $mv->video_elements->defineVideosPage($mv->router);
$video = $res['video'];
$mv->display404($video);
$mv->seo->mergeParams($video, "name");
// echo '<pre>';
// 			print_r($video->date_create);
// 			echo '</pre>';
include $mv->views_path . "main-header.php";
?>
<style>
    .news-detail-title,
    .news-detail-title a {
        margin: 0;
        padding: 2px 0 15px;
        border-bottom: none;
        color: #000;
        font-weight: 600;
        font-size: 18px;
    }

    .news-detail .card-title a:hover {
        border-bottom-color: transparent;
        text-decoration: none;
    }

    .news-detail-view,
    .news-detail-date,
    .news-detail-comments,
    .news-detail-author,
    .news-detail-other {
        padding-bottom: 5px;
        color: #a4a4a4;
        white-space: nowrap;
        font-size: 13px;
    }

    .news-detail-view i.fa,
    .news-detail-date i.fa,
    .news-detail-comments i.fa,
    .news-detail-author i.fa,
    .news-detail-tags i.fa,
    .news-detail-other i.fa {
        width: 13px;
        color: #b4b4b4;
    }

    .news-detail-tags {
        padding-bottom: 5px;
        color: #a4a4a4;
        font-size: 13px;
    }

    .news-detail-content {
        margin-bottom: 5px;
        font-size: 14px;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $mv->root_path; ?>">Главная</a></li>
        <li class="breadcrumb-item"><a href="/videos/">Видеотека</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$res['sectionName']?></li>
    </ol>
</nav>
<div class="news-detail">
    <div class="mb-3">
        <div class="plyr__video-embed w-100" id="player">
            <iframe  src="https://www.youtube.com/embed/<?= $video->link ?>?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div class="news-detail-body">
            <h3 class="news-detail-title mt-4"><?= $video->name ?></h3>
            <div class="news-detail-content">
            </div>
        </div>
        <?$date = new DateTime($video->date_create);?>
        <div class="news-detail-date">Дата создания: <?= $date->format('d.m.Y') ?></div>
    </div>
    <p>
        <a href="/videos/<?=$res['sectionCode']?>" class="btn btn-dark"> Вернуться назад</a>
    </p>
</div>
<script type="text/javascript">
    const player = new Plyr('#player', {
        disableContextMenu: true,
        ratio: '16:9',
    });

    const poster = document.querySelector('.plyr__poster');
    poster.style.display = 'block';
</script>
<?
include $mv->views_path . "main-footer.php";
?>