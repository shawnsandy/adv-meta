Pico adv-meta
========

A simple plugin to extend and add any values to the page header, makes it easy to customize page meta -- until Pico (devs) adds this option by default.

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
2. Open the pico config.php and insert add your custom meta values eg.
3. Add the values to your page as you would default values
4. They can now be accessed in themes as regular meta values {{ meta.category }}

### Sample adv_meta_values for config
`
<pre>
    $config['adv_meta_values'] = array(
    'category' => 'Category',
    'status' => 'Status',
    'type' => 'Type'
</pre>
`