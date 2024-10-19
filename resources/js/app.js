import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import '@selectize/selectize/dist/css/selectize.bootstrap5.css';
import '@selectize/selectize/dist/js/selectize';
import 'jquery-modal/jquery.modal';
import 'jquery-modal/jquery.modal.css';
//import 'bootstrap/dist/css/bootstrap.min.css';

import jQuery from 'jquery';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.$ = jQuery;

Alpine.start();
