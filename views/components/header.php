<?php
/**
 * @var AuthInterface $auth
 */
$user = $auth->user();
use App\Kernel\Auth\AuthInterface;

?>



<div class="header">
    <div class="container">
        <div class="header-line">
            <div class="header-logo">
                <a href="/home">
                    <img src="/assets/images/logo.png" alt="">
                </a>
            </div>
            <?php if ($auth->check()) { ?>
                <div class="nav">
                    <a class="nav-item" href="/profile">
                        <?php echo $user->name(); ?>
                    </a>
                </div>

                <form action="/logout" method="post">
                    <button class="button-as-text">Выход</button>
                </form>
            <?php } else { ?>
                <div class="nav">
                    <a class="nav-item" href="/register">Регистрация</a>
                    <a class="nav-item" href="/login">Вход</a>
                </div>
            <?php } ?>
        </div>
