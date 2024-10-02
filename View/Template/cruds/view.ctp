<div class="panel panel-primary">
  <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> VIEW </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <dl class="dl-horizontal dl-data dl-bordered">
          <dt>Name:</dt>
          <dd class="uppercase">{{ data.Crud.name }}</dd>

          <dt>Email:</dt>
          <dd>{{ data.Crud.email }}</dd>

          <dt>Age:</dt>
          <dd>{{ data.Crud.age }}</dd>

          <dt>Role:</dt>
          <dd>{{ data.CrudStatuses.name }}</dd> 

          <!-- <dt>Status:</dt>
          <dd>{{ data.Crud.approve }}</dd> Consider mapping approve value to human-readable text here -->
          
          <dt>Character:</dt>
          <dd>{{ data.Crud.character }}</dd>

          <dt>Birth date:</dt>
          <dd>{{ data.Crud.birthdate | date:'MM/dd/yyyy' }}</dd>

  


        </dl>
      </div>

      

      <div class="col-md-6">
        <hr> 
        
     <!-- Approval Buttons -->
          <div ng-if="data && data.Crud">
              <div ng-if="data.Crud.approve === null"> <!-- When approve is null -->
                  <a class="btn btn-success btn-sm btn-block" id="approve" ng-click="approveCrud()">Approve</a><br/>
                  <a class="btn btn-danger btn-sm btn-block" id="disapprove" ng-click="disapproveCrud()">Disapprove</a><br/>
              </div>
              <div ng-if="data.Crud.approve === true"> <!-- When approve is true -->
                  <span class="badge badge-info">Status: APPROVED</span>
              </div>
              <div ng-if="data.Crud.approve === false"> <!-- When approve is false -->
                  <span class="badge badge-danger">Status: DISAPPROVED</span>
              </div>
          </div>
          <div ng-if="!data || !data.Crud"> <!-- Fallback if data is not available -->
              <span class="badge badge-warning">Loading...</span>
          </div>
          <hr>

        
    <div class="btn-group-xs btn-group pull-left">
    <a href="/Training/cruds/printCrud/{{ data.Crud.id }}" class="btn btn-primary" target="_blank" title="PRINT" ng-disabled="data.Crud.approve === null || data.Crud.approve === false">PRINT</a>
    </div>

        <hr>
      </div>
    
      <div class="clearfix"></div>
      <hr>

     
      <dd class="col-md-12">
          <table class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                      <th class="w30px text-center">#</th>
                      <th class="text-center">File Name</th>
                      <th class="text-center">Download</th>
                  </tr>
              </thead>
              <tbody>
                  <tr ng-if="data.Crud.file_0">
                      <td class="text-center">1</td>
                      <td class="text-center">{{ data.Crud.file_0 }}</td>
                      <td class="text-center">
                          <a href="/Training/files/uploads/{{ data.Crud.file_0 }}" download="{{ data.Crud.file_0 }}">
                              <i class="fa fa-download"></i> Download
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="data.Crud.file_1">
                      <td class="text-center">2</td>
                      <td class="text-center">{{ data.Crud.file_1 }}</td>
                      <td class="text-center">
                          <a href="/Training/files/uploads/{{ data.Crud.file_1 }}" download="{{ data.Crud.file_1 }}">
                              <i class="fa fa-download"></i> Download
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="data.Crud.file_2">
                      <td class="text-center">3</td>
                      <td class="text-center">{{ data.Crud.file_2 }}</td>
                      <td class="text-center">
                          <a href="/Training/files/uploads/{{ data.Crud.file_2 }}" download="{{ data.Crud.file_2 }}">
                              <i class="fa fa-download"></i> Download
                          </a>
                      </td>
                  </tr>
                  <tr ng-if="!data.Crud.file_0 && !data.Crud.file_1 && !data.Crud.file_2">
                      <td colspan="3" class="text-center">No files uploaded.</td>
                  </tr>
              </tbody>
          </table>
      </dd>


      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="w30px text-center">#</th>
                  <th class="text-center">Beneficiary Name</th>
                  <th class="text-center">Birthdate</th>
                  <th class="text-center">Age</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="beneficiary in data.Beneficiary">
                  <td class="text-center">{{ $index + 1 }}</td>
                  <td class="text-center">{{ beneficiary.name }}</td>
                  <td class="text-center">{{ beneficiary.birthdate | date:'MM/dd/yyyy' }}</td>
                  <td class="text-center">{{ beneficiary.age }}</td>
                </tr>
                <tr ng-if="!data.Beneficiary.length">
                  <td colspan="4" class="text-center">No Beneficiaries available.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="btn-group btn-group-sm pull-right btn-min">
            <!-- Edit Button -->
            <a href="#/crud/edit/{{ data.Crud.id }}" class="btn btn-primary btn-min" ng-disabled="data.Crud.approve === true || data.Crud.approve === false"><i class="fa fa-edit"></i> EDIT</a> 
            <!-- Delete Button -->
            <button class="btn btn-danger btn-min" ng-click="remove(data.Crud)" ng-disabled="data.Crud.approve === true || data.Crud.approve === false"><i class="fa fa-trash"></i> DELETE</button>
          </div> 
        </div>
      </div>





    



    </div>
  </div>
</div>
