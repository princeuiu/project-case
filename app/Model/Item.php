<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Item extends AppModel {
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
    public $useTable = "items";
    
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
        
    
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'Unit' => array(
            'className' => 'Unit',
            'foreignKey' => 'unit_id'
        ),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id'
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Supplier' => array(
            'className' => 'Supplier',
            'joinTable' => 'supplier_to_item',
            'foreignKey' => 'item_id',
            'associationForeignKey' => 'supplier_id',
            'unique' => true
        ),
        'Brand' => array(
            'className' => 'Brand',
            'joinTable' => 'brand_to_item',
            'foreignKey' => 'item_id',
            'associationForeignKey' => 'brand_id',
            'unique' => true
        )
    );

    
	
}
