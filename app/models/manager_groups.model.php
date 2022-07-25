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

}
