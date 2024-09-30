<?php
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'FPDF', array('file' => 'FPDF/fpdf.php'));
App::uses('CakeEmail', 'Network/Email');

class CrudsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }

    public $uses = ['Crud', 'Beneficiary'];

    //OGGGGGG PRINT
    // public function printCrud($id = null) {
    //     // Load the specific Crud based on the ID
    //     $crud = $this->Crud->findById($id);
    //     if (empty($crud)) {
    //         throw new NotFoundException(__('Invalid CRUD'));
    //     }

    //     // Initialize FPDF
    //     $pdf = new FPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 16);

    //     // Output CRUD data
    //     $pdf->Cell(40, 10, 'CRUD Details');
    //     $pdf->Ln(10); // Line break
    //     $pdf->SetFont('Arial', '', 12);
    //     $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : 'N/A'));

    //     // Output the PDF
    //     $this->response->type('application/pdf');
    //     $pdf->Output();
    //     return $this->response;
    // }
    //WORKING PRINT FOR SPECIFIC ID
    // public function printCrud($id = null) {
    //     // Load the specific Crud based on the ID
    //     $crud = $this->Crud->find('first', [
    //         'conditions' => ['Crud.id' => $id],
    //         'contain' => ['CrudStatuses'] // Use CrudStatuses here
    //     ]);
        
    //     if (empty($crud)) {
    //         throw new NotFoundException(__('Invalid CRUD'));
    //     }
    
    //     // Initialize FPDF
    //     $pdf = new FPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 16);
    
    //     // Output CRUD data
    //     $pdf->Cell(40, 10, 'CRUD Details');
    //     $pdf->Ln(10); // Line break
    //     $pdf->SetFont('Arial', '', 12);
    //     $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
    //     $pdf->Ln(10);
    //     $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : 'N/A')); // Use CrudStatuses here
    
    //     // Output the PDF
    //     $this->response->type('application/pdf');
    //     $pdf->Output();
    //     return $this->response;
    // }
    
public function query($sql, $params = []) {
    $stmt = $this->getConnection()->prepare($sql); // Prepare the statement
    $stmt->execute($params); // Execute with parameters
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
}

//WORKS FOR DOWNLOADING SERACHED PDF
// public function printCrud() {
//     // Get the search term from the query if present
//     $search = isset($this->request->query['search']) ? $this->request->query['search'] : null;

//     // Prepare conditions for fetching the cruds
//     $conditions = [];
//     if (!empty($search)) {
//         $conditions['search'] = $search; // Set search condition
//     }

//     // Log the conditions to verify what's being applied
//     $this->log('Conditions for print: ' . print_r($conditions, true), 'debug');

//     // Fetch the SQL query string using the model method
//     $sql = $this->Crud->getAllCrudsWithStatuses($conditions); // Get the SQL string

//     // Log the generated SQL for debugging
//     $this->log('Generated SQL for print: ' . $sql, 'debug');

//     // Execute the SQL query
//     $cruds = $this->Crud->query($sql); // Execute the query

//     // Log the number of cruds fetched
//     $this->log('Number of CRUDs fetched for print: ' . count($cruds), 'debug');

//     if (empty($cruds)) {
//         throw new NotFoundException(__('No CRUDs found'));
//     }

//     // Initialize FPDF
//     $pdf = new FPDF();
//     $pdf->AddPage();
//     $pdf->SetFont('Arial', 'B', 16);
//     $pdf->Cell(40, 10, 'CRUD Details');
//     $pdf->Ln(10); // Line break

//     // Output CRUD data for each crud
//     $pdf->SetFont('Arial', '', 12);
//     foreach ($cruds as $crud) {
//         $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : 'N/A'));
//         $pdf->Ln(20); // Add space between CRUD entries
//     }

//     // Output the PDF
//     $this->response->type('application/pdf');
//     $pdf->Output('D', 'CRUD_Details.pdf'); // Change 'D' to force download or 'I' for inline display
//     return $this->response;
// }
//WORKING PRINT FOR SEARCH
// public function printCrud() {
//     // Get the search term from the query if present
//     $search = isset($this->request->query['search']) ? $this->request->query['search'] : null;

//     // Prepare conditions for fetching the cruds
//     $conditions = [];
//     if (!empty($search)) {
//         $conditions['search'] = $search; // Set search condition
//     }

//     // Log the conditions to verify what's being applied
//     $this->log('Conditions for print: ' . print_r($conditions, true), 'debug');

//     // Fetch the SQL query string using the model method
//     $sql = $this->Crud->getAllCrudsWithStatuses($conditions); // Get the SQL string

//     // Log the generated SQL for debugging
//     $this->log('Generated SQL for print: ' . $sql, 'debug');

//     // Execute the SQL query
//     $cruds = $this->Crud->query($sql); // Execute the query

//     // Log the number of cruds fetched
//     $this->log('Number of CRUDs fetched for print: ' . count($cruds), 'debug');

//     if (empty($cruds)) {
//         throw new NotFoundException(__('No CRUDs found'));
//     }

//     // Initialize FPDF
//     $pdf = new FPDF();
//     $pdf->AddPage();
//     $pdf->SetFont('Arial', 'B', 16);
//     $pdf->Cell(40, 10, 'CRUD Details');
//     $pdf->Ln(10); // Line break

//     // Output CRUD data for each crud
//     $pdf->SetFont('Arial', '', 12);
//     foreach ($cruds as $crud) {
//         $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Role: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : 'N/A'));
//         $pdf->Ln(20); // Add space between CRUD entries
//     }

//     // Set response type and headers for inline display
//     $this->response->type('application/pdf');
//     $this->response->header('Content-Disposition', 'inline; filename="CRUD_Details.pdf"'); // Change to 'inline'

//     // Output the PDF
//     $pdf->Output('I', 'CRUD_Details.pdf'); // Use 'I' to send the file inline to the browser
//     return $this->response;
// }

//test1
// public function printCrud() {
//     // Ensure Cruds model is loaded
//     $this->loadModel('Crud');
    
//     // Get search and status filters from the request
//     $searchQuery = $this->request->query('search');
//     $statusQuery = $this->request->query('status');

//     // Prepare conditions for filtering cruds
//     $conditions = [];
    
//     // Add search condition if provided
//     if (!empty($searchQuery)) {
//         $conditions['Crud.name LIKE'] = '%' . $searchQuery . '%';
//     }

//     // Add approval status condition if provided
//     if (!empty($statusQuery)) {
//         if ($statusQuery === 'PENDING') {
//             $conditions['Crud.approve'] = null; // Handle pending approval (NULL)
//         } elseif ($statusQuery === 'APPROVED') {
//             $conditions['Crud.approve'] = 1; // Handle approved status
//         } elseif ($statusQuery === 'DISAPPROVED') {
//             $conditions['Crud.approve'] = 0; // Handle disapproved status
//         }
//     }

//     // Retrieve filtered CRUDs with statuses using the conditions
//     $cruds = $this->Crud->find('all', [
//         'conditions' => $conditions,
//         'contain' => ['CrudStatuses'],  // Ensure CrudStatuses is contained
//     ]);

//     // Check if any cruds were fetched
//     if (empty($cruds)) {
//         throw new NotFoundException(__('No CRUDs found'));
//     }

//     // Initialize FPDF for output
//     $pdf = new FPDF();
//     $pdf->AddPage();
//     $pdf->SetFont('Arial', 'B', 16);
//     $pdf->Cell(40, 10, 'CRUD Details');
//     $pdf->Ln(10); // Line break

//     // Set regular font for outputting CRUD data
//     $pdf->SetFont('Arial', '', 12);

//     // Output each CRUD's data
//     foreach ($cruds as $crud) {
//         $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Email: ' . $crud['Crud']['email']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
//         $pdf->Ln(10);
//         $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : 'N/A'));
//         $pdf->Ln(20); // Line break between CRUD entries
//     }

//     // Set response headers for inline display
//     $this->response->type('application/pdf');
//     $this->response->header('Content-Disposition', 'inline; filename="CRUD_Details.pdf"'); // Display PDF inline

//     // Output the PDF
//     $pdf->Output('I', 'CRUD_Details.pdf');
    
//     return $this->response;
// }
//test2
// public function printCrud($id = null) {
//     if (!$id) {
//         throw new NotFoundException(__('Invalid CRUD'));
//     }

//     $this->loadModel('Crud');
    
//     // Fetch CRUD data by ID along with its status
//     $crud = $this->Crud->find('first', [
//         'conditions' => ['Crud.id' => $id],
//         'contain' => ['CrudStatuses']
//     ]);

//     if (empty($crud)) {
//         throw new NotFoundException(__('CRUD not found'));
//     }

//     // Initialize FPDF
//     $pdf = new FPDF();
//     $pdf->AddPage();
//     $pdf->SetFont('Arial', 'B', 16);
//     $pdf->Cell(40, 10, 'CRUD Details');
//     $pdf->Ln(10); // Line break

//     // Output CRUD data
//     $pdf->SetFont('Arial', '', 12);
//     $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
//     $pdf->Ln(10);
//     $pdf->Cell(40, 10, 'Email: ' . $crud['Crud']['email']);
//     $pdf->Ln(10);
//     $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
//     $pdf->Ln(10);
//     $pdf->Cell(40, 10, 'Role: ' . (!empty($crud['CrudStatuses']['name']) ? $crud['CrudStatuses']['name'] : 'N/A'));
//     $pdf->Ln(10);
//     $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
//     $pdf->Ln(10);
//     $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
//     $pdf->Ln(20); // Add space between CRUD entries

