<?php
/**
 * @var View $view
 * @var array<Recipe> $recipes
 * @var StorageInterface $storage
 * @var AuthInterface $auth
 **/

use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Models\Recipe;
?>

<?php $view->component('start');?>
<?php if ($auth->check()) {
        if($auth->user()->isAdmin() == 1) {?>
<main>
    <div class="element">
        <h3 class="nav-item">Панель администрирования</h3>
        <div>
            <h3 class="nav-item">Рецепты</h3>
            <a class="nav-item" href="/admin/recipes/add">Добавить рецепт</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Превью</th>
                <th>Название</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($recipes as $recipe) { ?>
                    <tr>
                        <td>
                            <img class="admin-img" src="<?php echo $storage->url($recipe->preview())  ?>">
                        </td>
                        <td><?php echo $recipe->name() ?></td>
                        <td><?php echo $recipe->createdAt() ?></td>
                        <td>
                            <div>
                                <form action="/admin/recipes/destroy" method="post">
                                    <input type="hidden" name="id" value="<?php echo $recipe->id() ?>" >
                                    <button class="admin-button">Удалить</button>
                                </form>
                            </div>
                            <a class="item" href="/admin/recipes/update?id=<?php echo $recipe->id() ?>">Изменить</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<?php }
} ?>
<?php $view->component('end');?>


