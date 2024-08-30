import $ from 'jquery';
window.$ = window.jQuery = $;

import 'summernote/dist/summernote-lite.css';
import 'summernote/dist/summernote-lite.js';

document.addEventListener('DOMContentLoaded', function() {
    $('.summernote').summernote({
        placeholder: 'Masukkan deskripsi...',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            
        ],
        fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36'],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Sans Serif']
    });
});