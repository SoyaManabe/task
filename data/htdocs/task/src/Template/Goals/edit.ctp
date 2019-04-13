<!-- File: src/Template/Goals/edit.ctp -->

<h1>Edit Goal</h1>
<?php
    echo $this->Form->create($goal);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('goal');
    echo $this->Form->button(__('Save Goal'));
    echo $this->Form->end();
?>
