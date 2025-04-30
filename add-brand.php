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

    .form-horizontal label {
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

    select.form-control {
        padding-right: 30px !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23102b49'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 10px center !important;
        background-size: 20px !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
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
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5c4ac7, #102b49) !important;
        box-shadow: 0 8px 20px rgba(92, 74, 199, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    .btn-primary:active {
        transform: translateY(1px) !important;
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
            <h3 class="text-primary">Agregar Proveedor</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Agregrar Proveedor</li>
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
                            <form class="form-horizontal" method="POST" id="submitBrandForm" action="php_action/createBrand.php" enctype="multipart/form-data">

                                <input type="hidden" name="currnt_date" class="form-control">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Nombre Proveedor</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="brandName" placeholder="Proveedor" name="brandName" required="" pattern="^[a-zA-z]+$" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Estado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="brandStatus" name="brandStatus">
                                                <option value="">~~Seleccionar~~</option>
                                                <option value="1">Disponible</option>
                                                <option value="2">No disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" name="create" id="createBrandBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>





        <?php include('./constant/layout/footer.php'); ?>