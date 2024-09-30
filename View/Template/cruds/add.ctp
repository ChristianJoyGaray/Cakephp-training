<div>
  <div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> NEW </div>
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


            <div class="col-md-12">
              <div class="form-group">
                <label> Email <i class="required">*</i></label>
                <input type="email" class="form-control" ng-model="data.Crud.email" data-validation-engine="validate[required]">
              </div>
            </div>


            <div class="col-md-4">
            <div class="form-group">
              <label> BIRTHDATE <i class="required">*</i></label>
              <input id="bday" name="Crud[birthdate]" type="text" class="form-control datepicker" ng-model="data.Crud.birthdate" data-validation-engine="validate[required]">
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
                <label> Character</label>
                <input type="text" class="form-control"  ng-model="data.Crud.character">
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

        <form enctype="multipart/form-data" method="post" action="<?php echo $this->Html->url(['action' => 'add']); ?>">
            <!-- Other input fields for CRUD and beneficiaries -->
            
            <div class="form-group">
                <label for="pdf_upload">Upload PDF:</label>
                <input type="file" name="pdf_upload" id="pdf_upload" accept=".pdf" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
          






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
            <a href="javascript:void(0)" ng-click="removeBeneficiary($index)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
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
        <td colspan="5" class="text-center">No beneficiaries added</td>
      </tr>
    </tbody>          
  </table>
</div>







</div>
				<div class="row">
					<div class="col-md-3 pull-right">
						<button class="btn btn-primary btn-sm btn-block" ng-click="save()">SAVE</button>
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
                        <!-- <label for="beneficiary-birthdate">Beneficiary Birthdate <i class="required">*</i></label>
                        <input  id="beneficiary-birthdate" type="text" class="datepicker" ng-model="newBeneficiary.birthdate" ng-required="true"> -->
                        <label for="beneficiary-birthdate">Birthdate:</label>
                        <input type="text" id="beneficiary-birthdate" class="form-control datepicker" ng-model="newBeneficiary.birthdate">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <!-- <label for="beneficiary-age">Beneficiary Age <i class="required">*</i></label>
                        <input id="beneficiary-age" type="number" class="form-control" ng-model="newBeneficiary.age" ng-required="true"> -->
                        <label for="beneficiary-age">Age:</label>
                        <input type="text"  class="form-control" id="beneficiary-age" ng-model="newBeneficiary.age">
                    </div>
                </div>

                <input type="hidden" ng-model="newBeneficiary.cruds_id" ng-value="selectedCrudId">

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary btn-sm" ng-click="saveBeneficiary(newBeneficiary)" ng-disabled="!newBeneficiary.name || !newBeneficiary.birthdate">ADD BENEFICIARY</button>
                </div>
            </div>
        </div>
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
              <input type="text" class="form-control" ng-model="newBeneficiary.name" ng-required="true">
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Birthdate<i class="required">*</i></label>
              <input type="date" class="form-control" ng-model="newBeneficiary.birthdate" ng-required="true">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Age<i class="required">*</i></label>
              <input type="number" class="form-control" ng-model="newBeneficiary.age" ng-required="true">
            </div>
          </div>
        </form>
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="updateBeneficiary(newBeneficiary)">SAVE</button>
      </div>
    </div>
  </div>
</div>



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