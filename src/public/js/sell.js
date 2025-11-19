document.addEventListener('DOMContentLoaded', () => {
    const sellImage = document.getElementById('sell_image');
    const preview = document.getElementById('preview');

    sellImage.addEventListener('change', event => {
        const file = event.target.files[0];

        if (file.type.match(/image\/*/)) {
            const reader = new FileReader();
            reader.addEventListener('load', event => {
                preview.src = event.target.result;
            });

            reader.readAsDataURL(file);
        }

        else {
            alert("画像ファイルを選択してください");
            return false;
        }

        preview.style.display = "block";
    });
});

