<?php error_reporting(0);
ini_set('display_errors', 0);?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1 " charset="utf-8">
<style type="text/css">
  .page {
    width:18.5cm;
    min-height: 27.7cm;
    padding: 10px 10px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding:10px 10px;
    border: 1px solid #000;
    height: 285mm;
}
@page {
    margin: 5px;
}
@media print {
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}
/*p{
  text-align: center;
  margin: 5px;
}*/
/*table.logotitle{
  width:100%;
  height:50px;
}*/
table.logotitle tr td p{
  text-align: right;
}
/*table.logotitle tr td div.logo img.logo-fav{
  width:80px;
  height:50px;
}*/
/*td.text-left-title h2{
  text-align: left;
}*/
table.cb-info{
  border-left:1px solid #000000;
  width:100%;
}
table.cb-info tr th,
table.cb-info tr td{
  padding: 3px;
  border-right:1px solid #000000;
  border-bottom:1px solid #000000;
  text-align: center;
}
table.cb-info tr th.chequename{
  width:30%;
}
div.logo{
  width:65%;
  padding: 5px;
}
table.table-info tr td.same-width{
  width:40%;
}
.title_lable{
  font-size: 12px;
}
tr.last-bottom td {
    border-bottom: 1px solid black;
}
span {
  content: "\20B9";
}
.logo img{
  width: 100%;
  height: auto;
}
td.text-left.student-info p {
    text-align: left;
}
table.student-info tr td ,th{
    border: 0.5px solid #CCC;
    padding: 4px;
    /*text-align: center;*/
}
table.student-info .bottom-border {
    border-bottom: 1px solid #000;
    text-align: center;
}

