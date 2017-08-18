<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;

$this->title = 'To-Do list:';?>
<?= (isset($_SESSION['alert'])) ? $_SESSION['alert'] : '' ;?>
<?unset($_SESSION['alert']);?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div id="w0" class="grid-view">
        <table class="table table-striped table-bordered">
            <tbody>
            <? $i = 0; foreach ($records as $record) { $i++;?>
                <tr data-key="1">
                    <td><?=$record['created']?></td>

                    <td>
                        <?php $form = ActiveForm::begin([
                            'id' => 'record-form' . $i,
                            'layout' => 'inline',
                            'action' => 'index.php?r=site/edit',

                            'fieldConfig' => [
                                'template' => "<span class=\"col-lg-4\" style=''>{input}</span>\n<span class=\"col-lg-4\"></span>"
                            ],
                        ]); ?>
                        <?= $form->field($model, 'id')->hiddenInput(['value' => $record['id']]) ?>
                        <?= $form->field($model, 'priority')->textInput(['value' => $record['priority']]) ?>
                        <?= $form->field($model, 'text')->textInput(['value' => $record['text']]) ?>


                        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'button', 'value' => 'update']) ?>
                        <?= Html::submitButton('Delete', ['class' => 'btn btn-primary', 'name' => 'button', 'value' => 'delete']) ?>
                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
        <h3>Add new item:</h3>
        <?php $form = ActiveForm::begin([
            'id' => 'add-form' . $i,
            'layout' => 'inline',
            'action' => 'index.php?r=site/edit',
            'fieldConfig' => [
                'template' => "<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\"></div>"
            ],
        ]); ?>

        <?= $form->field($model, 'priority')->textInput(['value' => 'Priority']) ?>
        <?= $form->field($model, 'text')->textInput(['value' => 'Text']) ?>
        <?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'button', 'value' => 'add']) ?>

        <?php ActiveForm::end(); ?>

    </div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>