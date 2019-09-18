








<!-- Main content -->
<section class="content">












    <div class="card">
            <div class="card-header">
              <h3 class="card-title">กิจกรรม</h3>
            </div>
             <div class="card-body">
                <button type="button"  id="add_information" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เพิ่มข้อมูล</button>
             
            



            <!-- /.card-header -->
            <div class="card-body">



  <div class="table-responsive">





              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                       <th>ลำดับ</th>
                  <th>รหัสกิจกรรม</th>
                  <th>ชื่อกิจกรรม</th>
                  <th>คะแนน</th>

                   <th>ประเภทกิจกรรม</th>
                     <th>คะแนนกิจกรรมรอง</th>
                    <th>ช่วงเวลา</th>
                 <th>สถานะ</th>

                  <th>ดำเนินการ</th>
                </tr>
                </thead>
                <tbody>
 










                 <?php













                  foreach($list_provinces as $val => $row) {
$val = $val +1;
$i=0;



                  // if($row->Main_activity ==1){
                  // echo"<td>กิจกรรมรอง</td>";
                  //   }if($row->Main_activity ==2){
                  //    echo"<td>กิจกรรมหลัก</td>";
                  //   }
                  //   if($row->Activity_period==1){
                  // echo"<td>มีระยะเวลา</td>";
                  //       }if($row->Activity_period==0){
                  //    echo"<td>ไม่มีระยะเวลา</td>";
                  //       }

                          echo" <tr>";
                             echo"<td>".$val."</td>";
                  echo"<td>".$row->Activity_code."</td>";
                  echo"<td>".$row->ev_Activity_name."</td>";
                  echo"<td>".$row->ev_point."</td>";
                   if($row->Main_activity ==2){
                  echo"<td>กิจกรรมรอง</td>";
                    }if($row->Main_activity ==1){
                     echo"<td>กิจกรรมหลัก</td>";
                    }

                        if($row->Main_activity_point !=0){
                  echo"<td>".$row->Main_activity_point."</td>";
                    }if($row->Main_activity_point ==0){
                     echo"<td>ไม่มีกิจกรรมรอง</td>";
                    }












                    if($row->Activity_period==1){
                  echo"<td>มีระยะเวลา</td>";
                        }if($row->Activity_period==0){
                     echo"<td>ไม่มีระยะเวลา</td>";
                        }
                    if($row->Status_event==1){                        

                echo"<td>เปิดใช้งาน</td>";
              }if($row->Status_event==0){
                   echo"<td>ปิดใช้งาน</td>";
              }
                     if($row->ev_id!=$row->le_ev_id){
                 echo" <td><a href='".site_url()."adim/C_Add_category/delete/".$row->ev_id."' class='btn btn-danger'>ลบ</button></a>&nbsp;&nbsp;<a  class='btn btn-warning' data-toggle='modal' data-target='#myModal_updata' id='updata'  value='".$row->ev_id."'>แก้ไข</button></a></td>";
               }if($row->ev_id==$row->le_ev_id){
                 echo"<td><a  class='btn btn-warning' data-toggle='modal' data-target='#myModal_updata' id='updata'  value='".$row->ev_id."'>แก้ไข</button></a></td>";
               }
                 
                echo"</tr>";
                                            }?>








             </tbody>
              </table>
            </div>

 </div>

            
        </div>
            <!-- /.card-body -->
          </div>





























<!-- 
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">กิจกรรม</h3>
        </div>

        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">เพิ่มข้อมูล</button>
            <br>
            <br>

            <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>รหัสกิจกรรม</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>คะแนน</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>john@example.com</td>
                    </tr>

                </tbody>
            </table>
        </div>
     
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div> -->








  <form action="<?php echo site_url()."adim/C_Add_category/insert" ?> " name="frmMain1" id="frmMain1" method="post" style="
    margin-bottom: 1px;    " class="needs-validation" novalidate>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">สร้างกิจกรรม</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">รหัสกิจกรรม</span>
                            </div>
                            <input type="text" class="form-control" id="Activity_code_insert" name="Activity_code" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="padding-right: 19px;">ชื่อกิจกรรม</span>
                            </div>
                            <input type="text" class="form-control" id="name_Activity_insert"  name="name_Activity" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="
    padding-right: 45px;
">คะแนน</span>
                            </div>
                            <input type="text" class="form-control" id="score_insert" name="score" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="
    padding-right: 47px;