//     // Output the PDF
//     $this->response->type('application/pdf');
//     $this->response->header('Content-Disposition', 'inline; filename="CRUD_Details.pdf"');
//     $pdf->Output('I', 'CRUD_Details.pdf');
//     return $this->response;
// }
//test combined test1 and test2
public function printCrud($id = null) {
    // Ensure Cruds model is loaded
    $this->loadModel('Crud');

    // Check if an ID is provided for individual CRUD
    if ($id) {
        // Fetch a single CRUD record by ID
        $cruds = $this->Crud->find('first', [
            'conditions' => ['Crud.id' => $id],
            'contain' => ['CrudStatuses']
        ]);

        if (empty($cruds)) {
            throw new NotFoundException(__('CRUD not found'));
        }
        // Convert to an array to maintain consistency when processing multiple records
        $cruds = [$cruds];
    } else {
        // If no ID, handle multiple CRUDs based on search and status filters
        $searchQuery = $this->request->query('search');
        $statusQuery = $this->request->query('status');

        // Prepare conditions for filtering cruds
        $conditions = [];
        
        // Add search condition if provided
        if (!empty($searchQuery)) {
            $conditions['Crud.name LIKE'] = '%' . $searchQuery . '%';
        }

        // Add approval status condition if provided
        if (!empty($statusQuery)) {
            if ($statusQuery === 'PENDING') {
                $conditions['Crud.approve'] = null; // Handle pending approval (NULL)
            } elseif ($statusQuery === 'APPROVED') {
                $conditions['Crud.approve'] = 1; // Handle approved status
            } elseif ($statusQuery === 'DISAPPROVED') {
                $conditions['Crud.approve'] = 0; // Handle disapproved status
            }
        }

        // Retrieve filtered CRUDs with statuses using the conditions
        $cruds = $this->Crud->find('all', [
            'conditions' => $conditions,
            'contain' => ['CrudStatuses'],  // Ensure CrudStatuses is contained
        ]);

        if (empty($cruds)) {
            throw new NotFoundException(__('No CRUDs found'));
        }
    }

    // Initialize FPDF for output
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'CRUD Details');
    $pdf->Ln(10); // Line break

    // Set regular font for outputting CRUD data
    $pdf->SetFont('Arial', '', 12);

    // Output each CRUD's data
    foreach ($cruds as $crud) {
        $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Email: ' . $crud['Crud']['email']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']['name']) ? $crud['CrudStatuses']['name'] : 'N/A'));
        $pdf->Ln(20); // Line break between CRUD entries
    }

    // Set response headers for inline display
    $this->response->type('application/pdf');
    $this->response->header('Content-Disposition', 'inline; filename="CRUD_Details.pdf"'); // Display PDF inline

    // Output the PDF
    $pdf->Output('I', 'CRUD_Details.pdf');
    
    return $this->response;
}





    
    
    
    


    
    // protected function generatePdf($cruds) {
    //     // Initialize FPDF
    //     $pdf = new FPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 16);
    
    //     // Output header
    //     $pdf->Cell(40, 10, 'CRUDs Report');
    //     $pdf->Ln(10); // Line break
    
    //     // Iterate over each CRUD and print its details
    //     foreach ($cruds as $crud) {
    //         $pdf->SetFont('Arial', '', 12);
    //         $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
    //         $pdf->Ln(10);
    //         $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
    //         $pdf->Ln(10);
    //         $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
    //         $pdf->Ln(10);
    //         $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
    //         $pdf->Ln(10);
    //         $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : 'N/A'));
    //         $pdf->Ln(20); // Space between records
    //     }
    
    //     // Output the PDF
    //     $this->response->type('application/pdf');
    //     $pdf->Output();
    //     return $this->response;
    // }
    


    //OGGGGGGGGGGGGGG before advance search
    // public function index(){



    //     // // without pagination
    //     // $datas = $this->Crud->find('all', array());

    //     // // transform data
    //     // $cruds = array();
    //     // foreach ($datas as $data){
    //     //     $cruds[] = array( //data[0].Crud.name
    //     //         'id'            =>   $data['Crud']['id'],
    //     //         'name'          =>   properCase($data['Crud']['name']),
    //     //         'age'           =>   $data['Crud']['age'],
    //     //         'character'     =>   $data['Crud']['character'],
    //     //         'visible'       =>   $data['Crud']['visible'],
    //     //         'date_created'  =>   date('m/d/Y', strtotime($data['Crud']['created'])),
    //     //     );
    //     // }

    //     //with pagination
    //     //default page 1
    //     $page = isset($this->request->query['page'])? $this->request->query['page'] : 1;


    //     $conditions = array();
    //     $conditions['Crud.visible'] = true;
    //     //paginate data
    //     $paginatorSettings = array(
    //         'conditions' => $conditions,
    //         'limit'      => 25,
    //         'page'       => $page,
    //         'order'      => array(
    //         'Crud.name'  => 'ASC'
    //         )
    //         );
    //         $modelName = 'Crud'; //cruds in table
    //         $this->Paginator->settings = $paginatorSettings;
    //         $tmpData = $this->Paginator->paginate($modelName);
    //         $paginator = $this->request->params['paging'][$modelName];

    //         //transform data
    //         $cruds_=array();
    //         foreach ($tmpData as $crud){
    //             $cruds_[] = array(
    //                 'id'            =>   $crud['Crud']['id'],
    //                 'name'          =>   properCase($crud['Crud']['name']),
    //                 'age'           =>   $crud['Crud']['age'],
    //                 'character'     =>   $crud['Crud']['character'],
    //                 'visible'       =>   $crud['Crud']['visible'],
    //                 'date_created'  =>   date('m/d/Y', strtotime($crud['Crud']['created'])),
    //             );
    //         }


    //     $response = array(
    //         'ok'=>true,
    //         'msg'=>'index',
    //         // 'untransformed' => $tmpData,
    //         'data' => $cruds_,
    //         'paginator' => $paginator,
    //     );

    //     $this->set(array(
    //         'response'=> $response,
    //         '_serialize'=>'response'
    //     ));
      
    // }

    //2ND OGGGGGGGGGG
    // public function index(){
    //     $cruds = $this->Crud->getAllCrudsWithStatuses();
    
    //     // default page 1
    //     $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
    
    //     $conditions = array();
    //     $conditions['Crud.visible'] = true;
        
    
    //     // paginate data
    //     $paginatorSettings = array(
    //         'conditions' => $conditions,
    //         'limit'      => 25,
    //         'extra' => array('conditions'=>$conditions),
    //         'page'       => $page,
    //         'order'      => array('Crud.name'  => 'ASC')
    //     );
    
    //     $this->Paginator->settings = $paginatorSettings;
    //     $tmpData = $this->Paginator->paginate('Crud');
    //     $paginator = $this->request->params['paging']['Crud'];
       
    //     // Transform data
    //     $cruds_ = array();
    //     foreach ($tmpData as $crud) {
    //         $cruds_[] = array(
    //             'id'            =>   $crud['Crud']['id'],
    //             'name'          =>   properCase($crud['Crud']['name']),
    //             'age'           =>   $crud['Crud']['age'],
    //             'character'     =>   $crud['Crud']['character'],
    //             'visible'       =>   $crud['Crud']['visible'],
    //             'date_created'  =>   date('m/d/Y', strtotime($crud['Crud']['created'])),
    //             'crudStatusId' =>    $crud['Crud']['crudStatusId'], 

    //         );

    //     }
    
    //     $response = array(
    //         'ok'        => true,
    //         'msg'       => 'index',
    //         'data'      => $cruds_,
    //         'paginator' => $paginator,
    //     );
    
    //     $this->set(array(
    //         'response'  => $response,
    //         '_serialize'=> 'response'
    //     ));
    // }

    //3RD WORKING WITH STATUSES DISPLAY
    // public function index() {
    //     // default page 1
    //     $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
    
    //     $conditions = array();
        
    //     // Optionally add other search conditions here
    
    //     $this->paginate = array(
    //         'Crud' => array(
    //             'limit' => 25,
    //             'page' => $page,
    //             'contain' => array('CrudStatuses'), // Include CrudStatus in the query
    //         )
    //     );
    
    //     $tmpData = $this->paginate('Crud');
       
    //     // transform data
    //     $cruds = array();
    //     if (!empty($tmpData)) {
    //         foreach ($tmpData as $crud) {
    //             $cruds[] = array(
    //                 'id' => $crud['Crud']['id'],
    //                 'name' => $crud['Crud']['name'],
    //                 'age' => $crud['Crud']['age'],
    //                 'character' => $crud['Crud']['character'],
    //                 'visible' => $crud['Crud']['visible'],
    //                 'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : null // Safely check for existence
    //             );
    //         }
    //     }
    
    //     $response = array(
    //         'ok' => true,
    //         'msg' => 'index',
    //         'data' => $cruds,
    //         'paginator' => $this->request->params['paging']['Crud']
    //     );
    
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    
    // }
    //TEST
    // public function index() {
    //     // default page 1
    //     $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
    
    //     // Prepare conditions for pagination
    //     $conditions = array('Crud.visible' => 1); // Assuming you want to fetch only visible cruds
    
    //     // Check for search input
    //     if (!empty($this->request->query['search'])) {
    //         $search = $this->request->query['search'];
    //         $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Search condition for name
    //     }
    
    //     // Pagination setup
    //     $this->paginate = array(
    //         'Crud' => array(
    //             'conditions' => $conditions,
    //             'limit' => 25,
    //             'page' => $page,
    //             'contain' => array('CrudStatuses'), // Include CrudStatus in the query
    //         )
    //     );
    
    //     $tmpData = $this->paginate('Crud');
    
    //     // Transform data
    //     $cruds = array();
    //     if (!empty($tmpData)) {
    //         foreach ($tmpData as $crud) {
    //             $cruds[] = array(
    //                 'id' => $crud['Crud']['id'],
    //                 'name' => $crud['Crud']['name'],
    //                 'age' => $crud['Crud']['age'],
    //                 'character' => $crud['Crud']['character'],
    //                 'visible' => $crud['Crud']['visible'],
    //                 'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : null // Safely check for existence
    //             );
    //         }
    //     }
    
    //     $response = array(
    //         'ok' => true,
    //         'msg' => 'index',
    //         'data' => $cruds,
    //         'paginator' => $this->request->params['paging']['Crud']
    //     );
    
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    // public function index() {
    //     // Default page 1
    //     $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
    
    //     // Prepare conditions for pagination
    //     $conditions = array('Crud.visible' => 1); // Fetch only visible cruds
    
    //     // Check for search input
    //     if (!empty($this->request->query['search'])) {
    //         $search = $this->request->query['search'];
    //         $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Search condition for name
    //     }
    
    //     // Pagination setup
    //     $this->paginate = array(
    //         'Crud' => array(
    //             'conditions' => $conditions,
    //             'limit' => 25,
    //             'page' => $page,
    //             'contain' => array('CrudStatuses'), // Include CrudStatus in the query
    //         )
    //     );
    
    //     $tmpData = $this->paginate('Crud');
    
    //     // Transform data
    //     $cruds = array();
    //     if (!empty($tmpData)) {
    //         foreach ($tmpData as $crud) {
    //             $cruds[] = array(
    //                 'id' => $crud['Crud']['id'],
    //                 'name' => $crud['Crud']['name'],
    //                 'age' => $crud['Crud']['age'],
    //                 'character' => $crud['Crud']['character'],
    //                 'visible' => $crud['Crud']['visible'],
    //                 'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : null // Safely check for existence
    //             );
    //         }
    //     }
    
    //     $response = array(
    //         'ok' => true,
    //         'msg' => 'index',
    //         'data' => $cruds,
    //         'paginator' => $this->request->params['paging']['Crud']
    //     );
    
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    // WORKING LATEST
    // public function index() {
    //     $page = isset($this->request->query['page']) ? (int)$this->request->query['page'] : 1;
    
    //     // Base conditions to fetch only visible cruds
    //     $conditions = ['Crud.visible' => 1];
    
    //     // Check if there is a search term
    //     if (!empty($this->request->query['search'])) {
    //         $search = $this->request->query['search'];
    //         $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Add the search condition
    //     }
    
    //     // Log the final conditions before pagination
    //     $this->log('Final Search Conditions: ' . print_r($conditions, true), 'debug');
    
    //     // Configure pagination
    //     $this->paginate = [
    //         'conditions' => $conditions,
    //         'limit' => 25,
    //         'page' => $page,
    //         'contain' => ['CrudStatuses'], // Ensure correct model for contain
    //     ];
    
    //     // Log the pagination settings for debugging
    //     $this->log('Pagination Settings: ' . print_r($this->paginate, true), 'debug');
    
    //     // Perform the pagination
    //     $cruds = $this->paginate('Crud');
    
    //     // Log the constructed SQL query after pagination
    //     $this->log('Executed SQL Query: ' . print_r($this->Crud->getDataSource()->getLog(), true), 'debug');
    
    //     // Prepare response data
    //     $responseCruds = [];
    //     foreach ($cruds as $crud) {
    //         $responseCruds[] = [
    //             'id' => $crud['Crud']['id'],
    //             'name' => $crud['Crud']['name'],
    //             'age' => $crud['Crud']['age'],
    //             'character' => $crud['Crud']['character'],
    //             'visible' => $crud['Crud']['visible'],
    //             'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['status_name'] : null,
    //         ];
    //     }
    
    //     // Prepare the response
    //     $response = [
    //         'ok' => true,
    //         'msg' => 'index',
    //         'data' => $responseCruds,
    //         'paginator' => $this->request->params['paging']['Crud'],
    //     ];
    
    //     $this->set([
    //         'response' => $response,
    //         '_serialize' => 'response',
    //     ]);
    // }

    public function initialize() {
        parent::initialize();
        $this->loadModel('Crud'); // Load the Cruds model explicitly
    }



    //WORKING LATEST
    // public function index() {
    //     $page = isset($this->request->query['page']) ? (int)$this->request->query['page'] : 1;
        
    //     // Base conditions to fetch only visible cruds
    //     $conditions = ['Crud.visible' => 1];
    
    //     // Check if there is a search term
    //     if (!empty($this->request->query['search'])) {
    //         $search = $this->request->query['search'];
    //         $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Add the search condition
    //     }
    
    //     // Log the final conditions before pagination
    //     $this->log('Final Search Conditions: ' . print_r($conditions, true), 'debug');
    
    //     // Fetch cruds with the conditions
    //     $cruds = $this->Crud->find('all', [
    //         'conditions' => $conditions,
    //         'limit' => 25,
    //         'page' => $page,
    //         'contain' => ['CrudStatuses'], // Ensure this relationship is defined correctly
    //         'order' => ['Crud.id' => 'ASC']
    //     ]);
    
    //     // Prepare response data
    //     $responseCruds = [];
    //     foreach ($cruds as $crud) {
    //         $responseCruds[] = [
    //             'id' => $crud['Crud']['id'],
    //             'name' => $crud['Crud']['name'],
    //             'age' => $crud['Crud']['age'],
    //             'character' => $crud['Crud']['character'],
    //             'birthdate' => $crud['Crud']['birthdate'],
    //             'visible' => $crud['Crud']['visible'],
    //             'approve' => $crud['Crud']['approve'],
    //             'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : null,//status_name
    //         ];
    //     }
    
    //     // Prepare the response with pagination information
    //     $response = [
    //         'ok' => true,
    //         'msg' => 'index',
    //         'data' => $responseCruds,
    //         'paginator' => [
    //             'page' => $page,
    //             'limit' => 25,
    //             'total' => $this->Crud->find('count', ['conditions' => $conditions]),
    //         ],
    //     ];
    
    //     $this->set([
    //         'response' => $response,
    //         '_serialize' => 'response',
    //     ]);
    // }

    //TEST
    public function index() {
        $page = isset($this->request->query['page']) ? (int)$this->request->query['page'] : 1;
        
        // Base conditions to fetch only visible cruds
        $conditions = ['Crud.visible' => 1];
    
        // Check if there is a search term
        if (!empty($this->request->query['search'])) {
            $search = $this->request->query['search'];
            $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Add the search condition
        }
    
        // Check for approval status filtering
        // if (!empty($this->request->query['status'])) {
        //     $conditions['approve'] = $this->request->query['status'];
        // }
        if (!empty($this->request->query['status'])) {
            if ($this->request->query['status'] === 'PENDING') {
                $conditions['Crud.approve'] = null; // Handle NULL for pending
            } elseif ($this->request->query['status'] === 'APPROVED') {
                $conditions['Crud.approve'] = 1; // Handle approved
            } elseif ($this->request->query['status'] === 'DISAPPROVED') {
                $conditions['Crud.approve'] = 0; // Handle disapproved
            }
        }
        
    
        // Log the final conditions before pagination
        $this->log('Final Search Conditions: ' . print_r($conditions, true), 'debug');
    
        // Fetch cruds with the conditions
        $cruds = $this->Crud->find('all', [
            'conditions' => $conditions,
            'limit' => 25,
            'page' => $page,
            'contain' => ['CrudStatuses'], // Ensure this relationship is defined correctly
            'order' => ['Crud.id' => 'ASC']
        ]);
    
        // Prepare response data
        $responseCruds = [];
        foreach ($cruds as $crud) {
            $responseCruds[] = [
                'id' => $crud['Crud']['id'],
                'name' => $crud['Crud']['name'],
                'age' => $crud['Crud']['age'],
                'character' => $crud['Crud']['character'],
                'birthdate' => $crud['Crud']['birthdate'],
                'visible' => $crud['Crud']['visible'],
                'approve' => $crud['Crud']['approve'],
                'crudStatus' => !empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : null,//status_name
            ];
        }
    
        // Prepare the response with pagination information
        $response = [
            'ok' => true,
            'msg' => 'index',
            'data' => $responseCruds,
            'paginator' => [
                'page' => $page,
                'limit' => 25,
                'total' => $this->Crud->find('count', ['conditions' => $conditions]),
            ],
        ];
    
        $this->set([
            'response' => $response,
            '_serialize' => 'response',
        ]);
    }
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    

    // public function add(){

    //     if($this->Crud->save($this->request->data['Crud'])){
    //         $response = array(
    //             'ok'    =>  true,
    //             'msg'   =>  'Saved',
    //             'data'  =>  $this->request->data['Crud'],
    //         );
    //     }else{
    //         $response = array(
    //             'ok'    =>  false,
    //             'msg'   =>  'Not saved',
    //             'data'  =>  $this->request->data['Crud'],
    //         );
    //     }
    // $this->set(array(
    //     'response'=> $response,
    //     '_serialize'=>'response'
    // ));
    // }

    // public function add() {
    //     if (!empty($this->request->data['Crud']['birthdate'])) {
    //         $birthdate = $this->request->data['Crud']['birthdate'];
    
    //         // Convert birthdate to a DateTime object
    //         $bdayDate = new DateTime($birthdate);
    //         $today = new DateTime();
    
    //         // Calculate the age
    //         $age = $today->diff($bdayDate)->y;
    
    //         // Add the computed age to the request data before saving
    //         $this->request->data['Crud']['age'] = $age;
    
    //         // Save the data
    //         if ($this->Crud->save($this->request->data['Crud'])) {
    //             $response = array(
    //                 'ok'    =>  true,
    //                 'msg'   =>  'Saved',
    //                 'data'  =>  $this->request->data['Crud'],
    //             );
    //         } else {
    //             $response = array(
    //                 'ok'    =>  false,
    //                 'msg'   =>  'Not saved',
    //                 'data'  =>  $this->request->data['Crud'],
    //             );
    //         }
    
    //         // Send the response
    //         $this->set(array(
    //             'response'=> $response,
    //             '_serialize'=>'response'
    //         ));
    //     } else {
    //         $response = array(
    //             'ok'    =>  false,
    //             'msg'   =>  'Birthdate is missing',
    //         );
    
    //         $this->set(array(
    //             'response'=> $response,
    //             '_serialize'=>'response'
    //         ));
    //     }
    // }
    


    // public function add() {
    //     // Begin transaction
    //     $this->Crud->getDataSource()->begin();
    //     CakeLog::write('debug', 'Transaction started.');
    
    //     $crud = $this->request->data['Crud'];
    //     $beneficiary = $this->request->data['Beneficiary'];
    
    //     // Check if birthdate is present
    //     if (!empty($crud['birthdate'])) {
    //         $birthdate = $crud['birthdate'];
            
    //         // Calculate age
    //         $bdayDate = new DateTime($birthdate);
    //         $today = new DateTime();
    //         $age = $today->diff($bdayDate)->y;
    
    //         // Add age to request data
    //         $crud['age'] = $age;
    
    //         // Log the request data before saving
    //         CakeLog::write('debug', 'Request data: ' . print_r($this->request->data, true));
    
    //         // Validate the Crud data
    //         $response = $this->Crud->validSave($crud);
    
    //         if ($response['ok']) {
    //             // Save the Crud data
    //             if ($this->Crud->save($crud)) {
    //                 $crudId = $this->Crud->id; // Get the last inserted Crud ID
    //                 CakeLog::write('debug', 'Crud saved successfully with ID: ' . $crudId);
    
    //                 // Prepare beneficiaries data if available
    //                 if (!empty($beneficiary)) {
    //                     foreach ($beneficiary as $key => $value) {
    //                         $beneficiary[$key]['cruds_id'] = $crudId; // Set the foreign key
                        
    //                     }
    //                     // Save beneficiaries data
    //                     if ($this->Beneficiary->saveMany($beneficiary)) {
    //                         // Commit transaction on success
    //                         $this->Crud->getDataSource()->commit();
    //                         CakeLog::write('debug', 'Beneficiaries saved successfully.');
    //                         $response['msg'] = 'Crud and Beneficiaries saved successfully';
    //                     } else {
    //                         // Rollback transaction on failure
    //                         $this->Crud->getDataSource()->rollback();
    //                         debug($this->Beneficiary->validationErrors);
    //                         $response = array(
    //                             'ok' => false,
    //                             'msg' => 'Could not save Beneficiaries',
    //                         );
    //                     }
    //                 } else {
    //                     // Commit transaction for Crud only if no beneficiaries
    //                     $this->Crud->getDataSource()->commit();
    //                     $response['msg'] = 'Crud saved successfully, no beneficiaries to save.';
    //                 }
    //             } else {
    //                 // Rollback transaction on failure
    //                 $this->Crud->getDataSource()->rollback();
    //                 debug($this->Crud->validationErrors);
    //                 $response = array(
    //                     'ok' => false,
    //                     'msg' => 'Could not save Crud',
    //                 );
    //             }
    //         }
    //     } else {
    //         $response = array(
    //             'ok' => false,
    //             'msg' => 'Birthdate is missing',
    //         );
    
    //         $this->set(array(
    //             'response' => $response,
    //             '_serialize' => 'response'
    //         ));
    //         debug($response);
    //         return; // Early return if birthdate is missing
    //     }
    
    //     // Send the response
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    
    
    
    
    
    
    //WORKS BENEFCIARIES
    // public function add() {
    //     // Begin transaction
    //     $this->Crud->getDataSource()->begin();
    
    //     // Save the Crud data first
    //     if ($this->Crud->save($this->request->data['Crud'])) {
    //         $crudId = $this->Crud->id; // Get the last inserted Crud ID

    //         if (!empty($crud['birthdate'])) {
    //                     $birthdate = $crud['birthdate'];
                        
    //                     // Calculate age
    //                     $bdayDate = new DateTime($birthdate);
    //                     $today = new DateTime();
    //                     $age = $today->diff($bdayDate)->y;
                
    //                     // Add age to request data
    //                     $crud['age'] = $age;
    //         }
    //         // Prepare beneficiaries data
    //         if (!empty($this->request->data['beneficiaries'])) {
    //             foreach ($this->request->data['beneficiaries'] as &$beneficiary) {
    //                 $beneficiary['cruds_id'] = $crudId; // Set the foreign key
    //             }
    
    //             // Save beneficiaries
    //             if ($this->Beneficiary->saveMany($this->request->data['beneficiaries'])) {
    //                 // Commit transaction on success
    //                 $this->Crud->getDataSource()->commit();
    //                 $response = array(
    //                     'ok' => true,
    //                     'msg' => 'Crud and Beneficiaries saved successfully',
    //                     'data' => $this->request->data['Crud'],
    //                 );
    //             } else {
    //                 // Rollback transaction on failure
    //                 $this->Crud->getDataSource()->rollback();
    //                 $response = array(
    //                     'ok' => false,
    //                     'msg' => 'Could not save Beneficiaries',
    //                 );
    //             }
    //         } else {
    //             // No beneficiaries to save, just commit Crud
    //             $this->Crud->getDataSource()->commit();
    //             $response = array(
    //                 'ok' => true,
    //                 'msg' => 'Crud saved successfully, no beneficiaries to save.',
    //                 'data' => $this->request->data['Crud'],
    //             );
    //         }
    //     } else {
    //         // Rollback if Crud saving fails
    //         $this->Crud->getDataSource()->rollback();
    //         $response = array(
    //             'ok' => false,
    //             'msg' => 'Could not save Crud',
    //         );
    //     }
    
    //     // Send the response
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    
    //WORKS WITH BIRTHDATE
    // public function add() {
    //     // Begin transaction
    //     $this->Crud->getDataSource()->begin();
        
    //     // Retrieve CRUD data from the request
    //     $crud = $this->request->data['Crud'];
        
    //     // Save the Crud data first
    //     if ($this->Crud->save($crud)) {
    //         $crudId = $this->Crud->id; // Get the last inserted Crud ID
            
    //         // Calculate age based on birthdate if present
    //         if (!empty($crud['birthdate'])) {
    //             $birthdate = $crud['birthdate'];
    //             // Calculate age
    //             $bdayDate = new DateTime($birthdate);
    //             $today = new DateTime();
    //             $age = $today->diff($bdayDate)->y;
    
    //             // Add age to request data
    //             $crud['age'] = $age;
    //             // Optionally, save the age back to the Crud if needed
    //             $this->Crud->id = $crudId; // Set the ID to update the existing record
    //             $this->Crud->saveField('age', $age); // Save the age back to the database
    //         }
    
    //         // Prepare beneficiaries data
    //         if (!empty($this->request->data['beneficiaries'])) {
    //             foreach ($this->request->data['beneficiaries'] as &$beneficiary) {
    //                 $beneficiary['cruds_id'] = $crudId; // Set the foreign key
    //             }
    
    //             // Save beneficiaries
    //             if ($this->Beneficiary->saveMany($this->request->data['beneficiaries'])) {
    //                 // Commit transaction on success
    //                 $this->Crud->getDataSource()->commit();
    //                 $response = array(
    //                     'ok' => true,
    //                     'msg' => 'Crud and Beneficiaries saved successfully',
    //                     'data' => $crud,
    //                 );
    //             } else {
    //                 // Rollback transaction on failure
    //                 $this->Crud->getDataSource()->rollback();
    //                 $response = array(
    //                     'ok' => false,
    //                     'msg' => 'Could not save Beneficiaries',
    //                 );
    //             }
    //         } else {
    //             // No beneficiaries to save, just commit Crud
    //             $this->Crud->getDataSource()->commit();
    //             $response = array(
    //                 'ok' => true,
    //                 'msg' => 'Crud saved successfully, no beneficiaries to save.',
    //                 'data' => $crud,
    //             );
    //         }
    //     } else {
    //         // Rollback if Crud saving fails
    //         $this->Crud->getDataSource()->rollback();
    //         $response = array(
    //             'ok' => false,
    //             'msg' => 'Could not save Crud',
    //         );
    //     }
    
    //     // Send the response
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    
 

