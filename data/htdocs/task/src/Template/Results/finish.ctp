<!-- File: src/Template/Results/finish.ctp -->

<h1>Finishing study</h1>
<?php
    echo $this->Form->create($result);
    echo $this->Form->control('comments');
    echo $this->Form->button(__('Save Study'));
    echo $this->Form->end();
?>
