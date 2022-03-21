import { ref } from "vue";
import axios from "axios";
import authHeader from "./auth-header";
import  { useRouter } from "vue-router";
import Api from "../api/api";

export default function usePeople() {

    const errors = ref([]);
    const isLoading = ref(false);
    const router = useRouter();
    const people = ref([]);


    const createPeople = async (data) => {
        try {
            isLoading.value = true;
            await Api.post('/api/people/create',data);
            await router.push({name: 'dashboard.index'})
        }catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.message) {
                    errors.value.push(e.response.data.message[key]);
                }
            }
        }
        isLoading.value = false;
    };

    const getPeople = async (id) => {
        try {
            isLoading.value = true;
            let res = await Api.get('/api/people/'+ id);
            people.value = res.data;
        }catch (e) {
        }
        isLoading.value = false;
    };

    const updatePeople = async (id) => {
        try {
            isLoading.value = true;
            await Api.put('/api/people/update/' + id, people.value);
            await router.push({name: 'dashboard.index'});
        }catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.message) {
                    errors.value.push(e.response.data.message[key]);
                }
            }
        }
        isLoading.value = false;
    };

    const deletePeople = async (id) => {
        try {
            isLoading.value = true;
            await Api.delete('/api/people/delete/' + id);
            await router.push({name: 'dashboard.index'});
        }catch (e) {
            console.log(e.response);
        }
        isLoading.value = false;
    }

    return {
        createPeople,
        updatePeople,
        getPeople,
        deletePeople,
        errors,
        isLoading,
        people
    }
}
