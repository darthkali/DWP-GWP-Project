<div class="products show">
	<h1><?=$product->name?></h1>
	<p>Preis: <?=$product->price?></p>

	<ul>
		<?php foreach($ppAll as $index => $pp) : ?>
		<li><b><?=$pp->name?>:</b> <?=$pp->value?></li>
		<?php endforeach; ?>
	</ul>

	<a href="index.php?c=pages&a=subscribe&event=1"><?=(isset($_SESSION['event']) && $_SESSION['event'] === true ? 'Nicht mehr Teilnehmen' : 'Teilnehmen')?></button>
</div>