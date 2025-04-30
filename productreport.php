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

    .card-title {
        font-weight: 600 !important;
        color: #102b49 !important;
        padding: 20px !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        background: linear-gradient(135deg, rgba(16, 43, 73, 0.03), rgba(92, 74, 199, 0.05)) !important;
    }

    .card-body {
        padding: 30px !important;
    }

    /* Mejoras en formulario */
    .form-horizontal .form-group {
        margin-bottom: 25px !important;
    }

    .form-group label {
        font-weight: 500 !important;
        color: #102b49 !important;
        font-size: 14px !important;
    }

    .form-control {
        border-radius: 10px !important;
        padding: 12px 15px !important;
        height: auto !important;
        border: 1px solid #e0e6ed !important;
        box-shadow: none !important;
        background-color: #f8f9fa !important;
        transition: all 0.3s ease !important;
    }

    .form-control:focus {
        border-color: #5c4ac7 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 3px rgba(92, 74, 199, 0.1) !important;
    }

    input[type="date"].form-control {
        padding-right: 15px !important;
        background-image: none !important;
    }

    /* Mejoras en botón */
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
        margin-top: 30px !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5c4ac7, #102b49) !important;
        box-shadow: 0 8px 20px rgba(92, 74, 199, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    .btn-primary:active {
        transform: translateY(1px) !important;
    }

    /* Mensajes de error */
    .text-danger {
        color: #e74c3c !important;
        font-size: 12px !important;
        margin-top: 5px !important;
        display: block !important;
    }

    .has-error .form-control {
        border-color: #e74c3c !important;
        box-shadow: 0 0 0 1px rgba(231, 76, 60, 0.2) !important;
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

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Reporte Productos</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">>Reporte Productos</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">




        <div class="row">
            <div class="col-lg-8" style="    margin-left: 10%;">
                <div class="card">
                    <div class="card-title">

                    </div>
                    <div id="add-brand-messages"></div>
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" action="getproductreport.php" method="post" id="getOrderReportForm">



                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Fecha Inicio</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Fecha Fin</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Fecha Fin" />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" id="generateReportBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Generar Reporte</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            $(document).ready(function() {
                // order date picker
                $("#startDate").date();
                // order date picker
                $("#endDate").date();

                $("#getOrderReportForm").unbind('submit').bind('submit', function() {

                    var startDate = $("#startDate").val();
                    var endDate = $("#endDate").val();

                    if (startDate == "" || endDate == "") {
                        if (startDate == "") {
                            $("#startDate").closest('.form-group').addClass('has-error');
                            $("#startDate").after('<p class="text-danger">La fecha de inicio es requerida</p>');
                        } else {
                            $(".form-group").removeClass('has-error');
                            $(".text-danger").remove();
                        }

                        if (endDate == "") {
                            $("#endDate").closest('.form-group').addClass('has-error');
                            $("#endDate").after('<p class="text-danger">La fecha de fin es requerida</p>');
                        } else {
                            $(".form-group").removeClass('has-error');
                            $(".text-danger").remove();
                        }
                    } else {
                        $(".form-group").removeClass('has-error');
                        $(".text-danger").remove();

                        var form = $(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'date',
                            success: function(response) {
                                var mywindow = window.open('', 'Reporte de Productos', 'height=400,width=600');
                                mywindow.document.write('<html><head><title>Reporte de Productos</title>');
                                mywindow.document.write('</head><body>');
                                mywindow.document.write(response);
                                mywindow.document.write('</body></html>');

                                mywindow.document.close(); // necessary for IE >= 10
                                mywindow.focus(); // necessary for IE >= 10

                                mywindow.print();
                                mywindow.close();
                            } // /success
                        }); // /ajax

                    } // /else

                    return false;
                });

            });
        </script>


        <?php include('./constant/layout/footer.php'); ?>