<?
class Video_Sections extends Model
{
	protected $name = 'Разделы';
	
	protected $model_elements = [
		// ['Id', 'int', 'id', ['required' => true]],
		['Название', 'char', 'name', ['required' => true]],
		['Код', 'url', 'code',  ['required' => true, 'unique' => true, 'translit_from' => 'name']],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
		['Активен', 'bool', 'active', ['required' => true]],
		['Сортировка', 'int', 'sort', ['required' => true]],
		['Видео', 'many_to_one', 'videos', ['related_model' => 'Video_Elements']],
	];
}
?>