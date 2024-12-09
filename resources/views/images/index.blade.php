<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .upload-form {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .upload-form input[type="file"] {
            padding: 10px;
            margin-right: 10px;
        }
        .upload-form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }
        .image-gallery img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .image-gallery img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Sube tu Imagen</h1>
        
        <!-- Formulario de subida -->
        <div class="upload-form">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" required>
                <button type="submit">Subir Imagen</button>
            </form>
        </div>

        <!-- Galería de imágenes -->
        <div class="row">
    @foreach ($images as $image)
        <div class="col-md-3">
            <!-- Mostrar la imagen usando Storage::url() -->
            <img src="{{ asset('ejercicio/' . $image->stored_name) }}" alt="{{ $image->original_name }}" style="max-width: 100px; height: auto;">
            <div class="text-center mt-2">
                <a href="{{ route('images.show', $image->id) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('images.destroy', $image->id) }}" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    @endforeach
</div>

    </div>
</body>
</html>
