import store from '../store/store'

function setup(instance) {
    instance.interceptors.request.use(
        function(config) {
            const token = localStorage.getItem('auth_token');
            if (token) {
                config.headers.Authorization = `Bearer ${token}`
            }
            return config
        },
        function(err) {
            return Promise.reject(err)
        }
    )
}

function checkToken(instance) {
    instance.interceptors.response.use(
        response => {
            if (response.headers['content-type'].startsWith('application/json')) {
                response.data = response.data.data
            }
            return response
        },
        error => {
            if (
                error.response.status === 401) {
                store.dispatch('setAuth', false);
                localStorage.setItem('auth_token', '');
                window.location.href = window.location.origin + '/login'
            }
            return Promise.reject(error)
        }
    )
}

export default {
    setup,
    checkToken
}
