app.controller('CrudController', function($scope, Crud) {
  // load data
  $scope.load = function(options) {
    options = typeof options !== 'undefined' ?  options : {};
    Crud.query(options, function(e) {
      if (e.ok) {
        $scope.cruds = e.data;
        //pagination
        $scope.paginator = e.paginator;
        $scope.pages = paginator($scope.paginator, 5);
      }
    });
  }
  $scope.load();
  //search
  $scope.search = function(search) {
    search = typeof search !== 'undefined' ? search : '';
    if (search.length > 0){
      $scope.load({
        search: search
      });
    }else{
      $scope.load();
    }
  }
  // remove
  $scope.remove = function(data) {
    bootbox.confirm('Are you sure you want to delete ' + data.name +' ?', function(c) {
      if (c) {
        Crud.remove({ id: data.id }, function(e) {
          if (e.ok) {
            $.gritter.add({
              title: 'Successful!',
              text:  e.msg,
            });
            $scope.load();
          }
        });
      }
    });
  }
});

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







// app.controller('CrudAddController', function($scope, Crud, Select, Beneficiary) {
//   $('#form').validationEngine('attach');

//   // Initialize data object for CRUD and Beneficiary
//   $scope.data = {
//     Crud: {},
//     Beneficiary: {}
//   };

//   // Get CRUD status
//   Select.get({ code: 'crud-status' }, function(e) {
//     $scope.status = e.data;
//   });

//   $scope.save = function() {
//     var valid = $("#form").validationEngine('validate');

//     if (valid) {
//       Crud.save($scope.data.Crud, function(e) {
//         if (e.ok) {
//           $.gritter.add({
//             title: 'Successful!',
//             text: e.msg,
//           });
//           window.location = '#/cruds';
//         } else {
//           $.gritter.add({
//             title: 'Warning!',
//             text: e.msg,
//           });
//         }
//       });
//     }
//   };

//   $scope.addPermission = function() {
//     console.log("Adding permission...");
//     $scope.data.Beneficiary = {}; // Reset beneficiary data
//     $('.savePermission').attr('disabled', false);
//     $('#add-permission-modal').modal('show');
//   };

//   $scope.savePermission = function() {
//     console.log("Saving beneficiary data:", $scope.data.Beneficiary);
//     Beneficiary.save($scope.data.Beneficiary, function(response) {
//       if (response.ok) {
//         console.log("Beneficiary saved successfully!");
//         $('#add-permission-modal').modal('hide');
//       } else {
//         console.error("Error saving beneficiary:", response.msg);
//       }
//     }, function(error) {
//       console.error("Service error:", error);
//     });
//   };
// });



//PUT COMMENTS/NOTES ALWAYSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS


app.controller('CrudAddController', function($scope, Beneficiary, Select) {
  $('#form').validationEngine('attach');

  // Get crud status
  Select.get({ code: 'crud-status' }, function(e) {
    $scope.status = e.data;
  });

  $scope.save = function() {
    var valid = $("#form").validationEngine('validate');

    if (valid) {
      // Set the correct cruds_id from the parent scope or relevant source
      $scope.data.beneficiary.cruds_id = $scope.data.Crud.id;

      Beneficiary.save($scope.data.beneficiary, function(e) {
        if (e.ok) {
          $.gritter.add({
            title: 'Successful!',
            text: e.msg,
          });
          window.location = '#/beneficiaries'; // Adjust the redirect path as needed
        } else {
          $.gritter.add({
            title: 'Warning!',
            text: e.msg,
          });
        }
      });
    }
  };
});








