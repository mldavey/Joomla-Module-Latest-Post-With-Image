<?php
/**
 * Latest Post With Image - Module
 * By: Maureen
 *
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_latestpostwimage is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$catids_to_exclude = $params->get('catids_to_exclude'); //from the module settings

//validate data - trim any extra spaces and make sure we're only getting numbers
$explode = explode(',', $catids_to_exclude);
$final_catids_to_exclude = '';

foreach($explode as $explode_item) {
	trim($explode_item);
	$explode_item = (int)$explode_item;
	$final_catids_to_exclude[] = "'$explode_item'";
}

$catids_to_exclude = implode(',', $final_catids_to_exclude);

$latestpost = modLatestPostHelper::getLatestPost($catids_to_exclude);
require JModuleHelper::getLayoutPath('mod_latestpostwimage');