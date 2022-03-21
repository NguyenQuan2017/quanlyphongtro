<template>
    <Loading v-if="isLoading"/>
    <div class="card">
        <div class="card-header row" >
            <div class="col-12 d-flex align-items-center">
                <h5 class="mb-0 col-10">
                    THÔNG TIN PHÒNG
                </h5>
                <div class="col-2">
                    <router-link :to="{name: 'room.edit'}" class="btn btn-primary mr-r-5">
                        Chỉnh sửa
                    </router-link>
                    <button @click="handleDeleteRoom" class="btn btn-danger">
                        Xóa
                    </button>
                </div>
            </div>
        </div>

        <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><h4>PHÒNG</h4></label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <h4>{{ room.name }}</h4>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-5" v-for="people in room.peoples">
            <div class="card-header" id="headingOne">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 col-6">
                        THÔNG TIN
                    </h5>
                    <div class="col-6 text-align-end">
                        <router-link :to="{name: 'people.edit', params: {people_id: people.id}}" class="btn btn-primary mr-r-5">
                            Chỉnh sửa
                        </router-link>
                        <button @click="handleDeletePeople(people.id)" class="btn btn-danger">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
            <div clas="card-body">
                <div class="form-group row">
                    <label class="col-4 col-form-label"><p>HỌ VÀ TÊN</p></label>
                    <div class="col-8 d-flex align-items-center">
                        <p>{{people.full_name.toUpperCase()}}</p>
                    </div>
                    <label class="col-4 col-form-label"><p>SỐ ĐIỆN THOẠI</p></label>
                    <div class="col-8 d-flex align-items-center">
                        <p>{{people.phone_number}}</p>
                    </div>
                    <label class="col-4 col-form-label"><p>CMND/CCCD</p></label>
                    <div class="col-8 d-flex align-items-center">
                        <p>{{people.cmnd}}</p>
                    </div>
                    <label class="col-4 col-form-label"><p>QUÊ QUÁN</p></label>
                    <div class="col-8 d-flex align-items-center">
                        <p>{{people.place_of_birth.toUpperCase()}}</p>
                    </div>
                    <label class="col-4 col-form-label"><p>NĂM SINH</p></label>
                    <div class="col-8 d-flex align-items-center">
                        <p>{{ $moment(people.date_of_birth).format('DD/MM/YYYY') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import useRoom from "../../../functions/room";
    import { onMounted } from "vue";
    import Loading from "../../layouts/Loading";
    import usePeople from "../../../functions/people";

    export default {
        components: {Loading},
        props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { getRoom,room,isLoading,deleteRoom } = useRoom();
            const { deletePeople } = usePeople();
            const room_id = props.id;
            onMounted(getRoom(props.id));

            const handleDeletePeople = (id) => {
                deletePeople(id);
            };

            const handleDeleteRoom = () => {
                deleteRoom(props.id);
            }

            return {
                room,
                isLoading,
                room_id,
                handleDeletePeople,
                handleDeleteRoom
            }
        }
    }
</script>
