Acf Oowp Bundle
========================

Symfony 2 Bundle to use with the Wordpress enabled Symfony 2 using the [RoutemasterBundle](https://github.com/outlandishideas/RoutemasterBundle) 
when using the [Advanced Custom Fields plugin](http://www.advancedcustomfields.com/).

It wraps the Advanced Custom Field plugin functions within a service, allowing you inject these functions as a dependency for other services.
Additionally it provides a Repository service that can used to save simple Models in the database that can be edited on the backend using 
custom fields.

## Features

* Wraps Advanced Custom Field plugin functions within a service, to make them testable and injectable.
* Store simple Models using Advanced Custom Fields with the Acf Repository service (Models must implement the Acf Model interface).

## Installation

* Add the github repository `https://github.com/outlandishideas/AcfOowpBundle.git` to the repositories section of your composer.json file
* Run `composer require outlandish/acf-oowp-bundle` (assuming [Composer](http://getcomposer.org/download/) is installed globally).

## Using Acf to store your models

Using Repeater Fields or Flexible Content fields, it is possible to store representations of a model using ACF.
The sub fields of a repeater field would store the different fields of an object, and each row would represent a new model.

This allows for the storing of simple models different to storing them as a custom post type, while providing 
the user a way of adding, deleting and updating them through the Wordpress interface.

* Create a new model with a number of fields. These fields must be possible to represent in some form using Acf fields.
* Create the repeater field in your Wordpress instance.
* Use the `Outlandish\AcfOowpBundle\Repository\Acf` to fetch, delete, update and create your models into Acf field.á