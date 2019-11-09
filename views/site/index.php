<?php

/* @var $this yii\web\View */
/* @var $authors app\models\Authors */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Книги!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <?php foreach ($authors as $iteauthors): ?>
                        <li class="list-group-item"><?=$iteauthors->name;?> <?=$iteauthors->surname;?>
                        <?php if (count($iteauthors->books) != 0): ?>
                            <ul>
                                <?php foreach ($iteauthors->books as $iteabook): ?>
                                    <li><?=$iteabook->title;?></li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

    </div>
</div>
