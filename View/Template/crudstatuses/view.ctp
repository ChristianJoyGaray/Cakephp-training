<div class="panel panel-primary">
  <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> VIEW </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <dl class="dl-horizontal dl-data dl-bordered">
          <dt>Status:</dt>
          <dd>{{ data.CrudStatus.name }}</dd> 
    <div class="clearfix"></div>
    <hr>

    <div class="row">
      <div class="col-md-12">
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