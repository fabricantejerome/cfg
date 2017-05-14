<?php

// no direct access
defined('_JEXEC') or die ;

// Load the K2 plugin API
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR.'/components/com_k2/lib/k2plugin.php');

class plgK2CfgVideos extends K2Plugin
{

    protected $pluginName = 'cfgvideos';
    protected $pluginNameHumanReadable = 'Video plugin';

    // Event to display (in the frontend)
    public function onK2AfterDisplayContent(&$item, &$params, $limitstart)
    {
        $plugins = new K2Parameter($item->plugins, '', $this->pluginName);

        $video_ids = $plugins->get('videos');

        if (empty($video_ids)) {
            return;
        }
        
        $video_controller = KObjectManager::getInstance()->getObject('com://site/cfgvideos.controller.video');

        if (!empty($video_ids))
        {
            $output = $video_controller->id($video_ids)->render();
        }

        return $output;
    }

    public function onAfterK2Save(&$row, $isNew)
    {
        $plugins   = new K2Parameter($row->plugins, '', $this->pluginName);
        $video_ids = $plugins->get('videos');

        $item_tag_names = $this->_getItemTags($row->id);

        $new_tag_ids = $this->_insertNewTags($item_tag_names);

        $video_uuids = $this->_getUid($video_ids);

        $this->_relateItemTagsToVideo($video_uuids, $new_tag_ids);
    }

    protected function _getItemTags($itemId)
    {
        K2Model::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');

        $model = K2Model::getInstance('Item', 'K2Model', array('table_path' => JPATH_COMPONENT_ADMINISTRATOR.DS.'tables'));

        $tags_object = $model->getCurrentTags($itemId);
        
        $tags = array();

        foreach ($tags_object as $tag) {
            $tags[] = strtolower($tag->name);
        }

        return !empty($tags) ? $tags : false;
    }

    // Insert new tags and get tags id
    protected function _insertNewTags($tags = array())
    {
        if (empty($tags)) 
        {
            return false;
        }

        $model = KObjectManager::getInstance()->getObject('com://admin/cfgvideos.model.tags');

        $ids = array();

        foreach ($tags as $value)
        {
            $value = ucfirst($value);
            $exist = $model->title($value)->fetch()->count();

            if (!$exist)
            {
                $row = $model->create(array('title' => $value))->save();
            }
            
            $ids[] = $model->title($value)->fetch()->getProperty('id');
        }

        return !empty($ids) ? $ids : false;
    }

    protected function _getUid($ids = array())
    {
        if (empty($ids))
        {
            return false;
        }

        $model = KObjectManager::getInstance()->getObject('com://site/cfgvideos.model.video');

        $row = array();

        foreach ($ids as $value)
        {
            $row[] = $model->id($value)->fetch()->getProperty('uuid');
        }

        return !empty($row) ? $row : false;
    }

    protected function _relateItemTagsToVideo($uuids = array(), $tag_ids = array())
    {
        if (empty($uuids) && empty($tag_ids))
        {
            return;
        }

        $table = KObjectManager::getInstance()->getObject('com://admin/cfgvideos.database.table.relations', array('name' => 'cfgvideos_tags_relations'));

        foreach ($uuids as $uuid)
        {
            foreach ($tag_ids as $tag_id)
            {
                $data = array(
                    'tag_id' => $tag_id,
                    'row' => $uuid
                );
                
                $exist = $table->count($data);

                if (!$exist)
                {
                    $relation = $table->createRow(array('data' => $data));
                    $result = $table->insert($relation);
                }
            }
        }
    }
}