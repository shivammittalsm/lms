<template>
    <div>
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Question</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(question,index) in questions" :key="index++">
                    <td>{{ index }}</td>
                    <td>{{ question['title'] }}</td>
                    <td><button class="btn btn-primary" @click="edit(question['id'])">edit</button></td>
                    <td>
                        <button class="btn btn-danger" @click="deleteQuestion(question['id'])">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: 'show-question',
    props: ['questions'],
    methods: {
        edit(id){
            window.location.href = "http://lms.test/questions/"+id+"/edit";
        },
        deleteQuestion(id){
            axios.delete('/questions/'+id)
            .then(response =>{
                location.reload();
            })
            .catch({
            })
        }
    }
}
</script>
