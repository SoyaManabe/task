<h1>Results</h1>
<ul>
<?php foreach ($results as $result): ?>
<li>
<p><?= $result->comments ?></p>
<!--<p><?= $url ?></p>
<p><?= $this->Html->link('View', ['action' => 'view', $book->id, $userId]) ?></p>
<p><?= $this->Form->postLink('Delete', ['action' => 'delete', $book->id],
		['confirm' => 'Are you ok to delete?']) ?></p>
-->
</li>
<?php endforeach; ?>
</ul>
<p><?= $this->Html->link('Mypage', ['controller' => 'mypages', 'action' => 'index']) ?></p>
