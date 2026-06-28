const quill = new Quill('#quillEditor', {
    theme: 'snow',
    placeholder: 'Write your note here…',
    modules: { toolbar: ['bold', 'italic', 'underline', { list: 'ordered' }, { list: 'bullet' }, 'link'] }
});

document.querySelector('form').addEventListener('submit', () => {
    document.getElementById('noteContent').value = quill.root.innerHTML;
});
