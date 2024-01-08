<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="shrink-0 mb-5">
        <img src="{{ asset('images/foto-carnet.jpg') }}" id="preview" />
    </div>
    <input type="file" id="fileInput">

    <script>
        const fileInput = document.querySelector('#fileInput');
        const preview = document.querySelector('#preview');


        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            console.log(file);
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.addEventListener('load', (e) => {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
                preview.style.width = '200px';
                preview.style.height = '200px';
            });
        });
    </script>

</body>

</html>
