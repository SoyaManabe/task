<!-- File: src/Template/Goals/add.ctp -->

<h1>Set new Goal</h1>
<?php
	echo $this->Form->create($goal);
	// Directry describe user_is now
	echo $this->Form->control('goal');
	echo $this->Form->button(__('Save Goal'));
	echo $this->Form->end();
?>
