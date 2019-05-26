<h1>Book Shelf</h1>
<p>
<?= $this->Html->link('Add Book', ['action' => 'add', $userId]) ?>
</p>
<ul>
<?php foreach ($books as $book): ?>
<li>
<p><?= $book->isbn ?></p>
<p><?= $this->Html->link('View', ['action' => 'view', $book->id, $userId]) ?></p>
<p><?= $this->Form->postLink('Delete', ['action' => 'delete', $book->id],
		['confirm' => 'Are you ok to delete?']) ?></p>
</li>
<?php endforeach; ?>
</ul>

