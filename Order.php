<?php include('./constant/layout/head.php'); ?>
<?php include('./constant/layout/header.php'); ?>

<?php include('./constant/layout/sidebar.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Estilos generales */
    body {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8f9fd !important;
    }

    .page-wrapper {
        background-color: #f8f9fd;
        min-height: 100vh;
        padding-bottom: 60px !important;
    }

    /* Mejoras en titulos y breadcrumb */
    .page-titles {
        background: transparent !important;
        margin-bottom: 20px !important;
        padding: 15px 30px !important;
    }

    .page-titles h3 {
        font-weight: 600 !important;
        font-size: 22px !important;
        color: #5c4ac7 !important;
    }

    .breadcrumb {
        background: transparent !important;
    }

    .breadcrumb-item a {
        color: #102b49 !important;
        font-weight: 500 !important;
    }

    .breadcrumb-item.active {
        color: #5c4ac7 !important;
        font-weight: 500 !important;
    }

    /* Mejoras en card */
    .card {
        border-radius: 15px !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        overflow: hidden !important;
        margin-bottom: 25px !important;
        animation: fadeInUp 0.5s ease-out forwards !important;
    }

    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12) !important;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0 !important;
            transform: translateY(20px) !important;
        }

        to {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    }

    .card-body {
        padding: 30px !important;
    }

    /* Botón generar factura */
    .btn-primary {
        background: linear-gradient(135deg, #102b49, #5c4ac7) !important;
        border: none !important;
        border-radius: 50px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        font-size: 14px !important;
        box-shadow: 0 5px 15px rgba(92, 74, 199, 0.3) !important;
        transition: all 0.3s ease !important;
        margin-bottom: 20px !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5c4ac7, #102b49) !important;
        box-shadow: 0 8px 20px rgba(92, 74, 199, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    /* Mejoras en tabla */
    .table-responsive {
        border-radius: 10px !important;
        background: white !important;
        padding: 15px !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important;
    }

    table.table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-bottom: 0 !important;
    }

    table.table thead th {
        background: linear-gradient(135deg, rgba(16, 43, 73, 0.05), rgba(92, 74, 199, 0.1)) !important;
        border-bottom: none !important;
        color: #102b49 !important;
        font-weight: 600 !important;
        padding: 15px !important;
        vertical-align: middle !important;
    }

    table.table tbody tr {
        transition: background 0.3s ease !important;
    }

    table.table tbody tr:hover {
        background-color: rgba(92, 74, 199, 0.03) !important;
    }

    table.table tbody td {
        padding: 15px !important;
        border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
        vertical-align: middle !important;
    }

    /* Botones de acción */
    .btn-xs {
        border-radius: 50px !important;
        width: 35px !important;
        height: 35px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 5px !important;
        transition: all 0.3s ease !important;
    }

    .btn-xs:hover {
        transform: translateY(-3px) !important;
    }

    .btn-xs.btn-primary {
        background: linear-gradient(135deg, #102b49, #5c4ac7) !important;
        box-shadow: 0 3px 8px rgba(92, 74, 199, 0.3) !important;
    }

    .btn-xs.btn-danger {
        background: linear-gradient(135deg, #f05746, #c9302c) !important;
        box-shadow: 0 3px 8px rgba(201, 48, 44, 0.3) !important;
    }

    .btn-xs.btn-success {
        background: linear-gradient(135deg, #28a745, #218838) !important;
        box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3) !important;
    }

    .btn-xs i {
        font-size: 14px !important;
    }

    /* Mejoras etiquetas */
    .label {
        border-radius: 30px !important;
        padding: 5px 15px !important;
        font-weight: 500 !important;
        letter-spacing: 0.5px !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }

    .label-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60) !important;
    }

    .label-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b) !important;
    }

    .label-warning {
        background: linear-gradient(135deg, #f39c12, #e67e22) !important;
    }

    .label h4 {
        margin: 0 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        color: white !important;
    }

    /* Footer personalizado */
    body::after {
        content: "Copyright © 2025 Project Developed by Diego Centeno";
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #f5f5f5;
        color: #5c4ac7;
        text-align: center;
        padding: 10px 0;
        z-index: 999999;
        font-size: 14px;
        border-top: 1px solid #eee;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.05);
    }

    /* Mejoras en sidebar - igual que dashboard */
    .left-sidebar {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1) !important;
        border-right: none !important;
        background: #fff !important;
    }

    .sidebar-nav>ul>li>a {
        border-radius: 8px !important;
        margin: 5px 15px !important;
        transition: all 0.3s ease !important;
    }

    .sidebar-nav>ul>li>a:hover {
        background: rgba(92, 74, 199, 0.1) !important;
        color: #5c4ac7 !important;
    }

    /* Estilos para corregir el menú dashboard */
    .sidebar-nav>ul>li.active>a {
        background: #5c4ac7 !important;
        /* Solo color morado */
        background-image: none !important;
        /* Elimina gradiente si existe */
        color: white !important;
        box-shadow: 0 5px 15px rgba(92, 74, 199, 0.4) !important;
    }

    /* Cambiar color de iconos a blanco */
    .sidebar-nav>ul>li>a i,
    .sidebar-nav>ul>li.active>a i {
        color: white !important;
    }

    /* Estilo al pasar el mouse */
    .sidebar-nav>ul>li>a:hover i {
        color: #5c4ac7 !important;
    }

    /* Color del texto del menú activo */
    .sidebar-nav>ul>li.active>a .hide-menu {
        color: white !important;
    }
</style>

<?php include('./constant/connect');
$user = $_SESSION['userId'];
$sql = "SELECT  uno, orderDate, clientName, clientContact,paymentStatus,id FROM orders WHERE delete_status = 0";
$result = $connect->query($sql);

//echo $sql;exit;

//echo $itemCountRow;exit; 
?>
<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary"> Gestionar Facturas</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Gestionar Facturas</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">




        <div class="card">
            <div class="card-body">

                <a href="add-order.php"><button class="btn btn-primary">Generar Factura</button></a>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Fecha Factura</th>
                                <th>Nombre Cliente</th>
                                <th>Contacto</th>

                                <th>Estado del Pago</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) {

                                $no += 1;
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><?php echo $row['orderDate'] ?></td>
                                    <td><?php echo $row['clientName'] ?></td>
                                    <td><?php echo $row['clientContact'] ?></td>


                                    <td><?php if ($row['paymentStatus'] == 1) {

                                            $paymentStatus = "<label class='label label-success' ><h4>Pago Completo</h4></label>";
                                            echo $paymentStatus;
                                        } else if ($row['payment_status'] == 2) {
                                            $paymentStatus = "<label class='label label-danger'><h4>Pago Pactial</h4></label>";
                                            echo $paymentStatus;
                                        } else {
                                            $paymentStatus = "<label class='label label-warning'><h4>Pago Pendiente</h4></label>";
                                            echo $paymentStatus;
                                        } // /els
                                        ?></td>
                                    <td>

                                        <a href="editorder.php?id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>



                                        <a href="php_action/removeOrder.php?id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Deseas eliminar este registro?')"><i class="fa fa-trash"></i></button></a>

                                        <a href="invoiceprint.php?id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-xs btn-success"><i class="fa fa-print"></i></button></a>


                                    </td>
                                </tr>

                        </tbody>
                    <?php
                            }

                    ?>
                    </table>
                </div>
            </div>
        </div>


        <?php include('./constant/layout/footer.php'); ?>