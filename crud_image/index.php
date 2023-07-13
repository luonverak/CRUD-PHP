<!DOCTYPE html>
<?php include('functions.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid bg-dark float-end p-2">
    <h1 class="text-light">CRUD Image</h1>
    <button id="openAdd" type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fa-solid fa-plus"></i> Add Product
    </button>
</div>
<table class="table table-dark table-hover align-middle" style="table-layout: fixed;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Thumbnail</th>
        <th>Actions</th>
    </tr>

    <?php get_data()?>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Enter Name" class="form-control" name="pro_name" id="pro_name" >
        <input type="text" placeholder="Enter Qty" class="form-control mt-3" name="pro_qty" id="pro_qty" >
        <input type="text" placeholder="Enter Price" class="form-control mt-3" name="pro_price" id="pro_price" >
        <input type="file" class="form-control mt-3" name="pro_image" id="pro_image" >
        <!-- Hidden  ID -->
        <input type="hidden" name="pro_id" id="pro_id">
        <!-- Hidden Image -->
        <input type="hidden" name="old_thumbnail" id="old_thumbnail">
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button id="btn_save" name="btn_save" type="submit" class="btn btn-primary">Save</button>
            <button id="btn_update" name="btn_update" type="submit" class="btn btn-success">Update</button>
        </div>

    </div>
    </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function(){
        $("#openAdd").click(function(){
            $("#btn_save").show();
            $("#btn_update").hide();
        })
        $("body").on("click","#openUpdate",function(){
            $("#btn_save").hide();
            $("#btn_update").show();

            id        = $(this).parents("tr").find("td").eq(0).text();
            name      = $(this).parents("tr").find("td").eq(1).text();
            qty       = $(this).parents("tr").find("td").eq(2).text();
            price     = $(this).parents("tr").find("td").eq(3).text();
            thumbnail = $(this).parents("tr").find("td:eq(4) img").attr("alt");

            $("#pro_id").val(id)
            $("#pro_name").val(name)
            $("#pro_qty").val(qty)
            $("#pro_price").val(price)
            $("#old_thumbnail").val(thumbnail)

        })
    })
</script>
</html>