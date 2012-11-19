html.class.php
==============

A pretty HTML class to use with any PHP project

To use, include the file and instantiate

    require_once('html.class.php');
    $html = new HTML();

Stylesheets/Javascript

    $html->includeCss(array('typography.css','ui.css'));
    // Outputs
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/typography.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/ui.css" />

Links

    $html->link_to('My link', 'http://localhost');
    // Outputs
    <a href="http://localhost">My link</a>

See source code for documentation

http://www.whoistom.me