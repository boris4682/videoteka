<?
class Video_Elements extends Model
{
	protected $name = 'Видео';

	protected $model_elements = [
		// ['Id', 'int', 'id', ['required' => true]],
		['Название', 'char', 'name', ['required' => true]],
		['Код', 'url', 'code',  ['required' => true, 'unique' => true, 'translit_from' => 'name']],
		['Идентификатор видео', 'char', 'link', ['required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
		['Активен', 'bool', 'active', ['required' => true]],
		['Сортировка', 'int', 'sort', ['required' => true]],
		['Превью', 'image', 'thumbnail', ['required' => true]],
		['Раздел', 'enum', 'section_parent', ['foreign_key' => 'Video_Sections', 'required' => true]],
	];

	public function defineVideosPage(Router $router)
	{
		$url_parts = $router->getUrlParts();
		$video = false;

		if (count($url_parts) == 3){
			global $mv;

			$section = $mv->video_sections->findRecord(['code' => $url_parts[1], 'active' => 1]);
			if($section->getId() > 0){
				$video = $this->findRecord(['code' => $url_parts[2], 'active' => 1, 'section_parent' => $section->getId()]);
				$res = ['video' => $video, 'sectionName' => $section->name, 'sectionCode' => $section->code];
			}
			// echo '<pre>';
			// print_r($video);
			// echo '</pre>';
		}

		return $res;
	}

	public function getVideosByPagination(){
		global $mv;
		$videos = $mv->db->getAll(
			"SELECT video_elements.name, link, video_elements.date_create, video_elements.thumbnail, video_elements.code as el_code, video_sections.code as sec_code
				FROM video_elements JOIN video_sections ON section_parent = video_sections.id
				WHERE video_elements.active = 1
				ORDER BY video_elements.section_parent ASC, video_elements.sort ASC 
				LIMIT ". $this -> pager -> getParamsForSelect() 
		);

		return $videos;
	}

	public function getVideosSectionByPagination($sectionCode){
		global $mv;
		$query = "SELECT video_elements.name, link, video_elements.date_create, video_elements.thumbnail,  video_elements.code as el_code, video_sections.code as sec_code
			FROM video_elements JOIN video_sections ON section_parent = video_sections.id
			WHERE video_elements.active = 1 AND video_sections.code = '$sectionCode'
			ORDER BY video_elements.section_parent ASC, video_elements.sort ASC";
		if($this -> pager){
			$query .= " LIMIT ". $this -> pager -> getParamsForSelect();
		}
		$videos = $mv->db->getAll($query);

		return $videos;
	}
}
