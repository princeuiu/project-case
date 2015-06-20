<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Question extends AppModel {
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
    public $useTable = "questions";
    
    public $actsAs = array( 
    );
 
    
    public $validate = array(
        'question' => array(
            'notempty' => array(
            'rule' => array('notempty'),
            'message' => 'Can\'t be empty',
            'allowEmpty' => false,
            'required' => false,
            'last' => false, // Stop validation after this rule
            'on' => array('create', 'update') // Limit validation to 'create' or 'update' operations
            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    
    
	
}
