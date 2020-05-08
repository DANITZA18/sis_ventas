<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <style>
        *{
      font-family: sans-serif;
    }
    *{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    @page{
        margin-left: 2.5cm;
        margin-top: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
    }

    body{
        position: relative;
    }

    .titulo{
        margin-right: auto;
        margin-left: auto;
        margin-bottom: auto;
        width: 300px;
    }
    
    .titulo p.emp{
        text-align: center;
        font-size: 1.05em;
        padding: 0;
        margin-bottom: -10px;
    }
    .titulo p.dir{
        text-align: center;
        font-size: 0.60em;
        padding: 0;
        margin-bottom: -10px;
    }

    .titulo p.activi{
        text-align: center;
        font-size: 0.60em;
        padding: 0;
    }

    .titulo_derecha{
        position: absolute;
        top: -40px;
        right: -55px;
        width: 180px;
    }
    
    .titulo_derecha h2{
        text-align: center;
        font-size: 0.85em;
        color:#008b35;
        font-family: Calibri, sans-serif;
        border:solid 1px #008b35;
        background: #c1f5d4;
        margin-bottom: 2px;
    }
    
    .titulo_derecha .contenedor_info{
        padding-left: 5px;
        width: 100%;
        border:solid 1px #008b35;
    }

    .titulo_derecha .contenedor_info p.info{
        font-size: 0.55em;
    }
    .logo{
        width: 130;
        height: 120px;
        position: absolute;
        top: -40px;
        left: -35px;
    }
    
    .datos_factura{
        font-size: 0.75em;
        width: 100%;
        margin-bottom: 10px;
        margin-top: 15px;
    }
    
    .datos_factura .c1{
        width: 20%;
    }
    
    .datos_factura .c2{
        width: 20%;
    }

    .factura{
        border-collapse: collapse;
        position: relative;
        width: 100%;
        font-size: 0.7em;
    }
    
    .factura thead tr{
        background:#008b35;
        color:white;
    }
    
    .factura thead tr th{
        text-align: center;
    }
    
    .factura tbody tr td{
        text-align: center;
    }
      
    .factura tbody tr.total td:first-child{
        text-align: right;
        padding-right: 15px;
    }
    
    .factura tbody tr.total_final td:nth-child(5n), tr.total_final td:nth-child(6n){
        background:#008b35;
        color:white;
    }

    .factura tbody tr.total_literal td:nth-child(3n){
        text-align: right;
        padding-right: 15px;
    }

    .factura tbody tr.total_literal td:nth-child(4n){
        text-align: left;
        padding-left: 15px;
    }

    .codigos{
        margin-top: 35px;
        width: 70%;
    }

    .codigos tbody tr td{
        font-size: 0.7em;
    }

    .codigos tbody tr td.c1{
        width: 35%;
    }   

    .codigos tbody tr td.c2{
        width: 65%;
    }

    .codigos tbody tr td.qr{
        width: 30%;
    }

    .qr{
        width: 120px;
        height: 120px;
    }

    .qr img{
        width: 100%;
        height: 100%;
    }

    .info1{
        margin-top: 20px;
        text-align: center;
        font-weight: bold;
        font-size: 0.6em;
    }
    .info2{
        text-align: center;
        font-weight: bold;
        font-size: 0.5em;
    }
    
    </style>
</head>


</html>