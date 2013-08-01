<?php

/**
 * The file description. *
 * @package Pico
 * @subpackage Basejump
 * @since BJ 1.0
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */
class Adv_Meta {

    private /* default meta valuse */
            $meta_values = array(
                //page category
                'category' => 'Category',
                //page status
                'status' => 'Status',
                //Type -- page, post, plugin
                'type' => 'Type',
                //Page Thumbnail -- (theme/images)
                'thumbnail' => 'Thumbnail',
                // image for page icon -- (theme/images/)
                'icon' => 'Icon'
                    ),
            $content = null,
            $config = null;

    public function __construct() {

    }

    public function before_load_content(&$file) {

        $this->content = file_get_contents($file);
        
    }

    public function config_loaded(&$settings) {

        $this->config = $settings;
    }

    public function file_meta(&$meta) {

        $adv_meta = $this->adv_file_meta();

        $meta = array_merge($meta, $adv_meta);

        //var_dump($meta);

        return $meta;
    }

    /**
     * Grab the file meta here
     * @return string
     */
    private function adv_file_meta() {

        //include the config aand grab some useful values
        $content = $this->content;
        $config = $this->config;

        if (!isset($this->config))
            $config = array();

        if (isset($config['adv_meta_values']))
            $this->meta_values = $config['adv_meta_values'];

        $headers = $this->meta_values;

        foreach ($headers as $field => $regex) {
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $content, $match) && $match[1]) {
                $headers[$field] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            } else {
                $headers[$field] = '';
            }
        }
        return $headers;
    }

}