public function add() {
    // Begin transaction
    $this->Crud->getDataSource()->begin();

    // Retrieve CRUD data from the request
    $crud = $this->request->data['Crud'];

    // Save the Crud data first
    if ($this->Crud->save($crud)) {
        $crudId = $this->Crud->id; // Get the last inserted Crud ID

        // Calculate age based on birthdate if present
        if (!empty($crud['birthdate'])) {
            $birthdate = $crud['birthdate'];
            $bdayDate = new DateTime($birthdate);
            $today = new DateTime();
            $age = $today->diff($bdayDate)->y;

            // Save the age back to the Crud if needed
            $this->Crud->id = $crudId; 
            $this->Crud->saveField('age', $age);
        }

        // Save beneficiaries if present
        if (!empty($this->request->data['beneficiaries'])) {
            foreach ($this->request->data['beneficiaries'] as &$beneficiary) {
                $beneficiary['cruds_id'] = $crudId;
            }

            if (!$this->Beneficiary->saveMany($this->request->data['beneficiaries'])) {
                $this->Crud->getDataSource()->rollback();
                $this->set(array(
                    'response' => array(
                        'ok' => false,
                        'msg' => 'Could not save Beneficiaries'
                    ),
                    '_serialize' => 'response'
                ));
                return;
            }
        }

        // Commit the transaction
        $this->Crud->getDataSource()->commit();

        // Send Email Notification to the User
        try {
            if (!empty($crud['email'])) {
                $email = new CakeEmail('default'); 
                $email->to($crud['email'])
                    ->subject('Notification: Your CRUD Record was Added')
                    ->emailFormat('html')
                    ->template('crud_notification', 'default') 
                    ->viewVars(array('crud' => $crud))
                    ->send();
            }
        } catch (Exception $e) {
            // Log error and notify the front-end if needed
            $this->log('Error sending email: ' . $e->getMessage(), 'error');
        }
        // Return success response
        $this->set(array(
            'response' => array(
                'ok' => true,
                'msg' => 'Crud and Beneficiaries saved successfully',
                'data' => $crud,
            ),
            '_serialize' => 'response'
        ));
    } else {
        // Rollback if Crud saving fails
        $this->Crud->getDataSource()->rollback();
        $this->set(array(
            'response' => array(
                'ok' => false,
                'msg' => 'Could not save Crud',
            ),
            '_serialize' => 'response'
        ));
    }
}

    
    
    
    


    // public function view($id = null){

    //     $data = $this->Crud->find('first', array(
    //         'contain'       =>  array(
    //             'CrudStatus' => array('name')

    //         ),
    //         'conditions'    =>  array(
    //         'Crud.id'       =>  $id,
    //         'Crud.visible'  =>  true
    //         )
    //     ));

    //     //OR (findById is a cakephp syntax)

    //     $data_ = $this->Crud->findById($id);   

    //     $response = array(
    //         'ok'    => true,
    //         'msg'   => 'view',
    //         'data'  => $data,
    //     );


    //     $this->set(array(
    //         'response'=>$response,
    //         '_serialize'=>'response'
    //     ));

    // }
    //WORKING VISIBLEEEEEEEEEEEEEEE
    // public function view($id = null) {
    //     // Fetch the Crud along with its CrudStatus and Beneficiaries
    //     $data = $this->Crud->find('first', array(
    //         'contain' => array(
    //             'CrudStatus' => array('name'), // Include CrudStatus name
    //             'Beneficiary' => array( // Include Beneficiary fields and ensure 'id' is present
    //                 'id', 'name', 'birthdate', 'age', 'visible'
    //             )
    //         ),
    //         'conditions' => array(
    //             'Crud.id' => $id, // Find by Crud id
    //             'Crud.visible' => true // Ensure Crud is visible
    //         )
    //     ));
    
    //     if (!$data) {
    //         // Return response if no data is found
    //         $response = array(
    //             'ok' => false,
    //             'msg' => 'No data found for this Crud.'
    //         );
    //     } else {
    //         // Filter out hidden beneficiaries (visible = 0)
    //         $data['Beneficiary'] = array_filter($data['Beneficiary'], function($beneficiary) {
    //             return $beneficiary['visible'] == 1; // Only include visible beneficiaries
    //         });
    
    //         // Return the found data
    //         $response = array(
    //             'ok' => true,
    //             'msg' => 'view',
    //             'data' => $data
    //         );
    //     }
    
    //     // Set response and serialize it
    //     $this->set(array(
    //         'response' => $response,
    //         '_serialize' => 'response'
    //     ));
    // }
    //LATESTTTTTTTTTTTTTTTTTTTTTTTTTTT WORKINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
    public function view($id = null) {
        $data = $this->Crud->find('first', array(
            'contain' => array(
                'CrudStatuses' => array('name'),
                'Beneficiary' => array(
                    'conditions' => array('Beneficiary.visible' => 1), // Only fetch visible beneficiaries
                    'fields' => array('id','name', 'birthdate', 'age','visible') // Include required fields
                )
            ),
            'conditions' => array(
                'Crud.id' => $id,
                'Crud.visible' => true
            )
        ));
    
        if (!$data) {
            $response = array(
                'ok' => false,
                'msg' => 'No data found for this Crud.'
            );
        } else {
            $response = array(
                'ok' => true,
                'msg' => 'view',
                'data' => $data
            );
        }
    
        $this->set(array(
            'response' => $response,
            '_serialize' => 'response'
        ));
    }
    
    
    // public function view($id = null) {
    //     // Fetch the data for the view
    //     $data = $this->Crud->find('first', [
    //         'contain' => [
    //             'CrudStatuses' => ['name'],
    //             'Beneficiary' => [
    //                 'conditions' => ['Beneficiary.visible' => 1],
    //                 'fields' => ['id', 'name', 'birthdate', 'age', 'visible']
    //             ]
    //         ],
    //         'conditions' => [
    //             'Crud.id' => $id,
    //             'Crud.visible' => true
    //         ]
    //     ]);
    
    //     if (!$data) {
    //         return $this->setResponse(['ok' => false, 'msg' => 'No data found for this Crud.']);
    //     }
    
    //     return $this->setResponse(['ok' => true, 'msg' => 'view', 'data' => $data]);
    // }
    // public function approve($id = null) {
    //     $this->request->allowMethod(['put']);
        
    //     // Fetch the CRUD entry by ID
    //     $crud = $this->Crud->get($id);
        
    //     if (!$crud) {
    //         return $this->response->withStatus(404)->withStringBody(json_encode([
    //             'status' => 'error',
    //             'message' => 'CRUD not found'
    //         ]));
    //     }
    
    //     // Get the approval status from the request
    //     $approvalStatus = $this->request->getData('approve'); // Expecting true or false
        
    //     // Validate the approvalStatus is a boolean
    //     if (!is_bool($approvalStatus)) {
    //         return $this->response->withStatus(400)->withStringBody(json_encode([
    //             'status' => 'error',
    //             'message' => 'Invalid approval status'
    //         ]));
    //     }
    
    //     // Convert boolean to 1/0 for the database
    //     $crud->approve = $approvalStatus ? 1 : 0; 
    //     $this->log('Approval Status: ' . $crud->approve, 'debug');
    //     if ($this->Crud->save($crud)) {
    //         return $this->response->withStringBody(json_encode([
    //             'ok' => true,
    //             'msg' => 'Crud approval status updated successfully',
    //             'data' => [
    //                 'approve' => $crud->approve // This will now return 1 or 0
    //             ]
    //         ]));
    //     } else {
    //         return $this->response->withStatus(500)->withStringBody(json_encode([
    //             'status' => 'error',
    //             'message' => 'Failed to update Crud approval status'
    //         ]));
    //     }
    // }
    //GOOD
    // public function approve($id = null) {
    //     // Allow PUT requests only
    //     $this->request->allowMethod(['put']);
        
    //     // Retrieve the data sent in the request
    //     $data = $this->request->data;  // Use request->data to access the request data in CakePHP 2.x
    
    //     // Check if the approve field is present
    //     $approveStatus = isset($data['approve']) ? $data['approve'] : null;
    
    //     // Find the CRUD entry by ID
    //     $crud = $this->Crud->findById($id);
    //     if (!$crud) {
    //         // Return a JSON response with error message if the CRUD entry is not found
    //         $this->autoRender = false;
    //         return json_encode(['ok' => false, 'msg' => 'Invalid CRUD ID.']);
    //     }
    
    //     // Update the approve status
    //     $this->Crud->id = $id;
    //     if ($this->Crud->saveField('approve', $approveStatus)) {
    //         // Return a success response
    //         $this->autoRender = false;
    //         return json_encode(['ok' => true, 'msg' => 'Approval status updated successfully.', 'approve' => $approveStatus]);
    //     } else {
    //         // Return an error response if the save operation fails
    //         $this->autoRender = false;
    //         return json_encode(['ok' => false, 'msg' => 'Failed to update approval status.']);
    //     }
    // }
    
    public function approve($id = null) {
        // Allow PUT requests only
        $this->request->allowMethod(['put']);
        
        // Retrieve the data sent in the request
        $data = $this->request->data;
        
        // Check if the approve field is present
        if (!isset($data['approve'])) {
            $this->autoRender = false;
            return json_encode(['ok' => false, 'msg' => 'Missing approval status.']);
        }
    
        $approveStatus = $data['approve'];
    
        // Validate the CRUD entry ID
        if (!$id || !$this->Crud->exists($id)) {
            $this->autoRender = false;
            return json_encode(['ok' => false, 'msg' => 'Invalid CRUD ID.']);
        }
    
        // Find the CRUD entry by ID
        $crud = $this->Crud->findById($id);
        if (!$crud) {
            $this->autoRender = false;
            return json_encode(['ok' => false, 'msg' => 'CRUD entry not found.']);
        }
    
        // Update the approve status
        $this->Crud->id = $id;
        if ($this->Crud->saveField('approve', $approveStatus)) {
            // Log the approval change
            $this->log('Approval status for CRUD ID ' . $id . ' updated to ' . $approveStatus, 'info');
            
            // Send email notification if an email is present
            if (!empty($crud['Crud']['email'])) {
                $this->log('Sending approval email to ' . $crud['Crud']['email'], 'debug');
                if (!$this->sendApprovalEmail($crud, $approveStatus)) {
                    $this->log('Failed to send approval email to ' . $crud['Crud']['email'], 'error');
                }
            } else {
                $this->log('No email found for CRUD ID ' . $id, 'warning');
            }
    
            // Return success response
            $this->autoRender = false;
            return json_encode(['ok' => true, 'msg' => 'Approval status updated successfully.', 'approve' => $approveStatus]);
        } else {
            // Log failure and return error response
            $this->log('Failed to update approval status for CRUD ID ' . $id, 'error');
            $this->autoRender = false;
            return json_encode(['ok' => false, 'msg' => 'Failed to update approval status.']);
        }
    }
    
    

    public function sendApprovalEmail($crud, $approveStatus) {
        // Create an email object
        $email = new CakeEmail('default');  // Assuming you have a default email config
    
        // Set the recipient email address
        if (empty($crud['Crud']['email'])) {
            $this->log('Email address is missing for CRUD ID ' . $crud['Crud']['id'], 'error');
            return false;
        }
    
        try {
            $email->to($crud['Crud']['email']);
            $email->subject('Approval Status Updated');
            $email->from(['christianjoygaray123@gmail.com' => 'CRUD WEBSITE']);
            
            // Use the 'approval_notification' template for the email
            $email->template('approval_notification');  // Template name without .ctp
            $email->emailFormat('html');
            
            // Pass data to the email template
            $email->viewVars([
                'crud' => $crud,
                'approveStatus' => $approveStatus
            ]);
            
            // Send the email
            if ($email->send()) {
                $this->log('Approval email sent to ' . $crud['Crud']['email'], 'info');
                return true;
            }
        } catch (Exception $e) {
            $this->log('Error sending approval email: ' . $e->getMessage(), 'error');
        }
    
        return false;
    }
    
    
    
    
    
 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // public function disapprove($id = null) {
    //     $this->request->allowMethod(['put']);
    //     $this->Crud->id = $id;
    
    //     if (!$this->Crud->exists()) {
    //         $this->set([
    //             'status' => 'error',
    //             'message' => 'Invalid CRUD ID',
    //             '_serialize' => ['status', 'message'] // Serialize the response to JSON
    //         ]);
    //         return $this->response->withStatus(404); // Set HTTP status code
    //     }
    
    //     if ($this->Crud->saveField('approve', 'DISAPPROVED')) {
    //         $this->set([
    //             'status' => 'success',
    //             'message' => 'Crud disapproved successfully',
    //             '_serialize' => ['status', 'message'] // Serialize the response to JSON
    //         ]);
    //         return $this->response; // Send the response
    //     }
    
    //     $this->set([
    //         'status' => 'error',
    //         'message' => 'Failed to disapprove Crud',
    //         '_serialize' => ['status', 'message'] // Serialize the response to JSON
    //     ]);
    //     return $this->response->withStatus(500); // Set HTTP status code
    // }
    
    
    
    // private function setResponse($response) {
    //     $this->set(compact('response'));
    //     $this->set('_serialize', 'response');
    // }
    
    
    
    



    // public function  eApproval($id = null) {
    //     // Get approval data from request
    //     $approveData = $this->request->data['approve'];
    
    //     // Log the received data for debugging
    //     $this->log('Approval Data: ' . json_encode($approveData), 'debug');
    
    //     // Check if the Crud ID is valid
    //     if ($this->Crud->exists($id)) {
    //         // Set the Crud ID
    //         $this->Crud->id = $id;
    
    //         // Attempt to save the approval status
    //         if ($this->Crud->saveField('approve', $approveData)) {
    //             $response = ['ok' => true, 'msg' => 'Approval status updated successfully.'];
    //         } else {
    //             $response = ['ok' => false, 'msg' => 'Failed to update approval status.'];
    //         }
    //     } else {
    //         $response = ['ok' => false, 'msg' => 'Invalid CRUD ID.'];
    //     }
    
    //     $this->set(compact('response'));
    //     $this->set('_serialize', 'response');
    // }
    


    // public function edit($id = null){

        

    //     if($this->Crud->save($this->request->data['Crud'])){
    //         $response = array(
    //             'ok'    =>  true,
    //             'msg'   =>  'Updated',
    //             'data'  =>  $this->request->data,
    //         );
    //     }else{
    //         $response = array(
    //             'ok'    =>  false,
    //             'msg'   =>  'Not updated',
    //             'data'  =>  $this->request->data,
    //         );
    //     }

    //         $this->set(array(
    //             'response'     =>  $response,
    //             '_serialize'   =>  'response'
    //         ));
    // }


    // public function edit($id = null) {
    //     // Check if the record exists
    //     $crud = $this->Crud->findById($id);
    //     if (!$crud) {
    //         throw new NotFoundException(__('Invalid record'));
    //     }
    
    //     if ($this->request->is(['post', 'put'])) {
    //         // Get the birthdate from the form data
    //         if (!empty($this->request->data['Crud']['birthdate'])) {
    //             $birthdate = $this->request->data['Crud']['birthdate'];
    
    //             // Convert the birthdate to a DateTime object
    //             $bdayDate = new DateTime($birthdate);
    //             $today = new DateTime();
    
    //             // Calculate the age
    //             $age = $today->diff($bdayDate)->y;
    
    //             // Add the computed age to the request data before saving
    //             $this->request->data['Crud']['age'] = $age;
    //         }
    
    //         // Save the data
    //         if ($this->Crud->save($this->request->data['Crud'])) {
    //             $response = array(
    //                 'ok'    =>  true,
    //                 'msg'   =>  'Updated',
    //                 'data'  =>  $this->request->data,
    //             );
    //         } else {
    //             $response = array(
    //                 'ok'    =>  false,
    //                 'msg'   =>  'Not updated',
    //                 'data'  =>  $this->request->data,
    //             );
    //         }
    
    //         // Set the response
    //         $this->set(array(
    //             'response'     =>  $response,
    //             '_serialize'   =>  'response'
    //         ));
    //     } else {
    //         // If the request is not post or put, load the current data
    //         $this->request->data = $crud;
    //     }
    // }
    




    
