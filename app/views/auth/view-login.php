<?
$form = new Form("Accounts");
$form->setRequiredFields(array("email", "password"));
$form->useTokenCSRF();

if (!empty($_POST)) {
    $form->getDataFromPost()->validate(array("email", "password"));

    if ($form->isValid())
        if (!$account = $mv->accounts->login($form->email, $form->password))
            $form->addError("Неверный email или пароль.");
        else
            $mv->redirect("home/"); //Переход на нужный нам URL

    $form->password = "";
}

include $mv->views_path . "main-header.php";
?>
<? echo $form->displayErrors(); ?>
<form method="post" action="<? echo $mv->root_path; ?>login/">
    <table>
        <? echo $form->display(array("email", "password")); ?>
    </table>
    <div class="form-buttons">
        <? echo $form->displayTokenCSRF(); ?>
        <input type="submit" value="Вход" />
    </div>
</form>
<?
include $mv->views_path . "main-footer.php";
?>