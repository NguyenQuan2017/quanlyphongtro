<template>
   <Nav/>
    <div class="container-fluid">
        <router-view/>
    </div>
</template>
<script>

import Nav from "./components/layouts/Nav";
import {computed,onMounted} from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import $ from "jquery";

export default {
    name: "App",
    components: {Nav}
}
</script>
