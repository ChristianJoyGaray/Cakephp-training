
//OGGGGGG
// app.controller('CrudController', function($scope, Crud) {
//   // Load data
//   $scope.load = function(options) {
//     options = typeof options !== 'undefined' ? options : {};
//     Crud.query(options, function(e) {
//       if (e.ok) {
//         // Update cruds to use the new structure from the backend response
//         $scope.cruds = e.data; // This should match the response structure
//         // Pagination
//         $scope.paginator = e.paginator;
//         $scope.pages = paginator($scope.paginator, 5);
//       }
//     });
//   }
  
//   $scope.load();

//   // Search
//   $scope.search = function(search) {
//     search = typeof search !== 'undefined' ? search : '';
//     if (search.length > 0) {
//       $scope.load({
//         search: search
//       });
//     } else {
//       $scope.load();
//     }
//   }
  
//   // Remove
//   $scope.remove = function(data) {
//     bootbox.confirm('Are you sure you want to delete ' + data.name + ' ?', function(c) {
//       if (c) {
//         Crud.remove({ id: data.id }, function(e) {
//           if (e.ok) {
//             $.gritter.add({
//               title: 'Successful!',
//               text: e.msg,
//             });
//             $scope.load();
//           }
//         });
//       }
//     });
//   }
// });

//WORKING SEARCH
// app.controller('CrudController', function($scope, Crud) {
    
//   $scope.cruds = [];
//   $scope.searchTxt = '';

//   // Load data
//   $scope.load = function(options) {
//       options = options || {};

//       // Call the CRUD API with the options (which may include the search term)
//       Crud.query(options, function(e) {
//           console.log('Options:', options); // Log options to check search term
//           console.log('Backend response:', e); // Log response to ensure correct data

//           if (e.ok) {
//               // Update cruds with the filtered data (returned by the backend)
//               $scope.cruds = e.data && e.data.length > 0 ? e.data : []; // Use filtered results
//               console.log('Cruds:', $scope.cruds); // Log the cruds array

//               // Update paginator info
//               $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 };

//               // If there are results, create pages; otherwise, reset pages
//               $scope.pages = $scope.paginator.pageCount > 0 ? paginator($scope.paginator, 5) : [];
//           } else {
//               // Handle the case where the query was not successful
//               console.error('Error fetching data:', e);
//           }
//       });
//   };

//   // Search functionality
//   $scope.search = function() {
//       console.log('Search term:', $scope.searchTxt);
//       if ($scope.searchTxt.length > 0) {
//           $scope.load({ search: $scope.searchTxt }); // Load filtered results
//       } else {
//           $scope.load(); // Load all items if the search box is empty
//       }
//   };

//   // Initialize load
//   $scope.load();
//   $scope.remove = function(data) {
//         bootbox.confirm('Are you sure you want to delete ' + data.name +' ?', function(c) {
//           if (c) {
//             Crud.remove({ id: data.id }, function(e) {
//               if (e.ok) {
//                 $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//                 });
//                 $scope.load();
//               }
//             });
//           }
//         });
//       }
// });

// WORKING EVERYTHING BUT I NEED TO FIX THE PRINT BUTTON FOR TABS
// app.controller('CrudController', function($scope, Crud) {
    
//     $scope.cruds = [];
//     $scope.searchTxt = '';
//     $scope.printUrl = ''; // Initialize print URL
//     $scope.statusFilter = ''; // Initialize status filter for tabs
  
//     // Load data
//     $scope.load = function(options) {
//         options = options || {};
  
//         // Apply status filter if set
//         if ($scope.statusFilter) {
//             options.status = $scope.statusFilter;
//         }
  
//         // Call the CRUD API with the options (including the search term and status filter)
//         Crud.query(options, function(e) {
//             console.log('Options:', options); // Log options to check search term and status filter
//             console.log('Backend response:', e); // Log response to ensure correct data
  
//             if (e.ok) {
//                 // Update cruds with the filtered data (returned by the backend)
//                 $scope.cruds = e.data && e.data.length > 0 ? e.data : []; // Use filtered results
//                 console.log('Cruds:', $scope.cruds); // Log the cruds array
  
//                 // Update paginator info
//                 $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 };
  
//                 // If there are results, create pages; otherwise, reset pages
//                 $scope.pages = $scope.paginator.pageCount > 0 ? paginator($scope.paginator, 5) : [];
  
//                 // Prepare the print URL with the current search term
//                 $scope.printUrl = '/Training/cruds/printCrud?search=' + encodeURIComponent($scope.searchTxt);
//             } else {
//                 // Handle the case where the query was not successful
//                 console.error('Error fetching data:', e);
//             }
//         });
//     };
  
//     // Search functionality
//     $scope.search = function() {
//         console.log('Search term:', $scope.searchTxt);
//         if ($scope.searchTxt.length > 0) {
//             $scope.load({ search: $scope.searchTxt }); // Load filtered results
//         } else {
//             $scope.load(); // Load all items if the search box is empty
//         }
//     };
  
//     // Function to handle the Print button click
//     $scope.print = function() {
//         // Navigate to the print URL with the current search term
//         window.open($scope.printUrl, '_blank');
//     };
  
//     // Function to handle tab clicks for filtering by status
//     $scope.filterByStatus = function(status) {
//         $scope.statusFilter = status; // Set the selected status filter
//         $scope.load(); // Reload data with the selected status filter
//     };
  
//     // Initialize load
//     $scope.load();
  
//     $scope.remove = function(data) {
//         bootbox.confirm('Are you sure you want to delete ' + data.name + ' ?', function(c) {
//             if (c) {
//                 Crud.remove({ id: data.id }, function(e) {
//                     if (e.ok) {
//                         $.gritter.add({
//                             title: 'Successful!',
//                             text: e.msg,
//                         });
//                         $scope.load();
//                     }
//                 });
//             }
//         });
//     };
//   });
//WORKING
app.controller('CrudController', function($scope, Crud) {
    
    $scope.cruds = [];
    $scope.searchTxt = '';
    $scope.printUrl = ''; // Initialize print URL
    $scope.statusFilter = ''; // Initialize status filter for tabs

    // Load data
    $scope.load = function(options) {
        options = options || {};

        // Apply status filter if set
        if ($scope.statusFilter) {
            options.status = $scope.statusFilter; // Include status in options for the API
        }

        // Call the CRUD API with the options (including the search term and status filter)
        Crud.query(options, function(e) {
            console.log('Options:', options); // Log options to check search term and status filter
            console.log('Backend response:', e); // Log response to ensure correct data

            if (e.ok) {
                // Update cruds with the filtered data (returned by the backend)
                $scope.cruds = e.data && e.data.length > 0 ? e.data : []; // Use filtered results
                console.log('Cruds:', $scope.cruds); // Log the cruds array

                // Update paginator info
                $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 }; // Ensure paginator structure exists
            }
        });
    };

    // Filter function for approval status
    $scope.filterByApproval = function(status) {
        $scope.statusFilter = status; // Set the selected status filter
        $scope.load({ page: 1 }); // Reload data with the new filter
    };

    // Search functionality (if you want to implement)
    $scope.search = function() {
        $scope.load({ search: $scope.searchTxt }); // Trigger load with search term
    };

    // Initial load
    $scope.load();
});





// app.controller('CrudController', function($scope, Crud) {
//     $scope.cruds = [];
//     $scope.searchTxt = '';
//     $scope.printUrl = ''; // Initialize print URL
//     $scope.statusFilter = ''; // Initialize status filter for tabs

//     // Load data
//     $scope.load = function(options) {
//         options = options || {};

//         // Apply status filter if set
//         if ($scope.statusFilter) {
//             options.tab = $scope.statusFilter; // Pass the status filter as 'tab'
//         }

//         // Call the CRUD API with the options (including the search term and status filter)
//         Crud.query(options, function(e) {
//             console.log('Options:', options); // Log options to check search term and status filter
//             console.log('Backend response:', e); // Log response to ensure correct data

//             if (e.ok) {
//                 // Update cruds with the filtered data (returned by the backend)
//                 $scope.cruds = e.data && e.data.length > 0 ? e.data : []; // Use filtered results
//                 console.log('Cruds:', $scope.cruds); // Log the cruds array

//                 // Update paginator info
//                 $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 };

//                 // If there are results, create pages; otherwise, reset pages
//                 $scope.pages = $scope.paginator.pageCount > 0 ? paginator($scope.paginator, 5) : [];

//                 // Prepare the print URL with the current search term
//                 $scope.printUrl = '/Training/cruds/printCrud?search=' + encodeURIComponent($scope.searchTxt);
//             } else {
//                 // Handle the case where the query was not successful
//                 console.error('Error fetching data:', e);
//             }
//         });
//     };

//     // Search functionality
//     $scope.search = function() {
//         console.log('Search term:', $scope.searchTxt);
//         if ($scope.searchTxt.length > 0) {
//             $scope.load({ search: $scope.searchTxt }); // Load filtered results
//         } else {
//             $scope.load(); // Load all items if the search box is empty
//         }
//     };

//     // Function to handle the Print button click
//     $scope.print = function() {
//         // Navigate to the print URL with the current search term
//         window.open($scope.printUrl, '_blank');
//     };

//     // Function to handle tab clicks for filtering by status
//     $scope.filterByStatus = function(status) {
//         $scope.statusFilter = status; // Set the selected status filter
//         $scope.load(); // Reload data with the selected status filter
//     };

//     // Initialize load
//     $scope.load();

//     $scope.remove = function(data) {
//         bootbox.confirm('Are you sure you want to delete ' + data.name + ' ?', function(c) {
//             if (c) {
//                 Crud.remove({ id: data.id }, function(e) {
//                     if (e.ok) {
//                         $.gritter.add({
//                             title: 'Successful!',
//                             text: e.msg,
//                         });
//                         $scope.load();
//                     }
//                 });
//             }
//         });
//     };
// });











// app.controller('CrudController', function($scope, Crud) {
//     $scope.cruds = [];
//     $scope.searchTxt = '';
//     $scope.printUrl = ''; // Initialize print URL
//     $scope.activeTab = 'PENDING'; // Default to PENDING tab

//     // Load data
//     $scope.load = function(options) {
//         options = options || {};
        
//         // Apply approve filter based on activeTab
//         if ($scope.activeTab === 'PENDING') {
//             options.approve = null; // Filter for pending
//         } else if ($scope.activeTab === 'APPROVED') {
//             options.approve = 1; // Filter for approved
//         } else if ($scope.activeTab === 'DISAPPROVED') {
//             options.approve = 0; // Filter for disapproved
//         }

//         // Log options before making the API call
//         console.log('Options before API call:', options);

//         // Call the CRUD API with the options
//         Crud.query(options, function(e) {
//             console.log('Backend response:', e); // Log response to ensure correct data

//             if (e.ok) {
//                 // Update cruds with the filtered data
//                 $scope.cruds = e.data && e.data.length > 0 ? e.data : []; // Use filtered results
//                 console.log('Cruds:', $scope.cruds); // Log the cruds array

//                 // Update paginator info
//                 $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 };

//                 // If there are results, create pages; otherwise, reset pages
//                 $scope.pages = $scope.paginator.pageCount > 0 ? paginator($scope.paginator, 5) : [];

//                 // Prepare the print URL with the current search term
//                 $scope.printUrl = '/Training/cruds/printCrud?search=' + encodeURIComponent($scope.searchTxt);
//             } else {
//                 // Handle the case where the query was not successful
//                 console.error('Error fetching data:', e);
//             }
//         });
//     };

//     // Search functionality
//     $scope.search = function() {
//         console.log('Search term:', $scope.searchTxt);
//         $scope.load({ search: $scope.searchTxt }); // Load filtered results with search term
//     };

//     // Function to handle the Print button click
//     $scope.print = function() {
//         // Navigate to the print URL with the current search term
//         window.open($scope.printUrl, '_blank');
//     };

//     // Set active tab for approval filter
//     $scope.setActiveTab = function(tab) {
//         $scope.activeTab = tab; // Set the active tab
    
//         let options = { search: $scope.searchTxt }; // Include current search text
    
//         // Set the appropriate approve filter based on the active tab
//         if ($scope.activeTab === 'PENDING') {
//             options.approve = null; // Filter for pending
//         } else if ($scope.activeTab === 'APPROVED') {
//             options.approve = 1; // Filter for approved
//         } else if ($scope.activeTab === 'DISAPPROVED') {
//             options.approve = 0; // Filter for disapproved
//         }
    
//         $scope.load(options); // Reload data with the new filter
//     };
    

