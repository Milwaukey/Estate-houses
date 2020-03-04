<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $sPageTitle ?? ''; ?></title>
    <link rel="stylesheet" href="css/style.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sacramento&display=swap" rel="stylesheet">


    <?php if( $sActive == 'view_all_properties' ){
        echo '
        <script src="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js"></script></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css" rel="stylesheet"/>
        ';
    } ?>

</head>
<body>

