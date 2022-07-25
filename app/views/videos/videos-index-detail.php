<?
$res = $mv->video_elements->defineVideosPage($mv->router);
$video = $res['video'];
$isViewed = $mv->video_history_viewed->checkViews($video->id) ? 1 : 0;
$isSalonEmployee = $mv->video_history_viewed->isSalonEmployee() ? 1 : 0;
$lastTime = $mv->video_history_viewed->getLastTime($video->id);
$mv->display404($video);
$mv->seo->mergeParams($video, "name");
// echo '<pre>';
// print_r($isViewed);
// echo '</pre>';
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

    .showed {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        color: #fff;
        background-color: #00c55d;
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
        <li class="breadcrumb-item active" aria-current="page"><?= $res['sectionName'] ?></li>
    </ol>
</nav>
<div class="news-detail">
    <div class="mb-3">
        <div class="plyr__video-embed w-100" id="player">
            <iframe src="https://www.youtube.com/embed/<?= $video->link ?>?controls=0&vq=hd1080" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div class="news-detail-body">
            <h3 class="news-detail-title mt-4">
                <?= $video->name ?>
                <? if ($isViewed) : ?>
                    <span class="showed">Просмотрено</span>
                <? endif; ?>
            </h3>
            <div class="news-detail-content">
            </div>
        </div>
        <? $date = new DateTime($video->date_create); ?>
        <div class="news-detail-date">Дата создания: <?= $date->format('d.m.Y') ?></div>
    </div>
    <p>
        <a href="/videos/<?= $res['sectionCode'] ?>" class="btn btn-dark"> Вернуться назад</a>
    </p>
</div>
<script type="text/javascript">
    let videoId = <?= $video->id ?>;
    let userId = <?= $account->id ?>;
    let isViewed = <?= $isViewed ?>;
    let isSalonEmployee = <?= $isSalonEmployee ?>;

    let ajaxPath = '/views/ajax/video/';
    let progressSum = 0;
    let lastProgressValue = 0;

    const player = new Plyr('#player', {
        // settings: ['quality'],
        quality: {
            default: '1080'
        },
        disableContextMenu: true,
        ratio: '16:9',
        youtube: {
            start: <?= $lastTime ?>
        },
        // quality: { default: 1080, options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240] }
    });

    if (isSalonEmployee) {
        player.on('playing', (event) => {
            if (!isViewed) {
                $.ajax({
                    dataType: 'json',
                    url: ajaxPath + 'turnedOnVideo.php?userId=' + userId + '&videoId=' + videoId,
                    success: function(data) {
                        if (data > 0) {
                            isViewed = true;
                        }
                        // console.log(data);
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            }
        });

        player.on('progress', (event) => {
            const instance = event.detail.plyr;
            let progressTime = parseFloat((instance.media.currentTime - lastProgressValue).toFixed(3));
            progressSum += progressTime;
            if (progressSum > 10) {
                let progressValue = (progressSum / instance.media.duration).toFixed(3);
                $.ajax({
                    dataType: 'json',
                    url: ajaxPath + 'addVideoProgress.php?userId=' + userId + '&videoId=' + videoId + '&progressValue=' + progressValue + '&curTime=' + Math.round(instance.media.currentTime),
                    success: function(data) {

                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                progressSum = 0;
            }

            lastProgressValue = instance.media.currentTime;
        });
    }

    const poster = document.querySelector('.plyr__poster');
    poster.style.display = 'block';
</script>
<?
include $mv->views_path . "main-footer.php";
?>