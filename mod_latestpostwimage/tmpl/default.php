<?php 
// No direct access
defined('_JEXEC') or die;

//get module settings
$title_classes = $params->get('title_classes');
$readmore_linked = $params->get('readmore_linked');
$img_classes = $params->get('img_classes');
$text_classes = $params->get('text_classes');
	
//get info about the latest post from the database via helper.php

//as long as we found at least one post matching our criteria, proceed
if(!empty($latestpost)) {
	$id = $latestpost->id;
	$catid = $latestpost->catid;
	$title = $latestpost->title;
	$intro = $latestpost->introtext;
	$text = $latestpost->introtext . $latestpost->fulltext;

	$image_regex = '/\<img.*?src=["\'](.*?)["\'].*?\>/';

	preg_match_all($image_regex, $text, $img_matches, PREG_SET_ORDER);

	foreach($img_matches as $match) {
		//[0] is the full <img /> tag, [1] is just the path to the image

		//check that image exists
		$checksize = getimagesize($match[1]);
		if(!empty($checksize)) {
			//proceed with displaying the image
			$image = $match[1];
		}
	}

	//prep text
	$intro = strip_tags($intro, '<a></a><strong></strong><em></em><b></b><i></i>');
	$intro = str_replace('<p>', '', $intro);
	$intro = str_replace('</p>', '<br /><br />', $intro);

	$url = ContentHelperRoute::getArticleRoute($id, $catid);

	?>
	<div class="<?php echo $title_classes; ?>">
		<a href="<?php echo $url; ?>"><?php echo $title; ?></a>
	</div>

	<div>
		<a href="<?php echo $url; ?>">
			<img src="<?php echo $image; ?>" class="<?php echo $img_classes; ?>" />
		</a>
	</div>

	<div class="<?php echo $text_classes; ?>">
		<?php echo $intro; ?> <a href="<?php echo $url; ?>"><?php echo $readmore_linked; ?></a>
	</div>
	<?php
}
?>