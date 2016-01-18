<?php
App::uses('AppModel', 'Model');
/**
 * Activity model for Ad Network Dashboard
 *
 * This model is used to log system wide activities 
 * use the log method to add an activity
 *
 */

class Activity extends AppModel {
    public $name = 'Activity';
    
    public $useTable = "activities";
    
    //public $belongsTo = array('User');
    
    public $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )
        );
    
    function logintry($item_type,$event,$item_id,$user_id=0,$reference_id=0,$description = ""){
		try{
			if($item_type=="user" && !Authsome::get('id')){
				$user_id = $item_id;
			}
			else $user_id = Authsome::get('id');
			$this->save(array('Activity'=>
				array(
					'item_type'		=>	$item_type,
					'event'			=>	$event,
					'item_id'		=>	$item_id,
					'user_id'		=>	$user_id,
					'reference_id'	=>	$reference_id,
					'description'	=>	$description
				)
			));
		} catch (Exception $e) {
			// some how the activity logging is failed!
		}
	}
        
        
        public function has_activity($item = null){
            if(is_array($item)){
                $cond = array();
                if(array_key_exists('item_type', $item)){
                    $cond['item_type'] = $item['item_type'];
                }
                if(array_key_exists('event', $item)){
                    $cond['event'] = $item['event'];
                }
                if(array_key_exists('item_id', $item)){
                    $cond['item_id'] = $item['item_id'];
                }
                if(array_key_exists('reference_id', $item)){
                    $cond['reference_id'] = $item['reference_id'];
                }
//                $activityId = $this->find();
            }
        }






        /**
	 * Overridden paginate method for caching
	 */
//	function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
//		$args = func_get_args();
//		$uniqueCacheId = '';
//		foreach ($args as $arg) {
//			$uniqueCacheId .= serialize($arg);
//		}
//		if (!empty($extra['contain'])) {
//			$contain = $extra['contain'];   
//		}
//		$uniqueCacheId = md5($uniqueCacheId);
//		$pagination = Cache::read('pagination-'.$this->alias.'-'.$uniqueCacheId, 'pagination_cache');
//		if (empty($pagination)) {
//			$pagination = $this->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive', 'group', 'contain'));
//			Cache::write('pagination-'.$this->alias.'-'.$uniqueCacheId, $pagination, 'pagination_cache');
//		}
//		return $pagination;
//	}
	
	/**
	 * Overridden paginateCount method for caching
	 */
//	function paginateCount ($conditions = null, $recursive = 0, $extra = array()) {
//	    $args = func_get_args();
//	    $uniqueCacheId = '';
//	    foreach ($args as $arg) {
//	        $uniqueCacheId .= serialize($arg);
//	    }
//	    $uniqueCacheId = md5($uniqueCacheId);
//	    if (!empty($extra['contain'])) {
//	        $contain = $extra['contain'];   
//	    }
//
//	    $paginationcount = Cache::read('paginationcount-'.$this->alias.'-'.$uniqueCacheId, 'pagination_cache');
//	    if (empty($paginationcount)) {
//	        $paginationcount = $this->find('count', compact('conditions', 'contain', 'recursive'));
//	        Cache::write('paginationcount-'.$this->alias.'-'.$uniqueCacheId, $paginationcount, 'pagination_cache');
//	    }
//	    return $paginationcount;
//	}
	
//    function afterSave($created) {
//        Cache::clear(false, 'pagination');
//    }
//
//    function afterFind($results, $primary = false) {
//        parent::afterFind($results, $primary);
//        //print_r($results); die;
//        return $results;
//    }
}
