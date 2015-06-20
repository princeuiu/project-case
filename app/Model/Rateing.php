<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class Rateing extends AppModel {
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
    public $useTable = "rateings";
    
    public $actsAs = array(
    );
 
    
//    public $validate = array(
//        'name' => array(
//            'notempty' => array(
//            'rule' => array('notempty'),
//            'message' => 'Can\'t be empty',
//            'allowEmpty' => false,
//            'required' => false,
//            'last' => false, // Stop validation after this rule
//            'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//            'between' => array(
//                'rule' => array('between', 2, 50),
//                'message' => 'between 2 to 50 letters'            
//            )
//        )
//    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
    
    public function getRecent() {
        $conditions = array(
            'created BETWEEN (curdate() - interval 7 day)' .
            ' and (curdate() - interval 0 day))'
        );
        return $this->find('all', compact('conditions'));
    }
    
    
    public $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id'
        )
    );
    
	
}
