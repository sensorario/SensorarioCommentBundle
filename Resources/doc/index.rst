SensorarioCommentBundle
-----------------------

Installation
=============

Import routing
--------------

=============
Configuration
=============

::

    SensorarioCommentBundle:
        resource: "@SensorarioCommentBundle/Controller/"
        type:     annotation
        prefix:   /

==========
jquery cdn
==========

::

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

======
assets
======

::

    $ php app/console assets:install
