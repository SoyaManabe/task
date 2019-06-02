<!-- File: src/Template/Books/search.ctp -->
<h1>Search new Book</h1>
<?php
        echo $this->Form->create($book, ['type' => 'post']);
        echo $this->Form->control('bookTitle');
        echo $this->Form->button(__('Search'));
        echo $this->Form->end();
?>

<?php if (isset($searchResults)): ?>
<h2>Search results</h2>
<?php foreach($searchResults['items'] as $searchResult): ?>
<h3><?= $searchResult['volumeInfo']['title'] ?></h3>
<?php if (isset($searchResult['volumeInfo']['subtitle'])): ?>
<p><?= $searchResult['volumeInfo']['subtitle'] ?></p>
<?php endif; ?>
<img src="http://images-jp.amazon.com/images/P/
<?= $searchResult['volumeInfo']['industryIdentifiers']['0']['identifier'] ?>.09.MZZZZZZZ">
<?php if (isset($searchResult['volumeInfo']['authors'])): ?>
<?php foreach($searchResult['volumeInfo']['authors'] as $author):?>
<p><?= $author ?></p>
<?php endforeach; ?>
<?php endif; ?>
<p>
<?= $this->Form->postLink('Add this book', ['controller' => 'books', 'action' => 'add',$searchResult['volumeInfo']['industryIdentifiers']['0']['identifier'],$userId], ['confirm' => 'Add This Book?']) ?>
</p>
<hr>
<?php endforeach; ?>
<?php endif; ?>

<p><?= $this->Html->link('Back', ['action' => 'index']);  ?></p>

