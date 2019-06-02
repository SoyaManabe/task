<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
<?= $this->Flash->render() ?>
<p><b>You have no account?... <?= $this->Html->link('SignUp', ['action' => 'add']) ?></b></p>
<?= $this->Form->create() ?>
	<fieldset>
		<legend><?= __('Please enter your username and password') ?></legend>
		<?= $this->Form->control('username') ?>
		<?= $this->Form->control('password') ?>
	</fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
