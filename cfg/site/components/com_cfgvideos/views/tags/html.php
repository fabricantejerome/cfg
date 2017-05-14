<?php

require_once JPATH_SITE . '/components/com_k2/helpers/route.php';

class ComCfgvideosViewTagsHtml extends ComKoowaViewHtml
{
    protected function _fetchData(KViewContext $context)
    {
        parent::_fetchData($context);

        $params = JFactory::getApplication()->getMenu()->getActive()->params;

        foreach ($context->data->tags as $tag) {
            $tag->k2_link = JRoute::_(K2HelperRoute::getTagRoute($tag->slug));
        }

        $context->data->params = $params;
    }
}