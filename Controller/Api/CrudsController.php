<?php
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'FPDF', array('file' => 'FPDF/fpdf.php'));

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

    public function printCrud($id = null) {
        // Load the specific Crud based on the ID
        $crud = $this->Crud->find('first', [
            'conditions' => ['Crud.id' => $id],
            'contain' => ['CrudStatuses'] // Use CrudStatuses here
        ]);
        
        if (empty($crud)) {
            throw new NotFoundException(__('Invalid CRUD'));
        }
    
        // Initialize FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
    
        // Output CRUD data
        $pdf->Cell(40, 10, 'CRUD Details');
        $pdf->Ln(10); // Line break
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Name: ' . $crud['Crud']['name']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Birthdate: ' . $crud['Crud']['birthdate']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Age: ' . $crud['Crud']['age']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Character: ' . $crud['Crud']['character']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Status: ' . (!empty($crud['CrudStatuses']) ? $crud['CrudStatuses']['name'] : 'N/A')); // Use CrudStatuses here
    
        // Output the PDF
        $this->response->type('application/pdf');
        $pdf->Output();
        return $this->response;
    }
    
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

    public function index() {
        $page = isset($this->request->query['page']) ? (int)$this->request->query['page'] : 1;
        
        // Base conditions to fetch only visible cruds
        $conditions = ['Crud.visible' => 1];
    
        // Check if there is a search term
        if (!empty($this->request->query['search'])) {
            $search = $this->request->query['search'];
            $conditions['Crud.name LIKE'] = '%' . $search . '%'; // Add the search condition
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
                // Calculate age
                $bdayDate = new DateTime($birthdate);
                $today = new DateTime();
                $age = $today->diff($bdayDate)->y;
    
                // Add age to request data
                $crud['age'] = $age;
                // Optionally, save the age back to the Crud if needed
                $this->Crud->id = $crudId; // Set the ID to update the existing record
                $this->Crud->saveField('age', $age); // Save the age back to the database
            }
    
            // Prepare beneficiaries data
            if (!empty($this->request->data['beneficiaries'])) {
                foreach ($this->request->data['beneficiaries'] as &$beneficiary) {
                    $beneficiary['cruds_id'] = $crudId; // Set the foreign key
                }
    
                // Save beneficiaries
                if ($this->Beneficiary->saveMany($this->request->data['beneficiaries'])) {
                    // Commit transaction on success
                    $this->Crud->getDataSource()->commit();
                    $response = array(
                        'ok' => true,
                        'msg' => 'Crud and Beneficiaries saved successfully',
                        'data' => $crud,
                    );
                } else {
                    // Rollback transaction on failure
                    $this->Crud->getDataSource()->rollback();
                    $response = array(
                        'ok' => false,
                        'msg' => 'Could not save Beneficiaries',
                    );
                }
            } else {
                // No beneficiaries to save, just commit Crud
                $this->Crud->getDataSource()->commit();
                $response = array(
                    'ok' => true,
                    'msg' => 'Crud saved successfully, no beneficiaries to save.',
                    'data' => $crud,
                );
            }
        } else {
            // Rollback if Crud saving fails
            $this->Crud->getDataSource()->rollback();
            $response = array(
                'ok' => false,
                'msg' => 'Could not save Crud',
            );
        }
    
        // Send the response
        $this->set(array(
            'response' => $response,
            '_serialize' => 'response'
        ));
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
public function edit($id = null) {
    // Get Crud data from request
    $crudData = $this->request->data['Crud'];
    $deletedBeneficiaries = $this->request->data['deletedBeneficiaries'];
    $beneficiariesData = $this->request->data['beneficiaries'];

    // Log the received data for debugging
    $this->log('Deleted Beneficiaries: ' . json_encode($deletedBeneficiaries), 'debug');
    $this->log('Crud Data: ' . json_encode($crudData), 'debug');
    $this->log('Beneficiaries Data: ' . json_encode($beneficiariesData), 'debug');

    // Check if the Crud data is being saved successfully
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
