<?php

App::uses('Permit', 'Sanction.Controller/Component');

Permit::access(
        array('controller' => array('Users'), 'action' => array('login', 'logout', 'register')),
        array(),
        array()
);



?>