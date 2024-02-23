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
        <h2>Добавление рецепта</h2>
        <form action="/admin/recipes/add" method="post" enctype="multipart/form-data">
            <label>Название рецепта:</label>
            <input class="recipe-add-form-input" type="text" id="name" name="name" required>
            <label>Описание рецепта:</label>
            <textarea class="description" id="description" name="description"></textarea>
            <label>Изображение:</label>
            <input type="file" id="image" name="image" required>
            <button type="submit">Добавить рецепт</button>
        </form>
    </div>
</main>
<?php $view->component('end');?>


