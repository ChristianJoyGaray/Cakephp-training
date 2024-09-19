<div class="panel panel-primary">
  <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> VIEW </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <dl class="dl-horizontal dl-data dl-bordered">
          <dt>Status:</dt>
          <dd>{{ data.name }}</dd> 
        </dl>


    <div class="row">
      <div class="col-md-12">
        <div class="btn-group btn-group-sm pull-right btn-min">

          <a href="#/crudstatuses/edit/{{ data.id }}" class="btn btn-primary btn-min"><i class="fa fa-edit"></i> EDIT</a> 
          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i>DELETE</a>


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