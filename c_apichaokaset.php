<?php
    echo "12345678";
    //  $this->load->model('m_api', 'mapi');
    //  $mapi = $this->mapi;
     $post = $_POST;
     //$status_login = 0;
     $a =$post['a'];
     $s =$post['s'];
     $d =$post['d'];
     $f =$post['f'];
     $g =$post['g'];
     $h =$post['h'];
    //  $mapi->aa = $a;
    //  $mapi->ss = $s;
    //  $mapi->dd = $d;
    //  $mapi->ff = $f;
    //  $mapi->gg = $g;
    //  $mapi->hh = $h;
    //  echo json($h);
    //  echo "kijlkjjh";
        echo json_encode($a,$s,$d,$f,$g,$h);
     //$respon =$mapi->insert_review();
     //echo $respon;
       
?>