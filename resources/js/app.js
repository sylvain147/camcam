require('./bootstrap');
import $ from "jquery";
import { Notyf } from 'notyf';
import Alpine from 'alpinejs';
import Sortable from "sortablejs";
window.Alpine = Alpine;
var el = document.getElementById('rank');
var sortable = Sortable.create(el,{
    handle: '.my-handle',
    animation: 150
});
$('.save').on('click', () => {
    console.log('ici')
   $.ajax({
       url : '/save-rank',
       method : 'POST',
       data : {
           songs : sortable.toArray(),
           '_token' : $('.token').data('token')
       }
   }).then(()=>{
       let notyf = new Notyf();
       notyf.success('Changements sauvegardés!');

   })
})
Alpine.start();
