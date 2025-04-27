<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba técnica Pandora FMS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
        }
        body {
            display: flex; 
            justify-content: center; 
            align-items: center; 
            font-family: Arial, sans-serif;
        }        
        .container {
            text-align: center; 
        }
        h1 {
            margin-bottom: 20px;
            color: #3e92f2; 
        }
        
        .button-link {
            display: inline-block;
            text-decoration: none;
            color: #333;
            background-color: #ffffff; 
            border: 2px solid #3e92f2; 
            border-radius: 8px; 
            padding: 15px 30px;
            margin: 10px;
            transition: background-color 0.3s, box-shadow 0.3s; 
        }
        .button-link:hover {
            background-color: #e6f0fc; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            color: #3e92f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resolución prueba técnica Pandora FMS</h1>
        <a href="/decodificacion/index.php" class="button-link">Decodificación</a>
        <a href="/sistema_citas/index.php" class="button-link">Sistema de Citas</a>
    </div>
</body>
</html>

