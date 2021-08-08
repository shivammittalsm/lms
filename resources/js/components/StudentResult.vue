<template>
    <div>
        <div class="col-12">
            <span class="float-right alert-info">We are calculating <u><strong>RANK</strong></u> based on percentage marks</span>
        </div>
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th class="border">Record</th>
                    <th>Student Name</th>
                    <th>Email Id</th>
                    <th>Course Name</th>
                    <th>Rank</th>
                    <th>Marks in %</th>
                    <th>Total attempt</th>
                    <th><a href="http://lms.test/export/result">Export</a></th>
                </tr>
            </thead>
                <tbody>
                    <tr v-for="(result,index) in results" :key="index++">
                        <td class="border">{{index}}</td>
                        <td>{{result['name']}}</td>
                        <td>{{result['email']}}</td>
                        <td>{{result['course']}}</td>
                        <td>{{index}}</td>
                        <td>{{result['percentage']}}%</td>
                        <td>{{result['attempt']}}</td>
                    </tr>
                </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: ['results'],
}
</script>