//     // Initialize load
//     $scope.load();

//     $scope.remove = function(data) {
//         bootbox.confirm('Are you sure you want to delete ' + data.name + ' ?', function(c) {
//             if (c) {
//                 Crud.remove({ id: data.id }, function(e) {
//                     if (e.ok) {
//                         $.gritter.add({
//                             title: 'Successful!',
//                             text: e.msg,
//                         });
//                         $scope.load(); // Reload after deletion
//                     }
//                 });
//             }
//         });
//     };
// });


  

// app.controller('CrudController', function($scope, Crud) {

//     $scope.cruds = [];
//     $scope.searchTxt = '';
//     $scope.status = 'all'; // Default status (change this dynamically based on user selection)
//     $scope.printUrl = ''; // Initialize print URL

//     // Load data
//     $scope.load = function(options) {
//         options = options || {};

//         Crud.query(options, function(e) {
//             if (e.ok) {
//                 $scope.cruds = e.data && e.data.length > 0 ? e.data : [];
//                 $scope.paginator = e.paginator || { page: 1, current: 0, count: 0, pageCount: 0 };
//                 $scope.pages = $scope.paginator.pageCount > 0 ? paginator($scope.paginator, 5) : [];

//                 // Prepare the print URL with both search and status filters
//                 var statusParam = $scope.status === 'all' ? '' : '&approve=' + encodeURIComponent($scope.status);
//                 $scope.printUrl = '/Training/cruds/printCrud?search=' + encodeURIComponent($scope.searchTxt) + statusParam;
//             }
//         });
//     };

//     // Search functionality
//     $scope.search = function() {
//         $scope.load({ search: $scope.searchTxt });
//     };

//     // Set status filter and reload the data
//     $scope.filterByStatus = function(status) {
//         $scope.status = status;
//         $scope.load({ search: $scope.searchTxt, approve: status === 'all' ? null : status });
//     };

//     // Print function
//     $scope.print = function() {
//         window.open($scope.printUrl, '_blank');
//     };

//     // Initialize load
//     $scope.load();

// });


// app.controller('CrudsController', function($scope, Crud) {
  
//   // Load data
//   $scope.load = function(options) {
//     options = typeof options !== 'undefined' ? options : {};
//     Crud.query(options, function(e) {
//       if (e.ok) {
//         $scope.cruds = e.data;
//         // Pagination
//         $scope.paginator = e.paginator;
//         $scope.pages = paginator($scope.paginator, 5);
//       }
//     });
//   }

//   $scope.load();
  
//   // Search
//   $scope.search = function(search) {
//     search = typeof search !== 'undefined' ? search : '';
//     if (search.length > 0) {
//       $scope.load({ search: search });
//     } else {
//       $scope.load();
//     }
//   }
    
//   // Remove
//   $scope.remove = function(data) {
//     bootbox.confirm('Are you sure you want to delete ' + data.name +' ?', function(c) {
//       if (c) {
//         Crud.remove({ id: data.id }, function(e) {
//           if (e.ok) {
//             $.gritter.add({
//               title: 'Successful!',
//               text: e.msg,
//             });
//             $scope.load();
//           }
//         });
//       }
//     });
//   }
// });


// app.controller('CrudAddController', function($scope, Crud, Select){
//   $('#form').validationEngine('attach');

//     // $('birthdate').datepicker({
//     //   format: 'mm/dd/yy',
//     //   autoclose: true
//     // });
//     $scope.data = {
//       Beneficiary: {}
//   };
  

//     //get crud status
//     Select.get({code: 'crud-status'}, function(e){
//       $scope.status = e.data;
//     });

//     $scope.save = function(){
//       valid = $("#form").validationEngine('validate');

//       if(valid){
//         Crud.save($scope.data,function(e) {
//           if (e.ok){
//             $.gritter.add({
//               title:'Successful!',
//               text: e.msg,
//             });
//             window.location = '#/cruds';
//           } else{
//             $.gritter.add({
//               title: 'Warning!',
//               text: e.msg,
//             });
//           }
//         }) 
          
        
//       }
//     }

//     $scope.addPermission = function() {
//       console.log("Adding permission..."); // Check if this logs
//       $('.savePermission').attr('disabled', false);
//       $('#add-permission-modal').modal('show');
//   }
//   $scope.savePermission = function(beneficiaryData) {
//     console.log("Saving beneficiary data:", beneficiaryData);
//     // Your save logic here
// };
// });








// WORKING ADD BENEFICIARY























/////////////////
















app.controller('CrudAddController', function($scope, Crud, Select) {
  // Attach validation engine to the form
  $('#form').validationEngine('attach');

  // Initialize data
  $scope.data = {
      Crud: {},
      beneficiaries: []
  };

  // Fetch crud status
  Select.get({ code: 'crud-status' }, function(e) {
      $scope.status = e.data; // Store statuses in the scope
  });

  // Function to save Crud and Beneficiaries
  $scope.save = function() {
      var valid = $("#form").validationEngine('validate');

      if (valid) {
          // Include beneficiaries data with Crud data
          $scope.data.Crud.beneficiaries = $scope.data.beneficiaries;
          console.log($scope.data);

          Crud.save($scope.data, function(e) {
              if (e.ok) {
                  $.gritter.add({
                      title: 'Successful!',
                      text: e.msg,
                  });
                  window.location = '#/cruds'; // Redirect after success
              } else {
                  $.gritter.add({
                      title: 'Warning!',
                      text: e.msg,
                  });
              }
          });
      }
  };

  // Function to add a beneficiary
  $scope.addBeneficiary = function() {
      // Reset the beneficiary data for a new entry
      $scope.newBeneficiary = {};
      $('#add-beneficiary-modal').modal('show');
  };

  // Save new beneficiary
  $scope.saveBeneficiary = function(beneficiaryData) {
      if (beneficiaryData.birthdate) {
          // Calculate age based on birthdate
          const bdayDate = new Date(beneficiaryData.birthdate);
          const today = new Date();
          beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
          const monthDiff = today.getMonth() - bdayDate.getMonth();
          if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
              beneficiaryData.age--;
          }
      }

      $scope.data.beneficiaries.push(beneficiaryData); // Add the new beneficiary to the array
      $('#add-beneficiary-modal').modal('hide');
      $.gritter.add({
          title: 'Beneficiary Added!',
          text: 'The beneficiary has been added successfully.',
      });
  };

  
});


app.controller('CrudAddController', function($scope, Crud, Select) {
  // Attach validation engine to the form
  $('#form').validationEngine('attach');

  // Initialize data
  $scope.data = {
      Crud: {},
      beneficiaries: []
  };

  // Fetch crud status
  Select.get({ code: 'crud-status' }, function(e) {
      $scope.status = e.data; // Store statuses in the scope
  });

  // Function to save Crud and Beneficiaries
  $scope.save = function() {
      var valid = $("#form").validationEngine('validate');

      if (valid) {
          // Include beneficiaries data with Crud data
          $scope.data.Crud.beneficiaries = $scope.data.beneficiaries;
          console.log($scope.data);

          Crud.save($scope.data, function(e) {
              if (e.ok) {
                  $.gritter.add({
                      title: 'Successful!',
                      text: e.msg,
                  });
                  window.location = '#/cruds'; // Redirect after success
              } else {
                  $.gritter.add({
                      title: 'Warning!',
                      text: e.msg,
                  });
              }
          });
      }
  };

  // Function to add a beneficiary
  $scope.addBeneficiary = function() {
      // Reset the beneficiary data for a new entry
      $scope.newBeneficiary = {};
      $('#add-beneficiary-modal').modal('show');
  };

  // Save new beneficiary
  $scope.saveBeneficiary = function(beneficiaryData) {
      if (beneficiaryData.birthdate) {
          // Calculate age based on birthdate
          const bdayDate = new Date(beneficiaryData.birthdate);
          const today = new Date();
          beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
          const monthDiff = today.getMonth() - bdayDate.getMonth();
          if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
              beneficiaryData.age--;
          }
      }

      $scope.data.beneficiaries.push(beneficiaryData); // Add the new beneficiary to the array
      $('#add-beneficiary-modal').modal('hide');
      $.gritter.add({
          title: 'Beneficiary Added!',
          text: 'The beneficiary has been added successfully.',
      });
  };

  // Edit beneficiary
  // Edit beneficiary
$scope.editBeneficiary = function(index, data) {
  $scope.editingIndex = index; // Set index for updating
  $scope.newBeneficiary = angular.copy(data); // Use copy to avoid direct changes
  $('#edit-beneficiary-modal').modal('show'); // Open the modal
};


  // Update beneficiary
  $scope.updateBeneficiary = function(data, index) {
      var valid = $('#edit_beneficiary').validationEngine('validate');

      if (valid) {
          data.amount = number_format(data.amount, 2, '.', ''); 
          $scope.data.beneficiaries[index] = data; // Update the beneficiary
          $.gritter.add({
              title: 'Beneficiary Updated!',
              text: 'The beneficiary has been updated successfully.',
          });
          $('#edit-beneficiary-modal').modal('hide');  
      }
  };

  // Remove beneficiary
  $scope.removeBeneficiary = function(index) {
      $scope.data.beneficiaries.splice(index, 1);
      $.gritter.add({
          title: 'Beneficiary Removed!',
          text: 'The beneficiary has been removed successfully.',
      });
  };
});







































app.controller('CrudViewController', function($scope, $routeParams, Crud, $http) {
  $scope.id = $routeParams.id;
  $scope.data = {}; // Initialize data to an empty object

  // Load the data for the CRUD entry
  $scope.load = function() {
      Crud.get({ id: $scope.id }, function(e) {
          console.log('Loaded data:', e.data); // Log the loaded data
          $scope.data = e.data;
      }, function(error) {
          console.error('Error fetching CRUD data:', error);
          $.gritter.add({
              title: 'Error!',
              text: 'Failed to load CRUD data.'
          });
      });
  };

  $scope.load();

  // Update the approval status
  $scope.updateApproveStatus = function(status) {
    var endpoint = '/Training/api/cruds/' + $scope.id + '/approve'; // Updated endpoint for approval

      // Send the approval status
      $http.put(endpoint, { approve: status }) // Send the approval status (1 or 0)
          .then(function(response) {
              if (response.data.ok) {
                  $.gritter.add({
                      title: 'Successful!',
                      text: 'Approval status updated successfully!'
                  });
                  $scope.load(); // Reload the data to reflect changes
              } else {
                  $.gritter.add({
                      title: 'Error!',
                      text: response.data.msg || 'Unknown error occurred.'
                  });
              }
          })
          .catch(function(error) {
              $.gritter.add({
                  title: 'Request Failed!',
                  text: error.statusText || 'Unknown error'
              });
          });
  };

  // Approve function
  $scope.approveCrud = function() {
      console.log('Approving CRUD with ID:', $scope.id);
      var payload = { approve: 1 }; // Set payload to true (1 in DB)
      $scope.updateApproveStatus(payload.approve); // Call the function to update status
  };

  // Disapprove function
  $scope.disapproveCrud = function() {
      console.log('Disapproving CRUD with ID:', $scope.id);
      $scope.updateApproveStatus(0); // Send 0 for DISAPPROVED
  };

  // Get approval status
  $scope.getApproveStatus = function(approve) {
      if (approve === 1) return 'APPROVED';
      if (approve === 0) return 'DISAPPROVED';
      return 'PENDING'; // Default case
  };

  $scope.isEditDisabled = function() {
    return $scope.data.approve === true || $scope.data.approve === false;
};


$scope.remove = function(data) {
        bootbox.confirm('Are you sure you want to delete ' + data.name +' ?', function(c) {
          if (c) {
            Crud.remove({ id: data.id }, function(e) {
              if (e.ok) {
                $.gritter.add({
                  title: 'Successful!',
                  text: e.msg,
                });
                window.location = '#/cruds';
                $scope.load();
              }
            });
          }
        });
      }

});










//MIGHT NEED TO PUT CODE IN CRUDEDITCONTROLLER




// app.controller('CrudEditController', function($scope, $routeParams, Crud, Select) {

  
//   $scope.id = $routeParams.id;

//   $("#form").validationEngine('attach');
  
//   // load 

//   Select.get({code: 'crud-status'}, function(e){
//     $scope.status = e.data;
//   });


//   $scope.load = function() {

//     Crud.get({ id: $scope.id }, function(e) {

//       $scope.data = e.data;

//       // $scope.data.User.password = '';

//       // $scope.confirmPassword = '';

//       // $scope.putIndex();

//     });

//   }

//   $scope.load();

  
  
