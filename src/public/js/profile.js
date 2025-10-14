document.addEventListener('DOMContentLoaded', () => {
    const avatarInput = document.getElementById('avatarInput');
    const preview = document.getElementById('preview');

    avatarInput.addEventListener('change', event => {
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
    });
});
