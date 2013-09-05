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

#### Access the meta in page loops;

````
{% for page in pages %}
{% if page.date %}
<!-- Note we check for Date field (posts) here -->
<aside>
<h1 class=""><a href="{{ page.url }}">{{ page.title }}</a></h1>
    <p class="">{{ page.excerpt }}</p>
    <p>Meta- Values : Type - {{ page.type }} - Slug - {{ page.slug }}</p>
</aside>
{% endif %}
{% endfor %}
````

License
-------

### Released under the MIT license.

Copyright (c) <year> <copyright holders>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.