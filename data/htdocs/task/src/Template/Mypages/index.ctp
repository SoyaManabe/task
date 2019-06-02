<h1>My Page</h1>
<hr>
<?php if (isset($unfinishedStudy)): ?>
<h3>Alert: Your study is still going on.</h3>
<h4><?= $unfinishedBook->bookTitle ?></h4>
<img src="<?= $unfinishedBook->imageLink ?>MZZZZZZZ"></img>
<h3>
<?= $this->Html->link('Finish', ['controller' => 'Results', 'action' => 'finish', $unfinishedStudy->id]) ?>
</h3>
<hr>
<?php endif; ?>
<?php if (isset($profile)): ?>
<h2><?= $this->Html->link('Profile', ['controller' => 'Profiles', 'action' => 'edit', $userId]) ?></h2>
<h3>Manabe Soya</h3>
<table>
<tr>
    <td>
	<b>PROFESSION</b>
    </td>
    <td>
        <?= $profile->profession ?>
    </td>
<tr>
<tr>
	<td>
		<b>MESSAGE</b>
	</td>
	<td>
		<?= $profile->message ?>
	</td>
</tr>
</table>
<?php else: ?>
<h2>Profile</h2>
<p>You don't have profile yet.</p>
<p><?= $this->Html->link('Create', ['controller' => 'Profiles', 'action' => 'add', $userId]) ?></p>
<?php endif; ?>
<h2>
<?= $this->Html->link('My Goals', ['controller' => 'Goals', 'action' => 'index', $userId]) ?>
</h2>
<?php foreach ($goals as $goal): ?>
<h3>
<?= $goal->goal ?>
</h3> 
<?php endforeach; ?>
<hr>
<h3>
<?= $this->Html->link('Go to your bookshelf', ['controller' => 'Books', 'action' => 'index']) ?>
</h3>
<h3>
<?= $this->Html->link('Go to your results', ['controller' => 'Results', 'action' => 'index']) ?>
</h3>