// public function edit($id = null){
//     // Retrieve the Crud record by ID, along with its associated beneficiaries
//     $crud = $this->Cruds->get($id, [
//         'contain' => ['Beneficiaries']
//     ]);

//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $crud = $this->Cruds->patchEntity($crud, $this->request->getData());
        
//         // Save the Crud and its associated beneficiaries
//         if ($this->Cruds->save($crud)) {
//             $this->Flash->success(__('The crud has been updated successfully.'));

//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('The crud could not be updated. Please, try again.'));
//     }

//     // Fetch available statuses for the dropdown (or other use)
//     $statuses = $this->Cruds->Statuses->find('list');

//     // Set variables to the view
//     $this->set(compact('crud', 'statuses'));
// }



// public function edit($id = null) {
//     // Retrieve the Crud record by ID, along with its associated beneficiaries
//     $crud = $this->Cruds->get($id, [
//         'contain' => ['Beneficiaries']
//     ]);

//     if ($this->request->is(['patch', 'post', 'put'])) {
//         // Patch the Crud entity
//         $crud = $this->Cruds->patchEntity($crud, $this->request->getData(), [
//             'associated' => ['Beneficiaries']
//         ]);

//         // Create a mapping of existing beneficiary IDs
//         $existingBeneficiaryIds = Hash::extract($crud->beneficiaries, '{n}.id');

