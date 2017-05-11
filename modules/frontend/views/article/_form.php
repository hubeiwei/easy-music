<?php

use app\common\captcha\Captcha;
use app\common\helpers\UserHelper;
use app\models\Article;
use ijackua\lepture\Markdowneditor;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\Article
 * @var $validator app\modules\frontend\models\ArticleValidator
 */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput([
        'autofocus' => true,
        'maxlength' => true,
    ]) ?>

    <?php
    if ($model->type == Article::TYPE_MARKDOWN) {
        echo $form->field($model, 'content')->widget(Markdowneditor::className());
    } else if ($model->type == Article::TYPE_HTML) {
        echo $form->field($model, 'content')->widget(Redactor::className());
    }
    ?>

    <?= $form->field($validator, 'published_at')->widget(DateTimePicker::className(), [
        'pluginOptions' => [
            'autoclose' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'visible')->dropDownList(Article::visibleMap()) ?>

    <?= $form->field($model, 'type', ['template' => '{input}'])->hiddenInput() ?>

    <?php
    if (UserHelper::isAdmin()) {
        echo $form->field($model, 'status')->dropDownList(Article::statusMap());
    }
    ?>

    <?= $form->field($validator, 'verifyCode')->widget(Captcha::className()) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