">สถานะ</span>
                            </div>
                            <select class="form-control" id="sel2" name="sellist1">
                                <option value="1">เปิดใช้งาน</option>
                                <option value="0">ปิดใช้งาน</option>
                            </select>
                        </div>
   <h3 class="card-title">ระยะเวลากิจกรรม</h3>
                        <div class="form-check">
                            <label class="form-check-label" for="radio1">
                                <input type="radio" class="form-check-input" id="radio1" name="Schedule" value="1">กำหนดเวลา



   <div class="form-group" id="time">
       

                  <div class="input-group" >
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id='reservation' name="reservation" required>
                  </div>
                  <!-- /.input group -->
                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio2">
                                <input type="radio" class="form-check-input" id="radio2" name="Schedule" value="0" checked>ไม่กำหนดเวลา
                            </label>
                        </div>












   <h3 class="card-title">กำหนดกิจกรรม</h3>







                        <div class="form-check">
                            <label class="form-check-label" for="radio3">
                                <input type="radio" class="form-check-input" id="radio3" name="nd_activity" value="2">ทำกิจกรรมครั้งที่2

                                <input type="number" class="form-control" id="datetimes1" name="datetimes1" required style="margin-right: 100px;" />

                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio4">
                                <input type="radio" class="form-check-input" id="radio4" name="nd_activity" value="1" checked>ไม่กำหนดกิจกรรมจำนวนครั้ง
                            </label>
                        </div>





















                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                             <button type="submit" id="Record_insert" class="btn btn-success">บันทึก</button>
                </div>

            </div>
                 </div>

            </div>
</form>























  <form action="<?php echo site_url()."adim/C_Add_category/updata" ?> " name="frmMain2" id="frmMain2" method="post" style="
    margin-bottom: 1px;    " class="needs-validation" novalidate>

    <!-- The Modal -->
    <div class="modal" id="myModal_updata">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">สร้างกิจกรรม</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">รหัสกิจกรรม</span>
                            </div>
                            <input type="text" class="form-control" name="Activity_code" id="Activity_code" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="padding-right: 19px;">ชื่อกิจกรรม</span>
                            </div>
                            <input type="text" class="form-control"  name="name_Activity" id="name_Activity" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="
    padding-right: 45px;
">คะแนน</span>
                            </div>
                            <input type="text" class="form-control" name="score" id="score" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="
    padding-right: 47px;
">สถานะ</span>
                            </div>
                            <select class="form-control" id="sel1" name="sellist1" >
                                <option value="1">เปิดใช้งาน</option>
                                <option value="0">ปิดใช้งาน</option>
                            </select>
                        </div>
   <h3 class="card-title">ระยะเวลากิจกรรม</h3>
                        <div class="form-check">
                            <label class="form-check-label" for="radio1">
                                <input type="radio" class="form-check-input" id="radio5" name="Schedule" value="1">กำหนดเวลา



   <div class="form-group" id="time_updata">
       

                  <div class="input-group" >
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id='reservation_updata' name="reservation" required>
                  </div>
                  <!-- /.input group -->
                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio2">
                                <input type="radio" class="form-check-input" id="radio6" name="Schedule" value="0" checked>ไม่กำหนดเวลา
                            </label>
                        </div>










   <h3 class="card-title">กำหนดกิจกรรม</h3>
                        <div class="form-check" id="nd_activity_radio7">
                            <label class="form-check-label" for="radio3">
                                <input type="radio" class="form-check-input" id="radio7" name="nd_activity" value="2">ทำกิจกรรมครั้งที่2

                                <input type="number" class="form-control" id="datetimes_updata" name="datetimes1" style="margin-right: 100px;" required />

                            </label>
                        </div>
                        <div class="form-check" id="nd_activity">
                            <label class="form-check-label" for="radio4">
                                <input type="radio" class="form-check-input" id="radio8" name="nd_activity" value="1" checked>ไม่กำหนดกิจกรรมจำนวนครั้ง
                                  <input type="text" class="form-control" id="user_id" name="user_id"  style='display:none'>
                            </label>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                             <button type="submit" id="Record_updata" class="btn btn-success">บันทึก</button>
                </div>

            </div>
                 </div>

            </div>
</form>



















































</section>

</body>

<script>
    $(document).ready(function() {
        $("#time").hide();
              $("#time_updata").hide();
           $("#datetimes1").hide();
$("#datetimes_updata").hide();


        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    $('#example1').DataTable();




        $("#radio1").click(function() {
               $("#time").show();
        });
        $("#radio2").click(function() {
      $("#reservation").val("");
            $("#time").hide();
        });



        $("#radio5").click(function() {
               $("#time_updata").show();
        });
        $("#radio6").click(function() {
      $("#reservation_updata").val("");
            $("#time_updata").hide();
        });







        $("#radio3").click(function() {
            $("#datetimes1").show();
        });
        $("#radio4").click(function() {
          $("#datetimes1").val("");
            $("#datetimes1").hide();
        });





        $("#radio7").click(function() {
            $("#datetimes_updata").show();
        });
        $("#radio8").click(function() {
          $("#datetimes_updata").val("");
            $("#datetimes_updata").hide();
        });


















    $('#reservation_updata').daterangepicker()



    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })



