<?php
class Crud extends AppModel {

	public $actsAs = array('Containable');

  public $belongsTo = array(
    'CrudStatus' => array(
      'foreignKey' => 'crudStatusId'
    )
  );
    // Relationship with Beneficiary (one-to-many)

  public $hasMany = array(
    'Beneficiary' => array(
        'className' => 'Beneficiary',
        'foreignKey' => 'cruds_id', // Use the correct foreign key here
        'dependent' => true
    )
  );

  

}
// <?php
// class Crud extends AppModel {

// public $actsAs = array('Containable');

// public $belongsTo = array(
//     'CrudStatus' => array(
//         'foreignKey' => 'crudStatusId'
//     )
// );

// public $hasMany = array(
//     'Beneficiary' => array(
//         'className' => 'Beneficiary',
//         'foreignKey' => 'cruds_id',
//         'dependent' => true // Optional: delete beneficiaries when a Crud is deleted
//     )
// );
// }

