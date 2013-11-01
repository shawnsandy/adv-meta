<?php

/**
 * The file description. *
 * @package Pico
 * @subpackage Adv meta
 * @version 0.1.3
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 *
 */
use \Michelf\MarkdownExtra;

class Adv_Meta {

    private /* default meta values */
            $meta_values = array(
                //page slug keep lower case
                'slug' => 'Slug',
                //page category
                'category' => 'Category',
                //page status
                'status' => 'Status',
                //Type -- page, post, plugin
                'type' => 'Type',
                //Page Thumbnail -- (theme/images)
                'thumbnail' => 'Thumbnail',
                // image for page icon -- (theme/images/)
                'icon' => 'Icon',
                //use custom page template(s)
                'tpl' => 'Tpl'
                    ),
            $content = null,
            $config = null,
            $custom_meta_enabled = false,
            $meta = array(),
            $column_data;

    public function __construct() {

    }

    public function before_load_content(&$file) {

        if (file_exists($file))
            $this->content = file_get_contents($file);
    }

    public function config_loaded(&$settings) {

        $this->config = $settings;
        if (isset($settings['custom_meta_values']))
            $this->meta_values = $settings['custom_meta_values'];
    }

    public function before_read_file_meta(&$headers) {

        foreach ($this->meta_values as $key => $value) {
            $headers[$key] = $value;
        }
        //var_dump($headers);
    }

    public function content_parsed(&$content) {
        $pattern = '#({column:(.*?)})(.+?)({/column:\\2})#ims';
        preg_match_all($pattern, $content, $matches);

        if (!empty($matches)):
            $counter = 0;
            foreach ($matches[2] as $var) {
                $columns[trim($var)] = MarkdownExtra::defaultTransform($matches[3][$counter]);
                $counter++;
            }
            $content = $columns['content'];
            $this->column_data = $columns;

        endif;
    }

    public function get_page_data(&$data, $page_meta) {
        //$data = array_merge($data, $this->adv_file_meta()) ;
        foreach ($page_meta as $key => $value) {
            $data[$key] = $value;
        }
        $data['content'] = $this->column_data['content'];
        $data['excerpt'] = $this->limit_words(strip_tags($this->column_data['content']), $this->config['excerpt_length']) ;
    }

    public function before_render(&$twig_vars, &$twig) {

        $twig_vars['adv_meta'] = $this->adv_file_meta();
        //var_dump($this->adv_file_meta());
        if(!empty($this->column_data)):
            $data = $this->column_data;
            //unset($data['content']);
            foreach ($data as $key => $val):
              $twig_vars[$key] = $val;
            endforeach;
        endif;
        var_dump($twig_vars);
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
        //var_dump($headers);
        return $headers;
    }

    /**
     * grabbed form pico
     * @param type $string
     * @param type $word_limit
     * @return string
     */
    protected function limit_words($string, $word_limit)
	{
		$words = explode(' ',$string);
		$excerpt = trim(implode(' ', array_splice($words, 0, $word_limit)));
		if(count($words) > $word_limit) $excerpt .= '&hellip;';
		return $excerpt;
	}

}