//   $scope.update = function() {

//     valid = $("#form").validationEngine('validate');

//     if(valid){
//       Crud.update({ id:$scope.id },$scope.data,function(e) {
//         if (e.ok){
//           $.gritter.add({
//             title:'Successful!',
//             text: e.msg,
//           });
//           window.location = '#/cruds';
//         } else{
//           $.gritter.add({
//             title: 'Warning!',
//             text: e.msg,
//           });
//         }
//       }) 
        
      
//     }

    

      
//     }
    
    
  

  
//   // $scope.data = {};
  
//   // $scope.bool = [{ id: true, value: 'Yes' }, { id: false, value: 'No' }];

//   // // get session

//   // Select.get({code: 'session'}, function(e){

//   //   $scope.roleId = e.data.roleId;

//   // });

//   // // get roles

//   // Select.get({code: 'roles'}, function(e){

//   //   $scope.roles = e.data;

//   // });

//   // // get branches

//   // Select.get({code: 'branch'}, function(e){

//   //   $scope.branches = e.data;

//   // });
  
//   // // get permissions

//   // Select.get({code: 'permissions'}, function(e){

//   //   $scope.permissions = e.data;

//   // });


//   // $scope.compute = function(){

//   //   amount = 0;

//   //   if($scope.data.UserPermission.length > 0){

//   //     $.each($scope.data.UserPermission,function(key,val){

//   //       if(val.visible != 0){

//   //         amount += parseFloat(val['amount']);

//   //       }

//   //     });

//   //   }

//   //   $scope.data.User.total = amount;

//   // }

//   // $scope.getPermission = function(id){

//   //   if($scope.permissions.length > 0){

//   //     $.each($scope.permissions,function(key,val){

//   //       if(id == val.id){

//   //         $scope.adata.permission = val.value;
          
//   //       }

//   //     });

//   //   }
  
//   // }

//   // $scope.putIndex = function(){

//   //   if($scope.data.UserPermission.length > 0){

//   //     index = 0;

//   //     $.each($scope.data.UserPermission,function(key,val){

//   //       if(val.visible != 0){

//   //         index += 1;

//   //         $scope.data.UserPermission[key].index = index;
          
//   //       }

//   //     });

//   //   }

//   // }

//   // $scope.addPermission = function() {

//   //   $('#add_permission').validationEngine('attach');

//   //   $scope.adata = {};

//   //   $('#add-permission-modal').modal('show');  

//   // }

//   // $scope.savePermission = function(data){

//   //   valid = $('#add_permission').validationEngine('validate');

//   //   if(valid){

//   //     data.amount = number_format(data.amount, 2, '.', ''); 

//   //     $scope.data.UserPermission.push(data);

//   //     $scope.compute();

//   //     $scope.putIndex();

//   //     $('#add-permission-modal').modal('hide');  

//   //   }
    
//   // }

//   // $scope.editPermission = function(index,data) {

//   //   $('#edit_permission').validationEngine('attach');

//   //   data.index = index;

//   //   $scope.adata = data;

//   //   $('#edit-permission-modal').modal('show');  

//   // }

//   // $scope.updatePermission = function(data,index) {

//   //   valid = $('#edit_permission').validationEngine('validate');

//   //   if(valid){

//   //     data.amount = number_format(data.amount, 2, '.', ''); 

//   //     $scope.data.UserPermission[data.index] = data;

//   //     $scope.compute();

//   //     $scope.putIndex();

//   //     $('#edit-permission-modal').modal('hide');  

//   //   }

//   // }

//   // $scope.removePermission = function(index){

//   //   $scope.data.UserPermission[index].visible = 0;

//   //   $scope.compute();

//   //   $scope.putIndex();

//   // }
//   $scope.saveBeneficiary = function(beneficiaryData) {
//     if (beneficiaryData.birthdate) {
//         // Calculate age based on birthdate
//         const bdayDate = new Date(beneficiaryData.birthdate);
//         const today = new Date();
//         beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//         const monthDiff = today.getMonth() - bdayDate.getMonth();
//         if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//             beneficiaryData.age--;
//         }
//     }

//     $scope.data.beneficiaries.push(beneficiaryData); // Add the new beneficiary to the array
//     $('#add-beneficiary-modal').modal('hide');
//     $.gritter.add({
//         title: 'Beneficiary Added!',
//         text: 'The beneficiary has been added successfully.',
//     });
// };

// // Edit beneficiary
// $scope.editBeneficiary = function(index, data) {
//     $('#edit_beneficiary').validationEngine('attach');

//     data.index = index;
//     $scope.adata = angular.copy(data); // Use a copy to avoid direct changes
//     $('#edit-beneficiary-modal').modal('show');
// };

// // Update beneficiary
// $scope.updateBeneficiary = function(data, index) {
//     var valid = $('#edit_beneficiary').validationEngine('validate');

//     if (valid) {
//         data.amount = number_format(data.amount, 2, '.', ''); 
//         $scope.data.beneficiaries[index] = data; // Update the beneficiary
//         $.gritter.add({
//             title: 'Beneficiary Updated!',
//             text: 'The beneficiary has been updated successfully.',
//         });
//         $('#edit-beneficiary-modal').modal('hide');  
//     }
// };

// // Remove beneficiary
// $scope.removeBeneficiary = function(index) {
//     $scope.data.beneficiaries.splice(index, 1);
//     $.gritter.add({
//         title: 'Beneficiary Removed!',
//         text: 'The beneficiary has been removed successfully.',
//     });
// };
// }); 



//WORKING BUT DUPLICATES
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//     Crud: {},
//     beneficiaries: []
//   };

//   // Fetch the Crud data including its beneficiaries by ID
//   Crud.get({ id: $routeParams.id }, function(response) {
//     console.log(response); // Debugging output
//     $scope.data.Crud = response.data.Crud;
//     $scope.data.beneficiaries = response.data.Beneficiary || []; // Note the change here
// });




//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//     $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and Beneficiaries
//   $scope.update = function() {
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         // Check if editing a beneficiary
//         if ($scope.editingIndex !== undefined) {
//             // Update the existing beneficiary
//             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.newBeneficiary);
//         } else {
//             // If adding a new beneficiary, include it in the array
//             $scope.data.beneficiaries.push(angular.copy($scope.newBeneficiary));
//         }

//         // Now include beneficiaries in the Crud data
//         $scope.data.Crud.beneficiaries = $scope.data.beneficiaries;

//         Crud.save($scope.data, function(e) {
//             if (e.ok) {
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     }
// };

// $scope.clearBeneficiaryForm = function() {
//   $scope.newBeneficiary = {};
//   $scope.editingIndex = undefined; // Reset editing index
// };


//   // Function to add a beneficiary
//   $scope.addBeneficiary = function() {
//     // Reset the beneficiary data for a new entry
//     $scope.newBeneficiary = {};
//     $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//     if (beneficiaryData.birthdate) {
//       // Calculate age based on birthdate
//       const bdayDate = new Date(beneficiaryData.birthdate);
//       const today = new Date();
//       beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//       const monthDiff = today.getMonth() - bdayDate.getMonth();
//       if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//         beneficiaryData.age--;
//       }
//     }

//     $scope.data.beneficiaries.push(beneficiaryData); // Add the new beneficiary to the array
//     $('#add-beneficiary-modal').modal('hide');
//     $.gritter.add({
//       title: 'Beneficiary Added!',
//       text: 'The beneficiary has been added successfully.',
//     });
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $('#edit_beneficiary').validationEngine('attach');

