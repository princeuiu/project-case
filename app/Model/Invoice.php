<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Invoice extends AppModel {
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
    public $useTable = "invoices";
    
    public $actsAs = array(
        'Sluggable' => array('label' => 'name', 'overwrite' => true), 
    );
 
    
    

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public $belongsTo = array(
        'Lawsuit' => array(
            'className' => 'Lawsuit',
            'foreignKey' => 'lawsuit_id'
        ),
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id'
        )
    );
    
    
    public $hasAndBelongsToMany = array(
        'Cost' =>
            array(
                'className' => 'Cost',
                'joinTable' => 'invoices_costs',
                'foreignKey' => 'invoice_id',
                'associationForeignKey' => 'cost_id',
                'unique' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => ''
            )
    );

    
	
}
//ok