import './bootstrap';
import 'flowbite';
import { initToastErrors } from './components/toast-errors';
import { initPasswordToggles } from './components/password-toggle';

document.addEventListener('DOMContentLoaded', () => {
    initToastErrors();
    initPasswordToggles();
});

import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

Swiper.use([Autoplay, Pagination]);
window.Swiper = Swiper;