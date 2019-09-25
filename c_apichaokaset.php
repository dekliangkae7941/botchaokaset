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
    $data = array('a' => "$a", 's' => "$s", 'd' => "$d", 'f' => "$f", 'g' => "$g", 'h' => "$h" );
    //$body = Unirest\Request\Body::json($data);
        echo json_encode($data);
     //$respon =$mapi->insert_review();
     //echo $respon;
       
?>