<?php
class CrudStatusesController extends AppController {

    public $uses = array('CrudStatuses'); //ADDEDDDDDDDDDDDDDDDDDDDDDDDD BY CJ

    public function beforeFilter(){
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }


    public function index() {
        // Fetch data from the model
        $crudStatuses = $this->CrudStatuses->find('all');
    
        // Transform data for the frontend if needed
        $data = array();
        foreach ($crudStatuses as $status) {
            $data[] = array(
                'id'   => $status['CrudStatuses']['id'],
                'name' => $status['CrudStatuses']['name']
            );
        }
    
        // Prepare response
        $response = array(
            'ok'    => true,
            'msg'   => 'Data retrieved successfully',
            'data'  => $data
        );
    
        // Set the response and serialize it
        $this->set(array(
            'response'   => $response,
            '_serialize' => 'response'
        ));
    }
    
    
    
    




    public function add() {
        $this->CrudStatuses->create(); // Prepare the model for saving
        
        // Data to be saved
        $data = array(
            'name' => $this->request->data['CrudStatus']['name']
        );
    
        // Save the data
        if ($this->CrudStatuses->save($data)) {
            $response = array(
                'ok'    => true,
                'msg'   => 'Saved',
                'data'  => $data
            );
        } else {
            $response = array(
                'ok'    => false,
                'msg'   => 'Not saved',
                'data'  => $data
            );
        }
    
        $this->set(array(
            'response'   => $response,
            '_serialize' => 'response'
        ));
    }
    


    // public function select() {
    //     $code = $this->request->query('code');

    //     if ($code === 'crud-status') {
    //         $data = $this->CrudStatuses->find('all');
    //         $response = array(
    //             'ok'    => true,
    //             'msg'   => 'Data retrieved successfully',
    //             'data'  => $data
    //         );
    //     } else {
    //         $response = array(
    //             'ok'    => false,
    //             'msg'   => 'Invalid code',
    //             'data'  => array()
    //         );
    //     }

    //     $this->set(array(
    //         'response'   => $response,
    //         '_serialize' => 'response'
    //     ));
    // }



    // public function view($id = null){

    //     $data = $this->Crudstatuses->find('first', array(
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


    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid ID'));
        }
    
        // Retrieve the data
        $data = $this->CrudStatuses->find('first', array(
            'conditions' => array(
                'CrudStatuses.id' => $id
            )
        ));
    
        if (empty($data)) {
            throw new NotFoundException(__('No data found'));
        }
    
        $response = array(
            'ok'    => true,
            'msg'   => 'Data retrieved successfully',
            'data'  => $data['CrudStatuses'], // Ensure this matches the AngularJS view structure
        );
    
        $this->set(array(
            'response'   => $response,
            '_serialize' => 'response'
        ));
    }
    



 
    public function edit($id = null){

        if($this->Crud->save($this->request->data['Crud'])){
            $response = array(
                'ok'    =>  true,
                'msg'   =>  'Updated',
                'data'  =>  $this->request->data,
            );
        }else{
            $response = array(
                'ok'    =>  false,
                'msg'   =>  'Not updated',
                'data'  =>  $this->request->data,
            );
        }

            $this->set(array(
                'response'     =>  $response,
                '_serialize'   =>  'response'
            ));
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
