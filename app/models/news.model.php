<?
class News extends Model
{
    protected $name = "Новости";

    protected $model_elements = array(
        array("Активация", "bool", "active", array("on_create" => true)),
        array("Дата", "date", "date", array("required" => true)),
        array("Название", "char", "name", array("required" => true)),
        array("Ссылка", "url", "url", array("unique" => true, "translit_from" => "name")),
        array("Изображение", "image", "image"),
        array("Текст новости", "text", "content", array("rich_text" => true))
    );
    /* public function defineNewsPage(Router $router)
    {
        $url_parts = $router->getUrlParts();
        $record = false;

        if (count($url_parts) == 2)
            if (is_numeric($url_parts[1]))
                $record = $this->findRecord(array("id" => $url_parts[1], "active" => 1));
            else
                $record = $this->findRecord(array("url" => $url_parts[1], "active" => 1));

        return $record;
    } */

    /* public function display()
    {
        $params = array(
            "active" => 1, "order->desc" => "date",
            "limit->" => $this->pager->getParamsForSelect()
        );

        $rows = $this->select($params);
        $html = "";

        foreach ($rows as $row) {
            $url = $this->root_path . "news/" . ($row['url'] ? $row['url'] : $row['id']) . "/";

            $html .= "<div class=\"news-wrapper\">\n";
            $html .= "<h2><a href=\"" . $url . "\">" . $row['name'] . "</a></h2>\n";
            $html .= "<p class=\"news-date\">" . I18n::formatDate($row['date']) . "</p>\n";

            if ($row['image']) {
                $html .= "<a href=\"" . $url . "\" class=\"news-image\">\n";
                $html .= $this->cropImage($row['image'], 187, 127) . "</a>\n";
            }

            $html .= "<p class=\"news-content\">" . Service::cutText($row['content'], 350, " ...") . "</p>\n";
            $html .= "</div>\n";
        }

        return $html;
    } */

    /* public function displayPreviousAndNext($current_id, $current_date)
    {
        $html = "";
        $params = array("active" => 1, "id!=" => $current_id, "date>=" => $current_date, "order->asc" => "date");

        if ($record = $this->findRecord($params)) {
            $url = $this->root_path . "news/" . ($record->url ? $record->url : $record->id) . "/";
            $html .= "<a class=\"previous\" href=\"" . $url . "\">Предыдущая новость</a>\n";
        }

        $params = array("active" => 1, "id!=" => $current_id, "date<=" => $current_date, "order->desc" => "date");

        if ($record = $this->findRecord($params)) {
            $url = $this->root_path . "news/" . ($record->url ? $record->url : $record->id) . "/";
            $html .= "<a class=\"next\" href=\"" . $url . "\">Следующая новость</a>\n";
        }

        return $html;
    } */
}
