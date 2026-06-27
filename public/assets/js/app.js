document.querySelectorAll('.toggle-password').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var input = this.closest('.input-wrap').querySelector('input');
        input.type = input.type === 'password' ? 'text' : 'password';
    });
});
