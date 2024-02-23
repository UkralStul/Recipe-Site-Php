<?php
/**
 * @var View $view
 *  * @var Recipe $recipe
 * @var StorageInterface $storage
 * @var RequestInterface $request
 * @var AuthInterface $auth
 * @var SessionInterface $session
 * @var Comment $comment
 **/

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Models\Comment;
use App\Models\Recipe;


?>

<?php $view->component('start');?>


<div class="recipe-container">
    <div class="recipe-image">
        <img class="recipe-image" src="<?php echo $storage->url($recipe->preview()) ?>" alt="Изображение блюда">
        <p>Добавлен: <?php echo $recipe->createdAt() ?> </p>
        <div class="comments-form">
            <?php if ($auth->check()) { ?>
                <?php if($session->has('error')) { ?>
                    <li style="color: red;"><?php echo $session->getFlash('error') ?></li>
                <?php } ?>
                <?php if ($session->has('comment')) {  ?>
                    <?php foreach ($session->getFlash('comment') as $error) { ?>
                        <li style="color: red;"><?php echo $error ?></li>
                    <?php } ?>

                <?php } ?>
                <form action="/favoriteRecipes/add" method="post">
                    <input type="hidden" value="<?php echo $recipe->id() ?>" name="id">
                    <button>Добавить в любимые рецепты</button>
                </form>
                <h2>Оставьте свой комментарий</h2>
                <form action="/comments/add" class="form" method="post">
                    <input type="hidden" value="<?php echo $recipe->id() ?>" name="id">
                    <label for="comment">Комментарий:</label>
                    <textarea id="comment" name="comment" rows="4" required></textarea>
                    <button type="submit">Отправить комментарий</button>
                </form>
            <?php } else { ?>
            <h2>Для того чтобы оставить коментарий <a class="nav-item" href="/login">Авторизируйтесь</a> </h2>
            <?php } ?>
        </div>
    </div>

    <div class="recipe-details">
        <h1><?php echo $recipe->name() ?></h1>
        <p><?php echo $recipe->description() ?></p>
        <div class="comments-list">
            <h2>Комментарии</h2>
            <?php foreach ($recipe->comments() as $comment) { ?>
            <div class="comment-card">
                <div class="comment-header"><?php echo $comment->user()->name() ?> | <?php echo $comment->createdAt() ?></div>
                <div class="comment-text"><?php echo $comment->comment() ?></div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $view->component('end');?>