//         // Process beneficiaries: only keep the existing ones or new ones
//         foreach ($crud->beneficiaries as $key => $beneficiary) {
//             if (!isset($beneficiary->id) || !in_array($beneficiary->id, $existingBeneficiaryIds)) {
//                 // Treat as new beneficiary
//                 $crud->beneficiaries[$key] = $this->Cruds->Beneficiaries->newEntity($beneficiary);
//             } else {
//                 // Update existing beneficiary
//                 $crud->beneficiaries[$key] = $this->Cruds->Beneficiaries->patchEntity(
//                     $crud->beneficiaries[array_search($beneficiary->id, $existingBeneficiaryIds)],
//                     $beneficiary
//                 );
//             }
//         }

//         // Save the Crud and its associated beneficiaries
//         if ($this->Cruds->save($crud)) {
//             $this->Flash->success(__('The crud has been updated successfully.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('The crud could not be updated. Please, try again.'));
//     }

//     // Fetch available statuses for the dropdown (or other use)
//     $statuses = $this->Cruds->Statuses->find('list');

//     // Set variables to the view
//     $this->set(compact('crud', 'statuses'));
// }


// public function edit($id = null) {
//     // Retrieve the Crud record by ID, along with its associated beneficiaries
//     $crud = $this->Cruds->get($id, [
//         'contain' => ['Beneficiaries']
//     ]);

