import './bootstrap';



import { createApp } from 'vue';
import T from './T.vue';
import S from './S.vue';
import A from './A.vue';
import C from './components/Comment.vue';
import Top from './components/Top10.vue';


const app = createApp(T);
const app2 = createApp(S);
const app3 = createApp(A);
const app4 = createApp(C);
const app6 = createApp(Top);
const app7 = createApp(Top);

app.mount('#app');
app2.mount('#app2');
app3.mount('#app3');
app4.mount('#app4');
app6.mount('#top10');
app6.mount('#dashboard_t');








