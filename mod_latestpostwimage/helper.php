<?php
/**
 * Helper class for Latest Post With Photo module
 * By: Maureen
 *
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_latestpostwimage is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModLatestPostHelper
{
    /**
     * Retrieves the latest post
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getLatestPost($cats_to_skip)
    {
        
        // Obtain a database connection
        $db = JFactory::getDbo();

        //Handle publish_up and publish_down dates - get the date/time
        $datetime = JFactory::getDate(strtotime('now'));

        // Retrieve the latest post
        $query = $db->getQuery(true)
                    ->select($db->quoteName('a.id') . ', ' . $db->quoteName('a.catid') . ', ' . $db->quoteName('a.title') . ', ' . $db->quoteName('a.introtext') . ', ' . $db->quoteName('a.fulltext') . '
                        FROM ' . $db->quoteName('#__content') . ' as a
                        LEFT JOIN ' . $db->quoteName('#__categories') . ' as b
                        ON a.catid=b.id
                        WHERE ' . $db->quoteName('a.state') . ' = ' . $db->quote('1') . ' 
                        AND ' . $db->quoteName('b.published') . ' = ' . $db->quote('1') . '
                        AND ' . $db->quoteName('a.catid') . ' NOT IN ( ' . $cats_to_skip . ') 
                        AND ' . $db->quoteName('a.publish_up') . ' <= ' . $db->quote($datetime) . '
                        AND (' . $db->quoteName('a.publish_down') . ' > ' . $db->quote($datetime) . ' OR ' . $db->quoteName('a.publish_down') . ' LIKE ' . $db->quote('0000-00-00 00:00:00') . ')
                        AND ( ' . $db->quoteName('a.introtext') . ' LIKE "%<img%" OR ' . $db->quoteName('a.fulltext') . ' LIKE "%<img%") 
                        ORDER BY ' . $db->quoteName('a.created') . ' DESC'
                        );

        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObject();
        // Return the result
        return $result;
    }
}