<?php

App::uses('Permit', 'Sanction.Controller/Component');
//App::import('Component', 'PermitComponent');

Permit::access(
        array('controller' => array('Users'), 'action' => array('login', 'logout', 'register')),
        array(),
        array()
);



/*
 * access rule for both admin and employee
 */

//Permit::access(
//    array('controller' => array('Tasks', 'Lawsuits', 'Clients'), 'action' => array('admin_list','admin_index')),
//    array('auth' => array('User.role' => array('employee', 'admin'))),
//    array('redirect' => array('controller'=>'users','action'=>'login'), 'message' => '<div class="alert alert-danger">' . __('You must be logged in as admin or manager to view this resource' . '</div>', true))
//);



/*
 * rule for every one
 */

//Permit::access(
//    array('controller' => array('Tasks','Dashboard','Histories','TaskComments')),
//    array('auth' => array('User.role' => array('employee'))),
//    array('redirect' => array('controller' => 'users', 'action' => 'login'),
//        'message' => '<div class="alert alert-danger">' . __('You must be logged in to view this resource', true)  . '</div>',
//        
//    )
//);

/*
 * access rule for admin only
 */

//Permit::access(
//    array('controller' => array('Tasks', 'Lawsuits', 'Clients','Dashboard','Histories','Invoices','TaskComments')),
//    array('auth' => array('User.role' => array('admin'))),
//    array('redirect' => array('controller' => 'users', 'action' => 'login'),
//        'message' => '<div class="alert alert-danger">' . __('You must be logged in to view this resource', true)  . '</div>',
//        
//    )
//);

//Permit::access(
//    array('controller' => array('Tasks', 'Lawsuits', 'Clients','Dashboard','Histories','Invoices','TaskComments')),
//    array('auth' => array('User.role' => array('employee'))),
//    array('redirect' => array('controller' => 'users', 'action' => 'login'),
//        'message' => '<div class="alert alert-danger">' . __('You must be logged in to view this resource', true)  . '</div>',
//        
//    )
//);








?>