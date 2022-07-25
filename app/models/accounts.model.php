<?
class Accounts extends Model
{
    protected $name = 'Аккаунты';

    protected $model_elements = [
        ['Имя', 'char', 'name', ['required' => true]],
        ['Email', 'email', 'email', ['required' => true, 'unique' => true]],
        ['Пароль', 'password', 'password', [
            'required' => true, 'letters_required' => true,
            'digits_required' => true
        ]],
        ['Телефон', 'phone', 'phone', ['required' => true]],
        ['Активировать', 'bool', 'active', ['on_create' => true]],
        ['Дата регистрации', 'date_time', 'date_registration'],
        ['Дата последнего посещения', 'date_time', 'date_last_visit'],
    ];


    protected function beforeCreate($fields)
    {
        $salt = $this->createPasswordSalt();
        return array("password" => Service::makeHash($fields["password"] . $salt));
    }

    protected function afterCreate($id, $fields)
    {
        if (isset($_POST['group_id'])) {
            if (count($_POST['group_id']) > 0) {
                $userGroupsModel = new User_Groups();
                foreach ($_POST['group_id'] as $groupId) {
                    $groupUser = $userGroupsModel->getEmptyRecord();
                    $groupUser->user_id = $id;
                    $groupUser->group_id = $groupId;
                    $groupUser->date_create = I18n::getCurrentDateTime();
                    $groupUser->date_update = I18n::getCurrentDateTime();
                    $groupUser->create();
                }
            }
        }
        $salt = $this->createPasswordSalt();
        return array("password" => Service::makeHash($fields["password"] . $salt));
    }

    protected function beforeUpdate($id, $old_fields, $new_fields)
    {
        if (isset($_POST['group_id'])) {
            if (count($_POST['group_id']) > 0) {

                $userGroupsModel = new User_Groups();

                $findGroups = $userGroupsModel->select(['user_id' => $id]);
                $findGroups = array_column($findGroups, 'group_id');

                foreach ($_POST['group_id'] as $key => $groupId) {
                    if (!in_array($groupId, $findGroups)) {
                        $groupUser = $userGroupsModel->getEmptyRecord();
                        $groupUser->user_id = $id;
                        $groupUser->group_id = $groupId;
                        $groupUser->date_create = I18n::getCurrentDateTime();
                        $groupUser->date_update = I18n::getCurrentDateTime();
                        $groupUser->create();
                    }
                    $findGroups = array_diff($findGroups, [$groupId]);
                }
                foreach ($findGroups as $groupIdDelete) {
                    $groupUser = $userGroupsModel->findRecord(['user_id' => $id, 'group_id' => $groupIdDelete]);
                    $groupUser->delete();
                }
            }
        } else {
            $userGroupsModel = new User_Groups();

            $findGroups = $userGroupsModel->select(['user_id' => $id]);
            $findGroups = array_column($findGroups, 'group_id');
            foreach ($findGroups as $groupIdDelete) {
                $groupUser = $userGroupsModel->findRecord(['user_id' => $id, 'group_id' => $groupIdDelete]);
                $groupUser->delete();
            }
        }

        if ($new_fields["password"] != $old_fields["password"]) {
            $salt = $this->createPasswordSalt();
            return array("password" => Service::makeHash($new_fields["password"] . $salt));
        }
    }

    public function createPasswordSalt()
    {
        $salt = $this->registry->getSetting("SecretCode");

        //Здесь можно добавить к переменной $salt еще строку
        //например $salt .= "hg3HgLi826gfvd)jsh";

        return $salt;
    }

    public function generateSessionToken($account)
    {
        $token = $account->id . $this->registry->getSetting('SecretCode');
        $token .= Debug::browser() . session_id();

        return md5($token);
    }

    public function login($email, $password)
    {
        $account = $this->findRecord(array("email" => $email, "active" => 1));
        $salt = $this->createPasswordSalt();

        if ($account && Service::checkHash($password . $salt, $account->password)) {
            $_SESSION["account"]["id"] = $account->id;
            $_SESSION["account"]["password"] = md5($account->password);
            $_SESSION["account"]["token"] = $this->generateSessionToken($account);

            $account->date_last_visit = I18n::getCurrentDateTime();
            $account->update();

            return $account;
        }
    }

    public function getUserGroups()
    {
        global $account;
        $userGroupsModel = new User_Groups();
        $userGroups = $userGroupsModel->select(['user_id' => $account->id]);
        $activeGroupIds = array_column($userGroups, 'group_id');
        return $activeGroupIds;
    }

    public function checkAuthorization()
    {
        if (isset($_SESSION["account"]["id"], $_SESSION["account"]["password"], $_SESSION["account"]["token"])) {
            $account = $this->findRecord(array("id" => $_SESSION["account"]["id"], "active" => 1));

            if ($account && $_SESSION["account"]["password"] == md5($account->password))
                if ($_SESSION["account"]["token"] == $this->generateSessionToken($account))
                    return $account;
        }
    }
}
