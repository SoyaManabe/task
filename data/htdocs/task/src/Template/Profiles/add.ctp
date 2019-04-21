<!-- File: src/Template/Profiles/add.ctp -->

<h1>New Profiles</h1>
<?php
    echo $this->Form->create($profile);
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $userId]);
    echo $this->Form->control('profession');
	echo $this->Form->control('message');
    echo $this->Form->button(__('Save Profile'));
    echo $this->Form->end();
?>
