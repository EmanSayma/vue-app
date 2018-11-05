class Errors{
    constructor(){
        this.errors={};
    }


    has(field){
        //if this.errors contains a field property
        return this.errors.hasOwnProperty(field);
    }

    any(){
        return Object.keys(this.errors).length >0;
    }

    get(field){
       if(this.errors[field]){
          return this.errors[field][0];
       }
    }

    record(errors){
        this.errors=errors;

    }
    clear(field) {
        if (field){
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}

class Form{
    constructor(data){
        this.originalData= data;

        for(let field in data){
            this[field]=data[field];
        }

        this.errors= new Errors();
    }

    data(){
        //clone the form object
       let data = Object.assign({},this);

       delete data.originalData;
       delete data.errors;

       return data;
    }


    reset(){
        for(let field in this.originalData){
            this[field]='';
        }
    }

    submit(requestType,url){
        axios[requestType](url, this.data())
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this))
    }

    onSuccess(response){
        alert(response.data.message);
        this.errors.clear();
        this.reset();
    }

    onFail(error){
        this.errors.record(error.response.data.errors)
    }
}



new Vue({
    el:"#app",
    data:{
       skills:[],
        form: new Form({
            name:'',
            description:''
        }),

    },

    mounted(){
        axios.get('/skills').then(response => this.skills=response.data);
    },
    methods:{
        onSubmit(){
            this.form.submit('post','/projects');

        }
    }
});
