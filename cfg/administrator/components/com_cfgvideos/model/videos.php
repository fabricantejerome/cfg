<?php
/**
 * Cfgvideos - an extension built with Nooku Framework.
 *
 */

class ComCfgvideosModelVideos extends KModelDatabase
{
    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('enabled', 'int');
    }

    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'searchable' => array('columns' => array('title', 'description')),
            )
        ));

        parent::_initialize($config);
    }

    protected function _buildQueryWhere(KDatabaseQueryInterface $query)
    {
        parent::_buildQueryWhere($query);

        $state = $this->getState();

        if (!is_null($state->enabled))
        {
            $query->where('(tbl.enabled IN :enabled)')->bind(array('enabled' => (array) $state->enabled));
        }
    }
}