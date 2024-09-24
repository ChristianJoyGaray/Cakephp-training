<?php

// src/Model/Entity/Beneficiary.php
class Beneficiary extends AppModel {
    public $belongsTo = array(
        'Crud' => array(
            'className' => 'Crud',
            'foreignKey' => 'cruds_id',
        )
    );
    public $primaryKey = 'id';
}

