<div>
  <div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> EDIT </div>
    <div class="panel-body">
    	<div class="col-md-12">
    	  <form id="form ">
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

<div class="modal fade" id="add-permission-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ADD PERMISSION </h4>
      </div>
      <div class="modal-body">
        <form id="add_permission">   

          <div class="col-md-12">
            <div class="form-group">
              <label>PERMISSION<i class="required">*</i></label>
              <select class="form-control" ng-options="opt.id as opt.value for opt in permissions" ng-model="adata.permission_id" ng-change = "getPermission(adata.permission_id)">
              </select>
            </div>
          </div> 

          <div class="col-md-12">
            <div class="form-group">
              <label> DATE <i class="required">*</i></label>
              <input type="text" class="form-control datepicker" ng-model="adata.date" data-validation-engine="validate[required]">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>REMARKS<i class="required">*</i></label>
              <textarea type="text" class="form-control" ng-model="adata.remarks" data-validation-engine="validate[required]"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>AMOUNT<i class="required">*</i></label>
              <input type="text" class="form-control" decimal = "true" ng-model="adata.amount" data-validation-engine="validate[required]">
            </div>
          </div>

        </form>
       </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="savePermission(adata)">SAVE</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-permission-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EDIT PERMISSION </h4>
      </div>
      <div class="modal-body">
        <form id="edit_permission">   

          <div class="col-md-12">
            <div class="form-group">
              <label>PERMISSION<i class="required">*</i></label>
              <select class="form-control" ng-options="opt.id as opt.value for opt in permissions" ng-model="adata.permission_id" ng-change = "getPermission(adata.permission_id)">
              </select>
            </div>
          </div> 

          <div class="col-md-12">
            <div class="form-group">
              <label> DATE <i class="required">*</i></label>
              <input type="text" class="form-control datepicker" ng-model="adata.date" data-validation-engine="validate[required]">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>REMARKS<i class="required">*</i></label>
              <textarea type="text" class="form-control" ng-model="adata.remarks" data-validation-engine="validate[required]"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>AMOUNT<i class="required">*</i></label>
              <input type="text" class="form-control" decimal = "true" ng-model="adata.amount" data-validation-engine="validate[required]">
            </div>
          </div>

        </form>
       </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="updatePermission(adata)">SAVE</button>
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