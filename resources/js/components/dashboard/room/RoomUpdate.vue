<template>
    <Loading v-if="isLoading"/>
    <div id="accordion">
        <form @submit.prevent="handleUpdateRoom">
            <div class="card">
                <div class="card-header row" id="headingOne">
                    <div class="col-12 d-flex align-items-center">
                        <h5 class="mb-0 col-11">
                            CHỈNH SỬA THÔNG TIN
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
                            <input type="number" v-on:keypress="NumbersOnly" class="form-control" v-model="room.name"  placeholder="Tên phòng">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>
<script>
    import useRoom from "../../../functions/room";
    import { onMounted,reactive } from "vue";
    import { useRoute } from "vue-router";
    import Loading from "../../layouts/Loading";
    import common from "../../../common/common";

    export default {
        components: {Loading},
        props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { getRoom,room,updateRoom,errors,isLoading } = useRoom();
            const { NumbersOnly } = common();

            const handleUpdateRoom = async () => {
                await updateRoom(props.id);
            }

            onMounted(getRoom(props.id));

            return {
                handleUpdateRoom,
                room,
                errors,
                isLoading,
                NumbersOnly
            }

        }
    }
</script>