//   $(document).on("change","input[name*='daterangepicker_end']" ,function() {


// var a=$( "input[name*='daterangepicker_end']" ).val();

// var b=$( "input[name*='daterangepicker_start']" ).val();

// $("#daterangepicker_end").val(a);

// $("#daterangepicker_start").val(a);
//         });




$(document).on("click","[id='updata']",function(){
  var id_address = $(this).attr("value")

//alert(id_address);



  $.get("<?php echo base_url(); ?>adim/C_Add_category/get_product_categories/"+id_address,function(a){
      var result = JSON.parse(a);
      console.log(result)
      for(var i = 0 ; i<result.length;i++){

$('#Activity_code').val(result[i].Activity_code );
$('#name_Activity').val(result[i].ev_Activity_name );
$('#score').val(result[i].ev_point );
$('#sel1').val(result[i].Status_event );
// $('#reservation').val(result[i].daterangepicker_start+'-'+daterangepicker_end );
 $('#datetimes1').val(result[i].Main_activity_point);
 $('#user_id').val(result[i].ev_id);


// $('#radio5').val(result[i].Activity_period  );
var Activity_period=result[i].Activity_period;
var Main_activity=result[i].Main_activity;

if(Main_activity==2){
$('#radio7').click();
$('#datetimes_updata').val(result[i].Main_activity_point );
$('#nd_activity').hide();
$('#nd_activity_radio7').show();

}if(Main_activity==1){
  $('#radio8').click();
$('#nd_activity').show();
$('#nd_activity_radio7').hide();

}


if(Activity_period==1){
$('#radio5').click();
$('#reservation_updata').val(result[i].daterangepicker_start.replace(/-/g,"/")+" "+'-'+" "+result[i].daterangepicker_end.replace(/-/g,"/") );
}else{
  $('#radio6').click();
}
// $('#radio6').click();








      }
    })
})


      $(document).on("click","#Record_insert",function(){
// $("#frmMain1").reset();




        var action = 0;
        var Activity_code_insert=$("#Activity_code_insert").val();
          var name_Activity_insert=$("#name_Activity_insert").val();
var score_insert=$("#score_insert").val();
var radio1= document.getElementById("radio1").checked;/*กุญแจอื่นๆ*/
var reservation=$("#reservation").val();
var radio3= document.getElementById("radio3").checked;/*กุญแจอื่นๆ*/
var datetimes1=$("#datetimes1").val();
var targle = $("#Activity_code_insert").val()
var data = $("#example1").DataTable().data()
data.each(function(a){a[1]==targle?action=1:false})
        if(action){
          $("#Activity_code_insert").css("border-color","#dc3545")
        }
        else{
          $("#Activity_code_insert").css("border-color","")
        }










        if(Activity_code_insert==""||name_Activity_insert==""||score_insert==""){
        $("#frmMain1").addClass("was-validated");
            action = 1
        }
        if(radio1==true){
          if(reservation==""){
               $("#frmMain1").addClass("was-validated");
            action = 1
          }

        }if(radio3==true){
              if(datetimes1==""){
               $("#frmMain1").addClass("was-validated");
            action = 1
          }
        }
            if(action){
        return false;
             }
      });
        

      $(document).on("click","#Record_updata",function(){

        var action = 0;
        var Activity_code=$("#Activity_code").val();
          var name_Activity=$("#name_Activity").val();
var score=$("#score").val();
var radio5= document.getElementById("radio5").checked;/*กุญแจอื่นๆ*/
var reservation_updata=$("#reservation_updata").val();
var radio7= document.getElementById("radio7").checked;/*กุญแจอื่นๆ*/
var datetimes_updata=$("#datetimes_updata").val();


var targle = $("#Activity_code").val()
var data = $("#example1").DataTable().data()
data.each(function(a){a[1]==targle?action=1:false})
        if(action){
          $("#Activity_code").css("border-color","#dc3545")
        }
        else{
          $("#Activity_code").css("border-color","")
        }



        if(Activity_code==""||name_Activity==""||score==""){
        $("#frmMain2").addClass("was-validated");
            action = 1
        }
        if(radio5==true){
          if(reservation_updata==""){
               $("#frmMain2").addClass("was-validated");
            action = 1
          }

        }if(radio7==true){
              if(datetimes_updata==""){
               $("#frmMain2").addClass("was-validated");
            action = 1
          }
        }
            if(action){
        return false;
             }
      });
        

 $(document).on("click","#add_information",function(){
  // $("#frmMain1").reset();
    $("#time").hide();
              $("#datetimes1").hide();
    document.getElementById("frmMain1").reset();
 });

});












    $(function() {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    });
</script>
</body>

</html>