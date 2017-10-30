<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <pages v-if="meta && topics.length" :pagination="meta.pagination"></pages>
                        <topic v-for="topic in topics" :topic="topic" :key="topic.id"></topic>
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
                topics: [],
                meta: null
            }
        },
        methods: {
            getTopics (page) {
            axios.get('/topics?page=' + page).then((res) => {
                    this.topics = res.data.data;
                    this.meta = res.data.meta;
                })
            }
        },
        mounted() {
            this.getTopics(1)

            eventHub.$on('switched-page', this.getTopics)
        }
    }
</script>
