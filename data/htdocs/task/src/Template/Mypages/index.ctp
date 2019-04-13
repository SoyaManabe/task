<h1>My Page</h1>
<hr>
<h2>Profile</h2>
<h3>Manabe Soya</h3>
<table>
<?php foreach ($profiles as $profile): ?>
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
<tr>
	<td>
		<?= $this->Html->link('Edit', ['controller' => 'Profiles', 'action' => 'edit', $profile->id]) ?>
	</td>
</tr>
<?php endforeach; ?>
</table>
<hr>
<h2>
<?= $this->Html->link('My Goals', ['controller' => 'Goals', 'action' => 'index']) ?>
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
