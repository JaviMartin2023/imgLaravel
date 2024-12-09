<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Imagen</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .image-details {
            text-align: center;
        }
        .image-details img {
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
        }
        .image-info {
            margin-top: 20px;
        }
        .image-info p {
            font-size: 1.2rem;
            color: #333;
        }
        .delete-button {
            padding: 10px 20px;
            background-color: #ff3333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-details">
        <img src="{{ asset('ejercicio/' . $image->stored_name) }}" alt="{{ $image->original_name }}" style="max-width: 600px; height: auto;">
        <div class="image-info">
                <p><strong>Nombre Original:</strong> {{ $image->original_name }}</p>
                <p><strong>Nombre Guardado:</strong> {{ $image->stored_name }}</p>
                <p><strong>Fecha:</strong> {{ $image->created_at->format('d-m-Y H:i:s') }}</p>
            </div>
            <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Eliminar Imagen</button>
                
            </form>
        </div>
    </div>
</body>
</html>
