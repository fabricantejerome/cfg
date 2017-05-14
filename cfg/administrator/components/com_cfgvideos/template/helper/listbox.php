<?php
/**
 * @package     Cfgvideos
 */

class ComCfgvideosTemplateHelperListbox extends ComKoowaTemplateHelperListbox
{
    /*public function tags($config = array())
    {
        $config = new KObjectConfigJson($config);
        $config->append(array(
            'identifier' => 'com://admin/cfgvideos.model.tags',
            'component'  => 'cfgvideos',
            'model' => '',
            'attribs'  => array(
                'multiple' => true
            )
        ));

        return $this->getTemplate()->helper('com:tags.listbox.tags', $config->toArray());
    }*/
    public function tags($config = array())
    {
        $config = new KObjectConfig($config);
        $config->append(array(
            'value' => 'title',
            'name' => 'tags',
            'label' => 'title',
            'prompt' => false,
            'select2' => true,
            'identifier' => 'com://admin/cfgvideos.model.tags',
            'autocreate' => true,
            'attribs'  => array(
                'multiple' => true
            )
        ));

        $entity = $config->entity;

        //Set the selected tags
        if ($entity instanceof KModelEntityInterface && $entity->isTaggable() && !$entity->isNew())
        {
            $config->append(array(
                'selected' => $entity->getTags()
            ));
        }

        return parent::_render($config);
    }
}