//     data.index = index;
//     $scope.adata = angular.copy(data); // Use a copy to avoid direct changes
//     $('#edit-beneficiary-modal').modal('show');
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function(data, index) {
//     var valid = $('#edit_beneficiary').validationEngine('validate');

//     if (valid) {
//       data.amount = number_format(data.amount, 2, '.', '');
//       $scope.data.beneficiaries[index] = data; // Update the beneficiary
//       $.gritter.add({
//         title: 'Beneficiary Updated!',
//         text: 'The beneficiary has been updated successfully.',
//       });
//       $('#edit-beneficiary-modal').modal('hide');
//     }
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//     $scope.data.beneficiaries.splice(index, 1);
//     $.gritter.add({
//       title: 'Beneficiary Removed!',
//       text: 'The beneficiary has been removed successfully.',
//     });
//   };
// });


// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: []
//   };

//   // Fetch the Crud data including its beneficiaries by ID
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Note the change here
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and Beneficiaries
//   $scope.update = function() {
//       var valid = $("#form").validationEngine('validate');

//       if (valid) {
//           // Prepare the beneficiaries array for saving
//           $scope.data.Crud.beneficiaries = $scope.data.beneficiaries.map(beneficiary => {
//               return {
//                   id: beneficiary.id || null, // Set ID for existing beneficiaries, null for new ones
//                   name: beneficiary.name,
//                   birthdate: beneficiary.birthdate,
//                   age: beneficiary.age,
//                   cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//               };
//           });

//           console.log('Data being sent to the server:', $scope.data);
//           // Save the Crud data
//           Crud.save($scope.data, function(e) {
//               if (e.ok) {
//                   $.gritter.add({
//                       title: 'Successful!',
//                       text: e.msg,
//                   });
//                   window.location = '#/cruds'; // Redirect after success
//               } else {
//                   $.gritter.add({
//                       title: 'Warning!',
//                       text: e.msg,
//                   });
//               }
//           });
//       }
//   };

//   $scope.clearBeneficiaryForm = function() {
//       $scope.newBeneficiary = {};
//       $scope.editingIndex = undefined; // Reset editing index
//   };

//   // Function to add a beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.clearBeneficiaryForm(); // Clear any existing data
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       if (beneficiaryData.birthdate) {
//           // Calculate age based on birthdate
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       // Directly add the new beneficiary to the array
//       $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//       $('#add-beneficiary-modal').modal('hide');
//       $.gritter.add({
//           title: 'Beneficiary Added!',
//           text: 'The beneficiary has been added successfully.',
//       });
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index; // Set the index for updating
//       $scope.newBeneficiary = angular.copy(data); // Use a copy to avoid direct changes
//       $('#edit-beneficiary-modal').modal('show'); // Open the modal
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function(data) {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Calculate age based on birthdate
//           if (data.birthdate) {
//               const bdayDate = new Date(data.birthdate);
//               const today = new Date();
//               data.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   data.age--;
//               }
//           }

//           // Ensure the ID is included for updating
//           if ($scope.editingIndex !== undefined) {
//               const existingBeneficiary = $scope.data.beneficiaries[$scope.editingIndex];
//               data.id = existingBeneficiary.id; // Assign the ID of the beneficiary being edited

//               // Update the beneficiary in the existing array
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm(); // Clear form after updating
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };
// });


// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: []
//   };

//   // Fetch the Crud data including its beneficiaries by ID
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Load existing beneficiaries
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and Beneficiaries
//   // Function to update Crud and Beneficiaries
// // Function to update Crud and Beneficiaries
// $scope.update = function() {
//   var valid = $("#form").validationEngine('validate');

//   if (valid) {
//       // Prepare the beneficiaries array for saving
//       $scope.data.Crud.beneficiaries = $scope.data.beneficiaries.map(beneficiary => {
//           return {
//               id: beneficiary.id || null, // Set ID for existing beneficiaries
//               name: beneficiary.name,
//               birthdate: beneficiary.birthdate,
//               age: beneficiary.age,
//               cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//           };
//       });

//       console.log('Data being sent to the server:', $scope.data); // Check the structure
//       // Save the Crud data
//       Crud.save($scope.data, function(e) {
//           if (e.ok) {
//               $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//               });
//               window.location = '#/cruds'; // Redirect after success
//           } else {
//               $.gritter.add({
//                   title: 'Warning!',
//                   text: e.msg,
//               });
//           }
//       });
//   }
// };



//   // Function to add a beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {};
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       if (beneficiaryData.birthdate) {
//           // Calculate age based on birthdate
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       // Add beneficiary to the array
//       $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//       $('#add-beneficiary-modal').modal('hide');
//       $.gritter.add({
//           title: 'Beneficiary Added!',
//           text: 'The beneficiary has been added successfully.',
//       });
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index; // Set index for updating
//       $scope.newBeneficiary = angular.copy(data); // Use copy to avoid direct changes
//       $('#edit-beneficiary-modal').modal('show'); // Open the modal
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function(data) {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Calculate age
//           if (data.birthdate) {
//               const bdayDate = new Date(data.birthdate);
//               const today = new Date();
//               data.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   data.age--;
//               }
//           }

//           // Update beneficiary
//           if ($scope.editingIndex !== undefined) {
//               const existingBeneficiary = $scope.data.beneficiaries[$scope.editingIndex];
//               data.id = existingBeneficiary.id; // Assign ID of the beneficiary being edited
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm(); // Clear form after updating
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };
// });

// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Do not load existing beneficiaries from the server
//       // $scope.data.beneficiaries = response.data.Beneficiary || [];
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   $scope.update = function() {
//       console.log("Update function called"); // Debugging output
//       var valid = $("#form").validationEngine('validate');

//       if (valid) {
//           console.log("Form is valid"); // Check if form validation is successful
          
//           // Prepare beneficiaries array for saving
//           // Ensure it only contains newly added beneficiaries
//           var newBeneficiaries = $scope.data.beneficiaries.map(beneficiary => {
//               return {
//                   id: null, // No existing IDs, all new beneficiaries
//                   name: beneficiary.name,
//                   birthdate: beneficiary.birthdate,
//                   age: beneficiary.age,
//                   cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//               };
//           });

//           console.log('Data being sent to the server:', $scope.data); // Check the structure
//           // Save the Crud data without any existing beneficiaries
//           Crud.save({ Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//               console.log("Response from server:", e); // Check server response
//               if (e.ok) {
//                   $.gritter.add({
//                       title: 'Successful!',
//                       text: e.msg,
//                   });
//                   window.location = '#/cruds'; // Redirect after success
//               } else {
//                   $.gritter.add({
//                       title: 'Warning!',
//                       text: e.msg,
//                   });
//               }
//           });
//       } else {
//           console.log("Form is invalid"); // If the form is invalid
//       }
//   };

//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {};
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       // Calculate age based on birthdate
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);
      
//       // Check for duplicates
//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $scope.newBeneficiary = {}; // Clear the form
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index; // Set index for updating
//       $scope.newBeneficiary = angular.copy(data); // Use copy to avoid direct changes
//       $('#edit-beneficiary-modal').modal('show'); // Open the modal
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function(data) {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Calculate age
//           if (data.birthdate) {
//               const bdayDate = new Date(data.birthdate);
//               const today = new Date();
//               data.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   data.age--;
//               }
//           }

//           // Update beneficiary
//           if ($scope.editingIndex !== undefined) {
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm(); // Clear form after updating
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };
// });

//no dups but no edit
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   // Function to update Crud and only new Beneficiaries
// $scope.update = function() {
//   console.log("Update function called"); // Debugging output
//   var valid = $("#form").validationEngine('validate');

//   if (valid) {
//       console.log("Form is valid"); // Check if form validation is successful
      
//       // Prepare beneficiaries array for saving
//       var newBeneficiaries = $scope.data.beneficiaries
//           .filter(b => b.id === null) // Only include new beneficiaries
//           .map(beneficiary => ({
//               id: null, // No existing IDs for new beneficiaries
//               name: beneficiary.name,
//               birthdate: beneficiary.birthdate,
//               age: beneficiary.age,
//               cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//           }));

//       console.log('Data being sent to the server:', $scope.data); // Check the structure
//       // Save the Crud data without any existing beneficiaries
//       Crud.save({ Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//           console.log("Response from server:", e); // Check server response
//           if (e.ok) {
//               $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//               });
//               window.location = '#/cruds'; // Redirect after success
//           } else {
//               $.gritter.add({
//                   title: 'Warning!',
//                   text: e.msg,
//               });
//           }
//       });
//   } else {
//       console.log("Form is invalid"); // If the form is invalid
//   }
// };


//   // Function to add a new beneficiary
// $scope.addBeneficiary = function() {
//   $scope.newBeneficiary = {}; // Reset new beneficiary data
//   $('#add-beneficiary-modal').modal('show');
// };

// // Save new beneficiary
// $scope.saveBeneficiary = function(beneficiaryData) {
//   // Calculate age based on birthdate
//   if (beneficiaryData.birthdate) {
//       const bdayDate = new Date(beneficiaryData.birthdate);
//       const today = new Date();
//       beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//       const monthDiff = today.getMonth() - bdayDate.getMonth();
//       if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//           beneficiaryData.age--;
//       }
//   }

//   console.log("New Beneficiary Data:", beneficiaryData);
  
//   // Check for duplicates
//   const duplicate = $scope.data.beneficiaries.some(b => 
//       b.name === beneficiaryData.name && 
//       b.birthdate === beneficiaryData.birthdate
//   );

//   if (!duplicate) {
//       // Assign id as null for new beneficiaries
//       beneficiaryData.id = null;
//       $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//       $('#add-beneficiary-modal').modal('hide');
//       $scope.newBeneficiary = {}; // Clear the form
//       $.gritter.add({
//           title: 'Beneficiary Added!',
//           text: 'The beneficiary has been added successfully.',
//       });
//   } else {
//       $.gritter.add({
//           title: 'Duplicate Beneficiary!',
//           text: 'This beneficiary already exists.',
//       });
//   }
// };


//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $('#edit-beneficiary-modal').modal('show');
//     $('#edit_beneficiary').validationEngine('attach'); // Attach validation here
// };

//   // Update beneficiary
//   // $scope.updateBeneficiary = function(data) {
//   //     var valid = $('#edit_beneficiary').validationEngine('validate');

//   //     if (valid) {
//   //         // Calculate age
//   //         if (data.birthdate) {
//   //             const bdayDate = new Date(data.birthdate);
//   //             const today = new Date();
//   //             data.age = today.getFullYear() - bdayDate.getFullYear();
//   //             const monthDiff = today.getMonth() - bdayDate.getMonth();
//   //             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//   //                 data.age--;
//   //             }
//   //         }

//   //         // Update beneficiary
//   //         if ($scope.editingIndex !== undefined) {
//   //             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//   //             $.gritter.add({
//   //                 title: 'Beneficiary Updated!',
//   //                 text: 'The beneficiary has been updated successfully.',
//   //             });
//   //             $('#edit-beneficiary-modal').modal('hide');
//   //             $scope.clearBeneficiaryForm(); // Clear form after updating
//   //         }
//   //     } else {
//   //         console.log('Beneficiary form is invalid');
//   //     }
//   // };

//   // Update beneficiary
//   $scope.updateBeneficiary = function() {
//     var valid = $('#edit_beneficiary').validationEngine('validate');

//     if (valid) {
//         // Calculate age
//         if ($scope.currentBeneficiary.birthdate) {
//             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//             const today = new Date();
//             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//             const monthDiff = today.getMonth() - bdayDate.getMonth();
//             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                 $scope.currentBeneficiary.age--;
//             }
//         }

//         // Update beneficiary if editingIndex is set
//         if ($scope.editingIndex !== undefined) {
//           $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
      
      
//             $.gritter.add({
//                 title: 'Beneficiary Updated!',
//                 text: 'The beneficiary has been updated successfully.',
//             });
//             $('#edit-beneficiary-modal').modal('hide');
//             $scope.clearBeneficiaryForm(); // Clear form after updating
//         }
//     } else {
//         console.log('Beneficiary form is invalid');
//     }
// };

// $scope.clearBeneficiaryForm = function() {
//   $scope.currentBeneficiary = {}; // Clear the current beneficiary data
// };


//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });

//PART 2 REALLLL no dups, added newly benef, but no save edited
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold beneficiaries (existing and new)
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });






//   $scope.update = function() {
//     console.log("Update function called"); // Debugging output
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         console.log("Form is valid"); // Check if form validation is successful
        
//         // Prepare beneficiaries array for saving
//         var newBeneficiaries = $scope.data.beneficiaries.filter(b => b.id === null); // Only include new beneficiaries
//         var modifiedBeneficiaries = $scope.data.beneficiaries.filter(b => b.id !== null && b.isModified); // Include modified beneficiaries
        
//         // Combine new and modified beneficiaries
//         var beneficiariesToSend = newBeneficiaries.concat(modifiedBeneficiaries);

//         console.log('Data being sent to the server:', $scope.data); // Check the structure
        
//         // Save the Crud data without any existing beneficiaries
//         Crud.save({ Crud: $scope.data.Crud, beneficiaries: beneficiariesToSend }, function(e) {
//             console.log("Response from server:", e); // Check server response
//             if (e.ok) {
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     } else {
//         console.log("Form is invalid"); // If the form is invalid
//     }
// };











//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {}; // Reset new beneficiary data
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       // Calculate age based on birthdate
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);
      
//       // Check for duplicates
//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           // Assign id as null for new beneficiaries
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $scope.newBeneficiary = {}; // Clear the form
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index;
//       $scope.currentBeneficiary = angular.copy(data);
//       $('#edit-beneficiary-modal').modal('show');
//       $('#edit_beneficiary').validationEngine('attach'); // Attach validation here
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function() {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Calculate age
//           if ($scope.currentBeneficiary.birthdate) {
//               const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//               const today = new Date();
//               $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   $scope.currentBeneficiary.age--;
//               }
//           }

//           // Update beneficiary if editingIndex is set
//           if ($scope.editingIndex !== undefined) {
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm(); // Clear form after updating
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   $scope.clearBeneficiaryForm = function() {
//       $scope.currentBeneficiary = {}; // Clear the current beneficiary data
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });




//FINE BUT NO DELETE
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold beneficiaries (existing and new)
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });






//   $scope.update = function() {
//     console.log("Update function called");
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         console.log("Form is valid");

//         // Prepare beneficiaries array for saving
//         var newBeneficiaries = $scope.data.beneficiaries.filter(b => b.id === null); // New beneficiaries
//         var modifiedBeneficiaries = $scope.data.beneficiaries.filter(b => b.isModified); // Modified beneficiaries
//         var deletedBeneficiaries = $scope.data.beneficiaries.filter(b => b.isDeleted); // Deleted beneficiaries

//         // Combine new and modified beneficiaries
//         var beneficiariesToSend = newBeneficiaries.concat(modifiedBeneficiaries);

//         console.log('Data being sent to the server:', { Crud: $scope.data.Crud, beneficiaries: beneficiariesToSend, deletedBeneficiaries: deletedBeneficiaries });

//         // Save the Crud data with beneficiaries
//         Crud.save({ Crud: $scope.data.Crud, beneficiaries: beneficiariesToSend, deletedBeneficiaries: deletedBeneficiaries }, function(e) {
//             console.log("Response from server:", e);
//             if (e.ok) {
//                 // Reset modified and deleted flags after saving
//                 beneficiariesToSend.forEach(b => {
//                     if (b.id !== null) {
//                         b.isModified = false; // Reset after saving
//                     }
//                 });
//                 deletedBeneficiaries.forEach(b => {
//                     b.isDeleted = false; // Clear deleted flag
//                 });
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     } else {
//         console.log("Form is invalid");
//     }
// };














//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {}; // Reset new beneficiary data
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       // Calculate age based on birthdate
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);
      
//       // Check for duplicates
//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           // Assign id as null for new beneficiaries
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $scope.newBeneficiary = {}; // Clear the form
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $scope.currentBeneficiary.isModified = true; // Mark as modified
//     $('#edit-beneficiary-modal').modal('show');
// };



//   // Update beneficiary
// //   $scope.updateBeneficiary = function() {
// //     var valid = $('#edit_beneficiary').validationEngine('validate');

// //     if (valid) {
// //         // Calculate age
// //         if ($scope.currentBeneficiary.birthdate) {
// //             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
// //             const today = new Date();
// //             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
// //             const monthDiff = today.getMonth() - bdayDate.getMonth();
// //             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
// //                 $scope.currentBeneficiary.age--;
// //             }
// //         }

// //         // Update beneficiary if editingIndex is set
// //         if ($scope.editingIndex !== undefined) {
// //             // Keep the isModified flag
// //             $scope.currentBeneficiary.isModified = true; 
// //             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
// //             $.gritter.add({
// //                 title: 'Beneficiary Updated!',
// //                 text: 'The beneficiary has been updated successfully.',
// //             });
// //             $('#edit-beneficiary-modal').modal('hide');
// //             $scope.clearBeneficiaryForm(); // Clear form after updating
// //         }
// //     } else {
// //         console.log('Beneficiary form is invalid');
// //     }
// // };

// $scope.updateBeneficiary = function() {
//   var valid = $('#edit_beneficiary').validationEngine('validate');

//   if (valid) {
//       // Calculate age
//       if ($scope.currentBeneficiary.birthdate) {
//           const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//           const today = new Date();
//           $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               $scope.currentBeneficiary.age--;
//           }
//       }

