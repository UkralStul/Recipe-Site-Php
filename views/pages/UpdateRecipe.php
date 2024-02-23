<?php
/**
 * @var View $view
 * @var SessionInterface $session
 * @var Recipe $recipe
 **/

use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Models\Recipe;

?>

<?php $view->component('start');?>
<main>
    <div class="registration-form">
        <h2>Изменение рецепта <?php echo $recipe->name() ?></h2>
        <form action="/admin/recipes/update?id=<?php echo $recipe->id() ?>" method="post" enctype="multipart/form-data">
            <label>Название рецепта:</label>
            <input class="recipe-add-form-input" value="<?php echo $recipe->name() ?>" type="text" id="name" name="name" required>
            <label>Описание рецепта:</label>
            <textarea id="description" name="description"><?php echo $recipe->description() ?></textarea>
            <label>Изображение:</label>
            <input  type="file" id="image" name="image">
            <button type="submit">Сохранить</button>
        </form>
    </div>
</main>
<?php $view->component('end');?>


