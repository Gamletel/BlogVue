import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

export const  echo = new Echo({
  broadcaster: 'reverb',
  key: 'rsnei8tzaydlxuhciuzm',
  wsHost: "127.0.0.1",
  wsPort: 9000,
  wssPort: 9000,
  forceTLS: false,
  enabledTransports: 'ws',
});
