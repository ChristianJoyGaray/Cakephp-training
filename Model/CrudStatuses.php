<?php
// app/Model/CrudStatuses.php
App::uses('AppModel', 'Model');

// class CrudStatuses extends AppModel {
//     public $useTable = 'crud_statuses'; // Specify the table name
// }
class CrudStatuses extends AppModel {
    public $hasMany = array(
        'Crud' => array(
            'className' => 'Crud',
            'foreignKey' => 'CrudStatusId' // Make sure this matches your database field
        )
    );
}
