<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class History extends AppModel {
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
    public $useTable = "histories";
    
    public $actsAs = array(
        'Sluggable' => array('label' => 'title', 'overwrite' => true), 
    );
 
    
    public $validate = array(
        'title' => array(
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
        
    
    public $belongsTo = array(
        'Lawsuit' => array(
            'className' => 'Lawsuit',
            'foreignKey' => 'lawsuit_id'
        )
    );
    
    
	
}