app.controller('CrudViewController', function($scope, $routeParams, Crud) {
  $scope.id = $routeParams.id;

  // $('birthdate').datepicker({
  //   format: 'mm/dd/yy',
  //   autoclose: true
  // });
  // $scope.data = {};
  // $scope.data.PermissionSelection = [];
  // $scope.data.UserPermission = []; 
  // load 

  
  $scope.load = function() {
    Crud.get({ id: $scope.id }, function(e) {
      $scope.data = e.data;
      // $scope.permissions_temp = $scope.data.PermissionSelection;
      // $scope.compute();    
    });
  }
  $scope.load();

  // $scope.compute = function(){
  //   amount = 0;
  //   if($scope.data.UserPermission.length > 0){
  //     $.each($scope.data.UserPermission,function(key,val){
  //       if(val.visible != 0){
  //         amount += parseFloat(val['amount']);
  //       }
  //     });
  //   }
  //   $scope.data.User.total = amount;
  // }
  // $scope.removeselected = function() {
  //   $('.deletePermission').attr('disabled',true);
  //   permissiondelete = [];
  //   for (i in $scope.data.UserPermission) {
  //     if ($scope.data.UserPermission[i].selected) {
  //       permissiondelete.push({
  //         user_id:       $scope.id,
  //         permission_id: $scope.data.UserPermission[i].id
  //       });
  //     }
  //   }
  //   if (permissiondelete.length <= 0) {
  //     $.gritter.add({
  //       title: 'Warning!',
  //       text: 'Please select permission to delete.',
  //     });
  //     $('.deletePermission').attr('disabled',false);
  //   } else {
  //     bootbox.confirm('Are you sure you want to delete your selected permission ?', function(c) {
  //       if (c) {
  //         DeleteSelected.save({ permissiondelete : permissiondelete }, function(e) {
  //           $('.deletePermission').attr('disabled',false);
  //           if (e.ok) {
  //             $.gritter.add({
  //               title: 'Successful!',
  //               text: e.msg
  //             });
  //             $scope.load();
  //           } else {
  //             $.gritter.add({
  //               title: 'Warning!',
  //               text: e.msg
  //             });
  //           }
  //         });
  //       } else {
  //         $('.deletePermission').attr('disabled',false);
  //       }
  //     });
  //   }
  // }
  // remove 
  $scope.remove = function(data) {
    bootbox.confirm('Are you sure you want to remove '+ data.name +' ?', function(c) {
      if (c) {
        Crud.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            window.location = "#/cruds";

          }

        });

      }

    });

  } 

  // add permission

  $scope.addPermission = function() {

    $('.savePermission').attr('disabled',false);

    $('#add-permission-modal').modal('show');

  }

  $scope.selectall = function() {

    if ($scope.selectAll) {

      bool = true;

    } else {

      bool = false;

    }

    for (i in $scope.data.PermissionSelection) {

      $scope.data.PermissionSelection[i].selected = bool;

    }

  }
  
  $scope.selectalldelete = function() {

    if ($scope.selectAlldelete) {

      bool = true;

    } else {

      bool = false;

    }

    for (i in $scope.data.UserPermission) {

      $scope.data.UserPermission[i].selected = bool;

    }

  }
    
  $scope.savePermission = function() {

    $('.savePermission').attr('disabled',true);

    permissions = [];

    for (i in $scope.data.PermissionSelection) {

      if ($scope.data.PermissionSelection[i].selected) {

        permissions.push({

          user_id:       $scope.id,

          permission_id: $scope.data.PermissionSelection[i].id

        });

      }

    }

    if (permissions.length <= 0) {

      $.gritter.add({

        title: 'Warning!',

        text: 'Please select permission to save.',

      });

      $('.savePermission').attr('disabled',false);

    } else {

      $('.savePermission').attr('disabled',true);

      UserPermission.save({ UserPermission: permissions }, function(e) {

        $('.savePermission').attr('disabled',true);

        if (e.ok) {

          $.gritter.add({

            title: 'Successful!',

            text: e.msg

          });

          $scope.load();

          $('#add-permission-modal').modal('hide');

        } else {

          $.gritter.add({

            title: 'Warning!',

            text: e.msg

          });

        }

      });

    }

  }

  // remove user

  $scope.removePermission = function (permission) {

    bootbox.confirm('Are you sure you want to delete "' + permission.module + '-' + permission.action + '"?', function(c) {

      if (c) {

        UserPermission.remove({ id:permission.id }, function(e){

          if(e.ok){

            $.gritter.add({ title: 'Successful!', text: e.msg });

            $scope.load();

          }

        }); 

      }

    }); 

  };
  
  $scope.filterPermission = function (search) {

    temp = [];

    if (search.module) {

      angular.forEach($scope.permissions_temp, function(value, key) {

        if (value.module == search.module) {

          temp.push(value);

        }

      });

    }else if (search.action) {

      angular.forEach($scope.permissions_temp, function(value, key) {

        if (value.action == search.action) {

          temp.push(value);

        }

      });

    } 

    $scope.data.PermissionSelection = temp;

  }

});

