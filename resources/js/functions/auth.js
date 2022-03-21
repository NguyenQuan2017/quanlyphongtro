import Api from "../api/api";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import authHeader from "./auth-header";
import axios from "axios";

export default function auth() {
    const errors = ref([]);
    const router = useRouter();
    const store = useStore();
    const isLoading = ref(false);
    const isLoggedIn = ref(false);

    const login = async (data) => {
        errors.value = [];
        try {
            isLoading.value = true;
            let response = await axios.post('/api/auth/login', data);
            if(response.data.data.access_token) {
                localStorage.setItem('auth_token',response.data.data.access_token);
                await store.dispatch('setAuth', true);
                await router.push({name: 'dashboard.index'});
                isLoading.value = false;
                isLoggedIn.value = true;
            }
        }catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.message) {
                    if (e.response.data.message[key]) {
                        errors.value.push(e.response.data.message[key]);
                    }
                }
            }else if(e.response.status === 401 && e.response.data.message) {
                errors.value.push(e.response.data.message[0]);
            }
            isLoading.value = false;
        }
    }

    const register = async (data) => {
        errors.value = [];
        try {
            await axios.post('/api/auth/register', data);
            await router.push({name: 'login.index'})
        }catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.message) {
                    if (e.response.data.message[key]) {
                        errors.value.push(e.response.data.message[key]);
                    }
                }
            }
        }
    }

    const logOut = async () => {
        try {
            isLoading.value = true;
            let res = await Api.post('/api/auth/logout');
            if (res.data.status && res.data.status === 'Success') {
                await router.push({name: 'login.index'});
                localStorage.setItem('auth_token','');
                await store.dispatch('setAuth', false);
                isLoading.value = false;
                isLoggedIn.value = true;
            }
        } catch (e) {
            console.log(e);
            isLoading.value = false;
        }
    }

    const checkLogin = async () => {
        try {
            authHeader();
            let res = await axios.post('/api/auth/check-login');
            isLoggedIn.value = res.data.isLogin;
        }catch (e) {
           if(e.response.status === 401) {
               isLoggedIn.value = false;
           }
        }
    }


    return {
        errors,
        login,
        logOut,
        register,
        isLoading,
        checkLogin,
        isLoggedIn
    }
}
