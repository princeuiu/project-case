<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Client extends AppModel {
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
    public $useTable = "clients";
    
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
        ),
        'address' => array(
            'notempty' => array(
            'rule' => array('notempty'),
            'message' => 'Can\'t be empty',
            'allowEmpty' => false,
            'required' => false,
            'last' => false, // Stop validation after this rule
            'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'between' => array(
                'rule' => array('between', 7, 100),
                'message' => 'between 2 to 15 letters'            
            )
        ),
        'phone' => array(
            'notempty' => array(
            'rule' => array('notempty'),
            'message' => 'Can\'t be empty',
            'allowEmpty' => false,
            'required' => false,
            'last' => false, // Stop validation after this rule
            'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'between' => array(
                'rule' => array('between', 2, 15),
                'message' => 'between 2 to 15 letters'            
            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public $hasMany = array(
        'Lawsuit' => array(
            'className' => 'Lawsuit',
            'foreignKey' => 'client_id',
            'dependent' => true,
            'conditions' => array('Lawsuit.status' => 'active'),
            'order' => 'Lawsuit.created DESC'
        )
    );
    
	
}
