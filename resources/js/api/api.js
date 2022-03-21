import axios from 'axios'
import interceptors from "../interceptors/interceptors";
const Api =
    axios.create({
        // baseURL: 'http:',
        withCredentials: false,
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json'
        },
        timeout: 5000 // request timeout
    })

interceptors.setup(Api);
interceptors.checkToken(Api);

export default Api
