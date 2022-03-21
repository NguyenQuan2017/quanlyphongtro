import { ref } from "vue";
import authHeader from "./auth-header";
import  { useRouter } from "vue-router";
import axios from "axios";
import Api from "../api/api";

export default function useRoom() {
    const errors = ref([]);
    const isLoading = ref(false);
    const router = useRouter();
    const rooms = ref([]);
    const room = ref([]);

    const getRooms = async () => {
        try {
            isLoading.value = true;
            let res = await Api.get('/api/room');
            rooms.value = res.data;
        }catch (e) {
            console.log(e);
        }
        isLoading.value = false;
    }

    const createRoom = async (data) => {
        errors.value = [];
        try {
            isLoading.value = true;
            await Api.post('/api/room/create',data);
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

    const updateRoom = async (id) => {
       try {
           isLoading.value = true;
           await Api.put('/api/room/update/' + id,room.value);
           await router.push({ name: 'dashboard.index'});
       } catch (e) {
           if (e.response.status === 422) {
               for (const key in e.response.data.message) {
                   errors.value.push(e.response.data.message[key]);
               }
           }
       }
       isLoading.value = false;
    };

    const deleteRoom = async (id) => {
        try {
            await Api.delete('/api/room/delete/' + id);
            await router.push({ name: 'dashboard.index'});
        }catch (e) {
            console.log(e.response);
        }
    }

    const getRoom = async (id) => {
        try {
            isLoading.value = true;
            let res = await Api.get('/api/room/'+ id);
            room.value = res.data;
        }catch (e) {
            console.log(e.response);
        }
        isLoading.value = false;
    }

    return {
        getRooms,
        createRoom,
        updateRoom,
        getRoom,
        deleteRoom,
        room,
        rooms,
        errors,
        isLoading,
    }
}
