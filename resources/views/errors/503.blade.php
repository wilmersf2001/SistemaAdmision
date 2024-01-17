<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
        }

        .container {
            width: 98vw;
            height: 90vh;
            display: grid;
            place-items: center;
            background-color: #ffffff;
            padding: 6px;
        }

        .content {
            text-align: center;
        }

        .base-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #4f46e5;
        }

        .header-text {
            margin-top: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: -0.02em;
            color: #333333;
        }

        .sub-text {
            width: 50%;
            margin-top: 1.5rem;
            font-size: 1rem;
            line-height: 1.75;
            color: #666666;
        }

        .button-group {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .home-button {
            padding: 8px 14px;
            border-radius: 4px;
            background-color: #4f46e5;
            font-size: 0.875rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
            transition: background-color 0.3s ease-in-out;
        }

        .home-button:hover {
            background-color: #3c349b;
        }

        .support-link {
            font-size: 0.875rem;
            font-weight: bold;
            color: #333333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .support-link span {
            margin-left: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <p class="base-text semibold indigo-color">503</p>
            <h1 class="header-text">¡Estaremos de vuelta pronto!</h1>
            <div style="display:flex; justify-content: center;">
                <p class="sub-text">Disculpe las molestias, pero estamos realizando tareas de mantenimiento en este
                    momento.
                    Si lo necesita, siempre puede contactarnos; de lo contrario, ¡volveremos a estar en línea en breve!.
                </p>
            </div>
            <div class="button-group">
                <a href="https://admision.unprg.edu.pe/" class="home-button">Ir al portal UNPRG <span>&rarr;</span></a>
            </div>
        </div>
    </div>
</body>

</html>
