<?php
/**
 * @var View $view
 *  * @var array<Recipe> $recipes
 * @var StorageInterface $storage
 * @var RequestInterface $request
 * @var AuthInterface $auth
 **/

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Models\Recipe;

?>

<?php $view->component('start');?>
<div class="profile">
    <div>
        <h2><?php echo $auth->user()->name() ?></span></h2>
        <h2><?php echo $auth->user()->email() ?></span></h2>
    </div>

    <div>
        <h2>Любимые рецепты</h2>
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
                            <form action="/favoriteRecipes/destroy?id=<?php $auth->user()->id() ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $recipe->id() ?>" >
                                <button class="admin-button">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <ul></ul>
    </div>
</div>
<?php $view->component('end');?>


