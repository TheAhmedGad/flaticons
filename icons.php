<?php 
session_start();
require "PHPHtmlParser/vendor/autoload.php"; // including Autoload files 
use PHPHtmlParser\Dom; // Importing Dom Parser
?>
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
	<div style="padding:15px 0 15px 15px">
		
	<a href="index.php" class="btn btn-success">Home</a>
	<a href="files.php" class="btn btn-success">Local Files</a>
	</div>
	<?php if(@$_SESSION['message'] != ''): // check for success message?>
		<div class="container">
			<div class="alert alert-success"><?=$_SESSION['message'] //show success message ?></div> 
		</div>
	<?php $_SESSION['message']=''; //clear session of message after viewing it?>
	<?php endif?>
	<div class="row">	
	<?php
		$currentPage = ($_GET['page'])?$_GET['page']:1; 
		$keyword 	 = $_GET['keyword']; //KeyWord To Search in Flat Icon
		$dom 		 = new Dom; // Call Dom Class
		$dom->load('https://www.flaticon.com/search/'.$currentPage.'?word='.$keyword); // load remote url
		$contents 	= $dom->find('li.icon'); // Search in page Source
		foreach ($contents as $content)
		{
			$innerDom = new Dom;  // Call Dom Class again for inner image in Li
			$innerDom->load($content->outerHtml); // load Li html code
			$img = $innerDom->getElementsbyTag('img'); //search in li code for image tag
			echo'<div class="col-md-1">
					<div class="thumbnail">
						<a href="grap.php?image='.$img->getAttribute('src').'&page='.$currentPage.'&back='.$keyword.'">
							'.$img->outerHtml.'
						</a>
					</div>
				 </div>'; //get img tag attr with some other options
		}
		$pagesCount 	= $dom->find('span#pagination-total')[0]; //pages count element for pagination 
		$pagesCount 	= $pagesCount->text; // the inner text for pages count
		$nextPage		= ($currentPage+1 > $pagesCount)?$pagesCount:$currentPage+1; //next page number
		$previousPage	= ($currentPage-1 == 0)?1:$currentPage-1; // pervious page number
	?>
		
	</div>
	<div class="text-center">
		<ul class="pagination">
			<?php if($currentPage == 1):?>
				<li>
					<a aria-label="Previous" disabled>
						<span aria-hidden="true">&laquo; Previous Page</span>
					</a>
				</li>
			<?php else: ?>
				<li><a href='icons.php?keyword=<?=$keyword?>&page=<?=$previousPage?>'> &laquo; Previous Page </a></li>
			<?php endif ?>

			<?php if($currentPage == $pagesCount):?>
				<li>
				  <a aria-label="Next" disabled>
				    <span aria-hidden="true">Next Page  &raquo;</span>
				  </a>
				</li>
			<?php else: ?>
				<li><a href='icons.php?keyword=<?=$keyword?>&page=<?=$nextPage?>'>Next Page &raquo;</a></li>
			<?php endif ?>
		</ul>
	</div>
</div>
