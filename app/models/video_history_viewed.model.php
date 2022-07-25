<?
class Video_History_Viewed extends Model
{
	protected $name = 'История просмотров';

	protected $model_elements = [
		['Пользователь', 'int', 'user_id', ['required' => true]],
		['Идентификатор видео', 'int', 'video_id', ['required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
		['Прогресс просмотра', 'float', 'viewing_progress', ['required' => false]],
		['Последнее время', 'int', 'last_time', ['required' => false]],
		['Просмотрено', 'bool', 'is_viewed', ['required' => true]],
	];

	public function checkViews($videoId)
	{
		global $account;
		return !empty($this->select(['user_id' => $account->id, 'video_id' => $videoId]));
	}
	
	public function getLastTime($videoId)
	{
		global $account;
		$res = $this->findRecord(['user_id' => $account->id, 'video_id' => $videoId]);

		return $res->last_time ?? 0;
	}

	public function isSalonEmployee()
	{
		global $userGroups, $mv;
		$salonGroups = array_column($mv->manager_groups->select(), 'group_id');
		
		return !empty(array_intersect($userGroups, $salonGroups));
	}
}
