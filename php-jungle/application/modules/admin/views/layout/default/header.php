<!DOCTYPE HTML>
<html>
<head>
    <title>Hola</title>
    <meta charset="utf8" content="width=device-width, initial-scale=1.0"/>
    
    <!--  incluimos los CSS del layout  -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_layout['layoutUrl']; ?>css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_layout['layoutUrl']; ?>css/style.css">
    
    <!--  Añado los CSS de $this->css  -->
    <?php foreach ($this->css as $css) { ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $css?>">
    <?php }  ?>
    
    
    <!--  paso la variable BASE_URL de php para poder usarla en los js  -->
    <script type="text/javascript">
        var base = '<?php echo BASE_URL; ?>';
    </script>
    
    <!--  Añado los JS de $this->js  -->
    <?php foreach ($this->js as $js) { ?>
            <script type="text/javascript" src="<?php echo $js; ?>"></script>
    <?php }  ?>   
    
</head>

<body>
    
<div id="wrap">
<div id="content">
    
    <header>        
        <h1 id="webTitle">PHP - MODULE</h1>       
    </header>
    
    
    <div id="bodyContent">