<template>
    <Loading v-if="isLoading"/>
    <form  @submit.prevent="handleUpdatePeople">
        <div class="row">
            <div class="card col-12">
                <div class="card-header d-flex align-items-center">
                    <div class="col-10">THÔNG TIN</div>
                    <div class="col-2" style="text-align: end">
                        <button type="submit" class="btn btn-primary btn-action_save">LƯU</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="accordion1">
                            <div class="card">
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="content-errors" v-if="errors">
                                            <div class="alert alert-danger"  v-for="error in errors"> {{error}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Phòng</label>
                                            <select class="form-control" v-model="people.room_id">
                                                <option value="">Vui lòng chọn phòng</option>
                                                <option :value="room.id" v-for="room in rooms">Phòng {{ room.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" v-model="people.full_name" class="form-control" placeholder="Họ và tên">
                                        </div>
                                        <div class="form-group">
                                            <label>Năm sinh</label>
                                            <input type="text" v-model="people.date_of_birth" class="form-control" placeholder="Năm sinh">
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text" v-model="people.phone_number" class="form-control" placeholder="Số điện thoại">
                                        </div>
                                        <div class="form-group">
                                            <label>CMND/CCCD</label>
                                            <input type="text" v-model="people.cmnd" class="form-control" placeholder="CMND/CCCD">
                                        </div>
                                        <div class="form-group">
                                            <label>Quê quán</label>
                                            <input type="text" v-model="people.place_of_birth" class="form-control" placeholder="Quê quán">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
    import usePeople from "../../../functions/people";
    import { reactive,onMounted } from "vue";
    import useRoom from "../../../functions/room";
    import moment from "moment";
    import Loading from "../../layouts/Loading";

    export default {
        components: {Loading},
        props: {
            people_id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { updatePeople,getPeople,people,errors,isLoading } = usePeople();
            const { getRooms,rooms } = useRoom();
            onMounted( () => {
                getPeople(props.people_id);
                getRooms();
            });


            const handleUpdatePeople = async () => {
                await updatePeople(props.people_id);
            }

            return {
                isLoading,
                errors,
                people,
                rooms,
                handleUpdatePeople
            }
        }
    }
</script>
