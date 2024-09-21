<?php
class CrudsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }

    public $uses = ['Crud', 'Beneficiary'];


    public function index(){


        // // without pagination
        // $datas = $this->Crud->find('all', array());

        // // transform data
        // $cruds = array();
        // foreach ($datas as $data){
        //     $cruds[] = array( //data[0].Crud.name
        //         'id'            =>   $data['Crud']['id'],
        //         'name'          =>   properCase($data['Crud']['name']),
        //         'age'           =>   $data['Crud']['age'],
        //         'character'     =>   $data['Crud']['character'],
        //         'visible'       =>   $data['Crud']['visible'],
        //         'date_created'  =>   date('m/d/Y', strtotime($data['Crud']['created'])),
        //     );
        // }

        //with pagination
        //default page 1
        $page = isset($this->request->query['page'])? $this->request->query['page'] : 1;


        $conditions = array();
        $conditions['Crud.visible'] = true;
        //paginate data
        $paginatorSettings = array(
            'conditions' => $conditions,
            'limit'      => 25,
            'page'       => $page,
            'order'      => array(
            'Crud.name'  => 'ASC'
            )
            );
            $modelName = 'Crud'; //cruds in table
            $this->Paginator->settings = $paginatorSettings;
            $tmpData = $this->Paginator->paginate($modelName);
            $paginator = $this->request->params['paging'][$modelName];

            //transform data
            $cruds_=array();
            foreach ($tmpData as $crud){
                $cruds_[] = array(
                    'id'            =>   $crud['Crud']['id'],
                    'name'          =>   properCase($crud['Crud']['name']),
                    'age'           =>   $crud['Crud']['age'],
                    'character'     =>   $crud['Crud']['character'],
                    'visible'       =>   $crud['Crud']['visible'],
                    'date_created'  =>   date('m/d/Y', strtotime($crud['Crud']['created'])),
                );
            }


        $response = array(
            'ok'=>true,
            'msg'=>'index',
            // 'untransformed' => $tmpData,
            'data' => $cruds_,
            'paginator' => $paginator,
        );

        $this->set(array(
            'response'=> $response,
            '_serialize'=>'response'
        ));

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
    
    
    
    
    
    


    public function view($id = null){

        $data = $this->Crud->find('first', array(
            'contain'       =>  array(
                'CrudStatus' => array('name')

            ),
            'conditions'    =>  array(
            'Crud.id'       =>  $id,
            'Crud.visible'  =>  true
            )
        ));

        //OR (findById is a cakephp syntax)

        $data_ = $this->Crud->findById($id);   

        $response = array(
            'ok'    => true,
            'msg'   => 'view',
            'data'  => $data,
        );


        $this->set(array(
            'response'=>$response,
            '_serialize'=>'response'
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


    public function edit($id = null) {
        // Check if the record exists
        $crud = $this->Crud->findById($id);
        if (!$crud) {
            throw new NotFoundException(__('Invalid record'));
        }
    
        if ($this->request->is(['post', 'put'])) {
            // Get the birthdate from the form data
            if (!empty($this->request->data['Crud']['birthdate'])) {
                $birthdate = $this->request->data['Crud']['birthdate'];
    
                // Convert the birthdate to a DateTime object
                $bdayDate = new DateTime($birthdate);
                $today = new DateTime();
    
                // Calculate the age
                $age = $today->diff($bdayDate)->y;
    
                // Add the computed age to the request data before saving
                $this->request->data['Crud']['age'] = $age;
            }
    
            // Save the data
            if ($this->Crud->save($this->request->data['Crud'])) {
                $response = array(
                    'ok'    =>  true,
                    'msg'   =>  'Updated',
                    'data'  =>  $this->request->data,
                );
            } else {
                $response = array(
                    'ok'    =>  false,
                    'msg'   =>  'Not updated',
                    'data'  =>  $this->request->data,
                );
            }
    
            // Set the response
            $this->set(array(
                'response'     =>  $response,
                '_serialize'   =>  'response'
            ));
        } else {
            // If the request is not post or put, load the current data
            $this->request->data = $crud;
        }
    }
    







    public function delete($id = null){
        
        if($this->Crud->hide($id)){
            $response = array(
                'ok'    =>  true,
                'msg'   =>  'Deleted',
                'data'  =>  $id,
            );
        }else{
            $response = array(
                'ok'    =>  false,
                'msg'   =>  'Not deleted',
                'data'  =>  $id,
            );
        }
        $this->set(array(
            'response'     =>  $response,
            '_serialize'   =>  'response'
        ));
    }
}
