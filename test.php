<html lang="en">

<head>
    <title>Krajee JQuery Plugins - © Kartik</title>

    <!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    <!-- the font awesome icon library if using with `fas` theme (or Bootstrap 4.x). Note that default icons used in the plugin are glyphicons that are bundled only with Bootstrap 3.x. -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x (for popover and tooltips). You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- the main fileinput plugin file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>
    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/th.js"></script>

</head>

<body>
  <script>
    var count=1;
        var count1=1;
         var count2=1;
    $(document).ready(function() {


   




      $(document).on("click",".DeleteRow1",function(){
          if($(".DeleteRow1").length > 1){
            $(this).parent().parent().remove()

count1--;

}
 action1 = 1 ;
 $("[name^=delivery_Topic]").each(function(){
     $(this).attr("name","delivery_Topic"+action1);
     $(this).closest("tr").find("[name^=delivery_Description]").attr("name","delivery_Description"+action1);
     action1++
 })
})











      $(document).on("click",".DeleteRow2",function(){
          if($(".DeleteRow2").length > 1){
            $(this).parent().parent().remove()
count2--;
}

 action2 = 1 ;
 $("[name^=Return_Policy_Topic]").each(function(){
     $(this).attr("name","Return_Policy_Topic"+action2);
     $(this).closest("tr").find("[name^=Return_Policy_comment]").attr("name","Return_Policy_comment"+action2);
     action2++
 })
   
        })

      $(document).on("click",".DeleteRow3",function(){
          if($(".DeleteRow3").length > 1){
            $(this).parent().parent().remove()
count--;
}

 action = 1 ;
 $("[name^=Details_Topic]").each(function(){
     $(this).attr("name","Details_Topic"+action);
     $(this).closest("tr").find("[name^=Details_Description]").attr("name","Details_Description"+action);
     action++
 })     
        })
  $("#add1").click(function(){
 $(".add1").each(function(){
    $("#b").append("  <tr>"+
      "<td><div class='form-group'><input type='text' class='form-control' id='delivery_Topic' name='delivery_Topic[]'></div></td>"+
                                "<td><div class='form-group'><textarea class='form-control' rows='5' id='delivery_comment' name='delivery_Description[]'></textarea></div></td>"+
                          "<td><button type='button' class='btn btn-danger DeleteRow1'>ลบ</button></td>"+
                            "</tr>");
          count1++;
            console.log(count1);
});
  });
  $("#add_2").click(function(){

 $(".add_2").each(function(){

    $("#a").append("  <tr>"+
                          // " <td><div class='form-group'><input type='text' class='form-control' id='Return_Policy_Topic' name='Return_Policy_Topic"+count2+"'></div></td>"+
                          //      " <td><div class='form-group'><textarea class='form-control' rows='5' id='Return_Policy_comment' name='Return_Policy_comment"+count2+"'></textarea></div></td>"+
                              " <td><div class='form-group'><input type='text' class='form-control' id='Return_Policy_Topic' name='Return_Policy_Topic[]'></div></td>"+
                               " <td><div class='form-group'><textarea class='form-control' rows='5' id='Return_Policy_comment' name='Return_Policy_comment[]'></textarea></div></td>"+
                          "<td><button type='button' class='btn btn-danger DeleteRow2'>ลบ</button></td>"+
                            "</tr>");
      count2++;
  });

});

function get_list(){
    var data = $('#file-upload-demo').fileinput('getPreview')
    var result = JSON.stringify(data["config"])
    console.log(data["config"])
    $('[name="Image"]').val(result)
    console.log($('[name="Image"]').val())
}


       $("#file-upload-demo").fileinput({
        allowedFileExtensions: ['jpg', 'png', 'gif'],
            'theme': 'fas',
            'uploadUrl': '/API_Controll/adim/C_edit_items/update_image',
            'deleteUrl': "/API_Controll/adim/C_edit_items/delete_image",
            uploadAsync: false,
            overwriteInitial: false,
            minFileCount: 1,
            initialPreviewAsData: true, 
            initialPreview: [
             <?php foreach($image_list->result() as $key => $row){ 
                  echo '"'.base_url($row->image_path).'",';
                } ?>
             ],
            initialPreviewConfig: [
             <?php foreach($image_list->result() as $key => $row){ 
                  echo '{"key" : "'.$row->image_path.'"},';
                } ?>
            ]
        }).on("filebatchselected", function(event, files) {
     $("#file-upload-demo").fileinput("upload");
});
        $("#file-upload-demo").on("filesorted",function(a,b){
           get_list()
        })
        $("#file-upload-demo").on("filebatchuploadcomplete",function(a,b,c,d,e){
            get_list()
        })
        $("#file-upload-demo").on("filedeleted",function(a,b,c,d,e){
            get_list()
        })



      $(document).on("click","#Record_insert",function(){

        var action = 0;
        var Product_Name=$("#Product_Name").val();
        var product_code=$("#product_code").val();
         var price=$("#price").val();
             var Number_of_products=$("#Number_of_products").val();



        if(Product_Name==""||product_code==""||price==""||Number_of_products==""){
        $("#frmMain2").addClass("was-validated");
            action = 1
        }
            if(action){
        return false;
             }
      });
get_list()    

      $(document).on("click","#Record_insert",function(){

        var action = 0;
        var Product_Name=$("#Product_Name").val();
        var product_code=$("#product_code").val();
         var price=$("#price").val();
             var Number_of_products=$("#Number_of_products").val();



        if(Product_Name==""||product_code==""||price==""||Number_of_products==""){
        $("#frmMain2").addClass("was-validated");
            action = 1
        }
            if(action){
        return false;
             }
      });
        


$("#add1").click()
$("#add_2").click()
$("#add3").click()

   



var Status=$("#Status").val();
$("#Status_update").val(Status);


var m=$("#manu").val();
// alert(m);

$("#sel1").val(m)


 });






