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
        <h2>Регистрация</h2>
        <form action="/register" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>
            <?php if ($session->has('name')) {  ?>
                <ul>
                    <?php foreach ($session->getFlash('name') as $error) { ?>
                        <li style="color: red;"><?php echo $error ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <?php if ($session->has('email')) {  ?>
                <ul>
                    <?php foreach ($session->getFlash('email') as $error) { ?>
                        <li style="color: red;"><?php echo $error ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <?php if ($session->has('password')) {  ?>
                <ul>
                    <?php foreach ($session->getFlash('password') as $error) { ?>
                        <li style="color: red;"><?php echo $error ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <button type="submit">Зарегистрироваться</button>

        </form>
    </div>
</main>
<?php $view->component('end');?>


