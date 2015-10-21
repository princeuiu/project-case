<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class TaskComment extends AppModel {
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
    public $useTable = "task_comments";

    public $validate = array(
        'body' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Can\'t be empty',
                'allowEmpty' => false,
                'required' => false,
                'last' => false, // Stop validation after this rule
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'between' => array(
                'rule' => array('between', 1, 300),
                'message' => 'between 1 to 300 letters'
            )
        )
    );


    //The Associations below have been created with all possible keys, those that are not needed can be removed


    public $belongsTo = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'task_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

    public $hasMany = array(
        'WantingDoc' => array(
            'className' => 'WantingDoc',
            'foreignKey' => 'comment_id'
        )
    );
}