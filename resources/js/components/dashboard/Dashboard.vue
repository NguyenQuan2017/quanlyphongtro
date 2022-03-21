<template>
    <Loading v-if="isLoading"/>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <div class="col-12 d-flex align-items-center">
                    <h5 class="mb-0 col-10">
                       DANH SÁCH PHÒNG
                    </h5>
                </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="row">
                    <div class="card-body col-3" v-for="room in rooms" :key="room.id">
                        <router-link :to="{name: 'room.index', params: {id:room.id}} " class="content-room">
                            <div class="card h-200">
                                <div class="card-body">
                                    <h4 class="d-flex justify-content-center">PHÒNG {{ room.name }}</h4>
                                    <div class="d-flex justify-content-center" v-for="people in room.peoples" >
                                        <p>{{ people.full_name.toUpperCase() }}</p>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .button-action {
        display: grid;
    }
    .button-info {
        margin-bottom: 10px;
    }
</style>
<script>
    import { useStore } from "vuex";
    import { useRouter } from "vue-router";
    import {onMounted,computed} from "vue";
    import useRoom from "../../functions/room";
    import Loading from "../layouts/Loading";
    import auth from "../../functions/auth";
    import usePeople from "../../functions/people";

    export default {
        name: "Dashboard",
        components: {Loading},
        setup() {
            const store = useStore();
            const router = useRouter();
            const { getRooms,rooms,isLoading } = useRoom();
            // const { checkLogin,isLoggedIn } = auth();
            let loggedIn = computed(() => store.state.authenticated);
            onMounted( async () => {
                await getRooms();
            });

            if (localStorage.getItem('auth_token') && loggedIn) {
                router.push({name:'dashboard.index'});
            }

            return {
                rooms,
                isLoading
            }
        }
    }
</script>
<style scoped>
    .content-room {
        color: #1a202c;
        text-decoration: none
    }
</style>
