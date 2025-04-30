<?php //error_reporting(1); 
?>
<?php include('./constant/layout/head.php'); ?>
<?php include('./constant/layout/header.php'); ?>

<?php include('./constant/layout/sidebar.php'); ?>

<?php


$lowStockSql = "SELECT * FROM product WHERE status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$lowStockSql1 = "SELECT * FROM brands WHERE brand_status = 1";
$lowStockQuery1 = $connect->query($lowStockSql1);
$countLowStock1 = $lowStockQuery1->num_rows;

$date = date('Y-m-d');
$lowStockSql3 = "SELECT * FROM product WHERE  expdate<'" . $date . "' AND status = 1";
//echo "SELECT * FROM product WHERE  expdate<='".$date."' AND status = 1" ;exit;
$lowStockQuery3 = $connect->query($lowStockSql3);
$countLowStock3 = $lowStockQuery3->num_rows;

$lowStockSql2 = "SELECT * FROM orders WHERE delete_status =0";
$lowStockQuery2 = $connect->query($lowStockSql2);
$countLowStock2 = $lowStockQuery2->num_rows;

//$connect->close();

?>

<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="page-wrapper">

    <!--     <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <div class="float-right"><h3 style="color:black;"><p style="color:black;"><?php echo date('l') . ' ' . date('d') . '- ' . date('m') . '- ' . date('Y'); ?></p></h3>
                    </div>
                    </div>
                
            </div> -->


    <div class="container-fluid ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Tabla de Facturas</strong>

                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Nombre Cliente</th>
                                    <th>Contacto</th>

                                    <th>Estado del Pago</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //include('./constant/connect');

                                $sql = "SELECT  uno, orderDate, clientName, clientContact,paymentStatus,id FROM orders WHERE delete_status = 0";
                                //echo $sql;exit;
                                $result = $connect->query($sql);
                                //print_r($result);exit;
                                foreach ($result as $row) {

                                    $no += 1;
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?php echo $row['orderDate'] ?></td>
                                        <td><?php echo $row['clientName'] ?></td>
                                        <td><?php echo $row['clientContact'] ?></td>


                                        <td><?php if ($row['paymentStatus'] == 1) {

                                                $paymentStatus = "<label class='label label-info' ><h4>Pago Completo</h4></label>";
                                                echo $paymentStatus;
                                            } else if ($row['payment_status'] == 2) {
                                                $paymentStatus = "<label class='label label-warning'><h4>Pago Parcial</h4></label>";
                                                echo $paymentStatus;
                                            } else {
                                                $paymentStatus = "<label class='label label-danger'><h4>Pago Pendiente</h4></label>";
                                                echo $paymentStatus;
                                            } // /els
                                            ?></td>

                                    </tr>

                            </tbody>
                        <?php
                                }

                        ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 dashboard">
                <div class="card" style="background: #eb8038 ">
                    <div class="media widget-ten">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-support"></i></span>
                        </div>
                        <div class="media-body media-text-right">


                            <h2 class="color-white"><?php echo $countLowStock; ?></h2>
                            <a href="product.php">
                                <p class="m-b-0">Medicinas</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
                <div class="col-md-6 dashboard">
                    <div class="card" style="    background-color: #f05746 ">
                        <div class="media widget-ten">
                            <div class="media-left meida media-middle">
                                <span><i class="ti-agenda"></i></span>
                            </div>
                            <div class="media-body media-text-right">

                                <h2 class="color-white"><?php echo $countLowStock3; ?></h2>
                                <a href="Order.php">
                                    <p class="m-b-0">Medicinas Vencidas</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
                <div class="col-md-6 dashboard">
                    <div class="card " style="    background-color: #46f9a0 ">
                        <div class="media widget-ten">
                            <div class="media-left meida media-middle">
                                <span><i class="ti-notepad"></i></span>
                            </div>
                            <div class="media-body media-text-right">

                                <h2 class="color-white"><?php echo $countLowStock2; ?></h2>
                                <a href="Order.php">
                                    <p class="m-b-0">Facturas</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
                <div class="col-md-6 dashboard">
                    <div class="card" style="background:#65c8db ">
                        <div class="media widget-ten">
                            <div class="media-left meida media-middle">
                                <span><i class="ti-rss"></i></span>
                            </div>
                            <div class="media-body media-text-right">




                                <h2 class="color-white"><?php echo $countLowStock1; ?></h2>
                                <a href="product.php">
                                    <p class="m-b-0">Proveedores</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>




        </div>


        <?php
        //error_reporting(0);
        //require_once('../constant/connect.php');
        $qqq = "SELECT * FROM product WHERE  status ='1' ";
        $result = $connect->query($qqq);
        //print_r($result);exit;
        foreach ($result as $row) {

            //print_r($row);
            $a .= $row["product_name"] . ',';
            $b .= $row["quantity"] . ',';
        }
        $am = explode(",", $a, -1);
        $amm = explode(",", $b, -1);
        //print_r($a);
        //print_r($b);

        $cnt = count($am);

        $datavalue1 = '';
        for ($i = 0; $i < $cnt; $i++) {
            $datavalue1 .= "['" . $am[$i] . "'," . $amm[$i] . "],";
        }
        //echo 

        $datavalue1; //used this $data variable in js
        ?>



    </div>
