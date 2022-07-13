<?
class Seo extends Model_Simple
{
	protected $name = "SEO parameters";
	
	protected $model_elements = array(
		array("Title", "char", "title", array("help_text" => "Default title value for all pages")),
		array("Keywords", "text", "keywords", array("help_text" => "Default keywords (meta keywords) for all pages")),
		array("Decription", "text", "description", array("help_text" => "Default description (meta description) for all pages")),
		array("Robots.txt", "text", "robots", array("help_text" => "Content of robots.txt file")),
		array("Meta data in head", "text", "meta_head", array("height" => 250, "help_text" => "Meta tags, counters, plugins")),
		array("Meta data in footer", "text", "meta_footer", array("height" => 250, "help_text" => "Counters and plugins"))
	);
	
	public function update()
	{
  		parent :: update();
   		
   		$file = $this -> registry -> getSetting("IncludePath")."robots.txt";
   		$text = $this -> getValue("robots");
   		file_put_contents($file, $text);
   		
   		return $this;
   }
	
   public function mergeParams($content)
   {
		if(!$this -> data_loaded)
			$this -> getDataFromDb();
		
		if(!$content) return;
		
		$seo_fields = array("title", "keywords", "description");
		$arguments = func_get_args();
		$text_value = false;
		
		if(count($arguments) == 1 && !is_object($content))
			$text_value = $content;
		
		$name_field = (isset($arguments[1]) && $arguments[1]) ? $arguments[1] : false;
		
		foreach($seo_fields as $field)
			if(is_object($content) && $content -> $field)
				$this -> data[$field] = $content -> $field;
			else if($name_field || $text_value)
			{
				if(!isset($this -> data[$field]))
					$this -> data[$field] = "";
				
				if(!$text_value && $content -> $name_field)
					$text_value = $content -> $name_field;
				
				if(!$text_value)
					continue;
				
				if($field == "keywords")
				{
					if($this -> data[$field])
						$this -> data[$field] = $text_value.", ".$this -> data[$field];
					else
						$this -> data[$field] = $text_value;
				}
				else
				{
					if($this -> data[$field])
						$this -> data[$field] = $text_value." ".$this -> data[$field];
					else
						$this -> data[$field] = $text_value;
				}
			}
		
		return $this;
	}
	
	public function displayMetaData($type)
	{
		if($type == "head" && $this -> getValue("meta_head"))
			return htmlspecialchars_decode($this -> getValue("meta_head"), ENT_QUOTES);
		else if($type == "footer" && $this -> getValue("meta_footer"))
			return htmlspecialchars_decode($this -> getValue("meta_footer"), ENT_QUOTES);
	}
}
?>