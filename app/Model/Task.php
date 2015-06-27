<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Task extends AppModel {
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
    public $useTable = "tasks";
    
    public $actsAs = array(
        'Sluggable' => array('label' => 'name', 'overwrite' => true), 
    );
 
    
    

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public $belongsTo = array(
        'Lawsuit' => array(
            'className' => 'Lawsuit',
            'foreignKey' => 'lawsuit_id'
        ),
        'Owner' => array(
            'className' => 'User',
            'foreignKey' => 'owner'
        ),
        'Assigned' => array(
            'className' => 'User',
            'foreignKey' => 'assigned_to'
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Follower' =>array(
            'className' => 'User',
            'joinTable' => 'followers',
            'foreignKey' => 'task_id',
            'associationForeignKey' => 'user_id',
            'unique' => true
        )
    );

    
	
}
