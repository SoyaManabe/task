<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Task Timer';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="jquery.skeduler.min.css">
	<?= $this->Html->script('jquery-3.3.1.min.js'); ?>
	<?= $this->Html->script('jquery.skeduler.min.js'); ?>
	<script src="<a href="https://www.jqueryscript.net/time-clock/">date</a>.format.min.js"</script>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $cakeDescription ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
			<ul class="left">
				<li><?= $this->Html->link('Mypage', ['controller' => 'Mypages', 'action' => 'index']) ?></li>
				<li><?= $this->Html->link('Books', ['controller' => 'Books', 'action' => 'index']) ?></li>
                		<li><?= $this->Html->link('Results', ['controller' => 'Results', 'action' => 'index']) ?></li>
			</ul>
            		<ul class="right">
				<?php if(isset($userId)): ?>
            			<li><?= $this->Html->link('SIGN OUT',['controller' => 'Users', 'action' => 'logout']) ?></li>
				<?php else: ?>
				<li><?= $this->Html->link('SIGN IN',['controller' => 'Users', 'action' => 'login']) ?></li>
				<li><?= $this->Html->link('SIGN UP',['controller' => 'Users', 'action' => 'add']) ?></li>
				<?php endif; ?>
			</ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
