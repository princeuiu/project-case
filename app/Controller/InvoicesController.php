<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');

class InvoicesController extends AppController {

    public $name = 'Invoices';
    public $uses = array('Invoice', 'Lawsuit', 'Client');

    public function generate($id = null) {
        if (!empty($this->data)) {
            $vat = 15;
            $invoiceData = $this->data;
            $allDesc = $this->data['Invoice']['description'];
            $allAmount = $this->data['Invoice']['amount'];
            $allDeduc = $this->data['Invoice']['deduction'];
            $allDeducAmount = $this->data['Invoice']['less_amount'];

            $descCount = count($allDesc);
            $amountCount = count($allAmount);

            if ($descCount != $amountCount) {
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t generate invoice now, Please try again later.') . '</div>');
                return;
            }
            $descData = array();
            for ($count = 0; $count < $descCount; $count++) {
                $descData[$count] = array(
                    'desc' => $allDesc[$count],
                    'amount' => $allAmount[$count]
                );
            }
            
            $dedDescData = array();
            for ($count = 0; $count < $dedDescData; $count++) {
                $dedDescData[$count] = array(
                    'deduction' => $allDeduc[$count],
                    'amount' => $allDeducAmount[$count]
                );
            }

            $totalAmount = 0;
            foreach ($allAmount as $eachAmount) {
                $totalAmount += $eachAmount;
            }
            $vatAmout = $totalAmount * $vat / 100;
            $finalAmout = $totalAmount + $vatAmout;

            $invoiceData['Invoice']['description'] = serialize($descData);
            $invoiceData['Invoice']['amount'] = $totalAmount;
            $invoiceData['Invoice']['final_amount'] = $finalAmout;
            $invoiceData['Invoice']['vat'] = $vatAmout;
            //print_r($invoiceData); die;

            if ($this->Invoice->save($invoiceData)) {
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Invoice saved successfully.') . '</div>');
                return $this->redirect(array('controller' => 'invoices', 'action' => 'detail', $this->Invoice->id));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save invoice now, Please try again later.') . '</div>');
                return;
            }
        }
        if ($id == null) {
            throw new BadRequestException();
        }
        $this->Lawsuit->id = $id;
        if (!$this->Lawsuit->exists()) {
            throw new NotFoundException(__('Invalid Case'));
        }
        $lawsuitInfo = $this->Lawsuit->read();
        //print_r($lawsuitInfo); die;
        $this->set(compact('lawsuitInfo'));
    }

    public function detail($id = null) {
        if ($id == null) {
            throw new BadRequestException();
        }
        $this->Invoice->id = $id;
        if (!$this->Invoice->exists()) {
            throw new NotFoundException(__('Invalid Case'));
        }
        ini_set('memory_limit', '512M');
        $invoiceData = $this->Invoice->read();

//        $this->pdfConfig = array(
//                'orientation' => 'portrait',
//                'filename' => 'Invoice_' . $id
//            );
//        
        //print_r($invoiceData); die;
        $descriptions = unserialize($invoiceData['Invoice']['description']);
        $amountInWord = $this->convert_number_to_words($invoiceData['Invoice']['amount']);
        $finalAmountInWord = $this->convert_number_to_words($invoiceData['Invoice']['final_amount']);
        $this->set(compact('invoiceData', 'descriptions','amountInWord', 'finalAmountInWord'));
    }

    public function admin_add() {
        if (!empty($this->data)) {
            if ($this->Invoice->save($this->data)) {
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case opened successfully.') . '</div>');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Invoice->id));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t open Case now, Please try again later.') . '</div>');
                return;
            }
        }

        $clients = $this->Client->find('list', array(
            'conditions' => array('Client.status' => 'active')
        ));

        $this->set(compact('clients'));
    }

    public function admin_edit($id) {
        if ($id == null) {
            throw new BadRequestException();
        }
        $this->Invoice->id = $id;

        if (!empty($this->data)) {
            if ($this->Invoice->save($this->data)) {
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Invoice->id));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Case now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Invoice->id));
            }
        }

        $this->data = $this->Invoice->read();

        $clients = $this->Client->find('list', array(
            'conditions' => array('Client.status' => 'active')
        ));

        $this->set(compact('clients'));


        $this->render('admin_add');
    }

    public function admin_index() {
        extract($this->params["named"]);

        if (isset($search)) {
            $options["Invoice.title like"] = "%$search%";
        } else
            $search = "";

        $this->paginate["Invoice"]["order"] = "Invoice.created DESC";

        $items = $this->paginate('Invoice', $options);


        //pr($items);
        $this->set(compact('items', 'search'));


        //$this->set("search",$search);
    }

    public function test() {
        throw new BadRequestException();
    }

    public function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    function admin_remove_image($name) {
        $this->Invoice->updateAll(array("image" => "''"), array("image" => "$name"));
        @unlink(WWW_ROOT . "img/items/original/" . $name);
        @unlink(WWW_ROOT . "img/items/resize/" . $name);
        @unlink(WWW_ROOT . "img/items/thumb/" . $name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }

}