//       // Update beneficiary if editingIndex is set
//       if ($scope.editingIndex !== undefined) {
//           $scope.currentBeneficiary.isModified = true; 
//           $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//           $.gritter.add({
//               title: 'Beneficiary Updated!',
//               text: 'The beneficiary has been updated successfully.',
//           });
//           $('#edit-beneficiary-modal').modal('hide');
//           $scope.clearBeneficiaryForm(); // Clear form after updating
//       }
//   } else {
//       console.log('Beneficiary form is invalid');
//   }
// };



//   $scope.clearBeneficiaryForm = function() {
//       $scope.currentBeneficiary = {}; // Clear the current beneficiary data
//   };

//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//     // Get the beneficiary being removed
//     const removedBeneficiary = $scope.data.beneficiaries[index];

//     // Check if beneficiary has an id, indicating it's in the database
//     if (removedBeneficiary.id) {
//         removedBeneficiary.isDeleted = true; // Mark for deletion
//     }

//     // If it's a new beneficiary (id is null), just remove it from the array
//     $scope.data.beneficiaries.splice(index, 1);

//     // For feedback
//     $.gritter.add({
//         title: 'Beneficiary Removed!',
//         text: 'The beneficiary has been removed successfully.',
//     });
// };




//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });


//LATEST WORKING  WITH EDIT AND NO DUPLICATE!!!!!!!!!!!!
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams, Beneficiary) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [], // Hold beneficiaries (existing and new)
//       deletedBeneficiaries: []
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//     console.log("Response data:", response); // Log entire response
//     $scope.data.Crud = response.data.Crud;
//     $scope.data.beneficiaries = response.data.Beneficiary || []; 
//     console.log("Loaded beneficiaries:", $scope.data.beneficiaries); // Log beneficiaries
// });


//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });




//   console.log('Deleted Beneficiaries before sending:', $scope.data.deletedBeneficiaries);


//   $scope.update = function() {
//     console.log("Update function called");
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         console.log("Form is valid");

//         // Prepare beneficiaries array for saving
//         var newBeneficiaries = $scope.data.beneficiaries.filter(b => b.id === null); // New beneficiaries
//         var modifiedBeneficiaries = $scope.data.beneficiaries.filter(b => b.isModified); // Modified beneficiaries

//         // Combine new and modified beneficiaries
//         var beneficiariesToSend = newBeneficiaries.concat(modifiedBeneficiaries);

//         console.log('Data being sent to the server:', { 
//             Crud: $scope.data.Crud, 
//             beneficiaries: beneficiariesToSend, 
//             deletedBeneficiaries: $scope.data.deletedBeneficiaries // Ensure this is sent
//         });

//         // Save the Crud data with beneficiaries
//         Crud.save({ 
//             Crud: $scope.data.Crud, 
//             beneficiaries: beneficiariesToSend, 
//             deletedBeneficiaries: $scope.data.deletedBeneficiaries 
//         }, function(e) {
//             console.log("Response from server:", e);
//             if (e.ok) {
//                 // Reset modified and deleted flags after saving
//                 beneficiariesToSend.forEach(b => {
//                     if (b.id !== null) {
//                         b.isModified = false; // Reset after saving
//                     }
//                 });
//                 // Clear deleted beneficiaries after saving
//                 $scope.data.deletedBeneficiaries = [];
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     } else {
//         console.log("Form is invalid");
//     }
// };















//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {}; // Reset new beneficiary data
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       // Calculate age based on birthdate
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);
      
//       // Check for duplicates
//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           // Assign id as null for new beneficiaries
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $scope.newBeneficiary = {}; // Clear the form
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $scope.currentBeneficiary.isModified = true; // Mark as modified
//     $('#edit-beneficiary-modal').modal('show');
// };



//   // Update beneficiary
// //   $scope.updateBeneficiary = function() {
// //     var valid = $('#edit_beneficiary').validationEngine('validate');

// //     if (valid) {
// //         // Calculate age
// //         if ($scope.currentBeneficiary.birthdate) {
// //             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
// //             const today = new Date();
// //             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
// //             const monthDiff = today.getMonth() - bdayDate.getMonth();
// //             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
// //                 $scope.currentBeneficiary.age--;
// //             }
// //         }

// //         // Update beneficiary if editingIndex is set
// //         if ($scope.editingIndex !== undefined) {
// //             // Keep the isModified flag
// //             $scope.currentBeneficiary.isModified = true; 
// //             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
// //             $.gritter.add({
// //                 title: 'Beneficiary Updated!',
// //                 text: 'The beneficiary has been updated successfully.',
// //             });
// //             $('#edit-beneficiary-modal').modal('hide');
// //             $scope.clearBeneficiaryForm(); // Clear form after updating
// //         }
// //     } else {
// //         console.log('Beneficiary form is invalid');
// //     }
// // };

// $scope.updateBeneficiary = function() {
//   var valid = $('#edit_beneficiary').validationEngine('validate');

//   if (valid) {
//       // Calculate age
//       if ($scope.currentBeneficiary.birthdate) {
//           const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//           const today = new Date();
//           $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               $scope.currentBeneficiary.age--;
//           }
//       }

//       // Update beneficiary if editingIndex is set
//       if ($scope.editingIndex !== undefined) {
//           $scope.currentBeneficiary.isModified = true; 
//           $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//           $.gritter.add({
//               title: 'Beneficiary Updated!',
//               text: 'The beneficiary has been updated successfully.',
//           });
//           $('#edit-beneficiary-modal').modal('hide');
//           $scope.clearBeneficiaryForm(); // Clear form after updating
//       }
//   } else {
//       console.log('Beneficiary form is invalid');
//   }
// };



//   $scope.clearBeneficiaryForm = function() {
//       $scope.currentBeneficiary = {}; // Clear the current beneficiary data
//   };

//   // Remove beneficiary
//   $scope.remove = function(beneficiary) {
//     bootbox.confirm('Are you sure you want to delete ' + beneficiary.name + '?', function(confirm) {
//       if (confirm) {
//         // Use the Crud service to delete the beneficiary
//         Crud.remove({ name: beneficiary.name, birthdate: beneficiary.birthdate }, function(response) {
//           if (response.ok) {
//             $.gritter.add({
//               title: 'Successful!',
//               text: response.msg,
//             });
//             $scope.load(); // Reload data after deletion
//           } else {
//             $.gritter.add({
//               title: 'Error!',
//               text: 'Failed to delete the beneficiary: ' + response.msg,
//             });
//           }
//         });
//       }
//     });
// };










//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });

app.controller('CrudEditController', function($scope, Crud, Select, $routeParams, Beneficiary) {
  // Attach validation engine to the form
  $('#form').validationEngine('attach');

  // Initialize data
  $scope.data = {
      Crud: {},
      beneficiaries: [], // Hold beneficiaries (existing and new)
      deletedBeneficiaries: []
  };

  // Fetch the Crud data excluding its beneficiaries
  Crud.get({ id: $routeParams.id }, function(response) {
    console.log("Response data:", response); // Log entire response
    $scope.data.Crud = response.data.Crud;
    $scope.data.beneficiaries = response.data.Beneficiary || []; 
    console.log("Loaded beneficiaries:", $scope.data.beneficiaries); // Log beneficiaries
});


  // Fetch crud status
  Select.get({ code: 'crud-status' }, function(e) {
      $scope.status = e.data; // Store statuses in the scope
  });




  console.log('Deleted Beneficiaries before sending:', $scope.data.deletedBeneficiaries);


  $scope.update = function() {
    console.log("Update function called");
    var valid = $("#form").validationEngine('validate');

    if (valid) {
        console.log("Form is valid");

        // Prepare beneficiaries array for saving
        var newBeneficiaries = $scope.data.beneficiaries.filter(b => b.id === null); // New beneficiaries
        var modifiedBeneficiaries = $scope.data.beneficiaries.filter(b => b.isModified); // Modified beneficiaries

        // Combine new and modified beneficiaries
        var beneficiariesToSend = newBeneficiaries.concat(modifiedBeneficiaries);

        console.log('Data being sent to the server:', { 
            Crud: $scope.data.Crud, 
            beneficiaries: beneficiariesToSend, 
            deletedBeneficiaries: $scope.data.deletedBeneficiaries // Ensure this is sent
        });

        // Save the Crud data with beneficiaries
        Crud.save({ 
            Crud: $scope.data.Crud, 
            beneficiaries: beneficiariesToSend, 
            deletedBeneficiaries: $scope.data.deletedBeneficiaries 
        }, function(e) {
            console.log("Response from server:", e);
            if (e.ok) {
                // Reset modified and deleted flags after saving
                beneficiariesToSend.forEach(b => {
                    if (b.id !== null) {
                        b.isModified = false; // Reset after saving
                    }
                });
                // Clear deleted beneficiaries after saving
                $scope.data.deletedBeneficiaries = [];
                $.gritter.add({
                    title: 'Successful!',
                    text: e.msg,
                });
                window.location = '#/cruds'; // Redirect after success
            } else {
                $.gritter.add({
                    title: 'Warning!',
                    text: e.msg,
                });
            }
        });
    } else {
        console.log("Form is invalid");
    }
};







  // Function to add a new beneficiary
  $scope.addBeneficiary = function() {
      $scope.newBeneficiary = {}; // Reset new beneficiary data
      $('#add-beneficiary-modal').modal('show');
  };

  // Save new beneficiary
  $scope.saveBeneficiary = function(beneficiaryData) {
      // Calculate age based on birthdate
      if (beneficiaryData.birthdate) {
          const bdayDate = new Date(beneficiaryData.birthdate);
          const today = new Date();
          beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
          const monthDiff = today.getMonth() - bdayDate.getMonth();
          if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
              beneficiaryData.age--;
          }
      }

      console.log("New Beneficiary Data:", beneficiaryData);
      
      // Check for duplicates
      const duplicate = $scope.data.beneficiaries.some(b => 
          b.name === beneficiaryData.name && 
          b.birthdate === beneficiaryData.birthdate
      );

      if (!duplicate) {
          // Assign id as null for new beneficiaries
          beneficiaryData.id = null;
          $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
          $('#add-beneficiary-modal').modal('hide');
          $scope.newBeneficiary = {}; // Clear the form
          $.gritter.add({
              title: 'Beneficiary Added!',
              text: 'The beneficiary has been added successfully.',
          });
      } else {
          $.gritter.add({
              title: 'Duplicate Beneficiary!',
              text: 'This beneficiary already exists.',
          });
      }
  };

  // Edit beneficiary
  $scope.editBeneficiary = function(index, data) {
    $scope.editingIndex = index;
    $scope.currentBeneficiary = angular.copy(data);
    $scope.currentBeneficiary.isModified = true; // Mark as modified
    $('#edit-beneficiary-modal').modal('show');
};



  // Update beneficiary
//   $scope.updateBeneficiary = function() {
//     var valid = $('#edit_beneficiary').validationEngine('validate');

//     if (valid) {
//         // Calculate age
//         if ($scope.currentBeneficiary.birthdate) {
//             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//             const today = new Date();
//             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//             const monthDiff = today.getMonth() - bdayDate.getMonth();
//             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                 $scope.currentBeneficiary.age--;
//             }
//         }

//         // Update beneficiary if editingIndex is set
//         if ($scope.editingIndex !== undefined) {
//             // Keep the isModified flag
//             $scope.currentBeneficiary.isModified = true; 
//             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//             $.gritter.add({
//                 title: 'Beneficiary Updated!',
//                 text: 'The beneficiary has been updated successfully.',
//             });
//             $('#edit-beneficiary-modal').modal('hide');
//             $scope.clearBeneficiaryForm(); // Clear form after updating
//         }
//     } else {
//         console.log('Beneficiary form is invalid');
//     }
// };

$scope.updateBeneficiary = function() {
  var valid = $('#edit_beneficiary').validationEngine('validate');

  if (valid) {
      // Calculate age
      if ($scope.currentBeneficiary.birthdate) {
          const bdayDate = new Date($scope.currentBeneficiary.birthdate);
          const today = new Date();
          $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
          const monthDiff = today.getMonth() - bdayDate.getMonth();
          if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
              $scope.currentBeneficiary.age--;
          }
      }

      // Update beneficiary if editingIndex is set
      if ($scope.editingIndex !== undefined) {
          $scope.currentBeneficiary.isModified = true; 
          $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
          $.gritter.add({
              title: 'Beneficiary Updated!',
              text: 'The beneficiary has been updated successfully.',
          });
          $('#edit-beneficiary-modal').modal('hide');
          $scope.clearBeneficiaryForm(); // Clear form after updating
      }
  } else {
      console.log('Beneficiary form is invalid');
  }
};



  $scope.clearBeneficiaryForm = function() {
      $scope.currentBeneficiary = {}; // Clear the current beneficiary data
  };

  // Remove beneficiary
  // Remove beneficiary
