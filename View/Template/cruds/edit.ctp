<div>
  <div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> EDIT </div>
    <div class="panel-body">
    	<div class="col-md-12">
    	  <form id="form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label> Name <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Crud.name" data-validation-engine="validate[required]">
              </div>
            </div>

                
            <div class="col-md-12">
              <div class="form-group">
                <label> Email <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Crud.email" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
              <label> BIRTHDATE <i class="required">*</i></label>
              <input id="bday" type="text" name="Crud[birthdate]" class="form-control datepicker" ng-model="data.Crud.birthdate" data-validation-engine="validate[required]" ng-change="calculateAge()">
            </div>
          </div>
    
            <div class="col-md-4">
              <div class="form-group">
                <label> Age <i class="required">*</i></label>
                <input type="number" id="age" name="Crud[age]" class="form-control" ng-model="data.Crud.age" data-validation-engine="validate[required]"> 
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label> Status <i class="required">*</i></label>
                <select class="form-control" ng-model="data.Crud.crudStatusId" ng-options="opt.id as opt.value for opt in status" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>

     
            <div class="col-md-12">
              <div class="form-group">
                <label> Character <i class="required">*</i></label>
                <input type="text" class="form-control"  ng-model="data.Crud.character" data-validation-engine="validate[required]">
              </div>
            </div>
           
          
            <div class="clearfix"></div>

         

          </div>  

<!--           
        
          <div class="col-md-12">
              <div class="form-group">
                  <label for="file_upload">Upload File:</label>
                  <input type="file" id="file" name="file" file-model="files" ng-model="files">
                  </div>
          </div> -->

          <div class="col-md-12">
              <div class="form-group">
                  <label for="file_upload">Upload File:</label>
                  <input type="file" id="fileInput" multiple ng-model="data.Crud.file" name="fileUpload[]" accept="*">
              </div>
          </div>





        <hr>
  
        <!-- <div class="col-md-12">
              <div class="form-group">
                  <label for="file_upload">Upload File:</label>
                  <input type="file" id="file" name="file" file-model="fileData" />
              </div>
          </div>
 -->


      <dd class="col-md-12">
          <table class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                 
                      <th class="text-center">File Name</th>
                      <th class="text-center"></th>
                  </tr>
              </thead>
              <tbody>
                  <tr ng-if="data.Crud.file_0">
                     
                      <td class="text-center"><a  href="/Training/files/uploads/{{ data.Crud.file_0 }}" target="_blank">{{ data.Crud.file_0 }}</a></td>
                      <td class="text-center">
                          <a ng-click="deleteFile('file_0')">
                              <i class="fa fa-trash"></i> Delete
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="data.Crud.file_1">
                     
                      <td class="text-center"><a  href="/Training/files/uploads/{{ data.Crud.file_1 }}" target="_blank">{{ data.Crud.file_1 }}</a></td>
                      <td class="text-center">
                          <a ng-click="deleteFile('file_1')">
                              <i class="fa fa-trash"></i> Delete
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="data.Crud.file_2">
                    
                      <td class="text-center"><a  href="/Training/files/uploads/{{ data.Crud.file_2 }}" target="_blank">{{ data.Crud.file_2 }}</a></td>
                      <td class="text-center">
                          <a ng-click="deleteFile('file_2')">
                              <i class="fa fa-trash"></i> Delete
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="!data.Crud.file_0 && !data.Crud.file_1 && !data.Crud.file_2">
                      <td colspan="3" class="text-center">No files uploaded.</td>
                  </tr>
              </tbody>
          </table>
      </dd>
      <hr>

      <div class="col-md-3 pull-left">
              <a class="btn btn-warning btn-sm btn-block" id="save" ng-click="addBeneficiary()">ADD BENEFICIARY</a><br/>
        </div>
        
        <div class="clearfix"></div>


        <div class="col-md-12">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th class="w30px text-center">#</th>
        <th class="text-center">Beneficiary Name</th>
        <th class="text-center">Birthdate</th>
        <th class="text-center">Age</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="beneficiary in data.beneficiaries">
        <td class="text-center">{{ $index + 1 }}</td>
        <td class="text-left">{{ beneficiary.name }}</td>
        <td class="text-center">{{ beneficiary.birthdate | date: 'MM/dd/yyyy' }}</td>
        <td class="text-center">{{ beneficiary.age }}</td>
        <td class="text-center">
            <div class="btn-group btn-group-xs">
                <a href="javascript:void(0)" ng-click="editBeneficiary($index, beneficiary)" class="btn btn-success" title="EDIT"><i class="fa fa-edit"></i></a>
                <button type="button" ng-click="removeBeneficiary($index)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></button>
               
       






    <!-- ///////////////////////////////////////// -->
              </div>
        </td>
      </tr>
    </tbody>
    <tfoot ng-if="data.beneficiaries.length > 0">
      <tr>
        <th class="text-left" colspan="3">TOTAL</th>
        <th class="text-right">{{ data.beneficiaries.length }}</th>
        <th></th>
      </tr>
    </tfoot>
    <tbody ng-if="data.beneficiaries.length === 0">
      <tr>
        <td colspan="5" class="text-center">No Beneficiary added</td>
      </tr>
    </tbody>          
  </table>
