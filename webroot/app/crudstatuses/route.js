app.config(function($routeProvider) {
  $routeProvider
  .when('/crudstatuses', {
    templateUrl: tmp + 'crudstatuses__index',
    controller: 'CrudController',
  })
  .when('/crudstatuses/add', {
    templateUrl: tmp + 'crudstatuses__add',
    controller: 'CrudStatusesAddController',
  })
  .when('/crudstatuses/edit/:id', {
    templateUrl: tmp + 'crudstatuses__edit',
    controller: 'CrudStatusesEditController',
  })
  .when('/crudstatuses/view/:id', {
    templateUrl: tmp + 'crudstatuses__view',
    controller: 'CrudStatusesViewController',
  })
  ;

});


