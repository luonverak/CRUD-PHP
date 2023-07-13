<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    $con = new mysqli('localhost','root','','db_php_2_3');
    function insert_data(){
        global $con;
        if(isset($_POST['btn_save'])){
            $name = $_POST['pro_name'];
            $qty  = $_POST['pro_qty'];
            $price= $_POST['pro_price'];
            $image = $_FILES['pro_image']['name'];
            if(!empty($name) && !empty($qty) && !empty($price) && !empty($image)){
                $image = date('dmyhis').'-'.$image;
                $path  = './images/'.$image;
                move_uploaded_file($_FILES['pro_image']['tmp_name'],$path);
                $sql = "INSERT INTO `product`(`name`, `qty`, `price`, `thumbnail`)
                        VALUES ('$name','$qty','$price','$image')";
                $rs  = $con->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "SUCCESS !",
                                text: "Data has been insert to system !",
                                icon: "success",
                                button: "Aww yiss!",
                              });
                        })
                    </script>
                    ';
                }
            }
        }
    }
    insert_data();
    function get_data(){
        global $con;
        $sql = "SELECT * FROM `product` ORDER BY id DESC";
        $rs  = $con->query($sql);
        while($row=mysqli_fetch_assoc($rs)){
            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>
                        <img src="./images/'.$row['thumbnail'].'" width="130" height="130" style="object-fit: cover" alt="'.$row['thumbnail'].'">
                    </td>
                    <td>
                        <div class="d-flex">
                            <button id="openUpdate" class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                            <form method="post">
                            <input type="hidden" name="field_id" value="'.$row['id'].'">
                            <button name="btn_delete" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                ';
        }
    }
    function delete_data(){
        global $con;
        if(isset($_POST['btn_delete'])){
            $id = $_POST['field_id'];
            $sql = "DELETE FROM `product` WHERE id = '$id'";
            $rs  = $con->query($sql);
            if($rs){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "DELTED !",
                            text: "Data has been delete from system !",
                            icon: "success",
                            button: "Aww yiss!",
                          });
                    })
                </script>
                ';
            }
        }
    }
    delete_data();
    function update_data(){
        global $con;
        if(isset($_POST['btn_update'])){
            $name  = $_POST['pro_name'];
            $qty   = $_POST['pro_qty'];
            $price = $_POST['pro_price'];
            $image = $_FILES['pro_image']['name'];
            $id    = $_POST['pro_id'];
            if(empty($image)){
                $image = $_POST['old_thumbnail'];
            }else{
                $image = date('dmyhis').'-'.$image;
                $path  = './images/'.$image;
                move_uploaded_file($_FILES['pro_image']['tmp_name'],$path);
            }
            if(!empty($name) && !empty($qty) && !empty($price) && !empty($image)){
                $sql = "UPDATE `product`
                        SET `name`='$name',`qty`='$qty',`price`='$price',`thumbnail`='$image'
                        WHERE id='$id'";
                $rs  = $con->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "UPDATED !",
                                text: "Data has been update to system !",
                                icon: "success",
                                button: "Aww yiss!",
                              });
                        })
                    </script>
                    ';
                }
            }
        }
    }
    update_data();
?>