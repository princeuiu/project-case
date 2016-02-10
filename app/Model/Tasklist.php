<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaTasklist $MediaTasklist
 */
class Tasklist extends AppModel {
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
    public $useTable = "tasklists";
    
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
                'rule' => array('between', 1, 200),
                'message' => 'between 1 to 200 letters'            
            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    
    public $hasMany = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'tasklist_id',
            'dependent' => false,
            'conditions' => array('Task.status' => 'active'),
            'order' => 'Task.created DESC'
        )
    );
    
    
    public $belongsTo = array(
        'Court' => array(
            'className' => 'Court',
            'foreignKey' => 'court_id'
        )
    );
    
    
	
}
