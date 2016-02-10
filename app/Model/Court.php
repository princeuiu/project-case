<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCourt $MediaCourt
 */
class Court extends AppModel {
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
    public $useTable = "courts";
    
    public $actsAs = array(
        'Tree' => array('__parentChange' => true),
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
                'rule' => array('between', 1, 100),
                'message' => 'between 1 to 100 letters'            
            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    
    public $hasMany = array(
        'Lawsuit' => array(
            'className' => 'Lawsuit',
            'foreignKey' => 'court_id',
            'dependent' => false,
            'conditions' => array('Lawsuit.status' => 'active'),
            'order' => 'Lawsuit.created DESC'
        ),
        'Tasklist' => array(
            'className' => 'Tasklist',
            'foreignKey' => 'court_id',
            'dependent' => false,
            'conditions' => array('Tasklist.status' => 'active'),
            'order' => 'Tasklist.created DESC'
        )
    );
    
	
}
