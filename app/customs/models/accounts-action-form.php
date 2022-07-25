<?
$groupsModel = new Groups();
$groups = $groupsModel->select();
$groupsPairs = array_column($groups, 'name', 'id');

$userGroupsModel = new User_Groups();
$userGroups = $userGroupsModel->select(['user_id' => $_GET['id']]);
$activeGroupIds = array_column($userGroups, 'group_id');

// echo '<pre>';
// print_r($system -> model);
// echo '</pre>';

?>
<tr>
    <td class="field-name">Группа<span class="required">*</span></td>
    <td class="field-content text">
        <select size="3" name="group_id[]" multiple required>
            <? foreach ($groupsPairs as $groupId => $groupName) : ?>
                <option value="<?= $groupId ?>" <?if(in_array($groupId, $activeGroupIds)) echo 'selected';?>><?= $groupName ?></option>
            <? endforeach; ?>
        </select>
    </td>
</tr>