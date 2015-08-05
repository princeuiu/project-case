<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class WantingDoc extends AppModel {
    /**
     * Display field
     *
     * @var string
     */

    /**
     * Validation rules
     *
     * @var array
     */
    public $useTable = "files";

    //The Associations below have been created with all possible keys, those that are not needed can be removed


    public $belongsTo = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'task_id'
        ),
        'TaskComment' => array(
            'className' => 'TaskComment',
            'foreignKey' => 'comment_id'
        )
    );



}
