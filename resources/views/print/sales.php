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
        <span class="topics" style="text-decoration: underline;">Sales Information </span>
    </div>

    <table class="table" border="0.5" width="100%">
        <tr>
            <th>
                <strong> Customer Name </strong>
            </th>
            <th>
                <strong> Item Name </strong>
            </th>
            <th>
                <strong> Quantity </strong>
            </th>
            <th>
                <strong> Dispatch Date </strong>
            </th>
            <th>
                <strong> Unit Price </strong>
            </th>
            <th>
                <strong> Max Retail Price </strong>
            </th>
            <th>
                <strong> Profit </strong>
            </th>
        </tr>

        <?php
        $x = 1;
        foreach ($sales as $items){ ?>
            <tr>
                <td>
                    <?php echo $items->customer_name ?>
                </td>
                <td>
                    <?php echo $items->title ?>
                </td>
                <td>
                    <?php echo $items->quantity ?>
                </td>
                <td>
                    <?php echo $items->dispatch_date ?>
                </td>
                <td>
                    Rs. <?php echo $items->unit_price ?>
                </td>
                <td>
                    Rs. <?php echo $items->max_retail_price ?>
                </td>
                <td>
                    Rs. <?php echo ($items->max_retail_price - $items->unit_price) * $items->quantity  ?>
                </td>

            </tr>

        <?php  } ?>
        <tr>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>
                Total Profit
            </td>
            <td>
                Rs. <?php echo ($items->max_retail_price - $items->unit_price) * $items->quantity  ?>
            </td>
        </tr>

    </table>

    <div class="page-break"></div>


    <div class="page-break"></div>

</div>
</div>
</body></html>

<script>
    window.print();
</script>