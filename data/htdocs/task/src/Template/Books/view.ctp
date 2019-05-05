<h1><?= $book->isbn ?></h1>
<p>
<?= $this->Html->link('Start', ['controller' => 'result', 'action' => 'start', $book->id]) ?>
</p>
<p><?= $this->Html->link('Back', ['action' => 'index']) ?></p>
<p><?= $this->Html->link('Delete', ['action' => 'delete', $book->id, $userId],
		['confirm' => 'Are you ok to delete?']) ?></p>