</div>
</div>


<?php include('./constant/layout/footer.php'); ?>
<script>
    $(function() {
        $(".preloader").fadeOut();
    })
</script>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'], <?php echo $datavalue1; ?>
        ]);

        var options = {
            title: 'Inventario de Medicinas',
            is3D: true,
            backgroundColor: 'transparent',
            colors: ['#5c4ac7', '#46f9a0', '#f05746', '#eb8038', '#65c8db'],
            titleTextStyle: {
                color: '#102b49',
                fontSize: 16,
                fontName: 'Poppins',
                bold: true
            },
            legend: {
                textStyle: {
                    color: '#4e4e4e',
                    fontSize: 13,
                    fontName: 'Poppins'
                }
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);

        var chart = new google.visualization.BarChart(document.getElementById('myChart1'));
        chart.draw(data, options);
    }
</script>

<!-- Script para reemplazar el copyright -->
<script>
    // Función para reemplazar el texto del copyright
    function replaceCopyright() {
        // Buscar todos los elementos que puedan contener el copyright
        var elements = document.querySelectorAll('footer, .footer, .copyright, .site-info, [class*="footer"], [class*="copy"], small, p');

        elements.forEach(function(el) {
            // Reemplazar el texto si contiene "Mayuri" o "copyright"
            if (el.innerHTML && (el.innerHTML.includes('Mayuri') || el.innerHTML.toLowerCase().includes('copyright'))) {
                el.innerHTML = el.innerHTML.replace(/Copyright[^<]+Mayuri K/gi, 'Copyright © 2025 Project Developed by Diego Centeno');
                el.innerHTML = el.innerHTML.replace(/Mayuri K/gi, 'Diego Centeno');
            }
        });

        // Buscar en todos los nodos de texto directamente
        var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
        var node;
        while (node = walker.nextNode()) {
            if (node.nodeValue && (node.nodeValue.includes('Mayuri') || node.nodeValue.toLowerCase().includes('copyright'))) {
                node.nodeValue = node.nodeValue.replace(/Copyright[^a-zA-Z]+\d{4}[^a-zA-Z]+Mayuri K/gi, 'Copyright © 2025 Project Developed by Diego Centeno');
                node.nodeValue = node.nodeValue.replace(/Mayuri K/gi, 'Diego Centeno');
            }
        }
    }

    // Ejecutar la función después de que la página esté completamente cargada
    $(document).ready(function() {
        replaceCopyright();
        // Ejecutar también después de un tiempo para asegurar que todo el contenido dinámico está cargado
        setTimeout(replaceCopyright, 500);
        setTimeout(replaceCopyright, 1500);
    });
</script>

