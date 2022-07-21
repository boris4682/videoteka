<?
class Blocks extends Model
{
	protected $name = "Блоки текста";
	
	protected $model_elements = array(
		array("Active", "bool", "active", array("on_create" => true)),
		array("Name", "char", "name", array("required" => true)),
		array("Content", "text", "content", array("rich_text" => true))
	);
}
?>