//     if ($this->request->is(['patch', 'post', 'put'])) {
//         // Patch the Crud entity
//         $crud = $this->Cruds->patchEntity($crud, $this->request->getData(), [
//             'associated' => ['Beneficiaries']
//         ]);

//         // Create a mapping of existing beneficiary IDs
//         $existingBeneficiaryIds = Hash::extract($crud->beneficiaries, '{n}.id');

//         // Process beneficiaries: only keep the existing ones or new ones
//         foreach ($crud->beneficiaries as $key => $beneficiary) {
//             if (!isset($beneficiary->id) || !in_array($beneficiary->id, $existingBeneficiaryIds)) {
//                 // Treat as new beneficiary
//                 $crud->beneficiaries[$key] = $this->Cruds->Beneficiaries->newEntity($beneficiary);
//             } else {
//                 // Update existing beneficiary
//                 $existingBeneficiary = $crud->beneficiaries[array_search($beneficiary->id, $existingBeneficiaryIds)];
//                 $crud->beneficiaries[$key] = $this->Cruds->Beneficiaries->patchEntity($existingBeneficiary, $beneficiary);
//             }
//         }

//         // Save the Crud and its associated beneficiaries
//         if ($this->Cruds->save($crud)) {
//             $this->Flash->success(__('The crud has been updated successfully.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('The crud could not be updated. Please, try again.'));
//     }

//     // Fetch available statuses for the dropdown (or other use)
//     $statuses = $this->Cruds->Statuses->find('list');

//     // Set variables to the view
//     $this->set(compact('crud', 'statuses'));
// }

// public function edit($id = null) {
//     $crud = $this->Cruds->get($id, ['contain' => ['Beneficiaries']]);
//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $data = $this->request->getData();
        
//         // Update the CRUD data
//         $crud = $this->Cruds->patchEntity($crud, $data['Crud']);
//         if ($this->Cruds->save($crud)) {
//             // Process beneficiaries
//             foreach ($data['beneficiaries'] as $beneficiaryData) {
//                 if (!empty($beneficiaryData['id'])) {
//                     // Update existing beneficiary
//                     $beneficiaryEntity = $this->Beneficiaries->get($beneficiaryData['id']);
//                     $beneficiaryEntity = $this->Beneficiaries->patchEntity($beneficiaryEntity, $beneficiaryData);
//                 } else {
//                     // Create new beneficiary
//                     $beneficiaryEntity = $this->Beneficiaries->newEntity($beneficiaryData);
//                 }

//                 // Assign cruds_id to the beneficiary
//                 $beneficiaryEntity->cruds_id = $crud->id;

//                 // Save the beneficiary
//                 $this->Beneficiaries->save($beneficiaryEntity);
//             }

//             $this->Flash->success(__('The CRUD has been updated.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('Unable to update the CRUD.'));
//     }
    
//     $this->set(compact('crud'));
// }

// public function edit($id = null) {
//     $crud = $this->Cruds->get($id);
//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $data = $this->request->getData();

//         // Update the CRUD data
//         $crud = $this->Cruds->patchEntity($crud, $data['Crud']);
//         if ($this->Cruds->save($crud)) {
//             // Process only new beneficiaries
//             foreach ($data['beneficiaries'] as $beneficiaryData) {
//                 // Skip empty entries
//                 if (empty($beneficiaryData['name']) || empty($beneficiaryData['birthdate']) || empty($beneficiaryData['age'])) {
//                     continue;
//                 }

//                 // Create new beneficiary
//                 $beneficiaryEntity = $this->Beneficiaries->newEntity($beneficiaryData);
//                 $beneficiaryEntity->cruds_id = $crud->id; // Assign cruds_id to the new beneficiary
//                 if ($this->Beneficiaries->save($beneficiaryEntity)) {
//                     $this->log('New beneficiary added: ' . json_encode($beneficiaryEntity), 'debug');
//                 } else {
//                     $this->log('Failed to save new beneficiary: ' . json_encode($beneficiaryEntity->getErrors()), 'debug');
//                 }
//             }

//             $this->Flash->success(__('The CRUD has been updated.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('Unable to update the CRUD.'));
//     }

//     $this->set(compact('crud'));
// }

// public function edit($id = null) {
//     $crud = $this->Cruds->get($id);
//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $data = $this->request->getData();

//         // Update the CRUD data
//         $crud = $this->Cruds->patchEntity($crud, $data['Crud']);
//         if ($this->Cruds->save($crud)) {
//             // Process beneficiaries
//             foreach ($data['beneficiaries'] as $beneficiaryData) {
//                 // Skip empty entries
//                 if (empty($beneficiaryData['name']) || empty($beneficiaryData['birthdate']) || empty($beneficiaryData['age'])) {
//                     continue;
//                 }

//                 if (isset($beneficiaryData['id']) && !empty($beneficiaryData['id'])) {
//                     // Update existing beneficiary
//                     $existingBeneficiary = $this->Beneficiaries->get($beneficiaryData['id']);
//                     $existingBeneficiary = $this->Beneficiaries->patchEntity($existingBeneficiary, $beneficiaryData);
//                     if ($this->Beneficiaries->save($existingBeneficiary)) {
//                         $this->log('Beneficiary updated: ' . json_encode($existingBeneficiary), 'debug');
//                     } else {
//                         $this->log('Failed to update beneficiary: ' . json_encode($existingBeneficiary->getErrors()), 'debug');
//                     }
//                 } else {
//                     // Create new beneficiary
//                     $beneficiaryEntity = $this->Beneficiaries->newEntity($beneficiaryData);
//                     $beneficiaryEntity->cruds_id = $crud->id; // Assign cruds_id to the new beneficiary
//                     if ($this->Beneficiaries->save($beneficiaryEntity)) {
//                         $this->log('New beneficiary added: ' . json_encode($beneficiaryEntity), 'debug');
//                     } else {
//                         $this->log('Failed to save new beneficiary: ' . json_encode($beneficiaryEntity->getErrors()), 'debug');
//                     }
//                 }
//             }

//             $this->Flash->success(__('The CRUD has been updated.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('Unable to update the CRUD.'));
//     }

//     $this->set(compact('crud'));
// }


// public function edit($id = null) {
//     $crud = $this->Cruds->get($id);
//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $data = $this->request->getData();
//         $crud = $this->Cruds->patchEntity($crud, $data['Crud']);

//         if ($this->Cruds->save($crud)) {
//             // Update existing beneficiaries
//             foreach ($data['beneficiaries'] as $beneficiaryData) {
//                 if (!empty($beneficiaryData['id'])) { // Check if it's an existing beneficiary
//                     $existingBeneficiary = $this->Beneficiaries->get($beneficiaryData['id']);
//                     $existingBeneficiary = $this->Beneficiaries->patchEntity($existingBeneficiary, $beneficiaryData);
//                     if ($this->Beneficiaries->save($existingBeneficiary)) {
//                         $this->log('Beneficiary updated: ' . json_encode($existingBeneficiary), 'debug');
//                     } else {
//                         $this->log('Failed to update beneficiary: ' . json_encode($existingBeneficiary->getErrors()), 'debug');
//                     }
//                 } else {
//                     // Create new beneficiary
//                     $beneficiaryEntity = $this->Beneficiaries->newEntity($beneficiaryData);
//                     $beneficiaryEntity->cruds_id = $crud->id;
//                     if ($this->Beneficiaries->save($beneficiaryEntity)) {
//                         $this->log('New beneficiary added: ' . json_encode($beneficiaryEntity), 'debug');
//                     } else {
//                         $this->log('Failed to save new beneficiary: ' . json_encode($beneficiaryEntity->getErrors()), 'debug');
//                     }
//                 }
//             }

//             $this->Flash->success(__('The CRUD has been updated.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('Unable to update the CRUD.'));
//     }
//     $this->set(compact('crud'));
// }


// CrudsController.php
//works but test still
// public function edit($id = null)
// {
//     // Fetch the Crud data and its associated Beneficiaries
//     $crud = $this->Cruds->get($id, [
//         'contain' => ['Beneficiaries'] // Fetch associated beneficiaries
//     ]);

//     if ($this->request->is(['patch', 'post', 'put'])) {
//         $data = $this->request->getData();
//         $crud = $this->Cruds->patchEntity($crud, $data['Crud']);

//         if ($this->Cruds->save($crud)) {
//             // Prepare a list to track existing beneficiary IDs for deletion
//             $existingBeneficiaryIds = [];

//             // Update or create beneficiaries
//             foreach ($data['beneficiaries'] as $beneficiaryData) {
//                 if (!empty($beneficiaryData['id'])) { // Existing beneficiary
//                     // Update existing beneficiary
//                     $existingBeneficiary = $this->Beneficiaries->get($beneficiaryData['id']);
//                     $existingBeneficiary = $this->Beneficiaries->patchEntity($existingBeneficiary, $beneficiaryData);
//                     if ($this->Beneficiaries->save($existingBeneficiary)) {
//                         $existingBeneficiaryIds[] = $existingBeneficiary->id; // Track ID
//                     }
//                 } else {
//                     // Create new beneficiary
//                     $beneficiaryEntity = $this->Beneficiaries->newEntity($beneficiaryData);
//                     if ($this->Beneficiaries->save($beneficiaryEntity)) {
//                         // Newly created beneficiary, do nothing
//                     }
//                 }
//             }