<!-- Estilos mejorados para el dashboard - manteniendo la sintonía con el login -->
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
        /* Espacio para el footer */
    }

    /* Mejoras en header */
    .header {
        background: linear-gradient(135deg, #102b49, #5c4ac7) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .navbar-header {
        background: transparent !important;
    }

    /* Mejoras en sidebar */
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

    .sidebar-nav>ul>li.active>a {
        background: linear-gradient(135deg, #102b49, #5c4ac7) !important;
        color: white !important;
        box-shadow: 0 5px 15px rgba(92, 74, 199, 0.4) !important;
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

    /* Mejoras en cards */
    .card {
        border-radius: 15px !important;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        overflow: hidden !important;
        margin-bottom: 25px !important;
    }

    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12) !important;
    }

    .card-header {
        background: linear-gradient(135deg, rgba(16, 43, 73, 0.03), rgba(92, 74, 199, 0.05)) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        padding: 20px !important;
    }

    .card-title {
        font-weight: 600 !important;
        color: #102b49 !important;
    }

    /* Mejoras específicas para los widgets de Medicinas, Medicinas Vencidas, etc. */
    .dashboard .media.widget-ten {
        padding: 20px !important;
    }

    .dashboard .media-left {
        background: rgba(255, 255, 255, 0.2) !important;
        border-radius: 50% !important;
        width: 70px !important;
        height: 70px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-right: 15px !important;
        transition: transform 0.3s ease !important;
    }

    .dashboard .card:hover .media-left {
        transform: scale(1.1) !important;
    }

    .dashboard .media-left i {
        font-size: 28px !important;
        color: white !important;
    }

    .dashboard .media-body {
        padding-left: 10px !important;
    }

    .dashboard .color-white {
        font-size: 32px !important;
        font-weight: 700 !important;
        margin-bottom: 5px !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    }

    .dashboard .m-b-0 {
        font-size: 16px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        color: white !important;
        margin: 0 !important;
    }

    .dashboard a {
        text-decoration: none !important;
    }

    /* Animación para las tarjetas */
    .dashboard .card {
        animation: fadeInUp 0.5s ease-out forwards !important;
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

    .dashboard .card:nth-child(1) {
        animation-delay: 0.1s !important;
    }

    .dashboard .card:nth-child(2) {
        animation-delay: 0.2s !important;
    }

    .dashboard .card:nth-child(3) {
        animation-delay: 0.3s !important;
    }

    .dashboard .card:nth-child(4) {
        animation-delay: 0.4s !important;
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

    /* Mejoras en etiquetas */
    .label {
        border-radius: 30px !important;
        padding: 5px 15px !important;
        font-weight: 500 !important;
        letter-spacing: 0.5px !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }

    .label-info {
        background: linear-gradient(135deg, #45aaf2, #2e86de) !important;
    }

    .label-warning {
        background: linear-gradient(135deg, #f7b731, #fa8231) !important;
    }

    .label-danger {
        background: linear-gradient(135deg, #fc5c65, #eb3b5a) !important;
    }

    .label h4 {
        margin: 0 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
    }

    /* Botones y links */
    .btn {
        border-radius: 50px !important;
        padding: 10px 20px !important;
        transition: all 0.3s ease !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        font-size: 14px !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #102b49, #5c4ac7) !important;
        border: none !important;
        box-shadow: 0 5px 15px rgba(92, 74, 199, 0.3) !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5c4ac7, #102b49) !important;
        box-shadow: 0 8px 20px rgba(92, 74, 199, 0.4) !important;
        transform: translateY(-2px) !important;
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

    /* Personalización de las gráficas */
    #myChart,
    #myChart1 {
        margin-top: 20px !important;
        border-radius: 10px !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important;
        background-color: white !important;
        padding: 15px !important;
    }

    /* Personalizar scrollbar para un look más moderno */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #5c4ac7;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #102b49;
    }

    /* Mejora en el header - cambio a degradado en tonos grises */
    .header {
        background: linear-gradient(135deg, #4e4e4e, #7e7e7e) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Ajuste del navbar-header para mantener consistencia */
    .navbar-header {
        background: transparent !important;
    }

    /* Color de los elementos del header */
    .navbar-top-links>li>a {
        color: #f8f9fd !important;
    }

    .navbar-top-links>li>a:hover,
    .navbar-top-links>li>a:focus {
        background: rgba(255, 255, 255, 0.1) !important;
    }

    /* Color del texto del perfil y otros elementos en el header */
    .profile-pic span {
        color: #ffffff !important;
    }
</style>
</div>