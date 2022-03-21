<template>
    <Loading v-if="isLoading"/>
    <form  @submit.prevent="handleCreatePeople">
        <div class="row">
            <div class="card col-12">
                <div class="card-header d-flex align-items-center">
                    <div class="col-10"><h4>THÊM NGƯỜI VÀO PHÒNG</h4></div>
                    <div class="col-2" style="text-align: end">
                        <button type="submit" class="btn btn-primary btn-action_save">LƯU</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div id="accordion1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        THÔNG TIN
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="content-errors" v-if="errors">
                                        <div class="alert alert-danger"  v-for="error in errors"> {{error}}</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Phòng</label>
                                            <select class="form-control" v-model="form.room_id">
                                                <option value="">Vui lòng chọn phòng</option>
                                                <option :value="room.id" v-for="room in rooms">Phòng {{ room.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" v-model="form.full_name" class="form-control" placeholder="Họ và tên">
                                        </div>
                                        <div class="form-group">
                                            <label>Năm sinh</label>
                                            <input type="text" v-model="form.date_of_birth" class="form-control" placeholder="Năm sinh">
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text" v-model="form.phone_number" class="form-control" placeholder="Số điện thoại">
                                        </div>
                                        <div class="form-group">
                                            <label>CMND/CCCD</label>
                                            <input type="text" v-model="form.cmnd" class="form-control" placeholder="CMND/CCCD">
                                        </div>
                                        <div class="form-group">
                                            <label>Quê quán</label>
                                            <input type="text" v-model="form.place_of_birth" class="form-control" placeholder="Quê quán">
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
    import { reactive, onMounted } from "vue";
    import useRoom from "../../../functions/room";
    import Loading from "../../layouts/Loading";

    export default {
        components: {Loading},
        setup() {

            const form = reactive({
                'full_name' : '',
                'phone_number' : '',
                'cmnd': '',
                'place_of_birth': '',
                'date_of_birth': '',
                'room_id': ''
            });

            const { createPeople,errors,isLoading } = usePeople();
            const { getRooms,rooms } = useRoom();

            onMounted( () => {
                getRooms();
            })

            const handleCreatePeople = async () => {
                await createPeople({...form});
            }

            return {
                rooms,
                form,
                errors,
                isLoading,
                handleCreatePeople
            }
        }
    }
</script>