app.controller('CrudEditController', function($scope, $routeParams, Crud, Select) {

  
  $scope.id = $routeParams.id;

  $("#form").validationEngine('attach');
  
  // load 

  Select.get({code: 'crud-status'}, function(e){
    $scope.status = e.data;
  });


  $scope.load = function() {

    Crud.get({ id: $scope.id }, function(e) {

      $scope.data = e.data;

      // $scope.data.User.password = '';

      // $scope.confirmPassword = '';

      // $scope.putIndex();

    });

  }

  $scope.load();
  
  $scope.update = function() {

    valid = $("#form").validationEngine('validate');

    if(valid){
      Crud.update({ id:$scope.id },$scope.data,function(e) {
        if (e.ok){
          $.gritter.add({
            title:'Successful!',
            text: e.msg,
          });
          window.location = '#/cruds';
        } else{
          $.gritter.add({
            title: 'Warning!',
            text: e.msg,
          });
        }
      }) 
        
      
    }

    

      
    }
    
    
  

  
  // $scope.data = {};
  
  // $scope.bool = [{ id: true, value: 'Yes' }, { id: false, value: 'No' }];

  // // get session

  // Select.get({code: 'session'}, function(e){

  //   $scope.roleId = e.data.roleId;

  // });

  // // get roles

  // Select.get({code: 'roles'}, function(e){

  //   $scope.roles = e.data;

  // });

  // // get branches

  // Select.get({code: 'branch'}, function(e){

  //   $scope.branches = e.data;

  // });
  
  // // get permissions

  // Select.get({code: 'permissions'}, function(e){

  //   $scope.permissions = e.data;

  // });


  // $scope.compute = function(){

  //   amount = 0;

  //   if($scope.data.UserPermission.length > 0){

  //     $.each($scope.data.UserPermission,function(key,val){

  //       if(val.visible != 0){

  //         amount += parseFloat(val['amount']);

  //       }

  //     });

  //   }

  //   $scope.data.User.total = amount;

  // }

  // $scope.getPermission = function(id){

  //   if($scope.permissions.length > 0){

  //     $.each($scope.permissions,function(key,val){

  //       if(id == val.id){

  //         $scope.adata.permission = val.value;
          
  //       }

  //     });

  //   }
  
  // }

  // $scope.putIndex = function(){

  //   if($scope.data.UserPermission.length > 0){

  //     index = 0;

  //     $.each($scope.data.UserPermission,function(key,val){

  //       if(val.visible != 0){

  //         index += 1;

  //         $scope.data.UserPermission[key].index = index;
          
  //       }

  //     });

  //   }

  // }

  // $scope.addPermission = function() {

  //   $('#add_permission').validationEngine('attach');

  //   $scope.adata = {};

  //   $('#add-permission-modal').modal('show');  

  // }

  // $scope.savePermission = function(data){

  //   valid = $('#add_permission').validationEngine('validate');

  //   if(valid){

  //     data.amount = number_format(data.amount, 2, '.', ''); 

  //     $scope.data.UserPermission.push(data);

  //     $scope.compute();

  //     $scope.putIndex();

  //     $('#add-permission-modal').modal('hide');  

  //   }
    
  // }

  // $scope.editPermission = function(index,data) {

  //   $('#edit_permission').validationEngine('attach');

  //   data.index = index;

  //   $scope.adata = data;

  //   $('#edit-permission-modal').modal('show');  

  // }

  // $scope.updatePermission = function(data,index) {

  //   valid = $('#edit_permission').validationEngine('validate');

  //   if(valid){

  //     data.amount = number_format(data.amount, 2, '.', ''); 

  //     $scope.data.UserPermission[data.index] = data;

  //     $scope.compute();

  //     $scope.putIndex();

  //     $('#edit-permission-modal').modal('hide');  

  //   }

  // }

  // $scope.removePermission = function(index){

  //   $scope.data.UserPermission[index].visible = 0;

  //   $scope.compute();

  //   $scope.putIndex();

  // }

}); 
