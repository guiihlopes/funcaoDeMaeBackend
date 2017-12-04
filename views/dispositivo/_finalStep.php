<?php 
  use yii\helpers\Url;
?>
<?php if($form->errorSummary($model) == ""){ ?>
  <div class="alert alert-success">
    Dispositivo cadastrado com sucesso!
  </div>
  <a href="<?= Url::toRoute('/dispositivo/index') ?>">Dispositivos</a>
  <?php }else{ ?>
  <div class="alert alert-danger">
    <?= $form->errorSummary($model) ?>
  </div>
<?php } ?>
