<template>
    <Loading v-if="isLoading"/>
    <div id="accordion">
        <div class="card">
            <form @submit.prevent="createRooms">
                <div class="card-header row" id="headingOne">
                    <div class="col-12 d-flex align-items-center">
                        <h5 class="mb-0 col-11">
                            TẠO PHÒNG
                        </h5>
                        <button type="submit" class="btn btn-primary float-right col-1">LƯU</button>
                    </div>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="content-errors" v-if="errors">
                        <div class="alert alert-danger"  v-for="error in errors">
                            {{error}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Phòng</label>
                            <input type="text" v-on:keypress="NumbersOnly" v-model="form.name" class="form-control" placeholder="Tên phòng">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<style>
    .content-errors {
        margin-top: 20px;
    }
</style>
<script>
    import useRoom from "../../../functions/room";
    import { reactive } from "vue";
    import Loading from "../../layouts/Loading";
    import common from "../../../common/common";

export default {
    components: {Loading},
    setup() {

        const form = reactive({
            'name': ''
        });

        const {createRoom,errors,isLoading} = useRoom();
        const { NumbersOnly } = common();
        const createRooms = async () => {
            await createRoom({...form})
        }

        return {
            createRooms,
            errors,
            form,
            isLoading,
            NumbersOnly
        }
    }
}
</script>
