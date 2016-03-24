<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');

class InvoicesController extends AppController {

    public $name = 'Invoices';
    public $uses = array('Invoice', 'Lawsuit', 'Client','Cost');

    public function generate($id = null) {
        //$this->check_access(array('manager','admin'));
        $this->check_access(array('employee', 'manager','admin'));

        if (!empty($this->data)) {
//            print_r($this->data); die;
            $printPDF = false;
            if(isset($_POST['btnPrintPDF'])){
                $printPDF = true;
            }
            $vat = 15;
            $tax = 10;
            $invoiceData = $this->data;
            $lawsuitId = $invoiceData['Invoice']['lawsuit_id'];
            $invoicePeriod = $invoiceData['Invoice']['lawsuit_invoice_period'];
            //print_r($invoiceData); die;
            $allCostIds = $this->data['Invoice']['cost_id'];
            $allCostQtys = $this->data['Invoice']['cost_qty'];
            $costsCount = count($allCostIds);
            
            $allCostsList = array();
            for ($count = 0; $count < $costsCount; $count++) {
                $allCostsList[$allCostIds[$count]] = $allCostQtys[$count];
            }
            
            $costsInfo = $this->Cost->find('all', array(
                    'conditions' => array('Cost.id' => $allCostIds),
                    'recursive' => -1,
                    'fields' => array('Cost.id', 'Cost.name', 'Cost.price'),
                ));
            
            $allCostsData = array();
            
            $totalFixedCost = 0;
            
            foreach($costsInfo as $eachCost){
                $qty = $allCostsList[$eachCost['Cost']['id']];
                if($qty != 0){
                    $allCostsData[] = array(
                        'name' => $eachCost['Cost']['name'],
                        'price' => $eachCost['Cost']['price'],
                        'qty' => $qty
                    );
                }
                $totalFixedCost += $eachCost['Cost']['price'] * $qty;
            }
//            print_r($allCostsData); die;
            
            
            $allVCosts = $this->data['Invoice']['v_cost'];
            $allVCostAmounts = $this->data['Invoice']['v_amount'];
            $allDesc = $this->data['Invoice']['description'];
            $allAmount = $this->data['Invoice']['amount'];
            
            
            
            
            $vCostsCount = count($allVCosts);
            
            $vCostsData = array();
            for ($count = 0; $count < $vCostsCount; $count++) {
                if($allVCosts[$count] != ''){
                    $vCostsData[$count] = array(
                        'vCost' => $allVCosts[$count],
                        'amount' => $allVCostAmounts[$count]
                    );
                }
            }
//            print_r($vCostsData); die;
            $totalVCostsAmount = 0;
            foreach ($allVCostAmounts as $eachVcostAmount) {
                $totalVCostsAmount += $eachVcostAmount;
            }
//            echo $totalVCostsAmount; die;
            
            $descCount = count($allDesc);

//            if ($descCount != $amountCount) {
//                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t generate invoice now, Please try again later.') . '</div>');
//                return;
//            }
            $descData = array();
            for ($count = 0; $count < $descCount; $count++) {
                $descData[$count] = array(
                    'desc' => $allDesc[$count],
                    'amount' => $allAmount[$count]
                );
            }
            
//            print_r($descData); die;

            $totalAmount = 0;
            $totalProFees = 0;
            foreach ($allAmount as $eachAmount) {
                $totalProFees += $eachAmount;
            }
//            echo $totalProFees; die;
            
            
            
//            echo $totalAmount; die;
            $vatAmount = 0;
            if(isset($invoiceData['Invoice']['vat']) && $invoiceData['Invoice']['vat'] == true){
                $vatAmount = $totalProFees * $vat / 100;
                $invoiceData['Invoice']['vat'] = $vat;
                $totalProFees += $vatAmount;
            }
            else{
                $invoiceData['Invoice']['vat'] = 0;
            }
            
            $totalAmount = $totalFixedCost + $totalVCostsAmount + $totalProFees;
            
            $taxAmount = 0;
            if(isset($invoiceData['Invoice']['tax']) && $invoiceData['Invoice']['tax'] == true){
                $taxAmount = $totalProFees * $tax / 100;
                $invoiceData['Invoice']['tax'] = $tax;
            }
            else{
                $invoiceData['Invoice']['tax'] = 0;
            }
            
            //$vatAmout = $totalAmount * $vat / 100;
            $finalAmout = $totalAmount - $vatAmount - $taxAmount;

            $invoiceData['Invoice']['f_cost'] = serialize($allCostsData);
            $invoiceData['Invoice']['f_amount'] = $totalFixedCost;
            $invoiceData['Invoice']['v_cost'] = serialize($vCostsData);
            $invoiceData['Invoice']['v_amount'] = $totalVCostsAmount;
            $invoiceData['Invoice']['description'] = serialize($descData);
            $invoiceData['Invoice']['amount'] = $totalProFees;
            $invoiceData['Invoice']['total_amount'] = $totalAmount;
            $invoiceData['Invoice']['vat_amount'] = $vatAmount;
            $invoiceData['Invoice']['tax_amount'] = $taxAmount;
            $invoiceData['Invoice']['total_deduction'] = $vatAmount + $taxAmount;
            $invoiceData['Invoice']['final_amount'] = $finalAmout;
            unset($invoiceData['Invoice']['cost_id']);
            unset($invoiceData['Invoice']['cost_qty']);
//            print_r($invoiceData); die;

            if ($this->Invoice->save($invoiceData)) {
                $this->Lawsuit->id = $lawsuitId;
                switch ($invoicePeriod){
                    case '1':
                        $this->Lawsuit->saveField('invoice_period', '2');
                        break;
                    case '2':
                        $this->Lawsuit->saveField('invoice_period', '3');
                        break;
                }
                if($printPDF){
                    return $this->redirect(array('controller' => 'invoices', 'action' => 'detail', $this->Invoice->id.'.pdf'));
                }
                else{
                    $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Invoice saved successfully.') . '</div>');
                    return $this->redirect(array('controller' => 'invoices', 'action' => 'index'));
                }
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
        $costList = $this->Cost->find('list', array(
            'conditions' => array('Cost.status' => 'active'),
            'recursive' => -1
        ));
        $costListArr = $this->Cost->find('all', array(
            'conditions' => array('Cost.status' => 'active'),
            'recursive' => -1,
            'fields' => array('Cost.id','Cost.name')
        ));
//        $costListing = array();
//        foreach($costListArr as $eachCost){
//            $costListing[] = array(
//                'id' => $eachCost['Cost']['id'],
//                'name' => $eachCost['Cost']['name']
//            );
//        }
//        $costListTxt = json_encode($costListing);
//        echo $costListTxt; die;
//        print_r($costListArr); die;
        $this->set(compact('lawsuitInfo','costList'));
    }

    public function detail($id = null) {
        $this->check_access(array('manager','admin'));

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
        $fCosts = array(); $vCosts = array();
        if(!empty($invoiceData['Invoice']['f_cost'])){
            $fCosts = unserialize($invoiceData['Invoice']['f_cost']);
        }
        if(!empty($invoiceData['Invoice']['v_cost'])){
            $vCosts = unserialize($invoiceData['Invoice']['v_cost']);
        }
//        print_r($fCosts); die;
        $descriptions = unserialize($invoiceData['Invoice']['description']);
        $finalAmountInWord = $this->convert_number_to_words($invoiceData['Invoice']['final_amount']);
        $this->set(compact('invoiceData', 'descriptions', 'fCosts', 'vCosts', 'finalAmountInWord'));
    }
    
    public function paid($id = null){
        $this->check_access(array('manager','admin'));

        if ($id == null) {
            throw new BadRequestException();
        }
        $this->Invoice->id = $id;
        $this->Invoice->saveField('status', 'paid');
        $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Invoice updated successfully.') . '</div>');
        return $this->redirect(array('controller' => 'invoices', 'action' => 'index'));
    }

    public function edit($id) {
        $this->check_access(array('manager','admin'));

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

    public function index() {
        $this->check_access(array('manager','admin'));
//        extract($this->params["named"]);
//
//        if (isset($search)) {
//            $options["Invoice.title like"] = "%$search%";
//        } else
//            $search = "";
//
//        $this->paginate["Invoice"]["order"] = "Invoice.created DESC";
        
        $this->Paginator->settings = array(
                'limit' => 10,
                'order' => 'Invoice.created DESC'
            );
        
        $items = $this->Paginator->paginate('Invoice');

        //print_r($items); die;
        //pr($items);
        $this->set(compact('items'));


        //$this->set("search",$search);
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
