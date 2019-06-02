<h1>Book Detail</h1>
<h2><?= $book->bookTitle ?></h2>
<h3><?= $book->bookSubtitle ?></h3>
<img src="<?= $book->imageLink ?>LZZZZZZZ">
<h3>Author</h3>
<p><?= $book->author ?></p>
<h3>Description</h3>
<p><?= $book->description ?></p>
<?php if(isset($unfinishedStudy)): ?>
<h3>You can start new task after current task has done.</h3>
<? else: ?>
<p>
<?= $this->Form->postLink('Start', ['controller' => 'results', 'action' => 'start', $book->id, $userId], ['confirm' => 'Start Study?']) ?>
</p>
<? endif; ?>
<p><?= $this->Html->link('Back', ['action' => 'index']) ?></p>
<p><?= $this->Html->link('Delete', ['action' => 'delete', $book->id, $userId],
		['confirm' => 'Are you ok to delete?']) ?></p>