// Remove beneficiary (set visible to 0)
$scope.remove = function(beneficiary) {
  // Set the beneficiary's visibility to 0
  beneficiary.visible = 0;

  // Add the beneficiary to the deletedBeneficiaries array for later processing
  $scope.data.deletedBeneficiaries.push(beneficiary);

  // Update the UI to reflect the change
  $scope.data.beneficiaries = $scope.data.beneficiaries.filter(b => b.id !== beneficiary.id);

  // Send the updated visibility status to the server
  Beneficiary.save({ id: beneficiary.id, visible: 0 }, function(response) {
      if (response.ok) {
          $.gritter.add({
              title: 'Successful!',
              text: beneficiary.name + ' has been marked as hidden.',
          });
      } else {
          $.gritter.add({
              title: 'Error!',
              text: 'Failed to hide the beneficiary.',
          });
      }
  });
};

$scope.editBeneficiaryVisibility = function(beneficiary) {
  // Toggle the visibility value
  beneficiary.visible = beneficiary.visible === 1 ? 0 : 1; 

  // Prepare the data to send
  const dataToSend = {
      id: beneficiary.id,
      visible: beneficiary.visible
  };

  // Call the update function to change visibility
  Beneficiary.update({ id: beneficiary.id }, dataToSend, function(response) {
      if (response.ok) {
          // Update the UI to reflect the change
          $.gritter.add({
              title: 'Successful!',
              text: beneficiary.visible === 1 ? 'Beneficiary is now visible.' : 'Beneficiary has been hidden.',
          });
      } else {
          // Revert the change if the update fails
          beneficiary.visible = beneficiary.visible === 1 ? 0 : 1; // Revert visibility
          $.gritter.add({
              title: 'Error!',
              text: 'Failed to update beneficiary visibility.',
          });
      }
  });
};








  // Function to display beneficiaries (HTML should be in your view)
  $scope.displayBeneficiaries = function() {
      if ($scope.data.beneficiaries.length > 0) {
          return $scope.data.beneficiaries;
      } else {
          return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
      }
  };
});


//LATESTTTT
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams,Beneficiary) {
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [],
//       deletedBeneficiaries: []
//   };

//   // Fetch the Crud data including beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log("Response data:", response);
//       $scope.data.Crud = response.data.Crud;
//       $scope.data.beneficiaries = response.data.Beneficiary || [];
//       console.log("Loaded beneficiaries:", $scope.data.beneficiaries);
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data;
//   });

//   // Update function to handle saving beneficiaries and Crud
//   $scope.update = function() {
//       var valid = $("#form").validationEngine('validate');

//       if (valid) {
//           console.log("Form is valid");

//           // Filter new and updated beneficiaries
//           var newBeneficiaries = $scope.data.beneficiaries.filter(b => b.id === null);
//           var beneficiariesToUpdate = $scope.data.beneficiaries.filter(b => b.id !== null && b.visible === 1);

//           // Log data being sent to the server
//           console.log('Data being sent to the server:', {
//               Crud: $scope.data.Crud,
//               beneficiaries: beneficiariesToUpdate,
//               deletedBeneficiaries: $scope.data.deletedBeneficiaries
//           });

//           // Save the Crud data
//           Crud.save({
//               Crud: $scope.data.Crud,
//               beneficiaries: beneficiariesToUpdate,
//               deletedBeneficiaries: $scope.data.deletedBeneficiaries
//           }, function(e) {
//               if (e.ok) {
//                   $scope.data.deletedBeneficiaries = []; // Clear deleted beneficiaries list
//                   $.gritter.add({
//                       title: 'Successful!',
//                       text: e.msg,
//                   });
//                   window.location = '#/cruds'; // Redirect after success
//               } else {
//                   $.gritter.add({
//                       title: 'Warning!',
//                       text: e.msg,
//                   });
//               }
//           });
//       } else {
//           console.log("Form is invalid");
//       }
//   };

//   // Add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {};
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index;
//       $scope.currentBeneficiary = angular.copy(data);
//       $scope.currentBeneficiary.isModified = true;
//       $('#edit-beneficiary-modal').modal('show');
//   };

//   // Update beneficiary
//   $scope.updateBeneficiary = function() {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Update age if birthdate exists
//           if ($scope.currentBeneficiary.birthdate) {
//               const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//               const today = new Date();
//               $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   $scope.currentBeneficiary.age--;
//               }
//           }

//           const existingBeneficiary = $scope.data.beneficiaries.find(b => b.id === Number($scope.currentBeneficiary.id));

//           if (existingBeneficiary) {
//               existingBeneficiary.birthdate = $scope.currentBeneficiary.birthdate;
//               existingBeneficiary.age = $scope.currentBeneficiary.age;
//               existingBeneficiary.visible = 1; // Make visible
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm();
//           } else {
//               console.log("Beneficiary not found for update:", $scope.currentBeneficiary.id);
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   // Remove beneficiary by hiding them
//   $scope.remove = function(beneficiary) {
//     if (confirm("Are you sure you want to delete this beneficiary?")) {
//         // Use Beneficiary service to delete the beneficiary by ID
//         Beneficiary.remove({ id: beneficiary.id }, function(response) {
//             // Assuming the backend sends a response confirming success
//             if (response.ok) {
//                 // Remove from the local list after successful deletion
//                 const index = $scope.data.beneficiaries.indexOf(beneficiary);
//                 if (index > -1) {
//                     $scope.data.beneficiaries.splice(index, 1);
//                 }

//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: 'The beneficiary has been deleted.',
//                 });
//             } else {
//                 $.gritter.add({
//                     title: 'Error!',
//                     text: 'Failed to delete the beneficiary.',
//                 });
//             }
//         });
//     }
// };




//   // Display beneficiaries based on visibility
//   $scope.displayBeneficiaries = function() {
//       return $scope.data.beneficiaries.filter(b => b.visible === 1);
//   };
// });










// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   $('#form').validationEngine('attach'); // Attach validation to form

//   $scope.data = {
//       Crud: {},
//       beneficiaries: []
//   };

//   // Fetch Crud data and its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); 
//       $scope.data.Crud = response.data.Crud;
//       $scope.data.beneficiaries = response.data.Beneficiary || [];
//   });

//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data;
//   });

//   // Update function for Crud and new Beneficiaries
//   $scope.update = function() {
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         var newBeneficiaries = $scope.data.beneficiaries
//             .filter(b => b.id === null)
//             .map(beneficiary => ({
//                 id: null,
//                 name: beneficiary.name,
//                 birthdate: beneficiary.birthdate,
//                 age: beneficiary.age,
//                 cruds_id: $scope.data.Crud.id
//             }));

//         Crud.update({ id: $routeParams.id, Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//             if (e.ok) {
//                 $.gritter.add({ title: 'Successful!', text: e.msg });
//                 window.location = '#/cruds';
//             } else {
//                 $.gritter.add({ title: 'Warning!', text: e.msg });
//             }
//         });
//     }
//   };

//   // Add new Beneficiary
//   $scope.addBeneficiary = function() {
//     $scope.newBeneficiary = {}; 
//     $('#add-beneficiary-modal').modal('show');
//   };

//   $scope.saveBeneficiary = function(beneficiaryData) {
//     if (beneficiaryData.birthdate) {
//         const bdayDate = new Date(beneficiaryData.birthdate);
//         const today = new Date();
//         beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//         if (today.getMonth() < bdayDate.getMonth() || 
//             (today.getMonth() === bdayDate.getMonth() && today.getDate() < bdayDate.getDate())) {
//             beneficiaryData.age--;
//         }
//     }

//     const duplicate = $scope.data.beneficiaries.some(b => 
//         b.name === beneficiaryData.name && 
//         b.birthdate === beneficiaryData.birthdate
//     );

//     if (!duplicate) {
//         beneficiaryData.id = null;
//         $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//         $('#add-beneficiary-modal').modal('hide');
//         $scope.newBeneficiary = {};
//         $.gritter.add({ title: 'Beneficiary Added!', text: 'The beneficiary has been added successfully.' });
//     } else {
//         $.gritter.add({ title: 'Duplicate Beneficiary!', text: 'This beneficiary already exists.' });
//     }
//   };

//   // Edit existing beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $('#edit-beneficiary-modal').modal('show');
//     $('#edit_beneficiary').validationEngine('attach');
//   };

//   // Update existing beneficiary
//   $scope.updateBeneficiary = function() {
//     var valid = $('#edit_beneficiary').validationEngine('validate');

//     if (valid) {
//         if ($scope.currentBeneficiary.birthdate) {
//             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//             const today = new Date();
//             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//             if (today.getMonth() < bdayDate.getMonth() || 
//                 (today.getMonth() === bdayDate.getMonth() && today.getDate() < bdayDate.getDate())) {
//                 $scope.currentBeneficiary.age--;
//             }
//         }

//         if ($scope.editingIndex !== undefined) {
//             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//             Crud.update({ id: $routeParams.id, beneficiary: $scope.currentBeneficiary }, function(response) {
//                 if (response.ok) {
//                     $.gritter.add({ title: 'Beneficiary Updated!', text: 'The beneficiary has been updated successfully.' });
//                     $('#edit-beneficiary-modal').modal('hide');
//                     $scope.clearBeneficiaryForm();
//                 } else {
//                     $.gritter.add({ title: 'Warning!', text: response.msg || 'An error occurred.' });
//                 }
//             }, function(error) {
//                 $.gritter.add({ title: 'Error!', text: 'An unexpected error occurred.' });
//                 console.error(error); // Log error for debugging
//             });
//         }
//     } else {
//         console.log('Beneficiary form is invalid');
//     }
// };




//   $scope.clearBeneficiaryForm = function() {
//     $scope.currentBeneficiary = {};
//   };

//   $scope.removeBeneficiary = function(index) {
//     $scope.data.beneficiaries.splice(index, 1);
//     $.gritter.add({ title: 'Beneficiary Removed!', text: 'The beneficiary has been removed successfully.' });
//   };

//   $scope.displayBeneficiaries = function() {
//     return $scope.data.beneficiaries.length > 0 ? $scope.data.beneficiaries : [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//   };
// });












// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   // Function to update Crud and only new Beneficiaries
// $scope.update = function() {
//   console.log("Update function called"); // Debugging output
//   var valid = $("#form").validationEngine('validate');

//   if (valid) {
//       console.log("Form is valid"); // Check if form validation is successful
      
//       // Prepare beneficiaries array for saving
//       var newBeneficiaries = $scope.data.beneficiaries
//           .filter(b => b.id === null) // Only include new beneficiaries
//           .map(beneficiary => ({
//               id: null, // No existing IDs for new beneficiaries
//               name: beneficiary.name,
//               birthdate: beneficiary.birthdate,
//               age: beneficiary.age,
//               cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//           }));

//       console.log('Data being sent to the server:', $scope.data); // Check the structure
//       // Save the Crud data without any existing beneficiaries
//       Crud.update({ Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//           console.log("Response from server:", e); // Check server response
//           if (e.ok) {
//               $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//               });
//               window.location = '#/cruds'; // Redirect after success
//           } else {
//               $.gritter.add({
//                   title: 'Warning!',
//                   text: e.msg,
//               });
//           }
//       });
//   } else {
//       console.log("Form is invalid"); // If the form is invalid
//   }
// };


//   // Function to add a new beneficiary
// $scope.addBeneficiary = function() {
//   $scope.newBeneficiary = {}; // Reset new beneficiary data
//   $('#add-beneficiary-modal').modal('show');
// };

// $scope.saveBeneficiary = function() {
//   // Assume this function is called to add a new beneficiary
//   if ($scope.newBeneficiary && $scope.newBeneficiary.name) {
//       // Validate and format as needed
//       $scope.data.beneficiaries.push(angular.copy($scope.newBeneficiary));
//       $('#add-beneficiary-modal').modal('hide');
//       $scope.newBeneficiary = {}; // Reset for next entry
//   }
// };

// $scope.editBeneficiary = function(index, beneficiary) {
//   // Prepare the modal for editing
//   $scope.editingIndex = index;
//   $scope.currentBeneficiary = angular.copy(beneficiary);
//   $('#edit-beneficiary-modal').modal('show');
// };

// $scope.updateBeneficiary = function() {
//   var valid = $('#edit_beneficiary').validationEngine('validate');

//   if (valid) {
//       // Update the beneficiary data
//       Crud.update({ id: $scope.currentBeneficiary.id }, { Beneficiary: $scope.currentBeneficiary }, function(response) {
//           if (response.ok) {
//               // Replace the old beneficiary with the updated one
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy($scope.currentBeneficiary);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//           } else {
//               $.gritter.add({
//                   title: 'Edit Failed!',
//                   text: response.msg,
//               });
//           }
//       });
//   } else {
//       console.log('Beneficiary form is invalid');
//   }
// };



// $scope.removeBeneficiary = function(index) {
//   if (index !== undefined) {
//       $scope.data.beneficiaries.splice(index, 1);
//   }
// };



// $scope.clearBeneficiaryForm = function() {
//   $scope.currentBeneficiary = {}; // Clear the current beneficiary data
// };


//   // Remove beneficiary
//   // $scope.removeBeneficiary = function(index) {
//   //     $scope.data.beneficiaries.splice(index, 1);
//   //     $.gritter.add({
//   //         title: 'Beneficiary Removed!',
//   //         text: 'The beneficiary has been removed successfully.',
//   //     });
//   // };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });


// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   // Function to update Crud and only new Beneficiaries
// $scope.update = function() {
//   console.log("Update function called"); // Debugging output
//   var valid = $("#form").validationEngine('validate');

//   if (valid) {
//       console.log("Form is valid"); // Check if form validation is successful
      
//       // Prepare beneficiaries array for saving
//       var newBeneficiaries = $scope.data.beneficiaries
//           .filter(b => b.id === null) // Only include new beneficiaries
//           .map(beneficiary => ({
//               id: null, // No existing IDs for new beneficiaries
//               name: beneficiary.name,
//               birthdate: beneficiary.birthdate,
//               age: beneficiary.age,
//               cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//           }));

//       console.log('Data being sent to the server:', $scope.data); // Check the structure
//       // Save the Crud data without any existing beneficiaries
//       Crud.save({ Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//           console.log("Response from server:", e); // Check server response
//           if (e.ok) {
//               $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//               });
//               window.location = '#/cruds'; // Redirect after success
//           } else {
//               $.gritter.add({
//                   title: 'Warning!',
//                   text: e.msg,
//               });
//           }
//       });
//   } else {
//       console.log("Form is invalid"); // If the form is invalid
//   }
// };


//   // Function to add a new beneficiary
// $scope.addBeneficiary = function() {
//   $scope.newBeneficiary = {}; // Reset new beneficiary data
//   $('#add-beneficiary-modal').modal('show');
// };

// // Save new beneficiary
// $scope.saveBeneficiary = function(beneficiaryData) {
//   // Calculate age based on birthdate
//   if (beneficiaryData.birthdate) {
//       const bdayDate = new Date(beneficiaryData.birthdate);
//       const today = new Date();
//       beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//       const monthDiff = today.getMonth() - bdayDate.getMonth();
//       if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//           beneficiaryData.age--;
//       }
//   }

//   console.log("New Beneficiary Data:", beneficiaryData);
  
//   // Check for duplicates
//   const duplicate = $scope.data.beneficiaries.some(b => 
//       b.name === beneficiaryData.name && 
//       b.birthdate === beneficiaryData.birthdate
//   );

//   if (!duplicate) {
//       // Assign id as null for new beneficiaries
//       beneficiaryData.id = null;
//       $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//       $('#add-beneficiary-modal').modal('hide');
//       $scope.newBeneficiary = {}; // Clear the form
//       $.gritter.add({
//           title: 'Beneficiary Added!',
//           text: 'The beneficiary has been added successfully.',
//       });
//   } else {
//       $.gritter.add({
//           title: 'Duplicate Beneficiary!',
//           text: 'This beneficiary already exists.',
//       });
//   }
// };


//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $('#edit-beneficiary-modal').modal('show');
//     $('#edit_beneficiary').validationEngine('attach'); // Attach validation here
// };

//   // Update beneficiary
//   $scope.updateBeneficiary = function(data) {
//       var valid = $('#edit_beneficiary').validationEngine('validate');

//       if (valid) {
//           // Calculate age
//           if (data.birthdate) {
//               const bdayDate = new Date(data.birthdate);
//               const today = new Date();
//               data.age = today.getFullYear() - bdayDate.getFullYear();
//               const monthDiff = today.getMonth() - bdayDate.getMonth();
//               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                   data.age--;
//               }
//           }

//           // Update beneficiary
//           if ($scope.editingIndex !== undefined) {
//               $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm(); // Clear form after updating
//           }
//       } else {
//           console.log('Beneficiary form is invalid');
//       }
//   };

//   // Update beneficiary
//   // Update beneficiary
  
  
  
// //   $scope.updateBeneficiary = function() {
// //     var valid = $('#edit_beneficiary').validationEngine('validate');

// //     if (valid) {
// //         // Calculate age
// //         if ($scope.currentBeneficiary.birthdate) {
// //             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
// //             const today = new Date();
// //             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
// //             const monthDiff = today.getMonth() - bdayDate.getMonth();
// //             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
// //                 $scope.currentBeneficiary.age--;
// //             }
// //         }

// //         // Prepare data to send to the server
// //         let beneficiaryData = angular.copy($scope.currentBeneficiary);
        
// //         // Check if editingIndex is set, indicating we're editing an existing beneficiary
// //         if ($scope.editingIndex !== undefined) {
// //             // Get the ID of the beneficiary to update
// //             let beneficiaryId = $scope.data.beneficiaries[$scope.editingIndex].id;

// //             // Send a PUT request to update the existing beneficiary
// //             Beneficiary.update({ id: beneficiaryId }, beneficiaryData, function(response) {
// //                 // Success response
// //                 $.gritter.add({
// //                     title: 'Beneficiary Updated!',
// //                     text: 'The beneficiary has been updated successfully in the database.',
// //                 });
// //                 // Update the local array with the updated beneficiary
// //                 $scope.data.beneficiaries[$scope.editingIndex] = beneficiaryData;
// //                 $('#edit-beneficiary-modal').modal('hide');
// //                 $scope.clearBeneficiaryForm();
// //             }, function(error) {
// //                 console.error('Error updating beneficiary:', error);
// //                 $.gritter.add({
// //                     title: 'Error!',
// //                     text: 'Failed to update beneficiary in the database.',
// //                 });
// //             });
// //         }
// //     } else {
// //         console.log('Beneficiary form is invalid');
// //     }
// // };




// $scope.clearBeneficiaryForm = function() {
//   $scope.currentBeneficiary = {}; // Clear the current beneficiary data
// };


//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });


//PART 2 REAL NO DUPS
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams, Beneficiary) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   // Function to update Crud and only new Beneficiaries
// $scope.update = function() {
//   console.log("Update function called"); // Debugging output
//   var valid = $("#form").validationEngine('validate');

