<div>
  <div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> EDIT </div>
    <div class="panel-body">
    	<div class="col-md-12">
    	  <form id="form">
          <div class="row">
            
            <div class="col-md-12">
              <div class="form-group">
                <label> Name <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Crud.name" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
              <label> BIRTHDATE <i class="required">*</i></label>
              <input id="bday" type="date" name="Crud[birthdate]" class="form-control datepicker" ng-model="data.Crud.birthdate" data-validation-engine="validate[required]">
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
        </form>

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
                <!-- <a href="javascript:void(0)" ng-click="remove(beneficiary)"  class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a> -->
                <!-- <a href="javascript:void(0)" ng-click=" remove(currentBeneficiary)"  class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a> -->
                <!-- <button type="button" ng-click="editBeneficiaryVisibility(currentBeneficiary)" class="btn btn-warning btn-sm btn-min">
        {{ currentBeneficiary.visible === 1 ? 'Delete Beneficiary' : 'Delete Beneficiary' }}
    </button> -->







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
                        <label>Beneficiary Birthdate <i class="required">*</i></label>
                        <input id="bday2" type="date" class="form-control" ng-model="newBeneficiary.birthdate" ng-required="true">
                    </div>
                </div>

                <!-- Remove this section if age is calculated from birthdate -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Beneficiary Age <i class="required">*</i></label>
                        <input id="age2" type="number" class="form-control" ng-model="newBeneficiary.age" ng-required="true">
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
              <label>Birthdate<i class="required">*</i></label>
              <input type="date" class="form-control" ng-model="currentBeneficiary.birthdate" ng-required="true">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Age<i class="required">*</i></label>
              <input type="number" class="form-control" ng-model="currentBeneficiary.age" ng-required="true">
            </div>
          </div>
        </form>
      </div>  
      <div class="modal-footer">
        <!-- Assuming this is in your edit modal -->
        
        <!-- <button type="button" class="btn btn-danger btn-sm btn-min" ng-click="editBeneficiaryVisibility(currentBeneficiary.id)">DELETE BENEFICIARY</button> -->
     
     
     
     <!-- //////////////////////// UNCOMMENT BELOW-->
     
     
     
     
     
        <button type="button" ng-click="editBeneficiaryVisibility(currentBeneficiary)" class="btn btn-warning btn-sm btn-min">
        {{ currentBeneficiary.visible === 1 ? 'Delete Beneficiary' : 'Delete Beneficiary' }}
        </button>
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