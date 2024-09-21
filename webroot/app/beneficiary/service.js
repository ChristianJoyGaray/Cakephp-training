app.factory("Beneficiary", function($resource) {
  return $resource(api + "beneficiary/:id", { id: '@id', search: '@search' }, {
    query: { method: 'GET', isArray: false },
    update: { method: 'PUT' },
    search: { method: 'GET' },
    save: { method: 'POST' },  // For creating a new beneficiary
    delete: { method: 'DELETE' }  // For deleting a beneficiary
  });
});