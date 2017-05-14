<?php
/**
 * Cfgvideos - a Joomla extension built with Nooku Framework.
 *
 */

/**
 * Tags menu template helper
 *
 */
class ComCfgvideosTemplateHelperTags extends KTemplateHelperAbstract
{
	/**
     * Render the menu
     *
     * @param   array   $config An optional array with configuration options
     * @return  string  Html
     */
	public function menu($config = array())
	{
		$tags = KObjectManager::getInstance()->getObject('com://site/cfgvideos.model.tags')->fetch();

		$html = '';
		foreach ($tags as $tag) {
			$html .= "<a href='" . $this->getTemplate()->route('view=videos&tag[]='. $tag->slug) . "'>" . $tag->title . " </a>";
		}

		return $html;
	}
}

