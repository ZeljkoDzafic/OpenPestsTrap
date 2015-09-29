<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Navigation</li>',
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Traps</span>', 'url' => ['/traps']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Pest Reports</span>', 'url' => ['/pest-reports']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Pest Families</span>', 'url' => ['/pest-families']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Trap Networks</span>', 'url' => ['/trap-networks']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Images</span>', 'url' => ['/images']],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sign in</span>', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Admin Tools',
                        'items' => [
                             [
                                'label' => '<i class="glyphicon glyphicon-lock"></i><span>Users</span>',
                                'url' => ['/user'],
                            ],

                        ],
                        'visible' =>Yii::$app->user->can('admin')
                    ],
                ],
            ]
        );
        ?>

    </section>

</aside>
