<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css">
    <style>

        td {
            font-weight:bold;
            font:bold 12pt arial;

        }

        h3 {
            text-decoration: underline;
        }

        .topics {
            font-weight: 400;color: black;font-size: 13px;
        }

        .td-line {
            border-top: 0px solid #dddddd !important;
        }
        @media all {
            .page-break  { display: none; }
        }

        @media print {
            .page-break  { display: block; page-break-before: always; }
        }

        .table>tbody>tr>td {
            padding: 8px;
            line-height: 1.846;
            vertical-align: top;
            border-top: 1px solid #f5f5f5;
        }

        .sub-text {
            color:black;
        }
    </style>

</head>
<body cz-shortcut-listen="true"><div class="container" style="width: 90%;">


    <div class="page-break"></div>


    <div align="center">
        <span class="topics" style="text-decoration: underline;">Purchase Returns Informations </span>
    </div>

    <table class="table" border="0.5" width="100%">
        <tr>
            <th>
               Supplier Name
            </th>
            <th>
               Item Name
            </th>
            <th>
               Quantity
            </th>
            <th>
               Order Date
            </th>
        </tr>

        <?php
        $x = 1;
        foreach ($purchaseReturns as $items){ ?>
        <tr>
            <td>
                <?php echo $items->supplier_name ?>
            </td>
            <td>
                <?php echo $items->item_name ?>
            </td>
            <td>
                <?php echo $items->quantity ?>
            </td>
            <td>
                <?php echo $items->order_date ?>
            </td>

        </tr>

        <?php  } ?>
    </table>

    <div class="page-break"></div>


    <div class="page-break"></div>

</div>
</div>
</body></html>

<script>
    window.print();
</script>