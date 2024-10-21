@script
    <script>
        const btn = document.getElementById('submit-btn');
        const upload = document.getElementById('upload-input');
        var img = null
        const formData = new FormData();
        upload.onchange = () => {
            img = upload.files[0];
            if (img.size > 1024) {
                Livewire.dispatch('show-toast', {
                    err: "image is too large"
                })
            } else {
                formData.append('file', img);
                formData.append('upload_preset', 'bestpost-test-preset')
                btn.click();
            }
        }
        btn.onclick = async function() {
            try {
                const response = await fetch('https://api.cloudinary.com/v1_1/drm3bzgpi/image/upload', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                const img_info = {
                    img_info: [
                        data.secure_url,
                        data.public_id
                    ]

                };
                console.log(img_info)
                Livewire.dispatch('img-uploaded', img_info);
            } catch (e) {
                console.log(e)
            }
        }
    </script>
@endscript
