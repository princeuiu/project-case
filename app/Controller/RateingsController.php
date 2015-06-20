<?php

App::uses('AppController', 'Controller');


class RateingsController extends AppController {

    public $name = 'Rateings';
    
    public $uses = array('Rateing','Item');
    
    public function ajax_rated() {
        $dataPost = $_POST['data'];
        $data = $dataPost['value'];
        if(!empty($data)){
            foreach($data as $eachData){
                $rating = $eachData[3];
                $itemId = $eachData[0];
                $ratingData = array(
                    'Rateing' => array(
                        'item_id' => $eachData[0],
                        'rateing' => $rating,
                        'email' => $eachData[1],
                        'comment' => $eachData[2]
                    )
                );
                //print_r($ratingData); exit;
                $options = array(
                    'conditions' => array('Item.id' => $itemId), //array of conditions
                    'recursive' => -1, //int
                    //array of field names
                    'fields' => array('Item.id','Item.rating')
                );
                $itemData = $this->Item->find('all',$options);
                //Echo print_r($itemData); exit;
                
                $prevRating = $itemData[0]['Item']['rating'];
                if($prevRating < 1){
                    $overAllRating = $rating;
                }
                else{
                    $overAllRating = ($rating+$prevRating)/2;
                }
                $this->Rateing->create();
                if($this->Rateing->save($ratingData)){
                    $this->Item->id = $itemData[0]['Item']['id'];
                    $this->Item->set(array(
                                'rating' => $overAllRating
                            ));
                    $this->Item->save();
                    unset($ratingData, $itemData,$options);
                }
                else{
                    Echo false;
                    exit;
                }
            }
            unset($_SESSION['rateIds']);
            Echo true;
            exit;
        }
        Echo false;
        exit;
    }
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Department->id = $id;
        if(!empty($this->data)){
            if($this->Department->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Department updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'departments', 'action' => 'edit', $this->Department->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Department now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'departments', 'action' => 'edit', $this->Department->id));
            }
        }

        $this->data = $this->Department->read();

        
        $this->render('admin_add');
    }
    
    

}
