 app.factory("CrudStatuses", function($resource) {
  return $resource( api + "crudstatuses/:id", { id: '@id'}, {
    query: { method: 'GET', isArray: false },
    update: { method: 'PUT' },
  });
});

// app.factory("Select", function($resource) {
//   return $resource(api + "select/:id", { id: '@id' }, {
//     get: { method: 'GET', isArray: false },
//     query: { method: 'GET', isArray: true } // if you need to get a list
//   });
// });
// app.factory('CrudStatuses', function($resource) {
//   return $resource('/Training/api/crudstatuses/:id', {id: '@id'}, {
//       'save': { method: 'POST' },
//       'query': { method: 'GET', isArray: true }
//   });
// });


// app.factory('CrudStatuses', ['$resource', function($resource) {
//   return $resource('/Training/api/crudstatuses/:id', { id: '@id' }, {
//       'update': { method: 'PUT' }
//   });
// }]);


// app.factory("UserPermission", function($resource) {
//   return $resource( api + 'user-permissions/:id', {id:'@id'}, {
//     query: { method: 'GET', isArray: false },
//     update: { method: 'PUT' }
//   });
// });

// app.factory("DeleteSelected", function($resource) {
//   return $resource( api + 'user_permissions/deleteSelected/:id', {id:'@id'}, {
//     query: { method: 'GET', isArray: false },
//     update: { method: 'PUT' }
//   });
// });

