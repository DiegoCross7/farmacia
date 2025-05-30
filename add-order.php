<?php include('./constant/layout/head.php'); ?>
<?php include('./constant/layout/header.php'); ?>

<?php include('./constant/layout/sidebar.php'); ?>

<!-- <link rel="stylesheet" href="custom/js/order.js"> -->

<?php include('./constant/connect.php');





if ($_GET['o'] == 'add') {
  // add order
  echo "<div class='div-request div-hide'>add</div>";
} else if ($_GET['o'] == 'manord') {
  echo "<div class='div-request div-hide'>manord</div>";
} else if ($_GET['o'] == 'editOrd') {
  echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<!-- <ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
    <?php //if($_GET['o'] == 'add') { 
    ?>
      Add Order
    <? php // } else if($_GET['o'] == 'manord') { 
    ?>
      Manage Order
    <?php //} // /else manage order 
    ?>
  </li>
</ol>


<h4>
  <i class='glyphicon glyphicon-circle-arrow-right'></i>
  <?php //if($_GET['o'] == 'add') {
  //echo "Add Order";
  //} else if($_GET['o'] == 'manord') { 
  // echo "Manage Order";
  //} else if($_GET['o'] == 'editOrd') { 
  //  echo "Edit Order";
  //}
  ?>  
</h4>
 -->



<div class="page-wrapper">

  <div class="row page-titles">
    <div class="col-md-5 align-self-center">
      <h3 class="text-primary">Agregar Factura</h3>
    </div>
    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Factura</li>
      </ol>
    </div>
  </div>


  <div class="container-fluid">




    <div class="row">
      <div class="col-lg-11" style="    margin-left: 5%;">
        <div class="card">
          <div class="card-title">

          </div>
          <div id="add-brand-messages"></div>
          <div class="card-body">
            <div class="input-states">
              <form class="form-horizontal" method="POST" id="createOrderForm" action="php_action/order.php" action="php_action/order.php">


                <div class="form-group">
                  <div class="row">

                    <label class="col-sm-2 control-label">No Factura</label>
                    <div class="col-sm-4">
                      <?php
                      $user = "select * from orders where  id=(select max(id) from orders)";
                      //echo $user;exit;
                      $result = $connect->query($user);
                      foreach ($result as $res) {
                        # code...
                      }

                      $n = "INV-000";
                      $l = $res['id'] + 1;
                      $stall_no = $n . "" . $l; ?>
                      <input type="text" class="form-control" placeholder="Número Factura" value="<?php echo $stall_no; ?>" autocomplete="off" name="uno" required />
                    </div>


                    <label class="col-sm-2 control-label">Fecha Factura</label>

                    <div class="col-sm-4">
                      <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="orderDate" name="orderDate" autocomplete="off" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-2 control-label">Nombre Cliente</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Nombre Cliente" autocomplete="off" />
                    </div>

                    <label class="col-sm-2 control-label">Móvil </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Número de Contacto" autocomplete="off" pattern="^[0][1-9]\d{9}$|^[1-9]\d{9}$" required />
                    </div>


                  </div>

                </div>


                <table class="table" id="productTable">
                  <thead>
                    <tr>
                      <th style="width:40%;">Medicina</th>
                      <th style="width:20%;">Cantidad Por Unidad</th>
                      <th style="width:10%;">Cantidades</th>
                      <th style="width:15%;">Disponibles</th>
                      <th style="width:25%;">Total</th>
                      <th style="width:10%;">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $arrayNumber = 0;
                    for ($x = 1; $x < 2; $x++) { ?>
                      <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                        <td style="margin-left:20px;">
                          <div class="form-group">

                            <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
                              <option value="">~~Seleccionar~~</option>
                              <?php
                              $productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
                              $productData = $connect->query($productSql);

                              while ($row = $productData->fetch_array()) {
                                echo "<option value='" . $row['product_id'] . "' id='changeProduct" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
                              } // /while 

                              ?>
                            </select>
                          </div>
                        </td>
                        <td style="padding-left:20px;">
                          <input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />
                          <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                        </td>
                        <td style="padding-left:20px;">
                          <div class="form-group">
                            <p id="available_quantity<?php echo $x; ?>"></p>
                          </div>
                        </td>
                        <td style="padding-left:20px;">
                          <div class="form-group">
                            <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                          </div>
                        </td>
                        <td>
                          <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                          <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                        </td>
                        <td>

                          <button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Cargando..."> <i class="fa fa-plus"></i></button>


            </div>
            </td>

            <td>



              <button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
          </div>
          </td>


          </tr>
        <?php
                      $arrayNumber++;
                    } // /for
        ?>
        </tbody>
        </table>


        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label">Sub total</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
              <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
            </div>

            <label for="totalAmount" class="col-sm-2 control-label">Monto total</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" />
              <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="discount" class="col-sm-2 control-label">Descuento</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" / pattern="^[0-9]+$" />
            </div>
            <label for="grandTotal" class="col-sm-2 control-label">Total</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
              <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
            </div>

          </div>
        </div>
        <div class="form-group">
          <div class="row">

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="vat" class="col-sm-2 control-label gst">IVA 19%</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="vat" name="gstn" readonly="true" />
              <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
            </div>

            <label for="paid" class="col-sm-2 control-label">Monto Pagado</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="due" class="col-sm-2 control-label">Cambio</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="due" name="due" disabled="true" />
              <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
            </div>

            <label for="clientContact" class="col-sm-2 control-label">Tipo de Pago</label>
            <div class="col-sm-4">
              <select class="form-control" name="paymentType" id="paymentType">
                <option value="">~~Seleccionar~~</option>
                <option value="2">Efectivo</option>
                <option value="4">Nequi</option>
                <option value="5">Google Pay</option>
                <option value="6">Amazon Pay</option>
                <option value="1">Cheque</option>
                <option value="3">Tarjeta de Crédito</option>

              </select>
            </div>


          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="clientContact" class="col-sm-2 control-label">Estado del Pago</label>
            <div class="col-sm-4">
              <select class="form-control" name="paymentStatus" id="paymentStatus">
                <option value="">~~Seleccionar~~</option>
                <option value="1">Pago Completo</option>
                <option value="2">Pago Parcial</option>
                <option value="3">Pago Pendiente</option>
              </select>
            </div>

            <label for="clientContact" class="col-sm-2 control-label">Lugar del Pago</label>
            <div class="col-sm-4">
              <select class="form-control" name="paymentPlace" id="paymentPlace">
                <option value="">~~Seleccionar~~</option>
                <option value="1">Colombia</option>
                <option value="2">Internet</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group submitButtonFooter">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success btn-flat m-b-30 m-t-30"><i class="glyphicon glyphicon-ok-sign"></i> Enviar</button>

            <button type="reset" class="btn btn-danger btn-flat m-b-30 m-t-30" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Resetear</button>
          </div>
        </div>

        </form>
        </div>
      </div>
    </div>
  </div>

</div>





<?php include('./constant/layout/footer.php'); ?>


<script>
  var manageOrderTable;

  $(document).ready(function() {
    $("#paymentPlace").change(function() {
      if ($("#paymentPlace").val() == 2) {
        $(".gst").text("IGST 18%");
      } else {
        $(".gst").text("GST 18%");
      }
    });

    var divRequest = $(".div-request").text();

    // top nav bar 
    $("#navOrder").addClass('active');

    if (divRequest == 'add') {
      // add order  
      // top nav child bar 
      $('#topNavAddOrder').addClass('active');

      // order date picker
      $("#orderDate").datepicker();

      // create order form function
      $("#createOrderForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();

        var orderDate = $("#orderDate").val();
        var clientName = $("#clientName").val();
        var clientContact = $("#clientContact").val();
        var paid = $("#paid").val();
        var discount = $("#discount").val();
        var paymentType = $("#paymentType").val();
        var paymentStatus = $("#paymentStatus").val();

        // form validation 
        if (orderDate == "") {
          $("#orderDate").after('<p class="text-danger"> The Order Date field is required </p>');
          $('#orderDate').closest('.form-group').addClass('has-error');
        } else {
          $('#orderDate').closest('.form-group').addClass('has-success');
        } // /else

        if (clientName == "") {
          $("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
          $('#clientName').closest('.form-group').addClass('has-error');
        } else {
          $('#clientName').closest('.form-group').addClass('has-success');
        } // /else

        if (clientContact == "") {
          $("#clientContact").after('<p class="text-danger"> The Contact field is required </p>');
          $('#clientContact').closest('.form-group').addClass('has-error');
        } else {
          $('#clientContact').closest('.form-group').addClass('has-success');
        } // /else

        if (paid == "") {
          $("#paid").after('<p class="text-danger"> The Paid field is required </p>');
          $('#paid').closest('.form-group').addClass('has-error');
        } else {
          $('#paid').closest('.form-group').addClass('has-success');
        } // /else

        if (discount == "") {
          $("#discount").after('<p class="text-danger"> The Discount field is required </p>');
          $('#discount').closest('.form-group').addClass('has-error');
        } else {
          $('#discount').closest('.form-group').addClass('has-success');
        } // /else

        if (paymentType == "") {
          $("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
          $('#paymentType').closest('.form-group').addClass('has-error');
        } else {
          $('#paymentType').closest('.form-group').addClass('has-success');
        } // /else

        if (paymentStatus == "") {
          $("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
          $('#paymentStatus').closest('.form-group').addClass('has-error');
        } else {
          $('#paymentStatus').closest('.form-group').addClass('has-success');
        } // /else


        // array validation
        var productName = document.getElementsByName('productName[]');
        var validateProduct;
        for (var x = 0; x < productName.length; x++) {
          var productNameId = productName[x].id;
          if (productName[x].value == '') {
            $("#" + productNameId + "").after('<p class="text-danger"> Nombre de Producto es requerido!! </p>');
            $("#" + productNameId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + productNameId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < productName.length; x++) {
          if (productName[x].value) {
            validateProduct = true;
          } else {
            validateProduct = false;
          }
        } // for              

        var quantity = document.getElementsByName('quantity[]');
        var validateQuantity;
        for (var x = 0; x < quantity.length; x++) {
          var quantityId = quantity[x].id;
          if (quantity[x].value == '') {
            $("#" + quantityId + "").after('<p class="text-danger"> Nombre de Producto es Requerido!! </p>');
            $("#" + quantityId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + quantityId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < quantity.length; x++) {
          if (quantity[x].value) {
            validateQuantity = true;
          } else {
            validateQuantity = false;
          }
        } // for        


        if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
          if (validateProduct == true && validateQuantity == true) {
            // create order button
            // $("#createOrderBtn").button('loading');

            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success: function(response) {
                console.log(response);
                // reset button
                $("#createOrderBtn").button('reset');

                $(".text-danger").remove();
                $('.form-group').removeClass('has-error').removeClass('has-success');

                if (response.success == true) {

                  // create order button
                  $(".success-messages").html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    ' <br /> <br /> <a type="button" onclick="printOrder(' + response.order_id + ')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimir </a>' +
                    '<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Nueva Factura </a>' +

                    '</div>');

                  $("html, body, div.panel, div.pane-body").animate({
                    scrollTop: '0px'
                  }, 100);

                  // disabled te modal footer button
                  $(".submitButtonFooter").addClass('div-hide');
                  // remove the product row
                  $(".removeProductRowBtn").addClass('div-hide');

                } else {
                  alert(response.messages);
                }
              } // /response
            }); // /ajax
          } // if array validate is true
        } // /if field validate is true


        return false;
      }); // /create order form function  

    } else if (divRequest == 'manord') {
      // top nav child bar 
      $('#topNavManageOrder').addClass('active');

      manageOrderTable = $("#manageOrderTable").DataTable({
        'ajax': 'php_action/fetchOrder.php',
        'order': []
      });

    } else if (divRequest == 'editOrd') {
      $("#orderDate").datepicker();

      // edit order form function
      $("#editOrderForm").unbind('submit').bind('submit', function() {
        // alert('ok');
        var form = $(this);

        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();

        var orderDate = $("#orderDate").val();
        var clientName = $("#clientName").val();
        var clientContact = $("#clientContact").val();
        var paid = $("#paid").val();
        var discount = $("#discount").val();
        var paymentType = $("#paymentType").val();
        var paymentStatus = $("#paymentStatus").val();

        // form validation 
        if (orderDate == "") {
          $("#orderDate").after('<p class="text-danger"> El campo Fecha de pedido es obligatorio </p>');
          $('#orderDate').closest('.form-group').addClass('has-error');
        } else {
          $('#orderDate').closest('.form-group').addClass('has-success');
        } // /else

        if (clientName == "") {
          $("#clientName").after('<p class="text-danger"> El campo Nombre del cliente es obligatorio </p>');
          $('#clientName').closest('.form-group').addClass('has-error');
        } else {
          $('#clientName').closest('.form-group').addClass('has-success');
        } // /else

        if (clientContact == "") {
          $("#clientContact").after('<p class="text-danger"> El campo de contacto es obligatorio </p>');
          $('#clientContact').closest('.form-group').addClass('has-error');
        } else {
          $('#clientContact').closest('.form-group').addClass('has-success');
        } // /else

        if (paid == "") {
          $("#paid").after('<p class="text-danger"> El campo Pagado es obligatorio </p>');
          $('#paid').closest('.form-group').addClass('has-error');
        } else {
          $('#paid').closest('.form-group').addClass('has-success');
        } // /else

        if (discount == "") {
          $("#discount").after('<p class="text-danger"> El campo Descuento es obligatorio </p>');
          $('#discount').closest('.form-group').addClass('has-error');
        } else {
          $('#discount').closest('.form-group').addClass('has-success');
        } // /else

        if (paymentType == "") {
          $("#paymentType").after('<p class="text-danger"> El campo Tipo de pago es obligatorio </p>');
          $('#paymentType').closest('.form-group').addClass('has-error');
        } else {
          $('#paymentType').closest('.form-group').addClass('has-success');
        } // /else

        if (paymentStatus == "") {
          $("#paymentStatus").after('<p class="text-danger"> El campo Estado de pago es obligatorio </p>');
          $('#paymentStatus').closest('.form-group').addClass('has-error');
        } else {
          $('#paymentStatus').closest('.form-group').addClass('has-success');
        } // /else


        // array validation
        var productName = document.getElementsByName('productName[]');
        var validateProduct;
        for (var x = 0; x < productName.length; x++) {
          var productNameId = productName[x].id;
          if (productName[x].value == '') {
            $("#" + productNameId + "").after('<p class="text-danger"> El campo nombre producto es obligatorio!! </p>');
            $("#" + productNameId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + productNameId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < productName.length; x++) {
          if (productName[x].value) {
            validateProduct = true;
          } else {
            validateProduct = false;
          }
        } // for              

        var quantity = document.getElementsByName('quantity[]');
        var validateQuantity;
        for (var x = 0; x < quantity.length; x++) {
          var quantityId = quantity[x].id;
          if (quantity[x].value == '') {
            $("#" + quantityId + "").after('<p class="text-danger"> El campo Nombre del producto es obligatorio!! </p>');
            $("#" + quantityId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + quantityId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < quantity.length; x++) {
          if (quantity[x].value) {
            validateQuantity = true;
          } else {
            validateQuantity = false;
          }
        } // for        


        if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
          if (validateProduct == true && validateQuantity == true) {
            // create order button
            // $("#createOrderBtn").button('loading');

            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success: function(response) {
                console.log(response);
                // reset button
                $("#editOrderBtn").button('reset');

                $(".text-danger").remove();
                $('.form-group').removeClass('has-error').removeClass('has-success');

                if (response.success == true) {

                  // create order button
                  $(".success-messages").html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    '</div>');

                  $("html, body, div.panel, div.pane-body").animate({
                    scrollTop: '0px'
                  }, 100);

                  // disabled te modal footer button
                  $(".editButtonFooter").addClass('div-hide');
                  // remove the product row
                  $(".removeProductRowBtn").addClass('div-hide');

                } else {
                  alert(response.messages);
                }
              } // /response
            }); // /ajax
          } // if array validate is true
        } // /if field validate is true


        return false;
      }); // /edit order form function  
    }

  }); // /documernt


  // print order function
  function printOrder(orderId = null) {
    if (orderId) {

      $.ajax({
        url: 'php_action/printOrder.php',
        type: 'post',
        data: {
          orderId: orderId
        },
        dataType: 'text',
        success: function(response) {

          var mywindow = window.open('', 'Sistema de Factura', 'height=400,width=600');
          mywindow.document.write('<html><head><title>Factura</title>');
          mywindow.document.write('</head><body>');
          mywindow.document.write(response);
          mywindow.document.write('</body></html>');

          mywindow.document.close(); // necessary for IE >= 10
          mywindow.focus(); // necessary for IE >= 10
          mywindow.resizeTo(screen.width, screen.height);
          setTimeout(function() {
            mywindow.print();
            mywindow.close();
          }, 1250);

          //mywindow.print();
          //mywindow.close();

        } // /success function
      }); // /ajax function to fetch the printable order
    } // /if orderId
  } // /print order function

  function addRow() {
    $("#addRowBtn").button("loading");

    var tableLength = $("#productTable tbody tr").length;

    var tableRow;
    var arrayNumber;
    var count;

    if (tableLength > 0) {
      tableRow = $("#productTable tbody tr:last").attr('id');
      arrayNumber = $("#productTable tbody tr:last").attr('class');
      count = tableRow.substring(3);
      count = Number(count) + 1;
      arrayNumber = Number(arrayNumber) + 1;
    } else {
      // no table row
      count = 1;
      arrayNumber = 0;
    }

    $.ajax({
      url: 'php_action/fetchProductData.php',
      type: 'post',
      dataType: 'json',
      success: function(response) {
        $("#addRowBtn").button("reset");

        var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
          '<td>' +
          '<div class="form-group">' +

          '<select class="form-control" name="productName[]" id="productName' + count + '" onchange="getProductData(' + count + ')" >' +
          '<option value="">~~Seleccionar~~</option>';
        // console.log(response);
        $.each(response, function(index, value) {
          tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
        });

        tr += '</select>' +
          '</div>' +
          '</td>' +
          '<td style="padding-left:20px;"">' +
          '<input type="text" name="rate[]" id="rate' + count + '" autocomplete="off" disabled="true" class="form-control" />' +
          '<input type="hidden" name="rateValue[]" id="rateValue' + count + '" autocomplete="off" class="form-control" />' +
          '</td style="padding-left:20px;">' +
          '<td style="padding-left:20px;">' +
          '<div class="form-group">' +
          '<p id="available_quantity' + count + '"></p>' +
          '</div>' +
          '</td>' +
          '<td style="padding-left:20px;">' +
          '<div class="form-group">' +
          '<input type="number" name="quantity[]" id="quantity' + count + '" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
          '</div>' +
          '</td>' +
          '<td style="padding-left:20px;">' +
          '<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" disabled="true" />' +
          '<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control" />' +
          '</td>' +
          '<td>' +
          '<button class="btn btn-primary removeProductRowBtn" type="button" onclick="addRow(' + count + ')"><i class="fa fa-plus"></i></button>' +
          '</td>' +
          '<td>' +
          '<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="fa fa-trash"></i></i></button>' +
          '</td>' +

          '</tr>';
        if (tableLength > 0) {
          $("#productTable tbody tr:last").after(tr);
        } else {
          $("#productTable tbody").append(tr);
        }

      } // /success
    }); // get the product data

  } // /add row

  function removeProductRow(row = null) {
    if (row) {
      $("#row" + row).remove();


      subAmount();
    } else {
      alert('error! Actuliza la página');
    }
  }

  // select on product data
  function getProductData(row = null) {

    if (row) {
      var productId = $("#productName" + row).val();

      if (productId == "") {
        $("#rate" + row).val("");

        $("#quantity" + row).val("");
        $("#total" + row).val("");

        // remove check if product name is selected
        // var tableProductLength = $("#productTable tbody tr").length;     
        // for(x = 0; x < tableProductLength; x++) {
        //  var tr = $("#productTable tbody tr")[x];
        //  var count = $(tr).attr('id');
        //  count = count.substring(3);

        //  var productValue = $("#productName"+row).val()

        //  if($("#productName"+count).val() == "") {         
        //    $("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide'); 
        //    console.log("#changeProduct"+count);
        //  }                     
        // } // /for

      } else {
        $.ajax({
          url: 'php_action/fetchSelectedProduct.php',
          type: 'post',
          data: {
            productId: productId
          },
          dataType: 'json',
          success: function(response) {
            // setting the rate value into the rate input field

            $("#rate" + row).val(response.rate);
            $("#rateValue" + row).val(response.rate);

            $("#quantity" + row).val(1);
            $("#available_quantity" + row).text(response.quantity);

            var total = Number(response.rate) * 1;
            total = total.toFixed(2);
            $("#total" + row).val(total);
            $("#totalValue" + row).val(total);



            subAmount();
          } // /success
        }); // /ajax function to fetch the product data 
      }

    } else {
      alert('no row! please refresh the page');
    }
  } // /select on product data

  // table total
  function getTotal(row = null) {
    if (row) {
      var total = Number($("#rate" + row).val()) * Number($("#quantity" + row).val());
      total = total.toFixed(2);
      $("#total" + row).val(total);
      $("#totalValue" + row).val(total);

      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
      var tr = $("#productTable tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(3);

      totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#subTotal").val(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);

    // vat
    var vat = (Number($("#subTotal").val()) / 100) * 18;
    vat = vat.toFixed(2);
    $("#vat").val(vat);
    $("#vatValue").val(vat);

    // total amount
    var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
    totalAmount = totalAmount.toFixed(2);
    $("#totalAmount").val(totalAmount);
    $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if (discount) {
      var grandTotal = Number($("#totalAmount").val()) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#grandTotal").val(grandTotal);
      $("#grandTotalValue").val(grandTotal);
    } else {
      $("#grandTotal").val(totalAmount);
      $("#grandTotalValue").val(totalAmount);
    } // /else discount 

    var paidAmount = $("#paid").val();
    if (paidAmount) {
      paidAmount = Number($("#grandTotal").val()) - Number(paidAmount);
      paidAmount = paidAmount.toFixed(2);
      $("#due").val(paidAmount);
      $("#dueValue").val(paidAmount);
    } else {
      $("#due").val($("#grandTotal").val());
      $("#dueValue").val($("#grandTotal").val());
    } // else

  } // /sub total amount

  function discountFunc() {
    var discount = $("#discount").val();
    var totalAmount = Number($("#totalAmount").val());
    totalAmount = totalAmount.toFixed(2);

    var grandTotal;
    if (totalAmount) {
      grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
      grandTotal = grandTotal.toFixed(2);

      $("#grandTotal").val(grandTotal);
      $("#grandTotalValue").val(grandTotal);
    } else {}

    var paid = $("#paid").val();

    var dueAmount;
    if (paid) {
      dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
      dueAmount = dueAmount.toFixed(2);

      $("#due").val(dueAmount);
      $("#dueValue").val(dueAmount);
    } else {
      $("#due").val($("#grandTotal").val());
      $("#dueValue").val($("#grandTotal").val());
    }

  } // /discount function

  function paidAmount() {
    var grandTotal = $("#grandTotal").val();

    if (grandTotal) {
      var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
      dueAmount = dueAmount.toFixed(2);
      $("#due").val(dueAmount);
      $("#dueValue").val(dueAmount);
    } // /if
  } // /paid amoutn function


  function resetOrderForm() {
    // reset the input field
    $("#createOrderForm")[0].reset();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error 
    $(".form-group").removeClass('has-success').removeClass('has-error');
  } // /reset order form


  // remove order from server
  function removeOrder(orderId = null) {
    if (orderId) {
      $("#removeOrderBtn").unbind('click').bind('click', function() {
        $("#removeOrderBtn").button('loading');

        $.ajax({
          url: 'php_action/removeOrder.php',
          type: 'post',
          data: {
            orderId: orderId
          },
          dataType: 'json',
          success: function(response) {
            $("#removeOrderBtn").button('reset');

            if (response.success == true) {

              manageOrderTable.ajax.reload(null, false);
              // hide modal
              $("#removeOrderModal").modal('hide');
              // success messages
              $("#success-messages").html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                '</div>');

              // remove the mesages
              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert            

            } else {
              // error messages
              $(".removeOrderMessages").html('<div class="alert alert-warning">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                '</div>');

              // remove the mesages
              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert            
            } // /else

          } // /success
        }); // /ajax function to remove the order

      }); // /remove order button clicked


    } else {
      alert('error! actualiza la página nuevamente');
    }
  }
  // /remove order from server

  // Payment ORDER
  function paymentOrder(orderId = null) {
    if (orderId) {

      $("#orderDate").datepicker();

      $.ajax({
        url: 'php_action/fetchOrderData.php',
        type: 'post',
        data: {
          orderId: orderId
        },
        dataType: 'json',
        success: function(response) {

          // due 
          $("#due").val(response.order[10]);

          // pay amount 
          $("#payAmount").val(response.order[10]);

          var paidAmount = response.order[9]
          var dueAmount = response.order[10];
          var grandTotal = response.order[8];

          // update payment
          $("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
            var payAmount = $("#payAmount").val();
            var paymentType = $("#paymentType").val();
            var paymentStatus = $("#paymentStatus").val();

            if (payAmount == "") {
              $("#payAmount").after('<p class="text-danger">El de pago es obligatorio</p>');
              $("#payAmount").closest('.form-group').addClass('has-error');
            } else {
              $("#payAmount").closest('.form-group').addClass('has-success');
            }

            if (paymentType == "") {
              $("#paymentType").after('<p class="text-danger">El monto de pago es requerido</p>');
              $("#paymentType").closest('.form-group').addClass('has-error');
            } else {
              $("#paymentType").closest('.form-group').addClass('has-success');
            }

            if (paymentStatus == "") {
              $("#paymentStatus").after('<p class="text-danger">El monto de pago es requerido</p>');
              $("#paymentStatus").closest('.form-group').addClass('has-error');
            } else {
              $("#paymentStatus").closest('.form-group').addClass('has-success');
            }

            if (payAmount && paymentType && paymentStatus) {
              $("#updatePaymentOrderBtn").button('loading');
              $.ajax({
                url: 'php_action/editPayment.php',
                type: 'post',
                data: {
                  orderId: orderId,
                  payAmount: payAmount,
                  paymentType: paymentType,
                  paymentStatus: paymentStatus,
                  paidAmount: paidAmount,
                  grandTotal: grandTotal
                },
                dataType: 'json',
                success: function(response) {
                  $("#updatePaymentOrderBtn").button('loading');

                  // remove error
                  $('.text-danger').remove();
                  $('.form-group').removeClass('has-error').removeClass('has-success');

                  $("#paymentOrderModal").modal('hide');

                  $("#success-messages").html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    '</div>');

                  // remove the mesages
                  $(".alert-success").delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                      $(this).remove();
                    });
                  }); // /.alert  

                  // refresh the manage order table
                  manageOrderTable.ajax.reload(null, false);

                } //

              });
            } // /if

            return false;
          }); // /update payment      

        } // /success
      }); // fetch order data
    } else {
      alert('Error ! Refresh the page again');
    }
  }
