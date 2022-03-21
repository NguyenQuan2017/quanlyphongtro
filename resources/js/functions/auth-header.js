import axios from "axios";
export default function authHeader() {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token')
}