//   if (valid) {
//       console.log("Form is valid"); // Check if form validation is successful
      
//       // Prepare beneficiaries array for saving
//       var newBeneficiaries = $scope.data.beneficiaries
//           .filter(b => b.id === null) // Only include new beneficiaries
//           .map(beneficiary => ({
//               id: null, // No existing IDs for new beneficiaries
//               name: beneficiary.name,
//               birthdate: beneficiary.birthdate,
//               age: beneficiary.age,
//               cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//           }));

//       console.log('Data being sent to the server:', $scope.data); // Check the structure
//       // Save the Crud data without any existing beneficiaries
//       Crud.save({ Crud: $scope.data.Crud, beneficiaries: newBeneficiaries }, function(e) {
//           console.log("Response from server:", e); // Check server response
//           if (e.ok) {
//               $.gritter.add({
//                   title: 'Successful!',
//                   text: e.msg,
//               });
//               window.location = '#/cruds'; // Redirect after success
//           } else {
//               $.gritter.add({
//                   title: 'Warning!',
//                   text: e.msg,
//               });
//           }
//       });
//   } else {
//       console.log("Form is invalid"); // If the form is invalid
//   }
// };


//   // Function to add a new beneficiary
// $scope.addBeneficiary = function() {
//   $scope.newBeneficiary = {}; // Reset new beneficiary data
//   $('#add-beneficiary-modal').modal('show');
// };

// // Save new beneficiary
// $scope.saveBeneficiary = function(beneficiaryData) {
//   // Calculate age based on birthdate
//   if (beneficiaryData.birthdate) {
//       const bdayDate = new Date(beneficiaryData.birthdate);
//       const today = new Date();
//       beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//       const monthDiff = today.getMonth() - bdayDate.getMonth();
//       if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//           beneficiaryData.age--;
//       }
//   }

//   console.log("New Beneficiary Data:", beneficiaryData);
  
//   // Check for duplicates
//   const duplicate = $scope.data.beneficiaries.some(b => 
//       b.name === beneficiaryData.name && 
//       b.birthdate === beneficiaryData.birthdate
//   );

//   if (!duplicate) {
//       // Assign id as null for new beneficiaries
//       beneficiaryData.id = null;
//       $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//       $('#add-beneficiary-modal').modal('hide');
//       $scope.newBeneficiary = {}; // Clear the form
//       $.gritter.add({
//           title: 'Beneficiary Added!',
//           text: 'The beneficiary has been added successfully.',
//       });
//   } else {
//       $.gritter.add({
//           title: 'Duplicate Beneficiary!',
//           text: 'This beneficiary already exists.',
//       });
//   }
// };


//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     $scope.currentBeneficiary = angular.copy(data);
//     $('#edit-beneficiary-modal').modal('show');
//     $('#edit_beneficiary').validationEngine('attach'); // Attach validation here
// };

//   // Update beneficiary
//   // $scope.updateBeneficiary = function(data) {
//   //     var valid = $('#edit_beneficiary').validationEngine('validate');

//   //     if (valid) {
//   //         // Calculate age
//   //         if (data.birthdate) {
//   //             const bdayDate = new Date(data.birthdate);
//   //             const today = new Date();
//   //             data.age = today.getFullYear() - bdayDate.getFullYear();
//   //             const monthDiff = today.getMonth() - bdayDate.getMonth();
//   //             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//   //                 data.age--;
//   //             }
//   //         }

//   //         // Update beneficiary
//   //         if ($scope.editingIndex !== undefined) {
//   //             $scope.data.beneficiaries[$scope.editingIndex] = angular.copy(data);
//   //             $.gritter.add({
//   //                 title: 'Beneficiary Updated!',
//   //                 text: 'The beneficiary has been updated successfully.',
//   //             });
//   //             $('#edit-beneficiary-modal').modal('hide');
//   //             $scope.clearBeneficiaryForm(); // Clear form after updating
//   //         }
//   //     } else {
//   //         console.log('Beneficiary form is invalid');
//   //     }
//   // };

//   // Update beneficiary
//   // Update beneficiary
// // Update beneficiary
// $scope.updateBeneficiary = function() {
//   var valid = $('#edit_beneficiary').validationEngine('validate');

//   if (valid) {
//       // Calculate age
//       if ($scope.currentBeneficiary.birthdate) {
//           const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//           const today = new Date();
//           $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               $scope.currentBeneficiary.age--;
//           }
//       }

//       // Ensure the correct ID is included
//       var beneficiaryData = angular.copy($scope.currentBeneficiary);
//       console.log('Updating beneficiary:', beneficiaryData);

//       // Update the beneficiary
//       Beneficiary.update({ id: beneficiaryData.id }, beneficiaryData).$promise
//             .then(function(response) {
//               $.gritter.add({
//                   title: 'Beneficiary Updated!',
//                   text: response.message || 'The beneficiary has been updated successfully.',
//               });
//               $('#edit-beneficiary-modal').modal('hide');
//               $scope.clearBeneficiaryForm();
//           })
//           .catch(function(error) {
//             console.error("Error updating beneficiary:", error);
//               $.gritter.add({
//                   title: 'Error!',
//                   text: 'Failed to update beneficiary. Check logs for more details.',
//               });
//           });
//   } else {
//       console.log('Beneficiary form is invalid');
//   }
// };






// $scope.clearBeneficiaryForm = function() {
//   $scope.currentBeneficiary = {}; // Clear the current beneficiary data
// };


//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });

//PART 2 still no edit
// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Hold new beneficiaries only
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries from the server
//       $scope.data.beneficiaries = response.data.Beneficiary || []; // Assuming this is where existing beneficiaries come from
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and only new Beneficiaries
//   $scope.update = function() {
//     console.log("Update function called"); // Debugging output
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         console.log("Form is valid"); // Check if form validation is successful

