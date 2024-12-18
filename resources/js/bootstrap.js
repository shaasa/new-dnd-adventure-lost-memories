/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;
console.log('APP_URL:', import.meta.env.VITE_APP_URL);
console.log('PUSHER_APP_KEY:', import.meta.env.VITE_PUSHER_APP_KEY || 'pippo');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = import.meta.env.VITE_APP_URL;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;  // Se hai bisogno di inviare cookie con la richiesta

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
const token = localStorage.getItem('authToken');
console.log('Auth Token:', token);
window.Echo =  new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    auth: {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    }

});

// Debug finale
console.log('Echo configurato:', window.Echo);
