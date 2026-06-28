const quill = new Quill('#quillEditor', {
    theme: 'snow',
    placeholder: 'Write your note here…',
    modules: { toolbar: ['bold', 'italic', 'underline', { list: 'ordered' }, { list: 'bullet' }, 'link'] }
});

const noteContent = document.getElementById('noteContent');
if (noteContent.value) {
    quill.root.innerHTML = noteContent.value;
}

document.querySelector('form').addEventListener('submit', () => {
    noteContent.value = quill.root.innerHTML;
});
