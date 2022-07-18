<?
$form = new Form("Accounts");
$form->setRequiredFields(array("email", "password"));
$form -> setHtmlParams("email", 'type="email" class="form-control"');
$form -> setHtmlParams("password", 'type="password" class="form-control"');
$form->useTokenCSRF();

if (!empty($_GET)) {
    if($_GET['action'] == 'logout'){
        unset($_SESSION["account"]);
    }
}

if (!empty($_POST)) {
    $form->getDataFromPost()->validate(array(/* "email",  */"password"));
    // echo '<pre>';
    // var_dump($form->getErrors());
    // echo'</pre>';

    if ($form->isValid())
        if (!$account = $mv->accounts->login($form->email, $form->password))
            $form->addError("Неверный email или пароль.");
        else
            $mv->redirect(''); //Переход на нужный нам URL

    $form->password = "";
}

include $mv->views_path . "main-header.php";
// echo '<pre>';
// print_r($_SESSION);
// echo'</pre>';
?>
<h2 class="text-center mb-5">
    Авторизация
</h2>
<? echo $form->displayErrors(); ?>
<div class="card mb-3 w-50 m-auto">
    <div class="row g-0 d-flex align-items-center">
        <div class="col-lg-12">
            <div class="card-body py-5 px-md-5">
                <form method="post" action="<? echo $mv->root_path; ?>login/">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <?=$form->display(['email'])?>
                        <!-- <input type="email" id="form2Example1" class="form-control" /> -->
                        <!-- <label class="form-label" for="email">Email</label> -->
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <?=$form->display(['password'])?>
                        <!-- <input type="password" id="form2Example2" class="form-control" /> -->
                        <!-- <label class="form-label" for="form2Example2">Пароль</label> -->
                    </div>
                    <?= $form->displayTokenCSRF(); ?>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <form method="post" action="<? echo $mv->root_path; ?>login/">
    <table>
        <? echo $form->display(array("email", "password")); ?>
    </table>
    <div class="form-buttons">
        <? echo $form->displayTokenCSRF(); ?>
        <input type="submit" value="Вход" />
    </div>
</form> -->
<?
include $mv->views_path . "main-footer.php";
?>