//             // Optionally delete beneficiaries that were not in the submitted list
//             if (!empty($crud->beneficiaries)) {
//                 foreach ($crud->beneficiaries as $beneficiary) {
//                     if (!in_array($beneficiary->id, $existingBeneficiaryIds)) {
//                         $this->Beneficiaries->delete($beneficiary);
//                     }
//                 }
//             }

//             $this->Flash->success(__('The CRUD has been updated.'));
//             return $this->redirect(['action' => 'index']);
//         }
//         $this->Flash->error(__('Unable to update the CRUD.'));
//     }

//     $this->set(compact('crud'));
// }
// public function edit($id = null) {
//     $beneficiaryData = $this->request->input('json_decode', true);
    
//     if (!$beneficiaryData) {
//         return $this->response->withStatus(400)->withStringBody(json_encode(['ok' => false, 'msg' => 'Invalid data.']));
//     }

//     $this->loadModel('Beneficiaries');
//     // Use find() to get the beneficiary entity
//     $beneficiary = $this->Beneficiaries->find('all', [
//         'conditions' => ['Beneficiaries.id' => $id]
//     ])->first(); // Get the first result

//     if (!$beneficiary) {
//         return $this->response->withStatus(404)->withStringBody(json_encode(['ok' => false, 'msg' => 'Beneficiary not found.']));
//     }

//     // Update the entity with new data
//     $beneficiary = $this->Beneficiaries->patchEntity($beneficiary, $beneficiaryData);

//     if ($this->Beneficiaries->save($beneficiary)) {
//         $response = ['ok' => true, 'msg' => 'Beneficiary updated successfully.', 'beneficiary' => $beneficiary];
//     } else {
//         $response = ['ok' => false, 'msg' => 'Unable to update beneficiary.'];
//     }

//     return $this->response->withStatus(200)->withStringBody(json_encode($response));
// }

//WORKING LIKE USER PERMISSION
// public function edit($id = null) {
//     $crudData = $this->request->data['Crud']; // Assuming 'Crud' is correctly structured
//     $beneficiaryData = $this->request->data['Beneficiary'];

//     // Save the Crud data first
//     if ($this->Crud->save($crudData)) {
//         if (!empty($beneficiaryData)) {
//             foreach ($beneficiaryData as $key => $value) {
//                 // Ensure 'id' exists to determine if this is an update or create
//                 if (isset($value['id'])) {
//                     $this->Beneficiary->id = $value['id']; // Set the ID for update
//                 } else {
//                     $value['cruds_id'] = $id; // Assign cruds_id for new beneficiaries
//                 }
//                 // Format birthdate
//                 $value['birthdate'] = isset($value['birthdate']) ? date('Y-m-d', strtotime($value['birthdate'])) : null;
//                 // Save the beneficiary
//                 if (!$this->Beneficiary->save($value)) {
//                     // Handle individual beneficiary save failure (optional)
//                 }
//             }
//         }

//         $response = array(
//             'ok' => true,
//             'msg' => 'Updated successfully.',
//             'data' => $this->request->data,
//         );
//     } else {
//         $response = array(
//             'ok' => false,
//             'msg' => 'Not updated.',
//             'data' => $this->request->data,
//         );
//     }

//     $this->set(array(
//         'response' => $response,
//         '_serialize' => 'response'
//     ));
// }

// public function edit($id = null) {
//     $beneficiary = $this->request->data['Beneficiary'];
//     $crud = $this->request->data['Crud'];

//     if ($this->Crud->save($crud)) {
//         if (!empty($beneficiary)) {
//             foreach ($beneficiary as $key => $value) {
//                 // Format and set necessary fields
//                 $beneficiary[$key]['date'] = $value['birthdate'] = isset($value['birthdate']) ? date('m-d-Y', strtotime($value['birthdate'])) : null;
//                 $beneficiary[$key]['cruds_id'] = $id;

//                 if (isset($value['id'])) {
//                     // Update existing beneficiary
//                     $this->Beneficiary->id = $value['id'];
//                     $this->Beneficiary->save($value);
//                 } else {
//                     // Save new beneficiary
//                     $this->Beneficiary->create();
//                     $this->Beneficiary->save($value);
//                 }
//             }
//         }

//         $response = [
//             'ok' => true,
//             'msg' => 'Updated.',
//             'data' => $this->request->data,
//         ];
//     } else {
//         $response = [
//             'ok' => false,
//             'msg' => 'Not updated.',
//             'data' => $this->request->data,
//         ];
//     }

//     $this->set([
//         'response' => $response,
//         '_serialize' => 'response',
//     ]);
// }



// public function edit($id = null) {
//     $crudData = $this->request->data['Crud'];
//     $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'];

//     // Log the received data
//     debug($deletedBeneficiaries);

//     // Check if the crudData is being saved
//     if ($this->Crud->save($crudData)) {
//         // Handle deleted beneficiaries
//         foreach ($deletedBeneficiaries as $delBeneficiary) {
//             if (isset($delBeneficiary['id']) && !empty($delBeneficiary['id'])) {
//                 // Attempt to delete the beneficiary
//                 if ($this->Beneficiary->delete($delBeneficiary['id'])) {
//                     $this->log('Deleted beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                 } else {
//                     $this->log('Failed to delete beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                 }
//             } else {
//                 $this->log('No valid ID for beneficiary to delete', 'debug');
//             }
//         }
//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }

//working
// public function edit($id = null) {
//     $crudData = $this->request->data['Crud'];
//     $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'];

//     // Log the received data
//     debug($deletedBeneficiaries);
    
//     // Check if the crudData is being saved
//     if ($this->Crud->save($crudData)) {
//         // Handle deleted beneficiaries
//         foreach ($deletedBeneficiaries as $delBeneficiary) {
//             if (isset($delBeneficiary['name']) && isset($delBeneficiary['birthdate'])) {
//                 // Find the beneficiary by name and birthdate
//                 $beneficiary = $this->Beneficiary->find('first', [
//                     'conditions' => [
//                         'name' => $delBeneficiary['name'],
//                         'birthdate' => $delBeneficiary['birthdate'],
//                         'cruds_id' => $crudData['id'] // Ensure it's related to the correct CRUD
//                     ]
//                 ]);
                
//                 if ($beneficiary) {
//                     if ($this->Beneficiary->delete($beneficiary['Beneficiary']['id'])) {
//                         $this->log('Deleted beneficiary: ' . json_encode($delBeneficiary), 'debug');
//                     } else {
//                         $this->log('Failed to delete beneficiary: ' . json_encode($delBeneficiary), 'debug');
//                     }
//                 }
//             }
//         }
//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }

//LATEST
// public function edit($id = null) {
//     $crudData = $this->request->data['Crud'];
//     $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'];

//     // Log the received data
//     debug($deletedBeneficiaries);
    
//     // Check if the crudData is being saved
//     if ($this->Crud->save($crudData)) {
//         // Handle deleted beneficiaries
//         foreach ($deletedBeneficiaries as $delBeneficiary) {
//             if (isset($delBeneficiary['name']) && !empty($delBeneficiary['name']) &&
//                 isset($delBeneficiary['birthdate']) && !empty($delBeneficiary['birthdate'])) {
        
//                 // Find beneficiary by name and birthdate
//                 $beneficiary = $this->Beneficiary->find('first', [
//                     'conditions' => [
//                         'name' => $delBeneficiary['name'],
//                         'birthdate' => $delBeneficiary['birthdate']
//                     ]
//                 ]);

//                 if ($beneficiary) {
//                     // Attempt deletion
//                     if ($this->Beneficiary->delete($beneficiary['Beneficiary']['id'])) {
//                         $this->log('Deleted beneficiary ID: ' . $beneficiary['Beneficiary']['id'], 'debug');
//                     } else {
//                         $this->log('Failed to delete beneficiary ID: ' . $beneficiary['Beneficiary']['id'], 'debug');
//                     }
//                 } else {
//                     $this->log('Beneficiary not found for deletion: ' . json_encode($delBeneficiary), 'debug');
//                 }
//             } else {
//                 $this->log('Invalid beneficiary data: ' . json_encode($delBeneficiary), 'debug');
//             }
//         }
        
//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }


// public function remove() {
//     $this->request->allowMethod(['post', 'delete']);
    
//     $name = $this->request->getData('name');
//     $birthdate = $this->request->getData('birthdate');

//     // Check if the beneficiary exists
//     $beneficiary = $this->Beneficiary->find('first', [
//         'conditions' => [
//             'name' => $name,
//             'birthdate' => $birthdate
//         ]
//     ]);

//     if (!$beneficiary) {
//         throw new NotFoundException(__('Invalid Beneficiary name or birthdate'));
//     }

//     // Attempt to delete the beneficiary
//     if ($this->Beneficiary->delete($beneficiary['Beneficiary']['id'])) {
//         $response = [
//             'ok' => true,
//             'msg' => 'Deleted successfully',
//             'data' => $name,
//         ];
//     } else {
//         $response = [
//             'ok' => false,
//             'msg' => 'Could not delete the beneficiary',
//             'data' => $name,
//         ];
//     }

//     $this->set([
//         'response' => $response,
//         '_serialize' => 'response'
//     ]);
// }
//LATEST
// public function edit($id = null) {
//     $crudData = $this->request->data['Crud'];
//     $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'];

//     // Log the received data
//     debug($deletedBeneficiaries);
    
//     // Check if the crudData is being saved
//     if ($this->Crud->save($crudData)) {
//         // Handle "deletion" by setting `visible` to 0
//         foreach ($deletedBeneficiaries as $delBeneficiary) {
//             if (isset($delBeneficiary['id']) && !empty($delBeneficiary['id'])) {
//                 // Update the `visible` field to 0 for the beneficiary with the given ID
//                 $this->Beneficiary->id = $delBeneficiary['id'];
//                 if ($this->Beneficiary->saveField('visible', 0)) {
//                     $this->log('Set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                 } else {
//                     $this->log('Failed to set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                 }
//             } else {
//                 $this->log('Invalid beneficiary data: ' . json_encode($delBeneficiary), 'debug');
//             }
//         }

//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }
//LAST WORKING WITH GOOD EDIT NO DUPS BUT NO DELETE
// public function edit($id = null) {
//     // Get Crud data from request
//     $crudData = $this->request->data['Crud']; //////////////////////////////////////////////////////
//     $deletedBeneficiaries = $this->request->data['deletedBeneficiaries']; //////////////////////////////////////////////////////
//     $beneficiariesData = $this->request->data['beneficiaries']; //////////////////////////////////////////////////////

