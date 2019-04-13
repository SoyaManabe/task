<h1>My Goals</h1>

<?php foreach ($goals as $goal): ?>
<h3>
<?= $goal->goal ?>
</h3>
<p>
<?= $this->Html->link('Edit', ['action' => 'edit', $goal->id]) ?>
</p>
<p>
<?= $this->Form->postLink('Delete', ['action' => 'delete', $goal->id],
	['confirm' => 'Are you ok to delete?']) ?>
</P>
<?php endforeach; ?>

<?= $this->Html->link('Add Goal', ['action' => 'add']) ?>

<h3>
<?= $this->Html->link('Go to myPage', ['controller' => 'Mypages', 'action' => 'index']); ?>
</h3>
