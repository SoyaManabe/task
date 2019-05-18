<h1><?= $book->isbn ?></h1>
<p>
<?= $this->Form->postLink('Start', ['controller' => 'results', 'action' => 'start', $book->id, $userId], ['confirm' => 'Start Study?']) ?>
</p>
<p><?= $this->Html->link('Back', ['action' => 'index']) ?></p>
<p><?= $this->Html->link('Delete', ['action' => 'delete', $book->id, $userId],
		['confirm' => 'Are you ok to delete?']) ?></p>

