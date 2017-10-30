<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <pages v-if="meta && users.length" :pagination="meta.pagination"></pages>
                        <div class="media" v-for="user in users">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" :src="user.avatar" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><a href="#">{{ user.name }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import eventHub from '../events';

    export default {
        data () {
            return {
                users: [],
                meta: null
            }
        },
        methods: {
            getUsers (page) {
                axios.get('/users?page=' + page).then((res) => {
                    this.users = res.data.data;
                    this.meta = res.data.meta;
                })
            }
        },
        mounted() {
            this.getUsers(1)

            eventHub.$on('switched-page', this.getUsers)
        }
    }
</script>
