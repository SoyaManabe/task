<h1>Results</h1>
<div id="skeduler-container">

</div>
<table>
<tr>
	<th>Date</th>
	<th>Time</th>
	<th>IMG</th>
	<th>Title</th>
	<th>Result</th>
	<th>Comment</th>
	<th></th>
</tr>
<?php foreach ($results as $result): ?>
<tr>
<th><?= $result->date ?></th>
<th><?= $result->startTime ?> - <?= $result->endTime?></th>
<th><img src="<?= $result->imageLink ?>"></th>
<th><?= $result->bookTitle ?></th>
<th><?= $result->timeDiff ?></th>
<th><?= $result->comments ?></th>
<th><?= $this->Form->postLink('Delete', ['action' => 'delete',$result->id ],
				['confirm' => 'Are you ok to delete?']) ?></th>
</tr>
<?php endforeach; ?>
</table>
<p><?= $this->Html->link('Mypage', ['controller' => 'mypages', 'action' => 'index']) ?></p>
