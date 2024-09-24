app.factory("Crud", function($resource) {
  return $resource( api + "cruds/:id", { id: '@id', search: '@search' }, {
    query: { method: 'GET', isArray: false },
    update: { method: 'PUT' },
    search: { method: 'GET' },
  });
});

app.factory("Beneficiary", function($resource) {
  return $resource(api + "beneficiary/:id", { id: '@id', search: '@search' }, {
    query: { method: 'GET', isArray: false },
    update: { method: 'PUT' },
    search: { method: 'GET' },
    save: { method: 'POST' },  // For creating a new beneficiary
    delete: { method: 'DELETE' }  // For deleting a beneficiary
  });
});

// Crud.deleteBeneficiary = function(data, callback) {
//   return $http.post('/path-to-your-delete-api', data).then(function(response) {
//       callback(response.data);
//   });
// };


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

