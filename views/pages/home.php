<?php
/**
 * @var View $view
 *  * @var array<Recipe> $recipes
 * @var StorageInterface $storage
 * @var RequestInterface $request
 **/

use App\Kernel\Http\RequestInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Models\Recipe;

?>

<?php $view->component('start');?>
<div class="horizontal">
    <?php foreach ($recipes as $recipe) { ?>
    <div class="cards-padding">
        <a href="/recipe?id=<?php echo $recipe->id() ?>" class="card-link">
            <div class="recipe-card">
                    <img class="recipe-image" src="<?php echo $storage->url($recipe->preview()) ?>">
                <div class="recipe-content">
                    <div class="recipe-title"><?php echo $recipe->name() ?></div>
                </div>
            </div>
        </a>
    </div>
    <?php } ?>
</div>

<?php $view->component('end');?>


