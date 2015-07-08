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
        'FollowerUser' =>array(
            'className' => 'User',
            'joinTable' => 'followers',
            'foreignKey' => 'task_id',
            'associationForeignKey' => 'user_id',
            'unique' => true
        )
    );
    
//    public function saveFowllers($taskId, $followers){  
//        $saveFollowersQuery = "INSERT INTO `followers` (`id`, `user_id`, `task_id`) VALUES ";
//        $count = 0;
//        foreach($followers as $key => $follower){
////            $sql = "SELECT * FROM `followers` WHERE user_id = '$follower' AND task_id = '$taskId'";
//            $sql = "DELETE FROM `followers` WHERE `user_id` = '$follower' AND `task_id` = '$taskId'";
//            $old_follower = $this->query($sql);
//            if(empty($old_follower)){
//                if($count == 0){
//                    $saveFollowersQuery .= "(NULL, '$follower', '$taskId')";
//                }
//                else{
//                    $saveFollowersQuery .= ", (NULL, '$follower', '$taskId')";
//                }
//                $count++;
//            }
//        }
//        $result = $this->query($saveFollowersQuery);
//        return $result;
//    }
    
    
    public function saveFowllers($taskId, $followers){  
        $saveFollowersQuery = "INSERT INTO `followers` (`id`, `user_id`, `task_id`) VALUES ";
        $this->removeFowllers($taskId);
        $count = 0;
        foreach($followers as $key => $follower){
            if($count == 0){
                $saveFollowersQuery .= "(NULL, '$follower', '$taskId')";
            }
            else{
                $saveFollowersQuery .= ", (NULL, '$follower', '$taskId')";
            }
            $count++;
        }
        $result = $this->query($saveFollowersQuery);
        return $result;
    }
    
    public function removeFowllers($taskId){
        $sql = "DELETE FROM `followers` WHERE `task_id` = '$taskId'";
        $this->query($sql);
        return;
    }




//    public function afterSave($created, $options = array()) {
//        //$followers = $this->data['Task']['follower'];
//        print_r($this->data); die;
//        if(!empty($followers)){
//            $taskId = $this->Task->id;
//            App::import('model','Follower');
//            $followerModel = new Follower();
//            $followers = $this->data['Task']['follower'];
//            if($created){
//                $followerData = array();
//                foreach($followers as $follower){
//                    $followerData[] = array(
//                        'user_id' => $follower,
//                        'task_id' => $taskId
//                    );
//                }
//                $followerModel->save($followerData);
//            }
//            else{
//                $followerData = array();
//                foreach($followers as $follower){
//                    $followerModel->recursive = -1;
//                    $old_entry = $followerModel->find('first',array('conditions'=>array('user_id'=>$follower, 'task_id' => $taskId)));
//                    if(!$old_entry){
//                        $followerData[] = array(
//                            'user_id' => $follower,
//                            'task_id' => $taskId
//                        );
//                    }
//                }
//                if(!empty($followerData)){
//                    $followerModel->save($followerData);
//                }
//            }
//        }
//        
//        parent::afterSave($created, $options);
//    }

    
	
}
