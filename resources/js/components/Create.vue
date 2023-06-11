<template>
    <div class="card my-4">
        <div class="card-body">
            <div class="mb-2" v-if="data.error">
                <ul v-for="(errorArray, index) in data.error"
                :key="index" class="list-group">
                    <li v-for="(error, index) in errorArray"
                    :key="index" class="list-group-item bg-danger text-white">
                        {{ error }}
                    </li>
                </ul>
            </div>
            <form @submit.prevent="store">
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input v-model="data.url.data.long_url" type="text" class="form-control form-control-lg" placeholder="Enter a long URL">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import axios from 'axios';
import { reactive, inject } from 'vue';


    const user_id = inject('user_id');
    const data = reactive({
        url: {
            data: {
                long_url : '',
            }
        },
        error: null
    });
    const store = async() => {
        try {
            const response = await axios.post('/api/add', {
                long_url: data.url.data.long_url,
                short_url: data.url.data.short_url,
                user_id
            });
            data.url = {
                data: {
                    long_url : '',
                }
            };
            data.error = null;
        } catch (error) {
            data.error = error.response.data.errors;
        }
    }
    
</script>
  