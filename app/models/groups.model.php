<?
class Groups extends Model
{
	protected $name = 'Группы';

	protected $model_elements = [
		// ['Id', 'int', 'id', ['required' => true]],
		['Название', 'char', 'name', ['required' => true]],
		['Описание', 'char', 'description', ['required' => true]],
        ['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
	];

}