</script>

<section class="content">



<div class="card">
      <!--         <div class="card-header">
                <h3 class="card-title">Condensed Full Width Table</h3>
              </div> -->
              <!-- /.card-header -->

    



        <div class="container kv-main">
            <div class="page-header">
                <h1>กรุณาใส่รูปสินค้า
        </h1>
            </div>
 <form action="<?php echo site_url()."/adim/C_edit_items/update" ?> "  name="frmMain2" id="frmMain2" method="post" class="form-horizontal" class="needs-validation" novalidate  >
          
                <input id="file-upload-demo" name="imageUpload[]" type="file" multiple>
                <input type="text" name="Image" style="display:none">
                <br>
           











            <div class="container-fluid">
                <div class="row">
                    <div class="col-9 bg-while" style="
    bottom: 60px;
">
                        <p>
                           

                                <br />

                                <div class="container mt-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="
    padding-right: 115px;
" >ชื่อสินค้า:</span>
                                        </div>


                                            <?php
                                             foreach($list_provinces as $row) {
                                               echo " <input type='text' class='form-control' id='Product_Name' name='Product_Name' value='".$row->name_product."' required>";
                                            }?>


                                       

                                    </div>


  <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="
    padding-right: 115px;
" >รหัสสินค้า:</span>
                                        </div>
                                           <?php
                                             foreach($list_provinces as $row) {
                                       echo  "<input type='text' class='form-control' id='product_code' name='product_code' value='".$row->product_code_additems."' required>";
                                          echo  " <input type='text' class='form-control' id='manu' name='manu' value='".$row->Produt_category."' style='display:none'>";
}?>
                                    </div>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">กรุณาเลือกประเภทสินค้า:</span>
                                        </div><?php //var_dump($list_cat); ?>

                                        <select class="form-control" id="sel1" name="sellist1">
                                            <?php foreach($list_cat->result() as $row) {
                                               echo "<option value='".$row->id."'>".$row->ad_Product_category."</option>";
                                            }?>
                                        </select>
                                        <div class="input-group-append">

                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="
    padding-right: 138px;
