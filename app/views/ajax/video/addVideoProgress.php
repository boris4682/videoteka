<?
    include "../../../config/autoload.php";
    $mv = new Builder();
    $videoHistoryModel = new Video_History_Viewed();
    $videoHistory = $videoHistoryModel->findRecord(['user_id' => $_GET['userId'], 'video_id' => $_GET['videoId']]);
    $progressValue = $videoHistory->viewing_progress ;
    $videoHistory->viewing_progress = $progressValue + $_GET['progressValue'];
    $videoHistory->date_update = I18n::getCurrentDateTime();
    $videoHistory->last_time = $_GET['curTime'];
    $videoHistory->update();
    echo json_encode(true, JSON_UNESCAPED_UNICODE);
?>