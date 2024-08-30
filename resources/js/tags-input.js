import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.min.css';

$(document).ready(function() {
    $('#tags-input').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: "Pilih atau ketik tags",
        data: [
            { id: 'Keraton Kasepuhan', text: 'Keraton Kasepuhan' },
            { id: 'Batik Trusmi', text: 'Batik Trusmi' },
            { id: 'Gua Sunyaragi', text: 'Gua Sunyaragi' },
            { id: 'Nasi Jamblang', text: 'Nasi Jamblang' },
            { id: 'Empal Gentong', text: 'Empal Gentong' },
            { id: 'Pantai Kejawanan', text: 'Pantai Kejawanan' },
            { id: 'Seni Tarling', text: 'Seni Tarling' },
            { id: 'Pelabuhan Cirebon', text: 'Pelabuhan Cirebon' },
            { id: 'Masjid Agung Sang Cipta Rasa', text: 'Masjid Agung Sang Cipta Rasa' },
            { id: 'Taman Ade Irma Suryani', text: 'Taman Ade Irma Suryani' }
        ]
    });
});