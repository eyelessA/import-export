<script>
import axios from 'axios';

export default {
    data() {
        return {
            file: null,
            message: ''
        };
    },
    methods: {
        handleFileChange(event) {
            this.file = event.target.files[0];
        },
        async handleSubmit() {
            if (!this.file) {
                this.message = 'Пожалуйста, выберите файл.';
                return;
            }

            const formData = new FormData();
            formData.append('file', this.file);

            try {
                const response = await axios.post('/', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if (response.status === 200) {
                    window.location.href = '/products';
                } else {
                    this.message = 'Ошибка при загрузке файла.';
                }
            } catch (error) {
                console.error('Ошибка при загрузке файла:', error);
                this.message = 'Ошибка при загрузке файла.';
            }
        }
    }
};
</script>

<template>
    <form class="max-w-sm mx-auto" @submit.prevent="handleSubmit">
        <div class="mb-5">
            <input type="file" @change="handleFileChange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
            <p v-if="message">{{ message }}</p>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</template>


<style scoped>

</style>