//     // Log the received data for debugging
//     $this->log('Deleted Beneficiaries: ' . json_encode($deletedBeneficiaries), 'debug');
//     $this->log('Crud Data: ' . json_encode($crudData), 'debug');
//     $this->log('Beneficiaries Data: ' . json_encode($beneficiariesData), 'debug');

//     // Check if the Crud data is being saved successfully
//     if ($this->Crud->save($crudData)) {
//         // Handle "deletion" by setting `visible` to 0 for beneficiaries
//         foreach ($deletedBeneficiaries as $delBeneficiary) { //////////////////////////////////////////////////////
//             if (!empty($delBeneficiary['id'])) {
//                 // Fetch the beneficiary by ID
//                 $this->Beneficiary->id = $delBeneficiary['id'];
                
//                 // Check if beneficiary exists in the database
//                 if ($this->Beneficiary->exists()) {
//                     // Attempt to set `visible` to 0
//                     if ($this->Beneficiary->saveField('visible', 0)) {
//                         $this->log('Set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                     } else {
//                         $this->log('Failed to set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                     }
//                 } else {
//                     $this->log('Beneficiary ID: ' . $delBeneficiary['id'] . ' does not exist in the database.', 'debug');
//                 }
//             } else {
//                 $this->log('Invalid beneficiary data: ' . json_encode($delBeneficiary), 'debug');
//             }
//         }

//         // Save or update remaining beneficiaries (for editing)
//         foreach ($beneficiariesData as $beneficiary) {    //////////////////////////////////////////////////////
//             if (!empty($beneficiary['id'])) {
//                 // Update existing beneficiary
//                 $this->Beneficiary->id = $beneficiary['id'];
//                 $this->Beneficiary->save($beneficiary);
//             } else {
//                 // Add new beneficiary
//                 $this->Beneficiary->create();
//                 $this->Beneficiary->save($beneficiary);
//             }
//         }

//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         // Respond with failure
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }

//WORKING FOR REAL
// public function edit($id = null) {
//     // Check if the request method is allowed
//     $this->request->allowMethod(['put', 'post']);
    
//     // Find the existing Crud record by ID
//     $crud = $this->Crud->findById($id);
    
//     if (!$crud) {
//         return $this->setResponse(['ok' => false, 'msg' => 'Invalid CRUD ID.']);
//     }

//     // Initialize variables with default values
//     $crudData = isset($this->request->data['Crud']) ? $this->request->data['Crud'] : [];
//     $deletedBeneficiaries = isset($this->request->data['deletedBeneficiaries']) ? $this->request->data['deletedBeneficiaries'] : [];
//     $beneficiariesData = isset($this->request->data['beneficiaries']) ? $this->request->data['beneficiaries'] : [];

//     // Log the received data for debugging
//     $this->log('Deleted Beneficiaries: ' . json_encode($deletedBeneficiaries), 'debug');
//     $this->log('Crud Data: ' . json_encode($crudData), 'debug');
//     $this->log('Beneficiaries Data: ' . json_encode($beneficiariesData), 'debug');

//     // Check if the Crud data is being saved successfully
//     $this->Crud->id = $id; // Set the ID to the existing record
//     if ($this->Crud->save($crudData)) {
//         // Handle "deletion" by setting `visible` to 0 for beneficiaries
//         foreach ($deletedBeneficiaries as $delBeneficiary) {
//             if (!empty($delBeneficiary['id'])) {
//                 // Fetch the beneficiary by ID
//                 $this->Beneficiary->id = $delBeneficiary['id'];
                
//                 // Check if beneficiary exists in the database
//                 if ($this->Beneficiary->exists()) {
//                     // Attempt to set `visible` to 0
//                     if ($this->Beneficiary->saveField('visible', 0)) {
//                         $this->log('Set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                     } else {
//                         $this->log('Failed to set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
//                     }
//                 } else {
//                     $this->log('Beneficiary ID: ' . $delBeneficiary['id'] . ' does not exist in the database.', 'debug');
//                 }
//             } else {
//                 $this->log('Invalid beneficiary data: ' . json_encode($delBeneficiary), 'debug');
//             }
//         }

//         // Save or update remaining beneficiaries (for editing)
//         foreach ($beneficiariesData as $beneficiary) {
//             if (!empty($beneficiary['id'])) {
//                 // Update existing beneficiary
//                 $this->Beneficiary->id = $beneficiary['id'];
//                 $this->Beneficiary->save($beneficiary);
//             } else {
//                 // Add new beneficiary
//                 $this->Beneficiary->create();
//                 $this->Beneficiary->save($beneficiary);
//             }
//         }

//         // Respond with success
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         // Respond with failure
//         $response = ['ok' => false, 'msg' => 'Update failed.'];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }
//part2 still working edit
public function edit($id = null) {
    // Check if the request method is allowed
    $this->request->allowMethod(['put', 'post']);
    
    // Find the existing Crud record by ID
    $crud = $this->Crud->findById($id);
    
    if (!$crud) {
        return $this->setResponse(['ok' => false, 'msg' => 'Invalid CRUD ID.']);
    }

    // Initialize variables with default values
    $crudData = isset($this->request->data['Crud']) ? $this->request->data['Crud'] : [];
    $deletedBeneficiaries = isset($this->request->data['deletedBeneficiaries']) ? $this->request->data['deletedBeneficiaries'] : [];
    $beneficiariesData = isset($this->request->data['beneficiaries']) ? $this->request->data['beneficiaries'] : [];

    // Log the received data for debugging
    $this->log('Deleted Beneficiaries: ' . json_encode($deletedBeneficiaries), 'debug');
    $this->log('Crud Data: ' . json_encode($crudData), 'debug');
    $this->log('Beneficiaries Data: ' . json_encode($beneficiariesData), 'debug');

    // Check if the approve status is being sent in the request
    if (isset($this->request->data['approve'])) {
        $approvalStatus = $this->request->data['approve']; // Expecting true or false

        // Validate the approvalStatus is a boolean
        if (is_bool($approvalStatus)) {
            // Convert boolean to 1/0 for the database
            $crudData['approve'] = $approvalStatus ? 1 : 0;
        } else {
            return $this->setResponse(['ok' => false, 'msg' => 'Invalid approval status.']);
        }
    }

    // Check if the Crud data is being saved successfully
    $this->Crud->id = $id; // Set the ID to the existing record
    if ($this->Crud->save($crudData)) {
        // Handle "deletion" by setting `visible` to 0 for beneficiaries
        foreach ($deletedBeneficiaries as $delBeneficiary) {
            if (!empty($delBeneficiary['id'])) {
                // Fetch the beneficiary by ID
                $this->Beneficiary->id = $delBeneficiary['id'];
                
                // Check if beneficiary exists in the database
                if ($this->Beneficiary->exists()) {
                    // Attempt to set `visible` to 0
                    if ($this->Beneficiary->saveField('visible', 0)) {
                        $this->log('Set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
                    } else {
                        $this->log('Failed to set visible=0 for beneficiary ID: ' . $delBeneficiary['id'], 'debug');
                    }
                } else {
                    $this->log('Beneficiary ID: ' . $delBeneficiary['id'] . ' does not exist in the database.', 'debug');
                }
            } else {
                $this->log('Invalid beneficiary data: ' . json_encode($delBeneficiary), 'debug');
            }
        }

        // Save or update remaining beneficiaries (for editing)
        foreach ($beneficiariesData as $beneficiary) {
            if (!empty($beneficiary['id'])) {
                // Update existing beneficiary
                $this->Beneficiary->id = $beneficiary['id'];
                $this->Beneficiary->save($beneficiary);
            } else {
                // Add new beneficiary
                $this->Beneficiary->create();
                $this->Beneficiary->save($beneficiary);
            }
        }

        // Respond with success
        $response = ['ok' => true, 'msg' => 'Updated successfully.'];
    } else {
        // Respond with failure
        $response = ['ok' => false, 'msg' => 'Update failed.'];
    }

    $this->set(compact('response'));
    $this->set('_serialize', 'response');
}

// public function edit($id = null) {
//     $this->request->allowMethod(['put', 'post']);
    
//     $crud = $this->Crud->findById($id);
    
//     if (!$crud) {
//         return $this->setResponse(['ok' => false, 'msg' => 'Invalid CRUD ID.']);
//     }

//     // Retrieve CRUD data
//     $crudData = isset($this->request->data['Crud']) ? $this->request->data['Crud'] : [];

//     // Handle approval status
//     if (isset($this->request->data['approve'])) {
//         $crudData['approve'] = $this->request->data['approve']; // Set approval status
//     }

//     // Attempt to save the CRUD data
//     $this->Crud->id = $id;
//     if ($this->Crud->save($crudData)) {
//         $response = ['ok' => true, 'msg' => 'Updated successfully.'];
//     } else {
//         $response = [
//             'ok' => false, 
//             'msg' => 'Update failed.', 
//             'errors' => $this->Crud->validationErrors // Include validation errors if any
//         ];
//     }

//     $this->set(compact('response'));
//     $this->set('_serialize', 'response');
// }









    //ORIGINAL
    // public function delete($id = null){
        
    //     if($this->Crud->hide($id)){
    //         $response = array(
    //             'ok'    =>  true,
    //             'msg'   =>  'Deleted',
    //             'data'  =>  $id,
    //         );
    //     }else{
    //         $response = array(
    //             'ok'    =>  false,
    //             'msg'   =>  'Not deleted',
    //             'data'  =>  $id,
    //         );
    //     }
    //     $this->set(array(
    //         'response'     =>  $response,
    //         '_serialize'   =>  'response'
    //     ));
    // }

    // // public function delete($id = null) {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $beneficiary = $this->Beneficiaries->get($id);
    
    //     if ($this->Beneficiaries->delete($beneficiary)) {
    //         $this->Flash->success(__('The beneficiary has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('Unable to delete the beneficiary.'));
    //     }
    
    //     return $this->redirect(['action' => 'index']);
    // }
    

    public function delete($id = null) {
        // Attempt to delete the Crud entry
        if ($this->Crud->hide($id)) {
            // If the Crud was successfully deleted, now handle the beneficiaries
            // Loop through deletedBeneficiaries or pass the beneficiary name
            $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'] ?? [];
    
            foreach ($deletedBeneficiaries as $name) {
                $beneficiary = $this->Beneficiary->find('first', [
                    'conditions' => ['Beneficiary.name' => $name]
                ]);
    
                if ($beneficiary) {
                    // Attempt to delete the beneficiary by ID
                    if ($this->Beneficiary->delete($beneficiary['Beneficiary']['name'])) {
                        // Log success or do something if needed
                    } else {
                        // Handle failure to delete beneficiary
                    }
                }
            }
    
            $response = [
                'ok' => true,
                'msg' => 'Deleted successfully',
                'data' => $id,
            ];
        } else {
            $response = [
                'ok' => false,
                'msg' => 'Not deleted',
                'data' => $id,
            ];
        }
    
        $this->set(array(
            'response' => $response,
            '_serialize' => 'response'
        ));
    }
    
}