</script>

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

    /* Mejoras en tabla de productos */
    #productTable {
        border-radius: 10px !important;
        overflow: hidden !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important;
        margin-bottom: 30px !important;
    }

    #productTable thead th {
        background: linear-gradient(135deg, rgba(16, 43, 73, 0.05), rgba(92, 74, 199, 0.1)) !important;
        border-bottom: none !important;
        color: #102b49 !important;
        font-weight: 600 !important;
        padding: 15px !important;
    }

    #productTable tbody td {
        padding: 15px 10px !important;
        border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
        vertical-align: middle !important;
    }

    #productTable tbody tr {
        transition: background 0.3s ease !important;
    }

    #productTable tbody tr:hover {
        background-color: rgba(92, 74, 199, 0.03) !important;
    }

    /* Mejoras en botones */
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

    .btn-danger {
        background: linear-gradient(135deg, #f05746, #c9302c) !important;
        border: none !important;
        border-radius: 50px !important;
        padding: 8px 20px !important;
        font-weight: 600 !important;
        box-shadow: 0 5px 15px rgba(201, 48, 44, 0.3) !important;
        transition: all 0.3s ease !important;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #c9302c, #f05746) !important;
        box-shadow: 0 8px 20px rgba(201, 48, 44, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838) !important;
        border: none !important;
        border-radius: 50px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        font-size: 14px !important;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3) !important;
        transition: all 0.3s ease !important;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #218838, #28a745) !important;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    /* Botones pequeños */
    .btn-flat {
        border-radius: 50px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s ease !important;
    }

    .btn-flat:hover {
        transform: translateY(-3px) !important;
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

    .sidebar-nav > ul > li > a {
        border-radius: 8px !important;
        margin: 5px 15px !important;
        transition: all 0.3s ease !important;
    }

    .sidebar-nav > ul > li > a:hover {
        background: rgba(92, 74, 199, 0.1) !important;
        color: #5c4ac7 !important;
    }

    /* Estilos para corregir el menú dashboard */
    .sidebar-nav > ul > li.active > a {
        background: #5c4ac7 !important; /* Solo color morado */
        background-image: none !important; /* Elimina gradiente si existe */
        color: white !important;
        box-shadow: 0 5px 15px rgba(92, 74, 199, 0.4) !important;
    }

    /* Cambiar color de iconos a blanco */
    .sidebar-nav > ul > li > a i, 
    .sidebar-nav > ul > li.active > a i {
        color: white !important;
    }

    /* Estilo al pasar el mouse */
    .sidebar-nav > ul > li > a:hover i {
        color: #5c4ac7 !important;
    }

    /* Color del texto del menú activo */
    .sidebar-nav > ul > li.active > a .hide-menu {
        color: white !important;
    }

    /* Estilos específicos para el formulario de facturas */
    .submitButtonFooter {
        margin-top: 30px !important;
        text-align: center !important;
    }

    .submitButtonFooter .btn {
        margin: 0 10px !important;
    }

    #available_quantity {
        font-weight: 500 !important;
        color: #5c4ac7 !important;
    }
</style>