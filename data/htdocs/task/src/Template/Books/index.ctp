<h1>Book Shelf</h1>
<p>
<?= $this->Html->link('Add Book', ['action' => 'search', $userId]) ?>
</p>
<ul>
<?php foreach ($books as $book): ?>
<div>
<li>
<p><?= $book->bookTitle ?></p>
<p><?= $book->bookSubtitle ?></p>
<img src="<?= $book->imageLink ?>MZZZZZZZ">
<p><?= $this->Html->link('View', ['action' => 'view', $book->id, $userId]) ?></p>
<p><?= $this->Form->postLink('Delete', ['action' => 'delete', $book->id],
		['confirm' => 'Are you ok to delete?']) ?></p>
</li>
</div>
<?php endforeach; ?>
</ul>
<p><?= $this->Html->link('Home', ['controller' => 'mypages', 'action' => 'index']) ?></p>

