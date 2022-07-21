<?
class User_Groups extends Model
{
	protected $name = 'Группы пользователей';

	protected $model_elements = [
		// ['Id', 'int', 'id', ['required' => true]],
		['Пользователь', 'int', 'user_id', ['required' => true]],
		['Идентификатор группы', 'int', 'group_id', ['required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
	];

}
