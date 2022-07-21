<?
class Video_History_Viewed extends Model
{
	protected $name = 'История просмотров';

	protected $model_elements = [
		// ['Id', 'int', 'id', ['required' => true]],
		['Пользователь', 'int', 'user_id', ['required' => true]],
		['Идентификатор видео', 'int', 'video_id', ['required' => true]],
		['Дата создания', 'date_time', 'date_create', ['required' => true]],
		['Дата изменения', 'date_time', 'date_update', ['required' => true]],
		['Просмотрено', 'bool', 'is_viewed', ['required' => true]],
	];

}
