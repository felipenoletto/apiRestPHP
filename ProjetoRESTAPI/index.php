<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>REST API - PHP</title>
    <?php
        header('Content-type: application/json');
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="datatables.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="datatables.min.css" />
    <script type="text/javascript" src="datatables.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
</head>
<body>

    

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>
</html>