//         // Prepare beneficiaries array for saving
//         var allBeneficiaries = $scope.data.beneficiaries.map(beneficiary => ({
//             id: beneficiary.id || null,  // Keep the existing ID if it exists
//             name: beneficiary.name,
//             birthdate: beneficiary.birthdate,
//             age: beneficiary.age,
//             cruds_id: $scope.data.Crud.id // Ensure it relates to the current Crud ID
//         }));

//         console.log('Data being sent to the server:', $scope.data); // Check the structure
//         // Save the Crud data along with all beneficiaries
//         Crud.save({ Crud: $scope.data.Crud, beneficiaries: allBeneficiaries }, function(e) {
//             console.log("Response from server:", e); // Check server response
//             if (e.ok) {
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     } else {
//         console.log("Form is invalid"); // If the form is invalid
//     }
// };


//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {}; // Reset new beneficiary data
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       // Calculate age based on birthdate
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);
      
//       // Check for duplicates
//       const duplicate = $scope.data.beneficiaries.some(b => 
//           b.name === beneficiaryData.name && 
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           // Assign id as null for new beneficiaries
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $scope.newBeneficiary = {}; // Clear the form
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
// // Edit beneficiary
// // Edit beneficiary
// $scope.editBeneficiary = function(index, data) {
//   $scope.editingIndex = index; // Set index for updating
//   $scope.currentBeneficiary = data; // Direct binding instead of angular.copy
//   console.log("Editing index: ", index); // Debug to ensure index is correct
//   $('#edit-beneficiary-modal').modal('show'); // Open the modal
// };

// // Update beneficiary
// $scope.updateBeneficiary = function() {
//   var valid = $('#edit_beneficiary').validationEngine('validate');

//   if (valid) {
//       // Calculate age
//       if ($scope.currentBeneficiary.birthdate) {
//           const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//           const today = new Date();
//           $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               $scope.currentBeneficiary.age--;
//           }
//       }

//       // Update beneficiary if editingIndex is set
//       if ($scope.editingIndex !== undefined) {
//           // Ensure that only the existing beneficiary gets updated
//           $scope.data.beneficiaries[$scope.editingIndex] = $scope.currentBeneficiary; // Direct binding here too
//           console.log('Updated beneficiary: ', $scope.data.beneficiaries[$scope.editingIndex]);
//           $.gritter.add({
//               title: 'Beneficiary Updated!',
//               text: 'The beneficiary has been updated successfully.',
//           });
//           $('#edit-beneficiary-modal').modal('hide');
//       } else {
//           console.log("Editing index not set, unable to update");
//       }
//   } else {
//       console.log('Beneficiary form is invalid');
//   }
// };





//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };

//   // Function to display beneficiaries (HTML should be in your view)
//   $scope.displayBeneficiaries = function() {
//       if ($scope.data.beneficiaries.length > 0) {
//           return $scope.data.beneficiaries;
//       } else {
//           return [{ name: 'No Beneficiary added', birthdate: '', age: '' }];
//       }
//   };
// });

// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   // Attach validation engine to the form
//   $('#form').validationEngine('attach');

//   // Initialize data
//   $scope.data = {
//       Crud: {},
//       beneficiaries: [] // Store both existing and new beneficiaries
//   };

//   // Fetch the Crud data excluding its beneficiaries
//   Crud.get({ id: $routeParams.id }, function(response) {
//       console.log(response); // Debugging output
//       $scope.data.Crud = response.data.Crud;
//       // Load existing beneficiaries
//       $scope.data.beneficiaries = response.data.Beneficiary || [];
//   });

//   // Fetch crud status
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data; // Store statuses in the scope
//   });

//   // Function to update Crud and both new and existing Beneficiaries
//   $scope.update = function() {
//     console.log("Update function called");
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//         console.log("Form is valid");

//         // Separate new beneficiaries and prepare existing ones for updating
//         var beneficiariesData = [];
//         $scope.data.beneficiaries.forEach(function(beneficiary) {
//             if (beneficiary.id) {
//                 // Existing beneficiary, add to update array
//                 beneficiariesData.push({
//                     id: beneficiary.id,
//                     name: beneficiary.name,
//                     birthdate: beneficiary.birthdate,
//                     age: beneficiary.age,
//                     cruds_id: $scope.data.Crud.id // Include Crud ID for reference
//                 });
//             } else {
//                 // New beneficiary, prepare for saving
//                 beneficiariesData.push({
//                     id: null, // New beneficiaries will have null IDs
//                     name: beneficiary.name,
//                     birthdate: beneficiary.birthdate,
//                     age: beneficiary.age,
//                     cruds_id: $scope.data.Crud.id
//                 });
//             }
//         });

//         console.log('Data being sent to the server:', $scope.data);

//         // Save the Crud data along with beneficiaries
//         Crud.save({ Crud: $scope.data.Crud, beneficiaries: beneficiariesData }, function(e) {
//             console.log("Response from server:", e);

//             if (e.ok) {
//                 $.gritter.add({
//                     title: 'Successful!',
//                     text: e.msg,
//                 });
//                 window.location = '#/cruds'; // Redirect after success
//             } else {
//                 $.gritter.add({
//                     title: 'Warning!',
//                     text: e.msg,
//                 });
//             }
//         });
//     } else {
//         console.log("Form is invalid");
//     }
// };


//   // Function to add a new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {};
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           const monthDiff = today.getMonth() - bdayDate.getMonth();
//           if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       console.log("New Beneficiary Data:", beneficiaryData);

//       const duplicate = $scope.data.beneficiaries.some(b =>
//           b.name === beneficiaryData.name &&
//           b.birthdate === beneficiaryData.birthdate
//       );

//       if (!duplicate) {
//           beneficiaryData.id = null; // New beneficiaries have null IDs
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $.gritter.add({
//               title: 'Beneficiary Added!',
//               text: 'The beneficiary has been added successfully.',
//           });
//       } else {
//           $.gritter.add({
//               title: 'Duplicate Beneficiary!',
//               text: 'This beneficiary already exists.',
//           });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//     $scope.editingIndex = index;
//     // Ensure you copy the entire beneficiary object, including the id
//     $scope.currentBeneficiary = angular.copy(data);
//     console.log("Editing Beneficiary:", $scope.currentBeneficiary);
//     $('#edit-beneficiary-modal').modal('show');
// };




//   // Update beneficiary
//   $scope.updateBeneficiary = function() {
//     console.log("Update beneficiary function called");
//     var valid = $('#edit_beneficiary').validationEngine('validate');
//     console.log("Is the form valid?", valid);

//     if (valid) {
//         // Calculate age
//         if ($scope.currentBeneficiary.birthdate) {
//             const bdayDate = new Date($scope.currentBeneficiary.birthdate);
//             const today = new Date();
//             $scope.currentBeneficiary.age = today.getFullYear() - bdayDate.getFullYear();
//             const monthDiff = today.getMonth() - bdayDate.getMonth();
//             if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bdayDate.getDate())) {
//                 $scope.currentBeneficiary.age--;
//             }
//         }

//         console.log("Current Beneficiary before update:", $scope.currentBeneficiary);
//         console.log("Current Beneficiary ID:", $scope.currentBeneficiary.id);

//         if ($scope.currentBeneficiary.id) {
//             const index = $scope.data.beneficiaries.findIndex(b => b.id === $scope.currentBeneficiary.id);
//             console.log("Beneficiary Index Found:", index);

//             if (index !== -1) {
//                 // Update the beneficiary details
//                 $scope.data.beneficiaries[index] = angular.copy($scope.currentBeneficiary);
//                 $('#edit-beneficiary-modal').modal('hide'); // Hide the modal
//                 $.gritter.add({
//                     title: 'Beneficiary Updated!',
//                     text: 'The beneficiary has been updated successfully.',
//                 });
//             } else {
//                 console.error("Beneficiary not found for update.");
//             }
//         } else {
//             console.error("No ID found for current beneficiary.");
//         }
//     } else {
//         console.log("Form is invalid. Update not performed.");
//     }
// };





//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({
//           title: 'Beneficiary Removed!',
//           text: 'The beneficiary has been removed successfully.',
//       });
//   };
// });





// app.controller('CrudEditController', function($scope, Crud, Select, $routeParams) {
//   $scope.data = {
//       Crud: {},
//       beneficiaries: []
//   };

//   // Attach validation engine to the form
//   $("#form").validationEngine('attach');

//   // Load Crud data and beneficiaries
//   $scope.load = function() {
//       Crud.get({ id: $routeParams.id }, function(response) {
//           $scope.data.Crud = response.data.Crud;
//           $scope.data.beneficiaries = response.data.Beneficiary || [];
//       });
//   };

//   // Fetch CRUD statuses
//   Select.get({ code: 'crud-status' }, function(e) {
//       $scope.status = e.data;
//   });

//   // Update function for Crud and beneficiaries
//   $scope.update = function() {
//     if ($("#form").validationEngine('validate')) {
//         const beneficiariesData = $scope.data.beneficiaries.map(b => ({
//             id: b.id || null, // Keep ID if exists
//             name: b.name,
//             birthdate: b.birthdate,
//             age: b.age,
//             cruds_id: $scope.data.Crud.id
//         }));

//         Crud.save({ Crud: $scope.data.Crud, beneficiaries: beneficiariesData }, function(e) {
//             if (e.ok) {
//                 $.gritter.add({ title: 'Successful!', text: e.msg });
//                 window.location = '#/cruds';
//             } else {
//                 $.gritter.add({ title: 'Warning!', text: e.msg });
//             }
//         });
//     }
// };


//   // Add new beneficiary
//   $scope.addBeneficiary = function() {
//       $scope.newBeneficiary = {};
//       $('#add-beneficiary-modal').modal('show');
//   };

//   // Save new beneficiary
//   $scope.saveBeneficiary = function(beneficiaryData) {
//       if (beneficiaryData.birthdate) {
//           const bdayDate = new Date(beneficiaryData.birthdate);
//           const today = new Date();
//           beneficiaryData.age = today.getFullYear() - bdayDate.getFullYear();
//           if (today.getMonth() < bdayDate.getMonth() || 
//               (today.getMonth() === bdayDate.getMonth() && today.getDate() < bdayDate.getDate())) {
//               beneficiaryData.age--;
//           }
//       }

//       const duplicate = $scope.data.beneficiaries.some(b =>
//           b.name === beneficiaryData.name && b.birthdate === beneficiaryData.birthdate && b.id
//       );

//       if (!duplicate) {
//           beneficiaryData.id = null;
//           $scope.data.beneficiaries.push(angular.copy(beneficiaryData));
//           $('#add-beneficiary-modal').modal('hide');
//           $.gritter.add({ title: 'Beneficiary Added!', text: 'The beneficiary has been added successfully.' });
//       } else {
//           $.gritter.add({ title: 'Duplicate Beneficiary!', text: 'This beneficiary already exists.' });
//       }
//   };

//   // Edit beneficiary
//   $scope.editBeneficiary = function(index, data) {
//       $scope.editingIndex = index;
//       $scope.currentBeneficiary = angular.copy(data); // Make sure this has an ID
//       $('#edit-beneficiary-modal').modal('show');
//   };

//   // Update beneficiary
//   // Update beneficiary
// $scope.updateBeneficiary = function() {
//   if ($('#edit_beneficiary').validationEngine('validate')) {
//       console.log("Current Beneficiary:", $scope.currentBeneficiary); // Debugging line
//       if ($scope.currentBeneficiary) {
//           if ($scope.currentBeneficiary.id) {
//               // Find the index of the beneficiary to update
//               const index = $scope.data.beneficiaries.findIndex(b => b.id === $scope.currentBeneficiary.id);
//               if (index !== -1) {
//                   // Update the existing beneficiary
//                   $scope.data.beneficiaries[index] = angular.copy($scope.currentBeneficiary);
//                   $.gritter.add({ title: 'Beneficiary Updated!', text: 'The beneficiary has been updated successfully.' });
//               } else {
//                   console.error("Beneficiary not found for update.");
//               }
//           } else {
//               // If the ID is missing, you might want to log it
//               console.error("Beneficiary ID is missing! Current Beneficiary:", $scope.currentBeneficiary);
//           }
//       }

//       // Close the modal
//       $('#edit-beneficiary-modal').modal('hide');
//   }
// };


//   // Remove beneficiary
//   $scope.removeBeneficiary = function(index) {
//       $scope.data.beneficiaries.splice(index, 1);
//       $.gritter.add({ title: 'Beneficiary Removed!', text: 'The beneficiary has been removed successfully.' });
//   };

//   // Initial load
//   $scope.load();
// });