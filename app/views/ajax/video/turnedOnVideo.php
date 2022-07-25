<?
    include "../../../config/autoload.php";
    $mv = new Builder();
    $videoHistoryModel = new Video_History_Viewed();
    $videoHistory = $videoHistoryModel->getEmptyRecord();
    $videoHistory->user_id = $_GET['userId'];
    $videoHistory->video_id = $_GET['videoId'];
    $videoHistory->is_viewed = 1;
    $videoHistory->date_create = I18n::getCurrentDateTime();
    $videoHistory->date_update = I18n::getCurrentDateTime();
    $id = $videoHistory->create();
    echo json_encode($id, JSON_UNESCAPED_UNICODE);
?>