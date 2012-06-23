Register Sensorario Namespace
=============================

    $loader->registerNamespaces(array(
        ....
        'Sensorario'                        => __DIR__.'/../vendor/bundles',
        ....
    ));

Update your DB schema
=====================

SensorarioCommentBundle use Comment entity to store comments. So, you must
update your database before start to use this bundle.

    $ php app/console doctrine:migrations:diff
    $ php app/console doctrine:migrations:migrate

Usage
=====

    {% render 'SensorarioCommentBundle:Default:index' with {'id': 'home_page'} %}