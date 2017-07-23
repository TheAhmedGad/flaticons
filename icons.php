<?php 
session_start();
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
	<?php if(@$_SESSION['message'] != ''):?>
		<div class="container">
			<div class="alert alert-success"><?=$_SESSION['message']?></div>
		</div>
	<?php $_SESSION['message']=''; ?>
	<?php endif?>
	<div class="row">	
	<?php
		require "PHPHtmlParser/vendor/autoload.php";
		use PHPHtmlParser\Dom;
		$currentPage = ($_GET['page'])?$_GET['page']:1;
		$keyword 	 = $_GET['keyword'];
		$dom 		 = new Dom;
		$dom->load('https://www.flaticon.com/search/'.$currentPage.'?word='.$keyword);
		$contents 	= $dom->find('li.icon');
				foreach ($contents as $content)
				{
					$innerDom = new Dom;
					$innerDom->load($content->outerHtml);
					$img = $innerDom->getElementsbyTag('img');
					
					echo'
							<div class="col-md-1">
								<div class="thumbnail">
									<a href="grap.php?image='.$img->getAttribute('src').'&page='.$currentPage.'&back='.$keyword.'">
										'.$img->outerHtml.'
									</a>
								</div>
							</div>
						';
				}
		$pagesCount 	= $dom->find('span#pagination-total')[0];
		$pagesCount 	= $pagesCount->text;
		$nextPage		= ($currentPage+1 > $pagesCount)?$pagesCount:$currentPage+1;
		$previousPage	= ($currentPage-1 == 0)?1:$currentPage-1;
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
