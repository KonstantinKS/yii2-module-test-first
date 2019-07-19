<?php
    var_dump(Yii::getAlias('@KonstantinKS/ModuleTestFirst'));
?>

<?php if (isset($data)): ?>

    <div class="block">

        <h3 class="red">Вывод тестовых данных</h3>

        <?php foreach ($data as $currentData): ?>

            <p><?=$currentData->ip?></p>

            <p><?=$currentData->comment?></p>

        <?php endforeach; ?>

    </div>

    <h1>2222222222222222222222222222222222222</h1>

    <h1>3333333333333333333333333333333333333</h1>

    <h1>4444444444444444444444444444444444444</h1>

    <h1>5555555555555555555555555555555555555</h1>

<?php endif; ?>

<?php
    print_r($render);
?>
