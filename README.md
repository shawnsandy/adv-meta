Pico adv-meta
========

A simple plugin to extend and add any values to the page header, makes it easy to customize page meta -- until Pico adds this option by default.

`
<pre>
/*
    Title: Sample Page
    Author:
    Date: 2013/07/18
    Status: Draft
    Category: Featured
    Robots: none
*/
</pre>
`

Installation
-------------

1. Copy the plugin file/folder the plugins directory of your Pico site.
2. Open the pico config.php and insert add your custom meta values or use the plugin default -- (slug,category,status,type,thumbnail,icon,tpl).
3. Add the custom values to your page as you would normally
4. They can now be accessed in themes as regular meta values {{ meta.category }}

#### Sample with Default adv_meta_values, copy to your config and modify
`
<pre>
    $config['adv_meta_values'] = array(
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
</pre>
`