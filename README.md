Register Sensorario Namespace
=============================

    $loader->registerNamespaces(array(
        ....
        'Sensorario'                        => __DIR__.'/../vendor/bundles',
        ....
    ));

Add Bundle to AppKernel
=======================

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Sensorario\CommentBundle\SensorarioCommentBundle(),
                ...
            );
        }

        ...
    }

Install
=======

Update your deps file

    [SensorarioCommentBundle]
        git=git://github.com/sensorario/SensorarioCommentBundle.git
        target=/bundles/Sensorario/CommentBundle

And install this vendor

    $ php bin/vendors install

Update your DB schema
=====================

SensorarioCommentBundle use Comment entity to store comments. So, you must
update your database before start to use this bundle.

    $ php app/console doctrine:migrations:diff
    $ php app/console doctrine:migrations:migrate

Usage
=====

    {% render 'SensorarioCommentBundle:Default:index' with {'id': 'home_page'} %}