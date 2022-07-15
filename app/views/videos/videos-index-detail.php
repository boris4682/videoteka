<?
$record = $mv -> news -> defineNewsPage($mv -> router);
// $mv -> display404($record);
$mv -> seo -> mergeParams($record, "name");
 
include $mv -> views_path."main-header.php";
?>
<div class="wrapper">
    <div id="content">
        <div class="breadcrumbs">
            <a href="<? echo $mv -> root_path; ?>">Главная</a>
            <a href="<? echo $mv -> root_path; ?>news/">Новости</a>
        </div>
        <h1><? echo $record -> name; ?></h1>
        <div class="news-inside-date"><? echo I18n :: formatDate($record -> date); ?></div>
        <div class="news-inside-content">
        <?
            echo $mv -> news -> cropImage($record -> image, 383, 258);
            echo $record -> content;
        ?>
        </div>
        <div id="previous-next">
            <? echo $mv -> news -> displayPreviousAndNext($record -> id, $record -> date); ?>
        </div>   
    </div>
</div>
<?
include $mv -> views_path."main-footer.php";
?>