<div class="panel panel-primary">
  <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> VIEW </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <dl class="dl-horizontal dl-data dl-bordered">
          <dt>Name:</dt>
          <dd class="uppercase">{{ data.Crud.name }}</dd>

          <dt>Age:</dt>
          <dd>{{ data.Crud.age }}</dd>

          <dt>Status:</dt>
          <dd>{{ data.CrudStatus.name }}</dd> 
          

          <dt>Character:</dt>
          <dd>{{ data.Crud.character }}</dd>

          <dt>Birth date:</dt>
          <dd>{{ data.Crud.birthdate | date:'MM/dd/yyyy' }}</dd>
          
        </dl>

  

    <div class="clearfix"></div>
    <hr>

    

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
          

          <a href="#/crud/edit/{{ data.Crud.id }}" class="btn btn-primary btn-min"><i class="fa fa-edit"></i> EDIT</a> 
          <button class="btn btn-danger btn-min" ng-click="remove(data.Crud)"><i class="fa fa-trash"></i> DELETE</button>

        </div> 
      </div>
    </div>




  </div>
</div>


<style>
  .table-wrapper{
    width:100%;
    height:500px;
    overflow-y:auto;
  }
</style>