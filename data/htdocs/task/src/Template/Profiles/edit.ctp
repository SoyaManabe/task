<!-- File: src/Template/Profiles/edit.ctp -->

<h1>Edit Profiles</h1>
<?php
    echo $this->Form->create($profile);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('profession');
	echo $this->Form->control('message');
    echo $this->Form->button(__('Save Profile'));
    echo $this->Form->end();
?>
