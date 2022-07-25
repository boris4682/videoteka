<?
class Manager_Groups extends Model
{
	protected $name = 'Группы руководителей';

	protected $model_elements = [
		['Руководитель', 'enum', 'manager_id', ['foreign_key' => 'Accounts', 'required' => true]],
		['Идентификатор группы', 'enum', 'group_id', ['foreign_key' => 'Groups', 'required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
	];

	public function getUserInfo()
	{
		global $account;
		$res = $this->findRecord(['manager_id' => $account->id]);

		$query = "SELECT accounts.id, accounts.name  FROM video_history_viewed 
			JOIN user_groups ON video_history_viewed.user_id = user_groups.user_id
			JOIN accounts ON video_history_viewed.user_id = accounts.id
		WHERE user_groups.group_id = $res->group_id";

		$usersInfo = $this->db->getAll($query);

		return $usersInfo;
	}

}
