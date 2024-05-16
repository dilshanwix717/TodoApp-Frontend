<template>
    <AppLayout>
        <template #content>
            <div class="container">
                <div class="row">
                    <div class="col lg 12 text-center">
                        <h3 class="page-title">Todo List</h3>
                    </div>
                    <div class="col-lg-12" mt-5>
                        <form @submit.prevent="taskStore">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <input class="form-control" v-model="task_form.title" type="text"
                                            placeholder="Enter task" required />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div>
                            <table class="table table-striped table-hover caption-top">
                                <caption>List of todos</caption>
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(task, index) in tasks_list" :key="task.id">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ task.title }}</td>
                                        <td>
                                            <span class="badge bg-warning" v-if="task.done == 0">Not Completed</span>
                                            <span class="badge bg-success" v-else>Completed</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" @click.prevent="deleteTask(task.id)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button
                                                :class="{ 'btn btn-success': task.done == 0, 'btn btn-warning': task.done == 1 }"
                                                type="button" @click.prevent="doneTask(task.id)">
                                                <i
                                                    :class="{ 'fa-solid fa-circle-check': task.done == 0, 'fa-solid fa-times': task.done == 1 }"></i>
                                            </button>
                                            <div class="btn btn-info" @click.prevent="editTask(task.id)">
                                                <i class="fa-solid fa-pen"></i>
                                            </div>

                                            <a href="{{ route('todo.sub', $task.id) }}" class="btn btn-warning ">
                                                <i class="fa-solid fa-list-check"></i> </a>


                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #modal>
            <!-- Modal -->
            <div class="modal fade" id="taskEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="taskEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="taskEditLabel">Edit main task
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="taskEditContent">
                            <form @submit.prevent="taskUpdate">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input class="form-control" v-model="task_update_form.title" type="text"
                                                placeholder="Enter task" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import axios from 'axios'
import 'bootstrap';
import $ from 'jquery';
import 'bootstrap/dist/js/bootstrap.bundle' // import bootstrap js


export default {

    components: {
        AppLayout,
        Link
    },
    // props: {
    //     tasks: Array,
    //     errors: Object
    // },
    data() {
        return {
            task_form: {
                title: ''
            },
            task_update_form: {
                title: ''
            },
            tasks_list: []
        }
    },
    beforeMount() {
        this.getTasks();

    },
    mounted() {
        $(this.$el).modal('show');
    },

    methods: {

        async getTasks() {
            const tasks = (await axios.get(route('todo.list'))).data
            this.tasks_list = tasks

        },

        async taskStore() {
            await axios.post(route('todo.store'), this.task_form)
            await this.getTasks()
            this.task_form.title = ''
        },

        async deleteTask(id) {
            await axios.delete(route('todo.delete', id))
            await this.getTasks()
        },

        async doneTask(id) {
            try {
                await axios.get(route('todo.done', id))
                await this.getTasks()
            } catch (error) {
                console.error(error)
            }
        },
        async editTask(id) {
            const task = (await axios.get(route('todo.get', id))).data
            this.task_update_form = task
            // use bootstrap's modal function
            const taskEditModal = new bootstrap.Modal(document.getElementById('taskEdit'))
            taskEditModal.show()
        },
        async taskUpdate() {
            try {
                await axios.post(route('todo.update', this.task_update_form.id), this.task_update_form);
                this.getTasks();
                this.$refs.taskEditModal.hide(); // Use $refs to access the modal instance
            } catch (error) {
                console.error(error); // Handle errors properly
            }
        },
        // submitForm() {
        //     this.$inertia.post(route('todo.store'), this.task)
        //     this.task.title = ''
        // },

        taskEditModal(task_id) {
            this.$inertia.get(route('todo.edit', task_id), {
                onSuccess: (page) => {
                    $('#taskEdit').modal('show');
                    $('#taskEditContent').html(page.props.modalContent);
                }
            });
        },



    }
}
</script>

<style>
.page-title {
    padding-top: 10vh;
    padding-bottom: 3vh;

    font-size: 40px;
    font-weight: 400;
    align-content: center;
    color: blue;
}
</style>
