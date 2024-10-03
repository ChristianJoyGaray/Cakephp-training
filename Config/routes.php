<?php

// Basic routes
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

// Router::connect(
//   '/api/cruds/:id',
//   ['controller' => 'Cruds', 'action' => 'edit'],
//   ['pass' => ['id'], 'id' => '[0-9]+']
// );

// Router::connect('/api/cruds/:id', 
//     array('controller' => 'Cruds', 'action' => 'edit'), 
//     array('pass' => array('id'), 'id' => '[0-9]+', '[method]' => 'PUT')
// );



// Beneficiary delete route
Router::connect(
  '/beneficiary/:id',
  ['controller' => 'Beneficiaries', 'action' => 'delete'],
  ['pass' => ['id'], 'id' => '\d+']
);

// Print CRUD route
Router::connect('/crud/print/:id', 
  ['controller' => 'Cruds', 'action' => 'printCrud'], 
  ['pass' => ['id'], 'id' => '[0-9]+']
);



Router::connect('/cruds/printCrud/*', ['controller' => 'Cruds', 'action' => 'printCrud']);

// Add routes for approval and disapproval actions
Router::connect('/api/cruds/:id/approve', // Updated route for approval
  ['controller' => 'Cruds', 'action' => 'approve'], 
  ['pass' => ['id'], 'id' => '\d+'] // Ensure ID is numeric
);

Router::connect('/api/cruds/:id/disapprove', 
  ['controller' => 'Cruds', 'action' => 'disapprove'], 
  ['pass' => ['id'], 'id' => '[0-9]+'] // Specify the ID to be numeric
);

// Map resources for API
$resources = array(
  'users', 'select', 'cruds', 'crudstatuses', 'assigns', 'names', 'suppliers', 'shipments', 'equips', 'trucks'
);
Router::mapResources($resources, array('prefix' => 'api'));

// Parse JSON for API requests
Router::parseExtensions('json');

// Load CakePHP plugin and default routes
CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
