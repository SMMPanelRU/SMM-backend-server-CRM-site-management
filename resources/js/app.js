import './bootstrap';

import '../sass/app.scss'
import * as bootstrap from 'bootstrap'

import ClassicEditor from "@ckeditor/ckeditor5-build-classic"
window.ClassicEditor = ClassicEditor;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './custom';
