<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

class ComCfgvideosModelEntityVideo extends KModelEntityRow
{

    protected $_vimeo_data = null;

    protected $_vimeo_embed_url = 'https://vimeo.com/api/oembed.json';

    public function getVimeoData()
    {

        if(!$this->_vimeo_data)
        {
            $client = JHttpFactory::getHttp();
            $response = $client->get($this->_vimeo_embed_url . '?url='.$this->video_url);

            if($response->code == '200')
            {
                $this->_vimeo_data = $this->getObject('object.config.factory')->fromString('json', $response->body);
            }
            else $this->_vimeo_data = $this->getObject('object.config.factory')->fromString('json', '{}');

        }

        return $this->_vimeo_data;
    }
}