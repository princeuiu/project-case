<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Lawsuit extends AppModel {
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
    public $useTable = "lawsuits";
    
    public $actsAs = array(
        'Sluggable' => array('label' => 'number', 'overwrite' => true), 
    );
 
    
    

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id'
        )
    );
    
    public $hasMany = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'lawsuit_id',
            'dependent' => true,
            'order' => 'Task.created DESC'
        ),
        'History' => array(
            'className' => 'History',
            'foreignKey' => 'lawsuit_id',
            'dependent' => true,
            'order' => 'History.created DESC'
        )
    );

    
	
}
//ok