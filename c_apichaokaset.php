<?php
echo "12345678";
function index_api() 
    { 
     $this->load->model('m_api', 'mapi');
     $mapi = $this->mapi;
     
     $post = $_POST;
     //$status_login = 0;
     $a =$post['a'];
     $s =$post['s'];
     $d =$post['d'];
     $f =$post['f'];
     $g =$post['g'];
     $h =$post['h'];
     $mapi->aa = $a;
     $mapi->ss = $s;
     $mapi->dd = $d;
     $mapi->ff = $f;
     $mapi->gg = $g;
     $mapi->hh = $h;
     echo $h;
     echo "kijlkjjh";
     //$respon =$mapi->insert_review();
     //echo $respon;
       
    }
?>