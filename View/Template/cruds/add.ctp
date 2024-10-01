<div>
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> NEW </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form id="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <i class="required">*</i></label>
                                <input type="text" class="form-control" ng-model="data.Crud.name" data-validation-engine="validate[required]">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email <i class="required">*</i></label>
                                <input type="email" class="form-control" ng-model="data.Crud.email" data-validation-engine="validate[required]">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>BIRTHDATE <i class="required">*</i></label>
                                <input id="bday" name="Crud[birthdate]" type="text" class="form-control datepicker" ng-model="data.Crud.birthdate" data-validation-engine="validate[required]" ng-change="calculateAge()">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Age <i class="required">*</i></label>
                                <input type="number" id="age" name="Crud[age]" class="form-control" ng-model="data.Crud.age" data-validation-engine="validate[required]" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status <i class="required">*</i></label>
                                <select class="form-control" ng-model="data.Crud.crudStatusId" ng-options="opt.id as opt.value for opt in status" data-validation-engine="validate[required]">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Character</label>
                                <input type="text" class="form-control" ng-model="data.Crud.character">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_upload">Upload File:</label>
                                <input type="file" id="fileUpload" ng-model="data.Crud.file" name="fileUpload" accept="*">
                                </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <hr>
                    <div class="col-md-3 pull-left">
                        <button type="button" class="btn btn-warning btn-sm btn-block" ng-click="addBeneficiary()">ADD BENEFICIARY</button><br/>
                    </div>

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
                                            <button type="button" ng-click="editBeneficiary($index, beneficiary)" class="btn btn-success" title="EDIT"><i class="fa fa-edit"></i></button>
                                            <button type="button" ng-click="removeBeneficiary($index)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></button>
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

                    <div class="clearfix"></div>

                    <div class="row">
                    <div class="col-md-3 pull-right">
                        <button type="button" class="btn btn-primary btn-sm btn-block" ng-click="save()">SAVE</button>
                    </div>
                </div>
                </form>

               
            </div>
        </div>
    </div>
</div>

<!-- Add Beneficiary Modal -->
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
                <form>
                    <div class="col-md-12">
                        <h4>Beneficiary Information</h4>
                        <div class="form-group">
                            <label>Beneficiary Name <i class="required">*</i></label>
                            <input type="text" class="form-control" ng-model="newBeneficiary.name" ng-required="true">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="beneficiary-birthdate">Birthdate:</label>
                            <input type="text" id="beneficiary-birthdate" class="form-control datepicker" ng-model="newBeneficiary.birthdate" ng-change="calculateBeneficiaryAge()">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="beneficiary-age">Age:</label>
                            <input type="text" class="form-control" id="beneficiary-age" ng-model="newBeneficiary.age" readonly>
                        </div>
                    </div>

                    <input type="hidden" ng-model="newBeneficiary.cruds_id" ng-value="data.Crud.id">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CANCEL</button>
                        <button type="button" class="btn btn-primary btn-sm" ng-click="saveBeneficiary(newBeneficiary)" ng-disabled="!newBeneficiary.name || !newBeneficiary.birthdate">ADD BENEFICIARY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Beneficiary Modal -->
<div class="modal fade" id="edit-beneficiary-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EDIT BENEFICIARY</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name<i class="required">*</i></label>
                            <input type="text" class="form-control" ng-model="newBeneficiary.name" ng-required="true">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit-beneficiary-birthdate">Birthdate:</label>
                            <input type="text" class="form-control datepicker" ng-model="newBeneficiary.birthdate" ng-change="calculateBeneficiaryAge()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit-beneficiary-age">Age:</label>
                            <input type="text" class="form-control" ng-model="newBeneficiary.age" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CANCEL</button>
                        <button type="button" class="btn btn-primary btn-sm" ng-click="updateBeneficiary(newBeneficiary)" ng-disabled="!newBeneficiary.name || !newBeneficiary.birthdate">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