</div>

			  <hr>
				<div class="row">
					<div class="col-md-3 pull-right">
						<button class="btn btn-primary btn-sm btn-block" ng-click="update()"> UPDATE </button>
					</div>
				</div>

      
        </form>
 
        
    	</div>
    </div>
  </div>
</div>
<script>
$('#form').validationEngine('attach');
</script>




<div class="modal fade" id="add-beneficiary-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">ADD BENEFICIARY</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h4>Beneficiary Information</h4>
                    <div class="form-group">
                        <label>Beneficiary Name <i class="required">*</i></label>
                        <input type="text" class="form-control" ng-model="newBeneficiary.name" ng-required="true">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="beneficiary-birthdate">Beneficiary Birthdate <i class="required">*</i></label>
                        <input id="beneficiary-birthdate" type="text" class="form-control datepicker" ng-model="newBeneficiary.birthdate" ng-required="true" ng-change="calculateBeneficiaryAge()">
                    </div>
                </div>

                <!-- Remove this section if age is calculated from birthdate -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="beneficiary-age">Beneficiary Age <i class="required">*</i></label>
                        <input id="beneficiary-age" type="text" class="form-control" ng-model="newBeneficiary.age" ng-required="true" readonly>
                    </div>
                </div>

                <input type="hidden" ng-model="newBeneficiary.cruds_id" ng-value="selectedCrudId">

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary btn-sm" ng-click="saveBeneficiary(newBeneficiary)" ng-disabled="!newBeneficiary.name || !newBeneficiary.birthdate">ADD BENEFICIARY</button>
                    <!-- <button type="button" class="btn btn-primary btn-sm" ng-click="saveBeneficiary(newBeneficiary)" ng-disabled="!newBeneficiary.name || !newBeneficiary.birthdate || isSaving">ADD BENEFICIARY</button> -->

                  </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="edit-beneficiary-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EDIT BENEFICIARY</h4>
      </div>
      <div class="modal-body">
        <form id="edit_beneficiary">   
          <div class="col-md-12">
            <div class="form-group">
              <label>Name<i class="required">*</i></label>
              <input type="text" class="form-control" ng-model="currentBeneficiary.name" ng-required="true">
            </div>
          </div> 
          <div class="col-md-4">
                    <div class="form-group">
                        <label for="beneficiary-birthdate2">Beneficiary Birthdate <i class="required">*</i></label>
                        <input id="beneficiary-birthdate2" type="text" class="form-control datepicker" ng-model="currentBeneficiary.birthdate" ng-required="true" ng-change="calculateBeneficiaryAge2()">
                    </div>
                </div>

                <!-- Remove this section if age is calculated from birthdate -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="beneficiary-age2">Beneficiary Age <i class="required">*</i></label>
                        <input id="beneficiary-age2" type="text" class="form-control" ng-model="currentBeneficiary.age" ng-required="true" readonly>
                    </div>
                </div>
        </form>
      </div>  
      <div class="modal-footer">
        <!-- Assuming this is in your edit modal -->
        
        <!-- <button type="button" class="btn btn-danger btn-sm btn-min" ng-click="editBeneficiaryVisibility(currentBeneficiary.id)">DELETE BENEFICIARY</button> -->
     
     
     
     <!-- //////////////////////// UNCOMMENT BELOW-->
     
     
     
     
<!--      
        <button type="button" ng-click="editBeneficiaryVisibility(currentBeneficiary)" class="btn btn-warning btn-sm btn-min">
        {{ currentBeneficiary.visible === 1 ? 'Delete Beneficiary' : 'Delete Beneficiary' }}
        </button> -->
        <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="updateBeneficiary()">SAVE</button>
      </div>
    </div>
  </div>
</div>


<script>
$('#edit_beneficiary').validationEngine('attach');
</script>


<script>
    const bday = document.getElementById("bday");
    const age = document.getElementById("age");

    function calculateAge() {
        const bdayInput = new Date(bday.value);
        const today = new Date();

        let computedAge = today.getFullYear() - bdayInput.getFullYear();
        const monthDifference = today.getMonth() - bdayInput.getMonth();
        const dayDifference = today.getDate() - bdayInput.getDate();

        if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
            computedAge--;
        }

        age.value = computedAge;  // Update the age input field
    }

    bday.addEventListener("input", calculateAge);  // Trigger calculation when birthdate changes
</script>