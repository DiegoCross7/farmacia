<?php
require_once 'constant/connect.php';

// 1) Validar GET
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: Falta el parámetro id de la factura');
}
$id = intval($_GET['id']);

// 2) Recuperar la orden (solo un registro)
$sql  = "SELECT * FROM orders WHERE delete_status = 0 AND id = $id";
$res  = $connect->query($sql);
if (!$res || $res->num_rows === 0) {
    die('Factura no encontrada');
}
$order = $res->fetch_assoc();

// 3) Recuperar los items
$sql2  = "SELECT oi.*, p.product_name, p.bno, p.expdate, p.mrp
          FROM order_item AS oi
          JOIN product AS p ON p.product_id = oi.productName
          WHERE oi.lastid = $id";
$res2  = $connect->query($sql2);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice Print</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            /*border-bottom: 1px solid #eee;*/
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            /*border-top: 2px solid #eee;*/
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="./assets/uploadImage/Logo/logo_factura.jpg" style="max-width:300px" />
                            </td>

                            <td>
                                Factura #: <?= htmlspecialchars($order['uno']) ?><br>
                                Fecha: <?= htmlspecialchars($order['orderDate']) ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                <?= htmlspecialchars($order['clientName']) ?><br>
                                <?= htmlspecialchars($order['clientContact']) ?><br>
                                <?= htmlspecialchars($order['address']) ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Método de Pago</td>
                <td>Monto</td>
            </tr>
            <tr class="details">
                <td>
                    <?php
                    // Mostrar el método de pago basado en el campo paymentType
                    switch ($order['paymentType']) {
                        case 1:
                            echo "Efectivo";
                            break;
                        case 2:
                            echo "Tarjeta";
                            break;
                        case 3:
                            echo "Transferencia";
                            break;
                        default:
                            echo "Otro";
                            break;
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($order['paid']) ?></td>
            </tr>

            <tr class="heading">
                <td>Medicina</td>
                <td>Lote</td>
                <td>Exp</td>
                <td>Qty</td>
                <td>MRP</td>
                <td>CxP</td>
                <td>Total</td>
            </tr>

            <?php while ($item = $res2->fetch_assoc()) : ?>
                <tr class="item">
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= htmlspecialchars($item['bno']) ?></td>
                    <td><?= htmlspecialchars($item['expdate']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td><?= htmlspecialchars($item['mrp']) ?></td>
                    <td><?= htmlspecialchars($item['rate']) ?></td>
                    <td><?= htmlspecialchars($item['total']) ?></td>
                </tr>
            <?php endwhile; ?>

            <tr class="total">
                <td colspan="6" style="text-align: right;">Descuentos:</td>
                <td><?= htmlspecialchars($order['discount']) ?></td>
            </tr>
            <tr class="total">
                <td colspan="6" style="text-align: right;">Impuestos:</td>
                <td><?= htmlspecialchars($order['gstn']) ?></td>
            </tr>
            <tr class="total">
                <td colspan="6" style="text-align: right;">Total:</td>
                <td><?= htmlspecialchars($order['grandTotalValue']) ?></td>
            </tr>
        </table>
    </div>
</body>

</html>