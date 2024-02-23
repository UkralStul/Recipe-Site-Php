<?php
/**
 * @var View $view
 * @var SessionInterface $session
 **/

use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;

?>

<?php $view->component('start');?>
<main>
    <div class="registration-form">
        <h2>Авторизация</h2>
        <form action="/login" method="post">
            <?php if ($session->has('error')) {  ?>
                <ul>
                        <li style="color: red;"><?php echo $session->getFlash('error') ?></li>
                </ul>
            <?php } ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Войти</button>
        </form>
    </div>
</main>
<?php $view->component('end');?>


