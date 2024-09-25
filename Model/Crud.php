<?php
class Crud extends AppModel {

  // public $recursive = -1; //added
	public $actsAs = array('Containable');

  // public $belongsTo = array(
  //   'CrudStatus' => array(
  //      'className' => 'CrudStatuses', /////added I THINK
  //     'foreignKey' => 'crudStatusId'
  //   )
  // );

  public $belongsTo = array(
    'CrudStatuses' => array(  //change to CrudStatus
        'className' => 'CrudStatus',
        'foreignKey' => 'crudStatusId' // This needs to match the foreign key in the Crud table
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
  
   // Example: Get all cruds using a MySQL query
//   public function getAllCruds($conditions = array()) {
//     $search = isset($conditions['search']) ? $conditions['search'] : '';

//     // Raw SQL query to get all cruds
//     $sql = "SELECT
//                 Crud.*
//             FROM
//                 cruds as Crud
//             WHERE
//                 Crud.visible = 1 AND
//                 (
//                     Crud.name LIKE '%$search%' 
//                 )
//             ORDER BY
//                 Crud.id ASC";

//     // Execute the query and return the results
//     return $this->query($sql);
// }


// public function getAllCrudsWithStatuses($conditions = array()) {
  
//   // Start building the SQL query
//   $sql = "SELECT Crud.*, CrudStatuses.name AS status_name 
//           FROM cruds AS Crud 
//           LEFT JOIN crud_statuses AS CrudStatuses ON Crud.CrudStatusId = CrudStatuses.id 
//           WHERE Crud.visible = 1";

//   // If conditions are provided, append them to the SQL
//   if (!empty($conditions)) {
//       // You might want to add more condition handling here
//       if (isset($conditions['search']) && !empty($conditions['search'])) {
//           $search = strtolower($this->escapeString($conditions['search']));
//           error_log("Search term: " . $search); // Check if the search term is being received
//           $sql .= " AND LOWER(Crud.name) LIKE '%$search%'";
//       }

//   }

//   // Add ordering if needed (adjust as necessary)
//   $sql .= " ORDER BY Crud.id ASC";

//   return $sql; // Ensure this returns a string
// }

// public function getAllCrudsWithStatuses($conditions=array()) {

//   $search = @$conditions['search'];

//   $status = @$conditions['status'];

//   return "SELECT

//       Crud.*,

//       CrudStatuses.*

//     FROM

//       cruds as Crud LEFT JOIN

//       cruds_statuses as CrudStatuses ON CrudStatuses.id = Crud.crudStatusId

//     WHERE

//       Crud.visible = true $CrudStatuses AND

//       (

//         Crud.name    LIKE  '%$search%' OR

//         Crud.crudStatusId       LIKE  '%$search%'

//       )

//     GROUP BY 

//       Crud.id

//     ORDER BY

//       Crud.id ASC
      
//   ";

// }

// public function getAllCruds($conditions = array()) {
//   $search = @$conditions['search'];
//   return "SELECT * FROM cruds WHERE visible = true AND (name LIKE '%$search%')";
// }

 // Method to get all cruds with optional search
 public function getAllCrudsWithStatuses($conditions = array()) {
  // Start building the SQL query
  $sql = "SELECT Crud.*, CrudStatuses.name AS status_name 
          FROM cruds AS Crud 
          LEFT JOIN crud_statuses AS CrudStatuses ON Crud.CrudStatusId = CrudStatuses.id 
          WHERE Crud.visible = 1";

  // Append search condition if provided
  if (!empty($conditions['search'])) {
      $search = strtolower($this->escapeString($conditions['search']));
      $sql .= " AND LOWER(Crud.name) LIKE '%$search%'";
  }

  // Add ordering
  $sql .= " ORDER BY Crud.id ASC";

  return $sql; // Return the SQL query as a string
}

// Method to count all cruds
public function countAllCruds($conditions = array()) {
  $search = isset($conditions['search']) ? $this->getDataSource()->value("%{$conditions['search']}%", 'string') : '';
  
  // Raw SQL query to count all cruds
  $sql = "SELECT COUNT(*) as total 
          FROM cruds as Crud 
          WHERE Crud.visible = 1";

  if ($search) {
      $sql .= " AND Crud.name LIKE $search";
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





