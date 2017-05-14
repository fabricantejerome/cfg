<?php

/**
 * @package
 * @SubPackage
 * @copyright    Copyright (C) 2015 Magnetic Merchandising Inc. All rights reserved.
 * @license      No License
 * @link        http://magneticmerchandising.com
 */
class ComCfgvideosDatabaseBehaviorTaggable extends ComTagsDatabaseBehaviorTaggable
{

    protected $package;

    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        $this->package = $config->package;
    }

    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'package' => 'cfg',
        ));

        parent::_initialize($config);
    }

    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Get a list of tags
     *
     * @return KDatabaseRowsetInterface
     */
    public function getTags()
    {
        $package = $this->getPackage();

        $model = $this->getObject('com:tags.model.tags', array('table' => $package . '_tags'));
        if (!$this->isNew()) {
            $tags = $model->row($this->uuid)->fetch();
        } else {
            $tags = $model->fetch();
        }
        return $tags;
    }

    /**
     * Modify the select query
     *
     * If the query's where information includes a tag property, auto-join the tags tables with the query and select
     * all the rows that are tagged with a term.
     */
    protected function _beforeSelect(KDatabaseContext $context)
    {
        $query = $context->query;
        if ($context->query->params->has('tag')) {
            $package = $this->getPackage();

            $query->join($package . '_tags_relations AS tags_relations', 'tags_relations.row = tbl.uuid');
            $query->join($package . '_tags AS tags', 'tags.tag_id = tags_relations.tag_id');
            $query->where('tags.slug IN :tag');
        }

    }

}