<!DOCTYPE html>
<html>
<head>
    <title>Ambil Gambar dari Kamera</title>
</head>
<body>
    <h1>Ambil Gambar dari Kamera</h1>
    <video id="video" width="640" height="480" autoplay></video>
    <button id="snap">Ambil Gambar</button>
    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
    <form id="uploadForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="image" id="image">
        <button type="submit">Unggah Gambar</button>
    </form>

    <script>
        // Akses kamera
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const image = document.getElementById('image');
        const context = canvas.getContext('2d');

        // Dapatkan akses ke kamera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error('Error: ' + err);
            });

        // Ambil gambar ketika tombol di-klik
        snap.addEventListener('click', () => {
            context.drawImage(video, 0, 0, 640, 480);
            const dataUrl = canvas.toDataURL('image/png');
            image.value = dataUrl;
            canvas.style.display = 'block';
        });

        // Tangani pengunggahan formulir
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route("upload.camera.image") }}', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Gambar berhasil diunggah!');
                } else {
                    alert('Gagal mengunggah gambar.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
