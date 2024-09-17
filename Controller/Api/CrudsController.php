<?php
class CrudsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }


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


    public function add(){

        if($this->Crud->save($this->request->data['Crud'])){
            $response = array(
                'ok'    =>  true,
                'msg'   =>  'Saved',
                'data'  =>  $this->request->data['Crud'],
            );
        }else{
            $response = array(
                'ok'    =>  false,
                'msg'   =>  'Not saved',
                'data'  =>  $this->request->data['Crud'],
            );
        }
    $this->set(array(
        'response'=> $response,
        '_serialize'=>'response'
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
