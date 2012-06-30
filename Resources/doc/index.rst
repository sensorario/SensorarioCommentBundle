Requirements
============

This bundle use jquery. To include it use:

::

    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"
        type="text/javascript"></script>

Register Sensorario Namespace
=============================

::

    $loader->registerNamespaces(array(
        ....
        'Sensorario'                        => __DIR__.'/../vendor/bundles',
        ....
    ));

Add Bundle to AppKernel
=======================

::

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

::

    [SensorarioCommentBundle]
        git=git://github.com/sensorario/SensorarioCommentBundle.git
        target=/bundles/Sensorario/CommentBundle

And install this vendor

::

    $ php bin/vendors install

Update your DB schema with Doctrine
===================================

If you want, can add migrations for update your database.
SensorarioCommentBundle use Comment entity to store comments. So, you must
update your database before start to use this bundle.

::

    $ php app/console doctrine:migrations:diff
    $ php app/console doctrine:migrations:migrate

Also, you can update your database schema with:

::

    $ php app/console doctrine:schema:update --force

Install assets
==============

Run this command:

::

    $ php app/console assets:install web/

Add routing
===========

Add this in routing.yml

::

    SensorarioCommentBundle:
        resource: "@SensorarioCommentBundle/Controller/"
        type:     annotation
        prefix:   /

Usage
=====

Just put this snippet of code on your pages, to comment them. And just remember
to change "unique_id" for each different "thread".

::

    {% render 'SensorarioCommentBundle:Index:index' with {'unique_id': 'home_page'} %}

Nice gui with Twitter Bootstrap
===============================

Also, if you like, can override comments.html.twig template with this. This
template add some icons. Like a trash for delete a comment, a "user" icon near
username, and a clock near comment datetime creation.

::

    <table>
        {% for commento in comments %}
            <tr id="sensorario_comment_tr_{{ commento.id }}">
                <td>
                    <span class="icon-time"></span> {{ commento.getCreationDate|date("d/m/Y") }}<br />
                    <span class="icon-user"></span> <strong>{{ commento.author }}</strong>: {{ commento.comment }}<br />
                </td>
                <td>
                    <a  
                    href="{{ path('sensorario_comment_delete', {'unique_id': commento.unique_id}) }}"
                    class="SensorarioCommentsDelete"
                    id="delete_{{ commento.id }}"
                    data="{{ commento.id }}">
                        <span class="icon-trash"></span>
                    </a>
                </td>
            </tr>
        {% endfor %}
    </table>
