<?php

  Router::connect('/', array(
    'controller' => 'main',
    'action'     => 'index',
  ));

  Router::connect('/login', array(
    'controller' => 'main',
    'action' => 'login',
  ));

  Router::connect('/logout', array(
    'controller' => 'main',
    'action'     => 'logout'
  ));

  Router::connect(
    '/beneficiary/:id',
    ['controller' => 'Beneficiaries', 'action' => 'delete'],
    ['pass' => ['id'], 'id' => '\d+']
);


// app/Config/routes.php
// Router::connect('/api/select', array('controller' => 'crud_statuses', 'action' => 'select', 'api' => true));

Router::connect('/crud/print/:id', 
    ['controller' => 'cruds', 'action' => 'printCrud'], 
    ['pass' => ['id'], 'id' => '[0-9]+']
);


    // api resources
    $resources = array(
      'users','select',
      'cruds','crudstatuses', 'assigns', 'names', 'suppliers', 'shipments', 'equips', 'trucks'
    );

  Router::mapResources($resources, array('prefix' => 'api'));
  Router::parseExtensions('json');

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
