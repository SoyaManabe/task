<!-- File: src/Template/Books/add.ctp -->
<h1>Add new Book</h1>
<?php
	echo $this->Form->create($book, ['tyupe' => 'post']);
	echo $this->Form->control('isbn');
	echo $this->Form->button(__('Save'));
	echo $this->Form->end();
?>
<p><?= $this->Html->link('Back', ['action' => 'index']);  ?></p>
