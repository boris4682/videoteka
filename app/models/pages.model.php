<?
class Pages extends Model
{
	protected $name = "Страницы меню";
	
	protected $model_elements = array(
		array("Active", "bool", "active", array("on_create" => true)),
		array("Show in menu", "bool", "in_menu", array("on_create" => true)),
		array("Name", "char", "name", array("required" => true)),
		array("Title", "char", "title"),
		array("Parent section", "parent", "parent"),
		array("URL", "url", "url", array("unique" => true, "translit_from" => "name")),
		array("Redirect", "redirect", "redirect"),
		array("Order", "order", "order"),
		array("Content", "text", "content", array("rich_text" => true))
	);
	
	public function defineCurrentPage(Router $router)
	{
		$url_parts = $router -> getUrlParts();
		
		if($router -> isIndex())
			$params = array("url" => "index", "active" => 1);
		else if(count($url_parts) == 1)
			$params = array("url" => $url_parts[0], "active" => 1);
		else if(count($url_parts) == 2 && $url_parts[0] == "page" && is_numeric($url_parts[1]))
			$params = array("id" => $url_parts[1], "active" => 1);
		else
			return false;

		if($content = $this -> findRecord($params))
			$this -> id = $content -> id;
			
		return $content;
	}
	
	public function displayMenu($parent)
	{
		$rows = $this -> select(array("parent" => $parent, "active" => 1, "in_menu" => 1, "order->asc" => "order"));
		
		$html = "";
		$first = false;		
		$arguments = func_get_args();
		$only_links = (isset($arguments[1]) && $arguments[1] == "A");
		
		foreach($rows as $row)
		{
			$css_class = "";
			
			if(!$first)
			{
				$css_class = "first";
				$first = true;
			}
			
			$html .= $only_links ? "<a" : "<li";
			
			if($this -> id == $row['id'])
				$css_class .= $css_class ? " active" : "active";
			
			if($css_class)
				$html .= " class=\"".$css_class."\"";				
			
			if($row['redirect'])
				$url = $row['redirect'];
			else if($row['url'] == "index")
				$url = $this -> root_path;
			else
				$url = $this -> root_path.($row['url'] ? $row['url'] : "page/".$row['id'])."/"; 
						
			if($only_links)
				$html .= " href=\"".$url."\">".$row['name']."</a>\n";
			else
				$html .= "><a href=\"".$url."\">".$row['name']."</a></li>\n";
		}

		return $html;
	}
}
?>