.titel{
    font-size: 13px;
    padding-right: 10px !important;
    
    border: 1px solid;
}
table.party_info_bill p {
    text-align: left !important;
    padding-left: 10px;
}
td.client-info {
    border-right: 1px solid #000 !important;
}
td.bill-info p {
    text-align: right !important;
}
@media print {
   /* .bg {
        background-color: black !important;
        -webkit-print-color-adjust: exact; 
    }*/
    .no1{
      
     /* background-color: #000;*/
      padding: 10px !important;
      width:50px;
      color: #000 !important;
    }
    
}
</style>
</head>
<body>
  <?php $h=2; ?>
  <div class="book">
    <div class="page">
      <div class="subpage">
       <table class="logotitle" cellspacing="0" width="100%">
          <tr>
            <td width="12%">
              <div class="logo">
                <?php if (getOptionValue('site_logo')) {?>
                    <img src="<?php echo base_url().'media/users/'.getOptionValue('site_logo');?>"  alt="Porto Admin"  width="100px" style="text-align: center;"/>
                <?php } else {?>
                    <h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
                <?php } ?>
              </div>
            </td>
            <td width="76%">
              <h1 style="margin-left: 50px;background-color:#000;color:#fff;">&nbsp;<?php echo (getOptionValue('title')); ?> &nbsp;</h1>&nbsp;
                  <h2 style="margin-left: 50px;">હણોલ પરીવાર ની યાદી </h2>
                  <p><center>www.hanolgam.com</center></p>
            </td>
            <td  width="12%">
                <h1 style="border:2px solid #000;border-radius: 50px; background-color: #000;color: #fff;">&nbsp;1&nbsp;&nbsp;</h1>
            </td>
          </tr>
        </table>
        <hr>
        <div style="overflow-x:auto;">
          <table class="tbl-info student-info" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
            <thead>
              <tr>
                <th width="15%">ક્રમ </th>    
                <th width="45%">નામ</th>
                <th width="25%">સભ્યો</th>
                <th width="25%">ટોટલ પરિવાર સભ્યો</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; $g=0; $o=0;foreach ($listofsurname as $key2) { 
                ?>
                <tr> 
                  <td style="text-align: center;"><?php echo $n; ?></td>
                  <td style="font-size: 13px !important;"><?php echo $key2['title']; ?></td>
                 
                  <td style="font-size: 13px !important;text-align: center;"><?php echo $key2['count'] ?></td>
                  <td style="font-size: 13px !important;text-align: center;"><?php echo $key2['total_member']==''? 00 : $key2['total_member'] ;  ?></td>
                </tr>
                
              <?php $n++; $g = $g + $key2['count']; $o = $o + $key2['total_member'];
             }?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan=2><b><center>Total :-</center></b></td>
                <td style="text-align: center;"><b><?php echo $g; ?></b></td>
                <td style="text-align: center;"><b><?php echo $o; ?></b></td>

              </tr>
            </tfoot>
         </table>
        </div>
      </div>
    </div>
    <div class="page">
      <div class="subpage">
        <!-- logo start -->
        <table class="logotitle" cellspacing="0" width="100%">
          <tr>
            <td width="12%">
              <div class="logo">
                <?php if (getOptionValue('site_logo')) {?>
                    <img src="<?php echo base_url().'media/users/'.getOptionValue('site_logo');?>"  alt="Porto Admin"  width="100px" style="text-align: center;"/>
                <?php } else {?>
                    <h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
                <?php } ?>
              </div>
            </td>
            <td width="76%">
              <h1 style="margin-left: 50px;background-color:#000;color:#fff;">&nbsp;<?php echo (getOptionValue('title')); ?> &nbsp;</h1>&nbsp;
             
                <?php if($status=='full') {
                $m=count($data);
                $q=1;$l=1;


                foreach ($data as $key => $value) {  
                  ?>
                  <h2 style="margin-left: 50px;"><?php echo $key; ?> પરીવાર ની યાદી </h2>
                  <p><center>www.hanolgam.com</center></p>
            </td>
            <td  width="12%">
                <h1 style="border:2px solid #000;border-radius: 50px; background-color: #000;color: #fff;">&nbsp;<?php echo $h; ?>&nbsp;&nbsp;</h1>
            </td>
          </tr>
        </table>  
        <hr>
        <div style="overflow-x:auto;">
          <table class="tbl-info student-info" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
            <tr>
              <th width="5%">ક્રમ </th>
              <th width="10%">ફોટો</th>
              <th width="25%">નામ</th>
              <th width="35%">એડ્રેસ</th>
              <th width="5%">બ્લડગ્રૂપ</th>
              <th width="5%">સભ્યો</th>
              <th width="10%">મોબાઇલ</th>
            </tr>
          <?php $i=1;$j=1; foreach ($value as $key1) { 
            ?>
            <tr> 
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td><center><?php if ($key1['photo']) {?>
                    <img class="" src="<?php echo base_url(); ?>media/member/<?php echo $key1['photo']; ?>" width="35px">
                 <?php } else {?>                                        
                    <img class="" src="<?php echo base_url(); ?>media/Admin.png" width="35px">
              <?php }?></center></td> 
            <td style="font-size: 13px !important;"><?php echo $key1['title']; ?> <?php echo $key1['name']; ?> <?php echo $key1['fname']; ?> </td>
            <td style="font-size: 13px !important;"><?php echo $key1['address']; ?> </td>
            <td style="font-size: 13px !important;text-align: center;"><?php echo $key1['bgroup']=='Not Selected' ? '-' : $key1['bgroup']; ?> </td>
            <td style="font-size: 13px !important;text-align: center;"><?php echo $key1['total_member'];?> </td>
            <td style="font-size: 13px !important;text-align: center;"><?php echo $key1['mobile']; ?></td>
            </tr>
          <?php $i++;$j++;
          if($j==21) { $h=$h+1;?>
         </table>
        </div>
    </div>
  </div>
  <div class="page">
    <div class="subpage">
      <table class="logotitle" cellspacing="0" width="100%">
        <tr>
          <td width="12%">
            <div class="logo">
              <?php if (getOptionValue('site_logo')) {?>
                  <img src="<?php echo base_url().'media/users/'.getOptionValue('site_logo');?>"  alt="Porto Admin" width="100px" style="text-align: center;"/>
              <?php } else {?>
                  <h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
              <?php } ?>
              
            </div>
          </td>
          <td width="76%">
            <h1 style="margin-left: 50px;background-color:#000;color:#fff;">&nbsp;<?php echo (getOptionValue('title')); ?> &nbsp;</h1>&nbsp;
            <h2 style="margin-left: 50px;"><?php echo $key1['title'] ?> પરીવાર ની યાદી</h2>
            <p><center>www.hanolgam.com</center></p>          
          </td>
          <td  width="12%">
              <h1 style="border:2px solid #000;border-radius: 50px;background-color: #000;color: #fff;">&nbsp;<?php echo $h; ?>&nbsp;&nbsp;</h1>
          </td>
        </tr>
    </table>  
  <hr>
  <div style="overflow-x:auto;">
     <table class="tbl-info student-info" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
      <tr>
        <th width="5%">ક્રમ </th>
        <th width="10%">ફોટો</th>
        <th width="25%">નામ</th>
        <th width="35%">એડ્રેસ</th>
        <th width="5%">બ્લડગ્રૂપ</th>
        <th width="5%">સભ્યો</th>
        <th width="10%">મોબાઇલ</th>
      </tr>
      <?php  $j = 1; }  
         }   ?>
    </table>
  </div>
    <?php if($q==0 && $m < $l || $l<$h) { $h=$h+1;?>
  </div>
</div>

      <div class="page">
        <div class="subpage">
        <!-- logo start -->
        <table class="logotitle" cellspacing="0" border="0" width="100%">
          <tr>
            <td width="12%">
              <div class="logo">
                <?php if (getOptionValue('site_logo')) {?>
                <img src="<?php echo base_url().'media/users/'.getOptionValue('site_logo');?>"  alt="Porto Admin"  width="100px" style="text-align: center;"/>
                <?php } else {?>
                    <h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
                <?php } ?>
              </div>
            </td>
            <td width="76%">
              <h1 style="margin-left: 50px;background-color:#000;color:#fff;">&nbsp;<?php echo (getOptionValue('title')); ?> &nbsp;</h1>&nbsp;
              <?php $q=1; } ?>
              <?php $q=0; $l=$l+1; } ?>
<?php }else{ ?>
            <h2 style="margin-left: 50px;"><?php echo $data[0]['title']; ?> પરીવાર ની યાદી</h2>
            <p><center>www.hanolgam.com</center></p>
            </td>
            <td width="10%">
              <h1 class="no1" style="border:2px solid #000;border-radius: 50px;background-color: #000;color: #fff;">&nbsp;<?php echo $h;?>&nbsp;&nbsp;</h1>
          </td>
          </tr>
        </table>  
      <div style="">
      <hr />
        <table class="tbl-info student-info" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
          <tr>
            <th>ક્રમ </th>
            <th>ફોટો</th>
            <th>નામ</th>
            <th>એડ્રેસ</th>
            <th>બ્લડગ્રૂપ</th>
            <th>સભ્યો</th>
            <th>મોબાઇલ</th>
          </tr>
          <?php $i=1;$j=1; foreach ($data as $key) { ?>
          <tr> 
          <td style="text-align: center;"><?php echo $i; ?></td>
          <td><center><?php if ($key['photo']) {?>
              <img class="" src="<?php echo base_url(); ?>media/member/<?php echo $key['photo']; ?>" width="35px">
              <?php } else {?>                                        
                  <img class="" src="<?php echo base_url(); ?>media/Admin.png" width="35px">
              <?php }?></center></td> 
          <td style="font-size: 13px !important;"><?php echo $key['title']; ?> <?php echo $key['name']; ?> <?php echo $key['fname']; ?> </td>
          <td style="font-size: 13px !important;"><?php echo $key['address']; ?> </td>
          <td style="font-size: 13px !important;text-align: center;"><?php echo $key['bgroup']=='Not Selected' ? '-' : $key['bgroup']; ?> </td>
          <td style="font-size: 13px !important;text-align: center;"><?php echo $key['total_member'];?> </td>
          <td style="font-size: 13px !important;text-align: center;"><?php echo $key['mobile']; ?></td>
          </tr>
        <?php $i++;$j++;
        if($j==21) { $h=$h+1;?>
       </table>
      </div>
    </div>

 
      <div class="subpage">
         <table class="logotitle" cellspacing="0" width="100%">
          <tr>
           <td width="12%">
              <div class="logo">
                <?php if (getOptionValue('site_logo')) {?>
                    <img src="<?php echo base_url().'media/users/'.getOptionValue('site_logo');?>"  alt="Porto Admin"  width="100px" style="text-align: center;"/>
                <?php } else {?>
                    <h4><?php echo strtoupper(getOptionValue('sitename')); ?></h4>
                <?php } ?>
                
              </div>
            </td>
            <td width="76%">
             <h1 style="margin-left: 50px;background-color:#000;color:#fff;">&nbsp;<?php echo (getOptionValue('title')); ?> &nbsp;</h1>&nbsp;
              
              <h2 style="margin-left: 50px;"><?php echo $data[0]['title'] ?> પરીવાર ની યાદી</h2>  
              <p><center>www.hanolgam.com</center></p>        
            </td>
            <td  width="12%">
                <h1 style="border:2px solid #000;border-radius: 50px;background-color: #000;color: #fff;">&nbsp;<?php echo $h; ?>&nbsp;&nbsp;</h1>
            </td>
          </tr>
        </table>  
        <hr>
        <div style="">
          <table class="student-info" border="0" cellspacing="0" width="100%">
            <tr>
              <th>ક્રમ </th>
              <th>ફોટો</th>
              <th>નામ</th>
              <th>એડ્રેસ</th>
              <th>બ્લડગ્રૂપ</th>
              <th>સભ્યો</th>
              <th>મોબાઇલ</th>
            </tr>
          <?php  $j = 1; }  
             }   ?>
          </table>
        </div> 
      <?php } ?>
      </div>    
    </div>
  </div>  
</body>
</html>
