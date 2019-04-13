<h1>My Page</h1>
<table>
<?php foreach ($profiles as $profile): ?>
<tr>
    <td>
        <?= $profile->profession ?>
    </td>
    <td>
        <?= $profile->message ?>
    </td>
<tr>
<?php endforeach; ?>
</table>
<?php foreach ($goals as $goal): ?>
<h3>
<?= $goal->goal ?>
</h3>
<?php endforeach; ?>

<h3>
<?= $this->Html->link('Go to your bookshelf', ['controller' => 'Books', 'action' => 'index']); ?>
</h3>
<h3>
<?= $this->Html->link('Go to your results', ['controller' => 'Results', 'action' => 'index']); ?>
</h3>
