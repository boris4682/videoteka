<?
$sections = $mv->video_sections->select(['active' => 1]);
$sectionCode = $sectionCode ?? '';
?>
<div class="list-group">
    <? foreach ($sections as $section) : ?>
        <a href="/videos/<?=$section['code']?>/" class="list-group-item list-group-item-action <?if($section['code'] == $sectionCode) echo 'active'?>">
            <?=$section['name']?>
        </a>
    <? endforeach; ?>
</div>