">ราคา:</span>
                                        </div>


                                          <?php
                                             foreach($list_provinces as $row) {
                                       echo  "<input type='number' class='form-control'  id='price' name='price'  value='".$row->price."' required>";

                                        echo  " <input type='text' class='form-control' id='Category_id_updat' name='id_updat' value='".$row->id_items."' style='display:none' >";
                                     
}?>




                                        
                                        <div class="input-group-append">
                                            <span class="input-group-text">บาท</span>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="
    padding-right: 94px;
" >จำนวนสินค้า</span>
                                        </div>

<?php
                                             foreach($list_provinces as $row) {
                                              echo " <input type='number' class='form-control' name='Number_of_products' id='Number_of_products' value='".$row->Number_of_products."' required>";
                                            
                                             } ?>

                                       
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="
    padding-right: 23px;
">ชิ้น</span>
                                        </div>
                                    </div>



 <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="
    padding-right: 84px;
" >สินค่าคงเหลือ</span>
                                        </div>

<?php
                                             foreach($list_provinces as $row) {
                                              echo " <input type='number' class='form-control' id='Number_of_products1' value='".$row->sum."' readonly>";
                                            
                                             } ?>

                                       
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="
    padding-right: 23px;
">ชิ้น</span>
                                        </div>
                                    </div>










                                             <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="
    padding-right: 132px;
">สถานะ</span>
                            </div>




<?php
          foreach($list_provinces as $row) {
                                              echo " <input type='number' class='form-control' id='Status' value='".$row->Status."' style='display:none'>";
                                            
                                             } ?>



                            <select class="form-control" id="Status_update" name="Status" >
                                <option value="1">เปิดใช้งาน</option>
                                <option value="0">ปิดใช้งาน</option>
                            </select>
                        </div>

                        </p>
                        </div>
                        <div class="col-3 bg-while">
                        </div>
                    </div>
                </div>




 <div class="container mt-3">

                
                        <label for="comment">
                        
               <h2>รายละเอียดสินค้า:</h2><button type="button" class="btn btn-success add1" id="add1" >เพิ่มตารางหัวข้อ</button></label>
                        
                    </div>
         

         



   <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>หัวข้อ</th>
                                <th>เนื้อหา</th>
                                 <th>ดำเนินงาน</th>
                               
                            </tr>
                        </thead>
                        <tbody id="b">
                            <tr>
         
                            </tr>
                         
                        </tbody>

                    </table>



<br>

<hr>
<br>












  <div class="container mt-3">

                    <div class="form-group">
                        <label for="comment">
                        
                <h2>การจัดส่งสินค้า:</h2><button type="button" class="btn btn-success add_2" id="add_2" >เพิ่มตารางหัวข้อ</button></label>
                        
                    </div>
         

         



   <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>หัวข้อ</th>
                                <th>เนื้อหา</th>
                               <th>ดำเนินงาน</th>
                            </tr>
                        </thead>
                        <tbody id="a">
                            <tr>
         
                            </tr>
                         
                        </tbody>

                    </table>



<br>

<hr>
<br>

<!-- 
 <div class="container mt-3">

                    <div class="form-group">
                        <label for="comment">
                        
                <h2>นโยบายการคืนสินค้า:</h2><button type="button" class="btn btn-success add3" id="add3" >เพิ่มตารางหัวข้อ</button></label>
                        
                    </div> -->
         

         




<!--    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>หัวข้อ</th>
                                <th>เนื้อหา</th>
                               <th>ดำเนินงาน</th>
                            </tr>
                        </thead>
                        <tbody id="c">
                            <tr>
                                   
                        
                            </tr>
                         
                        </tbody>

                    </table> -->



<br>

<br>







<div class="row">
  <div class="col-sm"> <button type="reset" class="btn btn-warning">Reset</button></div>
  <div class="col-sm"></div>
  <div class="col-sm"></div>
  <div class="col-sm d-flex justify-content-end"><button type="submit" id="Record_insert"  class="btn btn-success">Save</button></div>
</div>
<br>




</form>


        </div>

             
       </section >
</body>


</html>