# grigoros-boilerplate

This is a silex application skeleton named Grigoros.
This package come with handy tools out of the box to increasy development productivity.
Fits like a glove for small projects, and projects that require a quick development.

## Features
* [Silex Application](http://silex.sensiolabs.org/)
* [Doctrine ORM](http://www.doctrine-project.org/projects/orm.html)
* [Grunt task runner](http://gruntjs.com)
* [Monolog](https://github.com/seldaek/monolog)
* MySql log handler (Save logs to database)
* [Symfony Console Component](http://symfony.com/doc/current/components/console/introduction.html)
* [Twig Template Engine](http://twig.sensiolabs.org/)
* [Vue.js](http://vuejs.org)

## Instalation

Clone the repository
```
git clone https://github.com/dbiagi/silex-boilerplate.git
```

Install dependencies
```
composer install
npm install
bower install
```

_Optional_: If vue will be used in your project, run these followings commands to install browserify and compile vue components respectively.

```
npm install -g browserify
grunt vueify
```

Create the config/parameters.yml with db settings

TODO
* Configure swiftmailer provider
