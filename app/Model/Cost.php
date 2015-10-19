<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Cost extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
    public $useTable = "costs";
    
    public $actsAs = array(
        'Sluggable' => array('label' => 'name', 'overwrite' => true), 
    );
 
    
    public $validate = array(
        'name' => array(
            'notempty' => array(
            'rule' => array('notempty'),
            'message' => 'Can\'t be empty',
            'allowEmpty' => false,
            'required' => false,
            'last' => false, // Stop validation after this rule
            'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'between' => array(
                'rule' => array('between', 2, 50),
                'message' => 'between 2 to 50 letters'            
            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public $hasAndBelongsToMany = array(
        'Invoice' =>
            array(
                'className' => 'Invoice',
                'joinTable' => 'invoices_costs',
                'foreignKey' => 'cost_id',
                'associationForeignKey' => 'invoice_id',
                'unique' => true,
            )
    );
    
	
}
