<?php
/**
 * Created by PhpStorm.
 * User: hubeiwei
 * Date: 2016/8/2
 * Time: 18:27
 * To change this template use File | Settings | File Templates.
 */

/**
 * @var $this yii\web\View
 * @var $content string
 */

$this->beginContent('@app/views/layouts/master.php');
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?= $content ?>
    </div>
</div>

<?php $this->endContent(); ?>
