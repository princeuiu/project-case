<?php
App::uses('AppModel', 'Model');
/**
 * Media Model
 *
 * @property MediaCategory $MediaCategory
 */
class User extends AppModel {
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
 public $useTable = "users";
 
 
    
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
                'rule' => array('between', 3, 50),
                'message' => 'between 3 to 50 letters'            
            )
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Can\'t be empty',
                'allowEmpty' => false,
                'required' => false,
                'last' => false, // Stop validation after this rule
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            
            'email' => array(
                'rule' => array('email'),
                'message' => 'invalid email'
            ),
            
        ),
            'password' => array(
            'required' => array(
                'rule' => array('minLength', '8'),
                'message' => 'A password with a minimum length of 8 characters is required'
            )
        ),
            'repassword' => array(
            'required' => array(
                'rule' => array('equalToField', 'password' ), 
                'message' => 'Both password fields must be filled out'
            )
        )
    );

    function equalToField($array, $field) {
        return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
        
        
        
    public function authsomeLogin($type, $credentials = array()) {
        switch ($type) {
                case 'guest':
                        // You can return any non-null value here, if you don't
                        // have a guest account, just return an empty array
                        return array();
                case 'credentials':
                        $password = Authsome::hash($credentials['password']);

                        // This is the logic for validating the login
                        $conditions = array(
                                'User.email' => $credentials['email'],
                                'User.password' => $password,
                        );
                        break;
                case 'cookie':
                        list($token, $userId) = split(':', $credentials['token']);
                        $duration = $credentials['duration'];

                        $loginToken = $this->LoginToken->find('first', array(
                                'conditions' => array(
                                        'user_id' => $userId,
                                        'token' => $token,
                                        'duration' => $duration,
                                        'used' => false,
                                        'expires <=' => date('Y-m-d H:i:s', strtotime($duration)),
                                ),
                                'contain' => false
                        ));

                        if (!$loginToken) {
                                return false;
                        }

                        $loginToken['LoginToken']['used'] = true;
                        $this->LoginToken->save($loginToken);

                        $conditions = array(
                                'User.id' => $loginToken['LoginToken']['user_id']
                        );
                        break;
                default:
                        return null;
        }

        return $this->find('first', compact('conditions'));
    }

    public $hasMany = array(
        'LoginToken',
        'TaskOwner' => array(
            'className' => 'Task',
            'foreignKey' => 'owner',
            'dependent' => true,
            'conditions' => array('TaskOwner.status' => 'pending'),
            'order' => 'TaskOwner.created DESC'
        ),
        'TaskAssigned' => array(
            'className' => 'Task',
            'foreignKey' => 'assigned_to',
            'dependent' => false,
            'conditions' => array('TaskAssigned.status' => 'pending'),
            'order' => 'TaskAssigned.created DESC'
        ),
        'TaskComment' =>array(
            'className' => 'TaskComment',
            'foreignKey' => 'task_id',
            'dependent' => true,
            'order' => 'TaskComment.created DESC'
        )
    );
    
    public $hasAndBelongsToMany = array(
        'TaskFollower' =>array(
            'className' => 'Task',
            'joinTable' => 'followers',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'task_id',
            'unique' => true
        )
    );

    public function authsomePersist($user, $duration) {
            $token = md5(uniqid(mt_rand(), true));
            $userId = $user['User']['id'];

            $this->LoginToken->create(array(
                    'user_id' => $userId,
                    'token' => $token,
                    'duration' => $duration,
                    'expires' => date('Y-m-d H:i:s', strtotime($duration)),
            ));
            $this->LoginToken->save();

            return "${token}:${userId}";
    }
    
    function beforeSave( $options = Array() ) {
        if($this->validates()) :
            if($this->data['User']['password']):
                $this->data['User']['password'] = AuthSome::hash($this->data['User']['password']);
            else:
                unset($this->data['User']['password']);
            endif;
            return true;
        else :
            return false;
        endif;
    }
	
}
