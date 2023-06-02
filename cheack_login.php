<?php 
// print_r($_POST);
session_start();
        if(isset($_POST['m_user'])){
        //connection
                  include("condb.php");
        //รับค่า user & mem_password
                  $m_user = mysqli_real_escape_string($con,$_POST["m_user"]);
                  $m_pass = mysqli_real_escape_string($con,$_POST["m_pass"]);
                  $passwordenc = md5($m_pass);
            
    // echo $m_user;
    // echo $m_pass;
    // echo $passwordenc;
    //     exit;
                
                    //query 
                              $sql="SELECT * FROM tbl_member WHERE m_user = '$m_user' AND m_pass = '$passwordenc'";
                              $result = mysqli_query($con, $sql);

    // $row = mysqli_fetch_array($result);
    // echo $row['m_user'];
    // exit;
                            //     echo $sql;
                            // //   echo mysqli_num_rows($result);

                            //   exit;
                              if(mysqli_num_rows($result)==1){

                                  $row = mysqli_fetch_array($result);


                                  $_SESSION["member_id"] = $row["member_id"];
                                  $_SESSION["m_level"] = $row["m_level"];
                                  $_SESSION["m_name"] = $row["m_name"];   
                                  $_SESSION["m_img"] = $row["m_img"];     
                                      
                                    if(!empty($_POST['remember'])){
                                        setcookie('user_login', $_POST['m_user'], time()+ (10*365*24*60*60));
                                        setcookie('user_password', $_POST['m_pass'], time()+ (10*365*24*60*60));
                                    } else{
                                        if(isset($_COOKIE['user_login'])){
                                            setcookie('user_login', '');

                                            if(isset($_COOKIE['user_password'])){
                                                setcookie('user_password', '');
                                            }
                                        }
                                    }

                                      if($row['m_level']=="admin"){                                     
                                          Header("Location: admin/");
                                          
                                      }elseif($row['m_level']=="member"){
                                          Header("Location: member/");
                                      }elseif($row['m_level']=="verify"){
                                        echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
        
                                        echo '<script>
                                        setTimeout(function() {
                                        swal({
                                        title: "เกิดข้อผิดพลาด",
                                        text: "กรุณายืนยันอีเมล์ก่อนเข้าใช้งาน",
                                        type: "error"
                                        }, function() {
                                            window.location = "../index.php?act=reg";
                                         });
                                        }, 1000);
                                     </script>';
                                    }
                                
                                 
                                 


                              }else{
                                    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                    
                                    echo '<script>
                                    setTimeout(function() {
                                    swal({
                                        title: "เกิดข้อผิดพลาด",
                                        text: "Username หรือ Password ไม่ถูกต้อง",
                                        type: "error"
                                    }, function() {
                                        window.location = "../index.php?act=reg";
                                    });
                                }, 1000);
                            </script>';
                              }


                    //close else chk trim

                    //exit();




        }
?>