<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link class="navbar-brand" :to="{name: 'dashboard.index'}">QUẢN LÝ PHÒNG TRỌ</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto" v-if="authenticated">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'room.create'}">TẠO PHÒNG</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'people.create'}">THÊM NGƯỜI VÀO PHÒNG</router-link>
                </li>
            </ul>
<!--            <ul class="navbar-nav" v-if="!authenticated">-->
<!--                <li clas="nav-item">-->
<!--                    <a class="nav-link" style="cursor: pointer;" >ĐĂNG NHẬP</a>-->
<!--                </li>-->
<!--                <li clas="nav-item">-->
<!--                    <a class="nav-link" style="cursor: pointer;" >ĐĂNG KÝ</a>-->
<!--                </li>-->
<!--            </ul>-->
            <ul class="navbar-nav" v-if="authenticated">
                <li clas="nav-item">
                    <a class="nav-link" style="cursor: pointer;" @click="onLogout">ĐĂNG XUẤT</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import { useStore } from "vuex";
import { computed,onMounted,ref } from "vue";
import { useRouter } from "vue-router";
import auth from "../../functions/auth";
export default {
    name: "Nav",
    computed: {

    },
    setup() {
        const store = useStore();
        let authenticated = computed(() =>  store.state.authenticated);

        const { logOut } = auth();
        const onLogout = async () => {
            await logOut();
        };

        if (localStorage.getItem('auth_token')) {
            store.dispatch('setAuth', true)
        }

        return {
            authenticated,
            onLogout
        }
    }
}
</script>
