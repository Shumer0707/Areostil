<template>
    <div>
        <h1 class="text-2xl text-blue-600">Привет из Vue!</h1>
        <div>Name: {{ name }}</div>
        <button @click="">sayHallo</button>
        <div v-for="(person, index) in persons" :key="index">
            {{ person.name }}
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'ExampleComponent',

    data(){
        return{
            name: 'Vasia',
            persons : null,
        }
    },

    mounted() {
        this.getTest()
    },

    methods: {
        getTest(){
            axios.get('/api/test')
            .then(data => {
                console.log(data);

            })
            .catch(error =>{
                console.log(error);

            })
        }
    },

    // computed: {
    //     moreAge(){
    //         return this.persons.filter(function(person){
    //             return person.age > 20
    //         })
    //     }
    // },

    components: {
    }
};
</script>
