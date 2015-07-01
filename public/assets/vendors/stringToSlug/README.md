jQuery Plugin stringToSlug
=============

A Simple Plugin in jQuery JavaScript Framework.
The stringToSlug converts any string to SLUG supporting all Languages using or not accent and special chars as well.

Default Usage:
-----------------

    $(document).ready( function() {
        $("#string").stringToSlug();
    });


 [More in github page](http://leocaseiro.github.io/jQuery-Plugin-stringToSlug/)


The plugin removes special characters, converts the string to lowercase and defines a space character. You can set a prefix and/or suffix before to convert it.

Transforming a string into a url-friendly permalink.
You can use the plugin to display a view in html elements or form inputs.

It is the only plugin that removes the stress of words, exchanging letters marked by unaccented letters.

Features version 1.0.0:
-----------------
* Set one or more events to work (Default events are keyup, keydown and blur)
* Set get input or element to view the slug (Ex: input[type=hidden] or span#slug)
* Set character to space (Ex: hiphen or underscore)

Features version 1.0.1:
-----------------
* a little upgrade for win-1250. Some czech letters more (by Ales)

Features available with version 1.2.0
-----------------
* Set prefix (Ex: prefix table "tbl_")
* Set suffix (Ex: file extension ".jpg")
* Define replace regExpress before the slug be generated (Ex: remove text in parentheses)

Features available with version 1.2.1
-----------------
* Fixed error when use '_' or other char in space char
* callback implemented // eq: function(text){ console.log(text); }

Features available with version 1.3.0
-----------------
* Replace AND char
* Fixed quote error following the ISSUE: Undefined chars #4
