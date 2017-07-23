<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style>
	.thumbnail {
	  transition: all 0.5s ease;
	  background: white;
	  padding: 10px;
	}
	.thumbnail:hover {
	  background: silver;
	  padding: 11px;
	}
</style>
 <div class="container">
	<div class="row">
        <div class="col-md-12">
			<h1>Local Files</h1>
			<?php $dir = new DirectoryIterator(dirname(__FILE__).'/images'); ?>
			<?php foreach ($dir as $fileinfo):?>
			    <?php if (!$fileinfo->isDot()):?>
				<div class="col-md-1">
					<div class="thumbnail">
						<a href="images/<?=$fileinfo->getFilename()?>">
							<img src="images/<?=$fileinfo->getFilename()?>" alt="">
						</a>
					</div>
				</div>
			        
			    <?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
</div>