<?php
class Crud extends AppModel {

  public $actsAs = array('Containable');

  public $disableFileValidation = false;

  public $belongsTo = array(
      'CrudStatuses' => array(  
          'className' => 'CrudStatuses',
          'foreignKey' => 'crudStatusId' 
      )
  );

  public $hasMany = array(
      'Beneficiary' => array(
          'className' => 'Beneficiary',
          'foreignKey' => 'cruds_id',
          'dependent' => true
      )
  );

  public $validate = [
    'approve' => [
        'allowedValues' => [
            'rule' => ['inList', ['PENDING', 'APPROVED', 'DISAPPROVED']],
            'message' => 'Please provide a valid approval status',
            'allowEmpty' => true
        ]
    ],
    'email' => [
        'required' => [
            'rule' => 'notBlank',
            'message' => 'Email is required'
        ],
        'validFormat' => [
            'rule' => 'email',
            'message' => 'Please enter a valid email address'
        ]
    ],
    //     'file' => array(
    //     'rule' => array('extension', array('jpeg', 'jpg', 'png', 'pdf')),
    //     'message' => 'Please supply a valid file (jpeg, jpg, png, pdf).'
    // )
];


  public function initialize(array $config): void {
      parent::initialize($config);
      $this->setTable('cruds');
      $this->setPrimaryKey('id');
      $this->addBehavior('Timestamp');
      $this->setEntityClass('Crud');
  }


  public function beforeValidate($options = array())
  {
      parent::beforeValidate($options);

      // Check if the disableFileValidation flag is set
      if ($this->disableFileValidation) {
          unset($this->validate['file']); // Remove the file validation rule
      }

      return true;
  }



  public function getAllCrudsWithStatuses($conditions = array()) {
    // Start building the SQL query
    $sql = "SELECT Crud.*, CrudStatuses.name AS status_name 
            FROM cruds AS Crud 
            LEFT JOIN crud_statuses AS CrudStatuses ON Crud.CrudStatusId = CrudStatuses.id 
            WHERE Crud.visible = 1";

    // Append search condition if provided
    if (!empty($conditions['search'])) {
        $search = $conditions['search'];
        $sql .= " AND LOWER(Crud.name) LIKE LOWER('%$search%')";
    }

    // Append approve condition based on the values in the database
    if (isset($conditions['approve'])) {
        switch ($conditions['approve']) {
            case 'PENDING':
                $sql .= " AND Crud.approve IS NULL"; // Handle NULL for pending
                break;
            case 'APPROVED':
                $sql .= " AND Crud.approve = 1"; // Handle approved
                break;
            case 'DISAPPROVED':
                $sql .= " AND Crud.approve = 0"; // Handle disapproved
                break;
        }
    }

    // Add ordering
    $sql .= " ORDER BY Crud.id ASC";

    return $sql; // Ensure this returns a string
}


  public function countAllCruds($conditions = array()) {
      $search = isset($conditions['search']) ? $this->getDataSource()->value("%{$conditions['search']}%", 'string') : '';
      
      // Raw SQL query to count all cruds
      $sql = "SELECT COUNT(*) as total 
              FROM cruds as Crud 
              WHERE Crud.visible = 1";

      if ($search) {
          $sql .= " AND Crud.name LIKE $search";
      }

      // Append approve condition if provided
      if (isset($conditions['approve'])) {
          if ($conditions['approve'] === 'PENDING') {
              $sql .= " AND Crud.approve IS NULL"; // Handle NULL for pending
          } elseif ($conditions['approve'] === 'APPROVED') {
              $sql .= " AND Crud.approve = 'APPROVED'"; // Handle approved
          } elseif ($conditions['approve'] === 'DISAPPROVED') {
              $sql .= " AND Crud.approve = 'DISAPPROVED'"; // Handle disapproved
          }
      }

      // Execute the query and return the count
      $results = $this->query($sql);
      return $results[0][0]['total'];
  }

  // Custom pagination for cruds using raw SQL
  public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
      $recursive = -1;

      // Construct the base SQL query with conditions
      $queryConditions = isset($extra['extra']['conditions']) ? $extra['extra']['conditions'] : array();
      $sql = $this->getAllCrudsWithStatuses($queryConditions);

      // Add LIMIT clause for pagination
      $page = (int)$page;
      $limit = (int)$limit;
      $offset = max(0, ($page - 1) * $limit);

      // Add LIMIT clause to the SQL
      $sql .= " LIMIT $offset, $limit";

      // Execute the query and return results
      return $this->query($sql);
  }

  // Count method for pagination
  public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
      if (isset($extra['extra']['conditions'])) {
          return $this->countAllCruds($extra['extra']['conditions']);
      }

      return 0; // If no conditions, return 0
  }
}

