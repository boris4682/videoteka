<?
$content = $mv->pages->defineCurrentPage($mv->router);
$mv->display404($content);
$mv->seo->mergeParams($content, "name");

$usersInfo = $mv->manager_groups->getUserInfo();

if ($_POST['user'] > 0) {
	$videoHistory = $mv->video_history_viewed->getHistory($_POST['user']);
	$count = 1;
}
// echo '<pre>';
// print_r($mv->views_path . "main-footer.php");
// echo '</pre>';
include $mv->views_path . "main-header.php";
?>
<div class="content w-75 m-auto">
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
	<? if (!in_array($managerGroupId, $userGroups)) : ?>
		<p class="lead">
			У вас нет прав просмотра.
		</p>
	<? else : ?>
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="user-field nb-3">Статистика пользователя</label>
				<select class="form-control" id="user-field" name="user">
					<option value="0" selected>Выберите пользователя</option>
					<? foreach ($usersInfo as $user) : ?>
						<option value="<?= $user['id'] ?>" <? if ($user['id'] == $_POST['user']) echo 'selected'; ?>><?= $user['name'] ?></option>
					<? endforeach; ?>
				</select>
			</div>
			<button type="submit" class="btn btn-dark">Загрузить информацию</button>
		</form>
		<? if (count($videoHistory) > 0) : ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Видео</th>
							<th scope="col">Начало просмотра</th>
							<th scope="col">Последний просмотр</th>
							<th scope="col">Длительность просмотра в % от видео</th>
							<th scope="col">Остановился в видео на</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($videoHistory as $key => $video) : ?>
							<tr>
								<th scope="row"><?= $count ?></th>
								<td><a href="<?= '/videos/' . $video['section_code'] . '/' . $video['code'] ?>/"><?= $video['name'] ?></a></td>
								<td><?= I18n::formatDate($video['date_create']) ?></td>
								<td><?= I18n::formatDate($video['date_update']) ?></td>
								<td><?= $video['viewing_progress'] * 100 ?> %</td>
								<?
								$sec = $video['last_time'] % 60;
								$video['last_time'] = floor($video['last_time'] / 60);
								$min = $video['last_time'] % 60;
								$video['last_time'] = floor($video['last_time'] / 60);
								?>
								<td><?= $video['last_time'] . ":" . $min . ":" . $sec; ?></td>
							</tr>
							<? $count++;	?>
						<? endforeach; ?>
					</tbody>
				</table>
			</div>
		<? endif; ?>
	<? endif; ?>
</div>
<?
include $mv->views_path . "main-footer.php";
?>