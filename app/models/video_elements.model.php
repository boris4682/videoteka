<?
class Video_Elements extends Model
{
	protected $name = 'Видео';

	protected $model_elements = [
		['Id', 'int', 'active', ['required' => true]],
		['Название', 'char', 'name', ['required' => true]],
		['Код', 'url', 'code',  ['required' => true, 'unique' => true, 'translit_from' => 'name']],
		['Идентификатор видео', 'char', 'link', ['required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
		['Активен', 'bool', 'active', ['required' => true]],
		['Сортировка', 'int', 'sort', ['required' => true]],
		['Раздел', 'enum', 'section_parent', ["foreign_key" => "Video_Sections", 'required' => true]],
	];

	public function defineNewsPage(Router $router)
	{
		$url_parts = $router->getUrlParts();
		$record = false;

		if (count($url_parts) == 2)
			if (is_numeric($url_parts[1]))
				$record = $this->findRecord(array("id" => $url_parts[1], "active" => 1));
			else
				$record = $this->findRecord(array("url" => $url_parts[1], "active" => 1));

		return $record;
	}
}
