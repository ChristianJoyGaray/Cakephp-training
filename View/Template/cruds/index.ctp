<div class="panel panel-primary">
  <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> CRUDS </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-3">
        <a href="#/crud/add" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> ADD </a>
      </div>
        
      <div class="col-md-4 pull-right">
        <input type="text" class="form-control search" placeholder="SEARCH HERE" ng-model="searchTxt" ng-enter="search(searchTxt)">
        <sup style="font-size:10px;color:gray">Press Enter to search</sup>
      </div>
			
      <div class="clearfix"></div><hr> 

      <div class="col-md-12">
        
      <table class="table table-bordered center">
          <thead>
            <tr>
              <th class="w10x">#</th>
              <th>NAME</th>
              <th>STATUS</th>
              <th class="w90x"></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="crud in cruds">
              <td class="text-center">{{ (paginator.page - 1) * paginator.limit + $index + 1 }}</td>
              <td>{{ crud.name }}</td>
              <td>{{ crud.crudStatus }}</td>
              <td>
                  <div class="btn-group-xs btn-group">
                      <a href="#/crud/view/{{ crud.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                      <a href="#/crud/edit/{{ crud.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                      <a href="javascript:void(0)" ng-click="remove(crud)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                  </div>
              </td>
            </tr>
          </tbody>
      </table>
      </div>
    </div>
        <ul class="pagination pull-right">
            <li class="pagination-page">
                <a href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
            </li>
            <li class="prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                <a href="javascript:void(0)" ng-click="load({ page: paginator.page - 1, search: searchTxt })">&laquo;</a>
            </li>
            <li ng-repeat="page in pages" class="pagination-page {{ paginator.page == page.number ? 'active':''}}" >
                <a href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
            </li>
            <li class="nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                <a href="javascript:void(0)" ng-click="load({ page: paginator.page + 1, search: searchTxt })">&raquo;</a>
            </li>
            <li class="pagination-page">
                <a href="javascript:void(0)" ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
            </li>
        </ul>

    <div class="clearfix"></div>
        
        <div class="pull-right" ng-show="paginator.pageCount > 0">
          <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
        </div>
  </div>
</div>
